<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BookingList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;

class BookingListController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'car_id' => 'required|uuid|exists:cars,id|unique:booking_list,car_id,user_id,',
        ]);

        BookingList::create([
            'user_id' => auth()->id(),
            'car_id' => $request->car_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Car added to booking list']);
    }

    public function index()
    {
        $bookingLists = BookingList::with('car')
            ->where('user_id', auth()->id())
            ->get();

        $paymentMethods = PaymentMethod::select('id', 'name')->get();

        return view('frontend.booking-list.index', compact('bookingLists', 'paymentMethods'));
    }
}
