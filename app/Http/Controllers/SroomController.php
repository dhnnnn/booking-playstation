<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;

use App\Models\Fasilitas;






class SroomController extends Controller
{
    public function detail_room($id)
    {
        $room = Room::with('fasilitas', 'images')->find($id);
        $fasilitasList = Fasilitas::all();

        return view('sroom.index', compact('room', 'fasilitasList'));
    }

    public function booking()
    {
        return view('booking.index');
    }
}
