<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    // Karena ID bukan auto increment, tambahkan ini
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'booking_code',
        'full_name',
        'phone_number',
        'email',
        'room_id',
        'unit_id',
        'booking_date',
        'booking_time',
        'duration',
        'room_price',
        'addons_price',
        'total_price',
        'dp_amount',        // ✅ Sesuai migration (bukan dp_price)
        'status',
        'transaction_id',
        'payment_type'
    ];

    // Auto generate ID dan booking_code
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->id)) {
                $booking->id = (string) Str::uuid();
            }
            if (empty($booking->booking_code)) {
                $booking->booking_code = 'BK-' . strtoupper(Str::random(8));
            }
        });
    }

    // Relationships
    public function roomUnit()
    {
        return $this->belongsTo(RoomUnit::class, 'unit_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function bookingAddons()
    {
        return $this->hasMany(BookingAddon::class, 'booking_id');
    }
}