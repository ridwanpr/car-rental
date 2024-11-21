<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Rent;

class DashboardController extends Controller
{
    public function index()
    {
        $rents = Rent::with('car', 'payment')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();

        return view('frontend.dashboard.index', compact('rents'));
    }
}
