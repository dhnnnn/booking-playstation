<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RoomUnit extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'room_id',
        'unit_name',
        'status',
    ];

    // Generate ID otomatis seperti Room
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = $model->id ?? 'RU' . strtoupper(Str::random(3)) . rand(100, 999);
        });
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
