<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'payment_code',
        'total_amount',
        'status',
        'payment_method'
    ];
}