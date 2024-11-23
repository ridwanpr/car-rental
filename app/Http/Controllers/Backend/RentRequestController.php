<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class RentRequestController extends Controller
{
    public function index()
    {
        $requests = Payment::with('rent', 'paymentMethod')
            ->where('status', 'pending')
            ->where('payment_proof', '!=', null)
            ->orderBy('created_at', 'desc')->get();

        return view('backend.rent-request.index', compact('requests'));
    }
}
