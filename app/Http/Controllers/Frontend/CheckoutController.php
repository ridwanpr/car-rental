<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rent;
use App\Models\User;
use App\Models\Payment;
use App\Models\BookingList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\PaymentProofUploaded;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'rentals' => 'required|array|min:1',
            'rentals.*.car_id' => 'required|exists:cars,id',
            'rentals.*.rent_start' => 'required|date',
            'rentals.*.rent_end' => 'required|date|after:rentals.*.rent_start',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'rentals.*.price_per_day' => 'required|numeric|min:0',
            'rentals.*.total_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            foreach ($validated['rentals'] as $rental) {
                if (!$this->checkCarAvailability($rental['car_id'], $rental['rent_start'], $rental['rent_end'])) {
                    throw new \Exception('Car is not available for the chosen dates.');
                }
            }

            $payment = $this->createPayment($validated['total_amount'], $validated['payment_method']);

            foreach ($validated['rentals'] as $rental) {
                $this->createRental($rental, $payment->id);
            }

            session([
                'checkout_data' => [
                    'rentals' => $validated['rentals'],
                    'total_amount' => $validated['total_amount'],
                    'payment_method' => $validated['payment_method'],
                    'payment' => $payment
                ]
            ]);

            $this->deleteBookingList();

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => route('payment-created', ['id' => $payment->id])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Checkout failed. ' . $e->getMessage()
            ], 500);
        }
    }

    protected function createPayment($totalAmount, $paymentMethod)
    {
        return Payment::create([
            'user_id' => auth()->id(),
            'payment_code' => 'PAY-' . strtoupper(Str::random(8)),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $paymentMethod
        ]);
    }

    protected function createRental($rentalData, $paymentId)
    {
        Rent::create([
            'user_id' => auth()->id(),
            'car_id' => $rentalData['car_id'],
            'payment_id' => $paymentId,
            'rental_code' => 'RENT-' . strtoupper(Str::random(8)),
            'rent_start' => $rentalData['rent_start'],
            'rent_end' => $rentalData['rent_end'],
            'price_per_day' => $rentalData['price_per_day'],
            'total_price' => $rentalData['total_price'],
            'status' => 'pending'
        ]);
    }

    protected function deleteBookingList()
    {
        BookingList::where('user_id', auth()->id())->delete();
    }

    private function checkCarAvailability($carId, $startDate, $endDate)
    {
        $overlappingRentals = Rent::where('car_id', $carId)
            ->where(function ($query) {
                $query->where('status', 'approved')
                    ->orWhere('status', 'pending');
            })
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('rent_start', [$startDate, $endDate])
                    ->orWhereBetween('rent_end', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('rent_start', '<=', $startDate)
                            ->where('rent_end', '>=', $endDate);
                    });
            })
            ->exists();

        return !$overlappingRentals;
    }

    public function paymentCreated($id)
    {
        $payment = Payment::with('rent')
            ->where('id', $id)
            ->first();

        $paymentMethod = PaymentMethod::find($payment->payment_method);

        return view('frontend.payment.show', compact('payment', 'paymentMethod'));
    }

    public function uploadPaymentProof(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|max:2048',
        ]);

        $payment = Payment::where('user_id', auth()->id())
            ->where('id', $request->payment_id)
            ->first();

        $fileName = Str::random(10) . '.' . $request->file('payment_proof')->getClientOriginalExtension();

        $payment->update([
            'payment_proof' => $request->file('payment_proof')->storeAs('payment_proofs', $fileName),
            'status' => 'waiting confirmation'
        ]);

        $admins = User::where('role_id', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new PaymentProofUploaded($payment));
        }

        session()->flash('success', 'Payment created successfully.');
        return redirect()->route('user.dashboard');
    }
}
