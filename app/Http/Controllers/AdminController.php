<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Room;

use App\Models\Fasilitas;



class AdminController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {

            $usertype = Auth::user()->usertype;

            if($usertype=='user')
            {
                return view('home.index');
            }

            else if($usertype=='admin')
            {
                return view('admin.index');
            }

        }
        else
        {
            return redirect()->back();
        }
    }

    public function home()
    {
        return view('home.index');
    }

    public function room()
    {
        return view('admin.room');
    }

    public function create_room()
    {
        return view('admin.create');
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

        $data->save();

        // Handle fasilitas
        if ($request->input('fasilitas')) {
            $fasilitasIds = explode(',', $request->input('fasilitas'));
            $data->fasilitas()->attach($fasilitasIds);
        }

        // Handle images
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $imageName);

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
        return view('admin.room', compact('data'));
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

        return view('admin.update', compact('data', 'fasilitasList'));
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
            $fasilitasIds = explode(',', $request->input('fasilitas'));
            $data->fasilitas()->sync($fasilitasIds);
        } else {
            $data->fasilitas()->detach();
        }

        // Handle images
        if ($request->hasFile('photo')) {
            // Optionally, you might want to delete old images here

            foreach ($request->file('photo') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $imageName);

                $image = new \App\Models\Image();
                $image->image = $imageName;
                $image->room_id = $data->id;
                $image->save();
            }
        }
        notify()->success('Room berhasil diupdate!');
        return redirect('/rooms');
    }
}
