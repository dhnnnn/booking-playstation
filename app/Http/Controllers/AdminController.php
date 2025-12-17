<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Room;

use App\Models\Fasilitas;

use App\Models\Addons;



class AdminController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {

            $usertype = Auth::user()->usertype;

            if($usertype=='user')
            {
                $room = Room::all();

                return view('home.index', compact('room'));
            }

            else if($usertype=='admin')
            {
                // Fetch dashboard statistics from database
                $totalBookings = \App\Models\Booking::count();
                $activeBookings = \App\Models\Booking::where('status', 'confirmed')
                    ->whereDate('booking_date', today())
                    ->count();
                $availableRooms = \App\Models\RoomUnit::where('status', 'available')->count();
                $todayBookings = \App\Models\Booking::whereDate('created_at', today())->count();
                $totalRevenue = \App\Models\Booking::where('status', 'confirmed')->sum('dp_amount');
                
                // Get recent bookings with room and unit info
                $recentBookings = \App\Models\Booking::with(['roomUnit', 'room'])
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                
                // Get all room units for availability display
                $roomUnits = \App\Models\RoomUnit::with('room')->get();
                
                return view('admin.index', compact(
                    'totalBookings',
                    'activeBookings',
                    'availableRooms',
                    'todayBookings',
                    'totalRevenue',
                    'recentBookings',
                    'roomUnits'
                ));
            }

        }
        else
        {
            return redirect()->back();
        }
    }

    public function home()
    {
        $room = Room::all();

        return view('home.index', compact('room'));
    }

    public function room()
    {
        return view('admin.rooms.index');
    }

    public function create_room()
    {
        return view('admin.rooms.create');
    }

    public function add_room(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'room-name' => 'required|string|max:255',
            'room-description' => 'required|string',
            'price' => 'required|numeric',
            'room-type' => 'required|string',
            'fasilitas' => 'nullable|string',
            'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = new Room();

        $data->room_title = $request->input('room-name');
        $data->description = $request->input('room-description');
        $data->price = $request->input('price');
        $data->room_type = $request->input('room-type');
        $data->total_units = $request->input('total_units');

        $data->save();

        // Handle fasilitas
        if ($request->input('fasilitas')) {
            $fasilitasIds = array_filter(explode(',', $request->input('fasilitas')));
            if (!empty($fasilitasIds)) {
                $data->fasilitas()->attach($fasilitasIds);
            }
        }

        // Handle images
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/rooms'), $imageName);

                $image = new \App\Models\Image();
                $image->image = $imageName;
                $image->room_id = $data->id;
                $image->save();
            }
        }

        notify()->success('Room berhasil ditambahkan!');
        return redirect('/rooms');
    }

    public function rooms()
    {
        $data = Room::all();
        return view('admin.rooms.index', compact('data'));
    }

    public function room_delete($id)
    {
        $data = Room::find($id);
        $data->delete();

        notify()->success('Room berhasil di hapus!');
        return redirect()->back();
    }

    public function room_update($id)
    {
        $data = Room::with('fasilitas')->find($id);
        $fasilitasList = Fasilitas::all();

        return view('admin.rooms.update', compact('data', 'fasilitasList'));
    }

    public function edit_room(Request $request, $id)
    {
        $data = Room::find($id);

        $data->room_title = $request->input('room-name');
        $data->description = $request->input('room-description');
        $data->price = $request->input('price');
        $data->room_type = $request->input('room-type');

        $data->save();

        // Update fasilitas
        if ($request->input('fasilitas')) {
            $fasilitasIds = array_filter(explode(',', $request->input('fasilitas')));
            if (!empty($fasilitasIds)) {
                $data->fasilitas()->sync($fasilitasIds);
            } else {
                $data->fasilitas()->detach();
            }
        } else {
            $data->fasilitas()->detach();
        }

        // Handle images
        if ($request->hasFile('photo')) {
            // Optionally, you might want to delete old images here

            foreach ($request->file('photo') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $path = 'images/rooms';
                $file->move(public_path('images/rooms'), $imageName);

                $image = new \App\Models\Image();
                $image->image = $imageName;
                $image->room_id = $data->id;
                $image->save();
            }
        }
        notify()->success('Room berhasil diupdate!');
        return redirect('/rooms');
    }

    public function add_ons()
    {
        $addons = Addons::all();
        return view('admin.addons.index', compact('addons'));
    }

    public function create_addons()
    {
        return view('admin.addons.create');
    }

    public function add_addons(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'nama-barang' => 'required|string|max:255',
            'deskripsi-barang' => 'required|string',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
            'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $addons = new Addons();

        $addons->addons_title = $request->input('nama-barang');
        $addons->description = $request->input('deskripsi-barang');
        $addons->price = $request->input('harga');
        $addons->stock = $request->input('stock');

        // Handle images
        if ($request->hasFile('photo')) {
            $file = $request->file('photo')[0]; // Assuming only one image for addons
            $imageName = time() . '_' . $file->getClientOriginalName();
            $path = 'images/addons';
            $file->move(public_path('images/addons'), $imageName);
            $addons->image = $imageName;
        }

        $addons->save();

        notify()->success('Add-ons berhasil ditambahkan!');
        return redirect('/addons');
    }

    public function delete_addons($id)
    {
        $addons = Addons::find($id);
        $addons->delete();

        notify()->success('Add-ons berhasil di hapus!');
        return redirect()->back();
    }

    public function addons_update($id)
    {
        $addons = Addons::find($id);
        return view('admin.addons.update', compact('addons'));
    }

    public function edit_addons(Request $request, $id)
    {
        $addons = Addons::find($id);

        $addons->addons_title = $request->input('nama-barang');
        $addons->description = $request->input('deskripsi-barang');
        $addons->price = $request->input('harga');
        $addons->stock = $request->input('stock');

        // Handle images
        if ($request->hasFile('photo')) {
            $file = $request->file('photo')[0]; // Assuming only one image for addons
            $imageName = time() . '_' . $file->getClientOriginalName();
            $path = 'images/addons';
            $file->move(public_path('images/addons'), $imageName);
            $addons->image = $imageName;
        }

        $addons->save();

        notify()->success('Add-ons berhasil diupdate!');
        return redirect('/addons');
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $addon = Addons::find($id);
        
        if (!$addon) {
            return response()->json([
                'success' => false,
                'message' => 'Addon not found'
            ], 404);
        }

        $addon->stock = $request->stock;
        $addon->save();

        // Set session notification for page reload
        notify()->success('Stock berhasil diupdate!');

        return response()->json([
            'success' => true,
            'message' => 'Stock berhasil diupdate!',
            'new_stock' => $addon->stock
        ]);
    }

    public function bookings()
    {
        $bookings = \App\Models\Booking::with(['roomUnit.room', 'bookingAddons.addon'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.bookings.index', compact('bookings'));
    }

    public function searchBookings(Request $request)
    {
        $search = $request->input('search');
        
        $bookings = \App\Models\Booking::with(['roomUnit.room', 'bookingAddons.addon'])
            ->where(function($query) use ($search) {
                $query->where('booking_code', 'LIKE', "%{$search}%")
                    ->orWhere('full_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone_number', 'LIKE', "%{$search}%")
                    ->orWhereHas('roomUnit.room', function($q) use ($search) {
                        $q->where('room_title', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json(['bookings' => $bookings]);
    }


}
