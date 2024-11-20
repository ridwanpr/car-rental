<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rent;
use App\Models\Payment;
use App\Models\BookingList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

            $this->deleteBookingList();

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => route('payment-created')
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
            'status' => 'ongoing'
        ]);
    }

    protected function deleteBookingList()
    {
        BookingList::where('user_id', auth()->id())->delete();
    }

    private function checkCarAvailability($carId, $startDate, $endDate)
    {
        $overlappingRentals = Rent::where('car_id', $carId)
            ->where('status', 'ongoing')
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

    public function paymentCreated()
    {
        return view('frontend.payment.show');
    }
}
