<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Rent;
use Illuminate\Http\Request;
use App\Exports\RentalsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportPdf(Request $request)
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

        $pdf = Pdf::loadView('backend.report.pdf', compact('rentals', 'startDate', 'endDate', 'status'));
        return $pdf->stream('rental_report.pdf');
    }

    public function exportExcel(Request $request)
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

        return Excel::download(new RentalsExport($rentals), 'rental_report.xlsx');
    }
}
