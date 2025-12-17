<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $booking->booking_code }}</title>
    @include('invoice.css')
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <h1>MD Gaming</h1>
                <p>Premium PlayStation Rental</p>
                <p>Phone: (021) 1234-5678</p>
                <p>Email: info@mdgaming.com</p>
            </div>
            <div class="invoice-title">
                <h2>INVOICE</h2>
                <p style="font-size: 14px; color: #666;">{{ $booking->booking_code }}</p>
                <p style="font-size: 12px; color: #999; margin-top: 5px;">
                    {{ $booking->created_at->format('d F Y, H:i') }}
                </p>
            </div>
        </div>

        <!-- Invoice Meta -->
        <div class="invoice-meta">
            <div class="meta-box">
                <h3>Bill To</h3>
                <p><strong>{{ $booking->full_name }}</strong></p>
                <p>{{ $booking->email }}</p>
                <p>{{ $booking->phone_number }}</p>
            </div>
            <div class="meta-box">
                <h3>Invoice Details</h3>
                <p><strong>Status:</strong> <span class="status-badge">{{ strtoupper($booking->status) }}</span></p>
                <p><strong>Payment Type:</strong> {{ $booking->payment_type ?? 'N/A' }}</p>
                <p><strong>Transaction ID:</strong> {{ $booking->transaction_id ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="booking-details">
            <h3>Booking Information</h3>
            <div class="detail-grid">
                <span class="label">Room:</span>
                <span class="value">{{ $booking->roomUnit->room->room_title ?? 'N/A' }}</span>
                
                <span class="label">Unit:</span>
                <span class="value">{{ $booking->roomUnit->unit_name ?? 'N/A' }}</span>
                
                <span class="label">Date:</span>
                <span class="value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</span>
                
                <span class="label">Time:</span>
                <span class="value">{{ $booking->booking_time }}</span>
                
                <span class="label">Duration:</span>
                <span class="value">{{ $booking->duration }} Jam</span>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th style="text-align: center; width: 80px;">Qty</th>
                    <th style="text-align: right; width: 150px;">Price</th>
                    <th style="text-align: right; width: 150px;">Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Room -->
                <tr>
                    <td>
                        <strong>{{ $booking->roomUnit->room->room_title ?? 'Room' }}</strong>
                        <br>
                        <small style="color: #666;">{{ $booking->duration }} hours rental</small>
                    </td>
                    <td style="text-align: center;">1</td>
                    <td style="text-align: right;">Rp {{ number_format($booking->room_price, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($booking->room_price, 0, ',', '.') }}</td>
                </tr>

                <!-- Add-ons -->
                @foreach($booking->bookingAddons as $bookingAddon)
                <tr>
                    <td>
                        <strong>{{ $bookingAddon->addon->addons_title }}</strong>
                        <br>
                        <small style="color: #666;">Add-on</small>
                    </td>
                    <td style="text-align: center;">{{ $bookingAddon->quantity }}</td>
                    <td style="text-align: right;">Rp {{ number_format($bookingAddon->price, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($bookingAddon->total_price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;">Subtotal:</td>
                    <td style="text-align: right;">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">DP Paid:</td>
                    <td style="text-align: right; color: #28a745;">Rp {{ number_format($booking->dp_amount, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Actions -->
        <div class="actions no-print">
            <button onclick="window.print()" class="btn btn-print">
                <i class="fa fa-print"></i> Print Invoice
            </button>
            <a href="{{ url('/') }}" class="btn btn-home">
                <i class="fa fa-home"></i> Back to Home
            </a>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <p><strong>Thank you for choosing MD Gaming!</strong></p>
            <p class="note">This is a computer-generated invoice and does not require a signature.</p>
            <p class="note">Please contact us if you have any questions regarding this invoice.</p>
        </div>
    </div>
</body>
</html>
