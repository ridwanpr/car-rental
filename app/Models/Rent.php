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
        'status'
    ];
}
