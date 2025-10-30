<?php

use App\Models\Room;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'home']);

Route::get('/home', [AdminController::class, 'index'])->name('home');

Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');

Route::get('/rooms/create', [AdminController::class, 'create_room']);

Route::post('add_room', [AdminController::class, 'add_room']);

Route::get('/delete/{id}', [AdminController::class, 'room_delete']);

Route::get('/update/{id}', [AdminController::class, 'room_update']);

Route::post('/edit_room/{id}', [AdminController::class, 'edit_room']);

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
    return view('room.index');
});



