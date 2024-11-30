<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rent;
use Illuminate\Http\Request;

class RentRequestController extends Controller
{
    public function index()
    {
        $requests = Rent::where('rents.status', 'pending')
            ->join('payments', 'rents.payment_id', '=', 'payments.id')
            ->leftJoin('cars', 'rents.car_id', '=', 'cars.id')
            ->where('payments.payment_proof', '!=', null)
            ->where('payments.status', 'approved')
            ->select('rents.*', 'payments.*', 'cars.*', 'rents.status as rent_status')
            ->get();

        return view('backend.rent-request.index', compact('requests'));
    }

    public function show($id)
    {

    }
}
