<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Rent;
use App\Models\Payment;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentRequestController extends Controller
{
    public function index()
    {
        $requests = Rent::join('payments', 'rents.payment_id', 'payments.id')
            ->leftJoin('cars', 'rents.car_id', 'cars.id')
            ->where('payments.payment_proof', '!=', null)
            ->where('payments.status', 'approved')
            ->select(
                'rents.*',
                'rents.id as rent_id',
                'payments.*',
                'payments.id as payment_id',
                'cars.*',
                'rents.status as rent_status'
            )->get();

        return view('backend.rent-request.index', compact('requests'));
    }

    public function show($id)
    {
        $rentRequest = Rent::join('cars', 'rents.car_id', 'cars.id')
            ->join('users', 'rents.user_id', 'users.id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->where('rents.id', $id)
            ->select(
                'rents.*',
                'rents.id as rent_id',
                'cars.*',
                'rents.status as rent_status',
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'user_details.phone as user_phone',
            )->first();

        return response()->json([
            'data' => $rentRequest,
            'status' => 'success',
            'message' => 'Rent details fetched successfully'
        ]);
    }

    public function approveRent($id)
    {
        $rent = Rent::find($id);
        $rent->status = 'approved';
        $rent->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Rent approved successfully'
        ]);
    }

    public function rejectRent(Request $request, int $id)
    {
        $rent = Rent::findOrFail($id);
        $rent->status = 'declined';
        $rent->decline_message = $request->decline_message;
        $rent->save();

        $userDetail = UserDetail::where('user_id', $rent->user_id)->firstOrFail();
        $userDetail->balance += $rent->total_price;
        $userDetail->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Rent declined successfully',
        ]);
    }

    public function checkPenalty($id)
    {
        $rent = Rent::findOrFail($id);
        $currentDate = now();
        $returnDate = Carbon::parse($rent->rent_end);

        $isLate = $currentDate->gt($returnDate);
        $daysLate = (int) abs($currentDate->diffInDays($returnDate));
        $penaltyAmount = $daysLate * $rent->price_per_day;

        return response()->json([
            'is_late' => $isLate,
            'days_late' => $daysLate,
            'return_deadline' => $returnDate->format('d M Y'),
            'price_per_day' => $rent->price_per_day,
            'price_per_day_formatted' => number_format($rent->price_per_day, 0, ',', '.'),
            'penalty_amount' => $penaltyAmount,
            'penalty_amount_formatted' => number_format($penaltyAmount, 0, ',', '.')
        ]);
    }

    public function returnCar(Request $request, $id)
    {
        $rent = Rent::findOrFail($id);
        $currentDate = now();
        $returnDate = Carbon::parse($rent->rent_end);

        $isLate = $currentDate->gt($returnDate);
        $daysLate = (int) abs($currentDate->diffInDays($returnDate));
        $penaltyAmount = $daysLate * $rent->price_per_day;

        $rent->update([
            'status' => 'returned',
            'return_date' => $currentDate,
            'days_late' => $daysLate,
            'penalty_amount' => $penaltyAmount,
        ]);

        return response()->json([
            'is_late' => $isLate,
            'days_late' => $daysLate,
            'return_deadline' => $returnDate->format('d M Y'),
            'price_per_day' => $rent->price_per_day,
            'price_per_day_formatted' => number_format($rent->price_per_day, 0, ',', '.'),
            'penalty_amount' => $penaltyAmount,
            'penalty_amount_formatted' => number_format($penaltyAmount, 0, ',', '.'),
            'status' => $isLate ? 'warning' : 'success',
            'message' => 'Car returned successfully',
        ]);
    }
}
