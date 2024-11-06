<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Car extends Model
{
    use HasUuids;

    protected $fillable = [
        'brand_id',
        'model',
        'tahun',
        'plat_nomor',
        'harga_sewa',
        'jumlah_kursi',
        'bahan_bakar',
        'transmission',
        'slug',
        'status'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }
}
