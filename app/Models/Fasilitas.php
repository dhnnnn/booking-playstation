<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Room;


class Fasilitas extends Model
{

    use HasFactory;

    protected $fillable = [
        'nama_fasilitas',
    ];

    public function rooms(){
        return $this->belongsToMany(Room::class, 'fasilitas_room')->withTimestamps();
    }
}
