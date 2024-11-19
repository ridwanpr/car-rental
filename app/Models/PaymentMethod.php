<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_method';

    protected $fillable = [
        'id',
        'name',
        'description',
        'account_number',
        'account_name',
        'bank_name',
    ];

    public $incrementing = false;
    public $keyType = 'string';
}
