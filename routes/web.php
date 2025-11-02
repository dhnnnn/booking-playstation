<?php

use App\Models\Room;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\SroomController;

Route::get('/', [AdminController::class, 'home']);

Route::get('/home', [AdminController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {

    //menage rooms
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::get('/rooms/create', [AdminController::class, 'create_room']);
    Route::post('add_room', [AdminController::class, 'add_room']);
    Route::get('/rooms/delete/{id}', [AdminController::class, 'room_delete']);
    Route::get('/rooms/update/{id}', [AdminController::class, 'room_update']);
    Route::post('/edit_room/{id}', [AdminController::class, 'edit_room']);

    //menage addons
    Route::get('/addons', [AdminController::class, 'add_ons'])->name('add_ons');
    Route::post('add_addons', [AdminController::class, 'add_addons']);
    Route::get('/addons/create', [AdminController::class, 'create_addons']);
    Route::get('/addons/delete/{id}', [AdminController::class, 'delete_addons']);
    Route::get('/addons/update/{id}', [AdminController::class, 'addons_update']);
    Route::post('/edit_addons/{id}', [AdminController::class, 'edit_addons']);

});


Route::get('/room/detail/{id}', [SroomController::class, 'detail_room']);



Route::get('/about', function() {
    return view('about.index');
});

Route::get('/contact', function() {
    return view('contact.index');
});

Route::get('/gallery', function() {
    return view('gallery.index');
});

Route::get('/room', function() {
    $room = Room::all();
    return view('room.index', compact('room'));
});



