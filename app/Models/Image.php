<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $table = 'image';

    protected $fillable = [
        'image', 
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
