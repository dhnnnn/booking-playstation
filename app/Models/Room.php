<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Fasilitas;
use App\Models\Image;

class Room extends Model
{

    use HasFactory;
    
    protected $primaryKey = 'id'; 

    public $incrementing = false;  
          
    protected $keyType = 'string';       


    protected $fillable = [
        'id',
        'room_title',
        'description',
        'price',
        'room_type',
    ];

    public static function boot()
    {
        parent::boot();

        // Event: sebelum data dibuat, generate ID custom
        static::creating(function ($model) {
            // Format: MD + 3 huruf random + 3 angka random, contoh: MDXQZ712
            $model->id = $model->id ?? 'MD' . strtoupper(Str::random(3)) . rand(100, 999);
        });
    }

    public function fasilitas(){
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_room')->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'room_id');
    }
}
