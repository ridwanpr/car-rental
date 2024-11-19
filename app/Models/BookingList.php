<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingList extends Model
{
    protected $table = 'booking_list';

    protected $fillable = [
        'user_id',
        'car_id',
        'quantity',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
