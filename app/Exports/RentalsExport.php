<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RentalsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $rentals;

    public function __construct($rentals)
    {
        $this->rentals = $rentals;
    }

    public function collection()
    {
        return $this->rentals;
    }

    public function headings(): array
    {
        return [
            '#',
            'Payment Code',
            'Rental Code',
            'Car Model',
            'Rented By',
            'Rent Start',
            'Rent End',
            'Return Date',
            'Penalty',
            'Status',
            'Message',
        ];
    }

    public function map($rental): array
    {
        return [
            $rental->id,
            $rental->payment->payment_code,
            $rental->rental_code,
            $rental->car->model,
            $rental->user->name,
            $rental->rent_start,
            $rental->rent_end,
            $rental->return_date ?? '-',
            'Rp. ' . number_format($rental->penalty_amount, 0, ',', '.'),
            ucfirst($rental->status),
            \Illuminate\Support\Str::limit($rental->decline_message ?? '-', 50),
        ];
    }
}
