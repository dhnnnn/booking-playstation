<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;

class WhatsAppService
{
    protected $apiToken;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiToken = env('FONNTE_API_TOKEN', '');
        $this->baseUrl = 'https://api.fonnte.com/send';
    }

    /**
     * Send booking confirmation via WhatsApp
     */
    public function sendBookingConfirmation(Booking $booking)
    {
        try {
            if (empty($this->apiToken)) {
                Log::error('WhatsApp API token is not configured');
                return false;
            }
            
            $phoneNumber = $this->formatPhoneNumber($booking->phone_number);
            $invoiceUrl = url('/invoice/' . $booking->id);
            $message = $this->formatBookingMessage($booking, $invoiceUrl);
            
            $response = Http::withHeaders([
                'Authorization' => $this->apiToken,
            ])->post($this->baseUrl, [
                'target' => $phoneNumber,
                'message' => $message,
                'countryCode' => '62',
            ]);

            Log::info('WhatsApp notification sent', [
                'booking_code' => $booking->booking_code,
                'phone' => $phoneNumber,
                'success' => $response->successful()
            ]);

            return $response->successful();
            
        } catch (\Exception $e) {
            Log::error('WhatsApp send failed', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }

    /**
     * Format booking confirmation message
     */
    protected function formatBookingMessage(Booking $booking, string $invoiceUrl): string
    {
        $roomName = $booking->roomUnit->room->room_title ?? 'N/A';
        $date = \Carbon\Carbon::parse($booking->booking_date)->format('d F Y');
        $formattedPrice = 'Rp ' . number_format($booking->total_price, 0, ',', '.');

        return "Halo *{$booking->full_name}*! 🎮\n\n" .
               "Terima kasih telah melakukan booking di MD Gaming!\n\n" .
               "📋 *Detail Booking:*\n" .
               "- Booking Code: {$booking->booking_code}\n" .
               "- Room: {$roomName}\n" .
               "- Tanggal: {$date}\n" .
               "- Jam: {$booking->booking_time}\n" .
               "- Durasi: {$booking->duration} jam\n\n" .
               "💳 Total Pembayaran: {$formattedPrice}\n\n" .
               "📄 Lihat invoice lengkap di:\n{$invoiceUrl}\n\n" .
               "Sampai jumpa di MD Gaming! 🎉";
    }

    /**
     * Format phone number to WhatsApp format (62xxx)
     */
    protected function formatPhoneNumber(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if (substr($phone, 0, 1) === '0') {
            $phone = substr($phone, 1);
        }
        
        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
}
