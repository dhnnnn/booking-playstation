<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Booking;
use App\Models\BookingAddon;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createPayment(Request $request)
    {
        // Debug: Log the incoming request data
        \Log::info('Payment request data:', $request->all());

        // Validate request
        $request->validate([
            'fullName' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|email',
            'bookingDate' => 'required|date',
            'bookingTime' => 'required',
            'duration' => 'required|integer|min:1',
            'room_id' => 'required|string',
            'unit_id' => 'required|string',
            'total_harga' => 'required|numeric',
            'total_dp' => 'required|numeric',
            'addons_price' => 'required|numeric',
        ]);

        // Extract data
        $fullName = $request->input('fullName');
        $email = $request->input('email');
        $phoneNumber = $request->input('phoneNumber');
        $bookingDate = $request->input('bookingDate');
        $bookingTime = $request->input('bookingTime');
        $duration = $request->input('duration');
        $roomId = $request->input('room_id');
        $unitId = $request->input('unit_id');
        $totalHarga = $request->input('total_harga');
        $totalDp = $request->input('total_dp');
        $addonsPrice = $request->input('addons_price');


        // ===== VALIDATION: Check if unit is already booked =====
        $existingBookings = Booking::where('unit_id', $unitId)
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
                \Log::warning('Booking conflict detected', [
                    'unit_id' => $unitId,
                    'booking_date' => $bookingDate,
                    'booking_time' => $bookingTime,
                    'duration' => $duration,
                    'existing_booking_id' => $booking->id,
                    'existing_booking_time' => $booking->booking_time,
                    'existing_duration' => $booking->duration
                ]);
                break;
            }
        }

        if ($hasConflict) {
            return response()->json([
                'error' => 'Maaf, ruangan yang Anda pilih sudah tidak tersedia untuk waktu tersebut. Silakan pilih ruangan lain atau waktu yang berbeda.'
            ], 422);
        }


        // Process addons
        $bookingAddons = [];
        if ($request->has('addons')) {
            foreach ($request->input('addons') as $addonId => $quantity) {
                if ($quantity > 0) {
                    // Get addon details
                    $addon = \App\Models\Addons::find($addonId);
                    if ($addon) {
                        // Validate stock availability
                        $availableStock = (int)$addon->stock;
                        if ($availableStock < $quantity) {
                            return response()->json([
                                'error' => "Stock {$addon->addons_title} tidak mencukupi. Tersedia: {$availableStock}, Diminta: {$quantity}"
                            ], 422);
                        }

                        $bookingAddons[] = [
                            'addon_id' => $addonId,
                            'quantity' => $quantity,
                            'price' => $addon->price,
                            'total_price' => $addon->price * $quantity,
                        ];
                    }
                }
            }
        }


        // Calculate prices
        $roomPrice = $totalHarga - $addonsPrice;

        // 3. Simpan ke database - SESUAI MIGRATION
        $booking = Booking::create([
            'full_name'     => $fullName,
            'email'         => $email,
            'phone_number'  => $phoneNumber,
            'booking_date'  => $bookingDate,
            'booking_time'  => $bookingTime,
            'duration'      => $duration,
            'room_id'       => $roomId,
            'unit_id'       => $unitId,
            'room_price'    => $roomPrice,
            'addons_price'  => $addonsPrice,
            'total_price'   => $totalHarga,
            'dp_amount'     => $totalDp,
            'status'        => 'pending'
        ]);

        // 3.1. Simpan booking_addons
        foreach ($bookingAddons as $addonData) {
            BookingAddon::create([
                'booking_id' => $booking->id,
                'addon_id'   => $addonData['addon_id'],
                'quantity'   => $addonData['quantity'],
                'price'      => $addonData['price'],
                'total_price' => $addonData['total_price']
            ]);
        }

        // Create Midtrans transaction
        $transaction_details = [
            'order_id' => $booking->booking_code . '-' . time(),
            'gross_amount' => $totalDp, // Use DP amount for payment
        ];

        $customer_details = [
            'first_name' => $fullName,
            'email' => $email,
            'phone' => $phoneNumber,
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];

        try {
            \Log::info('Attempting to get Snap Token for order: ' . $transaction_details['order_id']);
            $snapToken = Snap::getSnapToken($transaction);
            \Log::info('Snap Token retrieved success: ' . $snapToken);
            return response()->json([
                'snapToken' => $snapToken,
                'bookingId' => $booking->id
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create payment token: ' . $e->getMessage()], 500);
        }
    }

    public function handleCallback()
    {
        try {
            // Log incoming callback
            \Log::info('Midtrans callback received', [
                'raw_input' => file_get_contents('php://input'),
                'headers' => request()->headers->all()
            ]);

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');

            $notif = new \Midtrans\Notification();

            $transaction = $notif->transaction_status;
            $fraud = $notif->fraud_status;
            $order_id = $notif->order_id;

            \Log::info('Midtrans notification details', [
                'order_id' => $order_id,
                'transaction_status' => $transaction,
                'fraud_status' => $fraud,
                'transaction_id' => $notif->transaction_id,
                'payment_type' => $notif->payment_type
            ]);

            // Parse order_id to get booking_code
            // Format: BK-XXXXXXXX-timestamp (e.g., BK-6MM4LPKJ-1765907341)
            // Remove the timestamp (last segment) to get booking_code
            $parts = explode('-', $order_id);
            array_pop($parts); // Remove timestamp
            $booking_code = implode('-', $parts);

            \Log::info('Parsed booking code', ['booking_code' => $booking_code]);

            $booking = Booking::where('booking_code', $booking_code)->first();

            if (!$booking) {
                \Log::error('Booking not found', ['booking_code' => $booking_code, 'order_id' => $order_id]);
                return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
            }

            // Handle different transaction statuses
            // Map to existing ENUM values: ['pending', 'confirmed', 'cancelled', 'completed']
            if ($transaction == 'capture') {
                if ($fraud == 'accept') {
                    $this->updateBookingStatus($booking, 'confirmed', $notif); // Payment successful
                }
            } else if ($transaction == 'settlement') {
                $this->updateBookingStatus($booking, 'confirmed', $notif); // Payment successful
            } else if ($transaction == 'pending') {
                $this->updateBookingStatus($booking, 'pending', $notif); // Waiting for payment
            } else if ($transaction == 'deny') {
                $this->updateBookingStatus($booking, 'cancelled', $notif); // Payment denied
            } else if ($transaction == 'expire') {
                $this->updateBookingStatus($booking, 'cancelled', $notif); // Payment expired
            } else if ($transaction == 'cancel') {
                $this->updateBookingStatus($booking, 'cancelled', $notif); // Payment cancelled
            }

            \Log::info('Booking status updated successfully', [
                'booking_id' => $booking->id,
                'new_status' => $booking->status
            ]);

            return response()->json(['status' => 'success', 'message' => 'Notification processed']);
        } catch (\Exception $e) {
            \Log::error('Midtrans callback error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    protected function updateBookingStatus(Booking $booking, $status, $notif)
    {
        $oldStatus = $booking->status;

        $booking->update([
            'status' => $status,
            'transaction_id' => $notif->transaction_id,
            'payment_type' => $notif->payment_type,
        ]);

        \Log::info('Booking status updated', [
            'booking_id' => $booking->id,
            'booking_code' => $booking->booking_code,
            'old_status' => $oldStatus,
            'new_status' => $status,
            'transaction_id' => $notif->transaction_id,
            'payment_type' => $notif->payment_type
        ]);

        // Stock management
        if ($status === 'confirmed' && $oldStatus !== 'confirmed') {
            $this->deductAddonStock($booking);
            
            // Send WhatsApp notification
            $this->sendWhatsAppNotification($booking);
        } elseif ($status === 'cancelled' && $oldStatus === 'confirmed') {
            $this->restoreAddonStock($booking);
        }
    }

    protected function sendWhatsAppNotification(Booking $booking)
    {
        try {
            $whatsappService = new \App\Services\WhatsAppService();
            $whatsappService->sendBookingConfirmation($booking);
        } catch (\Exception $e) {
            Log::error('WhatsApp notification error', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function deductAddonStock(Booking $booking)
    {
        $bookingAddons = BookingAddon::where('booking_id', $booking->id)->get();
        
        foreach ($bookingAddons as $bookingAddon) {
            $addon = \App\Models\Addons::find($bookingAddon->addon_id);
            if ($addon) {
                $oldStock = (int)$addon->stock;
                $newStock = max(0, $oldStock - $bookingAddon->quantity);
                $addon->update(['stock' => (string)$newStock]);
                
                \Log::info('Addon stock deducted', [
                    'booking_id' => $booking->id,
                    'addon_id' => $addon->id,
                    'addon_title' => $addon->addons_title,
                    'quantity_deducted' => $bookingAddon->quantity,
                    'old_stock' => $oldStock,
                    'new_stock' => $newStock
                ]);
            }
        }
    }

    protected function restoreAddonStock(Booking $booking)
    {
        $bookingAddons = BookingAddon::where('booking_id', $booking->id)->get();
        
        foreach ($bookingAddons as $bookingAddon) {
            $addon = \App\Models\Addons::find($bookingAddon->addon_id);
            if ($addon) {
                $oldStock = (int)$addon->stock;
                $newStock = $oldStock + $bookingAddon->quantity;
                $addon->update(['stock' => (string)$newStock]);
                
                \Log::info('Addon stock restored', [
                    'booking_id' => $booking->id,
                    'addon_id' => $addon->id,
                    'addon_title' => $addon->addons_title,
                    'quantity_restored' => $bookingAddon->quantity,
                    'old_stock' => $oldStock,
                    'new_stock' => $newStock
                ]);
            }
        }
    }    public function showInvoice($bookingId)
    {
        $booking = Booking::with(['roomUnit.room', 'bookingAddons.addon'])
            ->findOrFail($bookingId);
        
        // Only show invoice for confirmed bookings
        if ($booking->status !== 'confirmed') {
            abort(403, 'Invoice hanya tersedia untuk booking yang sudah confirmed');
        }
        
        return view('invoice.show', compact('booking'));
    }
}
