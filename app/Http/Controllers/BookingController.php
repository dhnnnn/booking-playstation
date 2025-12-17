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

    public function checkAvailability(Request $request)
    {
        $bookingDate = $request->input('booking_date');
        $bookingTime = $request->input('booking_time');
        $duration = $request->input('duration');
        $roomId = $request->input('room_id');

        if (!$bookingDate || !$bookingTime || !$duration || !$roomId) {
            return response()->json(['error' => 'Missing required parameters'], 400);
        }

        // Get all units for this room
        $units = RoomUnit::where('room_id', $roomId)->get();

        $availableUnits = [];

        foreach ($units as $unit) {
            // Get all confirmed bookings for this unit on this date
            $existingBookings = \App\Models\Booking::where('unit_id', $unit->id)
                ->where('status', 'confirmed')
                ->where('booking_date', $bookingDate)
                ->get();

            $hasConflict = false;

            // Parse requested time
            $requestedStart = strtotime($bookingDate . ' ' . $bookingTime);
            $requestedEnd = $requestedStart + ($duration * 3600);

            // Check each existing booking for overlap
            foreach ($existingBookings as $booking) {
                $existingStart = strtotime($bookingDate . ' ' . $booking->booking_time);
                $existingEnd = $existingStart + ($booking->duration * 3600);

                // Check for overlap: (StartA < EndB) and (EndA > StartB)
                if ($requestedStart < $existingEnd && $requestedEnd > $existingStart) {
                    $hasConflict = true;
                    break;
                }
            }

            $availableUnits[] = [
                'id' => $unit->id,
                'name' => $unit->unit_name,
                'status' => $hasConflict ? 'tidak tersedia' : 'tersedia',
                'type' => strtolower($unit->room->room_type),
            ];
        }

        return response()->json([
            'success' => true,
            'units' => $availableUnits
        ]);
    }


}
