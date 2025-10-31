<?php

use App\Models\Room;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'home']);

Route::get('/home', [AdminController::class, 'index'])->name('home');

Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');

Route::get('/addons', [AdminController::class, 'add_ons'])->name('add_ons');

Route::get('/rooms/create', [AdminController::class, 'create_room']);

Route::get('/addons/create', [AdminController::class, 'create_addons']);

Route::post('add_room', [AdminController::class, 'add_room']);

Route::post('add_addons', [AdminController::class, 'add_addons']);

Route::get('/rooms/delete/{id}', [AdminController::class, 'room_delete']);

Route::get('/addons/delete/{id}', [AdminController::class, 'delete_addons']);

Route::get('/rooms/update/{id}', [AdminController::class, 'room_update']);

Route::get('/addons/update/{id}', [AdminController::class, 'addons_update']);

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



