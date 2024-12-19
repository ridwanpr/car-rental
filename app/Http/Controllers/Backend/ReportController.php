<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('startDate', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('endDate', Carbon::now()->endOfMonth()->toDateString());
        $status = $request->input('status');

        $query = Rent::with(['user', 'car', 'payment'])
            ->whereBetween('rent_start', [$startDate, $endDate]);

        if ($status) {
            $query->where('rents.status', $status);
        } else {
            $query->whereIn('rents.status', ['returned', 'declined']);
        }

        $rentals = $query->get();

        return view('backend.report.index', compact('rentals', 'startDate', 'endDate', 'status'));
    }
}
