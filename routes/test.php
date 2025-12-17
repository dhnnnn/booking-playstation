<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\Booking;

// Test endpoint for WhatsApp
Route::get('/test-whatsapp/{booking_id}', function($booking_id) {
    $booking = Booking::with(['roomUnit.room'])->findOrFail($booking_id);
    
    \Log::info('=== MANUAL WhatsApp TEST STARTED ===', [
        'booking_id' => $booking->id,
        'booking_code' => $booking->booking_code,
        'phone' => $booking->phone_number
    ]);
    
    $whatsappService = new \App\Services\WhatsAppService();
    $result = $whatsappService->sendBookingConfirmation($booking);
    
    return response()->json([
        'success' => $result,
        'message' => $result ? 'WhatsApp sent successfully! Check logs for details.' : 'WhatsApp send failed. Check logs for details.',
        'booking_code' => $booking->booking_code,
        'phone' => $booking->phone_number,
        'check_logs' => 'tail -f storage/logs/laravel.log'
    ]);
})->name('test.whatsapp');
