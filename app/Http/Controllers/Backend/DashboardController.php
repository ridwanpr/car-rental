<?php

namespace App\Http\Controllers\Backend;

use App\Models\Rent;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $countActiveRental = Rent::where('status', 'approved')->count();
        $countCompletedRental = Rent::where('status', 'returned')->count();
        $countTotalCarBrands = Brand::count();
        $countTotalCars = Car::count();
        $sumRevenueGenerated = Payment::sum('total_amount') + Rent::sum('penalty_amount');
        $countPendingPayment = Payment::where('status', 'pending')->where('payment_proof', '!=', null)->count();
        $countTotalUsers = User::where('role_id', User::ROLE_USER)->count();

        $months = [];
        $revenuesData = array_fill(1, 12, 0);

        $revenueData = DB::table('payments')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_amount) as total_amount'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $penaltyData = DB::table('rents')
            ->select(DB::raw('MONTH(return_date) as month'), DB::raw('SUM(penalty_amount) as penalty_amount'))
            ->groupBy(DB::raw('MONTH(return_date)'))
            ->get();

        foreach ($revenueData as $data) {
            if (isset($data->month) && $data->month >= 1 && $data->month <= 12) {
                $revenuesData[$data->month] += $data->total_amount;
            }
        }

        foreach ($penaltyData as $data) {
            if (isset($data->month) && $data->month >= 1 && $data->month <= 12) {
                $revenuesData[$data->month] += $data->penalty_amount;
            }
        }

        $revenuesData = array_values($revenuesData);

        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create(null, $i, 1)->format('F');
        }

        return view('backend.dashboard', compact(
            'countActiveRental',
            'countCompletedRental',
            'countTotalCarBrands',
            'countTotalCars',
            'sumRevenueGenerated',
            'countPendingPayment',
            'countTotalUsers',
            'months',
            'revenuesData'
        ));
    }
}
