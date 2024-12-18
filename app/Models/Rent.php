<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'payment_id',
        'rental_code',
        'rent_start',
        'rent_end',
        'price_per_day',
        'total_price',
        'status',
        'decline_message',
        'return_date',
        'days_late',
        'penalty_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
