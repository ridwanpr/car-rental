<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $fillable = ['user_id', 'phone', 'address', 'id_card', 'balance', 'bank_name', 'account_number', 'account_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
