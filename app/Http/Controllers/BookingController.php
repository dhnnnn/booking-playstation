<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\RoomUnit;
use App\Models\Fasilitas;
use App\Models\Addons;

class BookingController extends Controller
{
    public function booking($id)
    {
        $room = Room::with('units')->findOrFail($id);
        $addons = Addons::All();
        

        // ubah data unit ke format JS
        $units = $room->units->map(function ($unit) {
            return [
                'id' => $unit->id,
                'name' => $unit->unit_name,
                'status' => $unit->status,
                'type' => strtolower($unit->room->room_type),
            ];
        });

        return view('booking.index', compact('room', 'units', 'addons'));
    }
}
