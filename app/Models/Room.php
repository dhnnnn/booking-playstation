<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Fasilitas;
use App\Models\Image;
use App\Models\RoomUnit;

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
        'total_units',
    ];

    public static function boot()
    {
        parent::boot();

        // Event: sebelum data dibuat, generate ID custom
        static::creating(function ($model) {
            // Format: MD + 3 huruf random + 3 angka random, contoh: MDXQZ712
            $model->id = $model->id ?? 'MD' . strtoupper(Str::random(3)) . rand(100, 999);
        });

        static::created(function ($room) {
            // Jika total_units diset
            if ($room->total_units && $room->total_units > 0) {
                // Ambil 3 huruf pertama dari room_title (huruf besar semua)
                $prefix = strtoupper(substr($room->room_title, 0, 3));
                
                for ($i = 1; $i <= $room->total_units; $i++) {
                    $unitName = "{$prefix}{$i}"; // contoh: REG1, REG2, REG3
                    $room->units()->create([
                        'unit_name' => $unitName,
                        'status' => 'tersedia',
                    ]);
                }
            }
        });
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_room')->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'room_id');
    }

    public function units()
    {
        return $this->hasMany(RoomUnit::class, 'room_id');
    }
}
