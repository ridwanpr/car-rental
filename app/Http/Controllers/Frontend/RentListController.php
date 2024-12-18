<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentListController extends Controller
{
    public function index()
    {
        $rents = Rent::join('payments', 'rents.payment_id', 'payments.id')
            ->leftJoin('cars', 'rents.car_id', 'cars.id')
            ->where('rents.user_id', auth()->user()->id)
            ->where('payments.status', '!=', 'pending')
            ->select(
                'rents.*',
                'rents.id as rent_id',
                'payments.*',
                'payments.id as payment_id',
                'cars.*',
                'rents.status as rent_status'
            )->orderBy('rents.created_at', 'desc')
            ->get();


        return view('frontend.rent-list.index', compact('rents'));
    }

    public function show($id)
    {
        $rent = Rent::join('payments', 'rents.payment_id', 'payments.id')
            ->leftJoin('cars', 'rents.car_id', 'cars.id')
            ->where('rents.id', $id)
            ->select(
                'rents.*',
                'rents.id as rent_id',
                'payments.*',
                'payments.id as payment_id',
                'cars.*',
                'rents.status as rent_status'
            )->first();

        return view('frontend.rent-list.show', compact('rent'));
    }
}
