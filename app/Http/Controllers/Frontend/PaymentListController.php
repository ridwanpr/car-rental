<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentListController extends Controller
{
    public function index()
    {
        $payments = Payment::with('paymentMethod')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.payment-list.index', compact('payments'));
    }
}
