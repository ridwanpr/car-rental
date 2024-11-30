<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rent;

class DashboardController extends Controller
{
    public function index()
    {
        $payments = Payment::where('user_id', auth()->id())
            ->with('rent')
            ->where(function ($query) {
                $query->where('status', 'pending')
                    ->orWhere('status', 'waiting confirmation');
            })
            ->get();

        return view('frontend.dashboard.index', compact('payments'));
    }
}
