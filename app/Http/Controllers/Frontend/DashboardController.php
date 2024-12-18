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
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $countActiveRent = Rent::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->count();

        $countTotalRent = Rent::where('user_id', auth()->id())
            ->where('status', 'returned')
            ->count();

        $totalSpent = Payment::where('user_id', auth()->id())
            ->sum('total_amount');

        $countPendingPayment = Payment::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->count();

        return view('frontend.dashboard.index', compact('payments', 'countActiveRent', 'countTotalRent', 'totalSpent', 'countPendingPayment'));
    }
}
