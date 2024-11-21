<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Car extends Model
{
    use HasUuids;

    public const STATUS_ACTIVE = 'tersedia';
    public const STATUS_NOT_ACTIVE = 'tidak tersedia';
    public const STATUS_RENTED = 'disewa';

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

    public function rent()
    {
        return $this->hasMany(Rent::class);
    }
}
