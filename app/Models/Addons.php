<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Addons extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; 

    public $incrementing = false;  
          
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'addons_title',
        'description',
        'price',
        'image',
        'stock'
    ];

    public static function boot()
    {
        parent::boot();

        // Event: sebelum data dibuat, generate ID custom
        static::creating(function ($model) {
            // Format: AD + 3 huruf random + 3 angka random, contoh: ADXQZ712
            $model->id = $model->id ?? 'AD' . strtoupper(\Illuminate\Support\Str::random(3)) . rand(100, 999);
        });
    }
}
