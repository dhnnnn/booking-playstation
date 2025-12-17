<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    
    <div class="container">
        <header>
            @include('admin.bookings.header')
        </header>

        <main>
            <section class="widget recent-bookings">
                    <div class="">
                        <h3 class="widget-title">BOOKINGS</h3>
                        <div style="margin-bottom: 20px;">
                            <input type="text" id="searchInput" placeholder="Search by booking code, name, email, or room..." style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-dark); color: var(--text-light); font-size: 14px;">
                        </div>
                    </div>
                    <table id="bookingsTable">
                        <thead>
                            <tr>
                                <th>Booking Code</th>
                                <th>Customer</th>
                                <th>Room</th>
                                <th>Date & Time</th>
                                <th>Duration</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="bookingsTableBody">

                            @foreach($bookings as $booking)
                            <tr>
                                <td><strong>{{ $booking->booking_code }}</strong></td>
                                <td>
                                    {{ $booking->full_name }}<br>
                                    <small style="color: #888;">{{ $booking->email }}</small>
                                </td>
                                <td>
                                    {{ $booking->roomUnit->room->room_title ?? 'N/A' }}<br>
                                    <small style="color: #888;">Unit: {{ $booking->roomUnit->unit_name ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}<br>
                                    <small style="color: #888;">{{ $booking->booking_time }}</small>
                                </td>
                                <td>{{ $booking->duration }} Jam</td>
                                <td>Rp. {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="status-badge status-pending">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="status-badge status-confirmed">Confirmed</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="status-badge status-cancelled">Cancelled</span>
                                    @else
                                        <span class="status-badge">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('invoice', $booking->id) }}" target="_blank">
                                        <button class="edit-btn"><i class="fa-solid fa-file-invoice"></i> View Invoice</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </section>
        </main>
    </div>
    
    <x-notify::notify />
    @notifyJs

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let searchTimeout;
            
            $('#searchInput').on('keyup', function() {
                clearTimeout(searchTimeout);
                const searchValue = $(this).val();
                
                // Debounce search - wait 300ms after user stops typing
                searchTimeout = setTimeout(function() {
                    if (searchValue.length >= 0) {
                        $.ajax({
                            url: '{{ route("bookings.search") }}',
                            type: 'GET',
                            data: { search: searchValue },
                            success: function(response) {
                                updateTable(response.bookings);
                            },
                            error: function(xhr) {
                                console.error('Search error:', xhr);
                            }
                        });
                    }
                }, 300);
            });
            
            function updateTable(bookings) {
                const tbody = $('#bookingsTableBody');
                tbody.empty();
                
                if (bookings.length === 0) {
                    tbody.append(`
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 30px; color: var(--text-dark);">
                                <i class="fa-solid fa-search" style="font-size: 2rem; margin-bottom: 10px;"></i>
                                <p>No bookings found</p>
                            </td>
                        </tr>
                    `);
                    return;
                }
                
                bookings.forEach(function(booking) {
                    const date = new Date(booking.booking_date);
                    const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                    
                    let statusBadge = '';
                    if (booking.status === 'pending') {
                        statusBadge = '<span class="status-badge status-pending">Pending</span>';
                    } else if (booking.status === 'confirmed') {
                        statusBadge = '<span class="status-badge status-confirmed">Confirmed</span>';
                    } else if (booking.status === 'cancelled') {
                        statusBadge = '<span class="status-badge status-cancelled">Cancelled</span>';
                    } else {
                        statusBadge = '<span class="status-badge">' + booking.status.charAt(0).toUpperCase() + booking.status.slice(1) + '</span>';
                    }
                    
                    const roomTitle = booking.room_unit?.room?.room_title || 'N/A';
                    const unitName = booking.room_unit?.unit_name || 'N/A';
                    
                    const row = `
                        <tr>
                            <td><strong>${booking.booking_code}</strong></td>
                            <td>
                                ${booking.full_name}<br>
                                <small style="color: #888;">${booking.email}</small>
                            </td>
                            <td>
                                ${roomTitle}<br>
                                <small style="color: #888;">Unit: ${unitName}</small>
                            </td>
                            <td>
                                ${formattedDate}<br>
                                <small style="color: #888;">${booking.booking_time}</small>
                            </td>
                            <td>${booking.duration} Jam</td>
                            <td>Rp. ${new Intl.NumberFormat('id-ID').format(booking.total_price)}</td>
                            <td>${statusBadge}</td>
                            <td>
                                <a href="/invoice/${booking.id}" target="_blank">
                                    <button class="edit-btn"><i class="fa-solid fa-file-invoice"></i> View Invoice</button>
                                </a>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            }
        });
    </script>

</body>
</html>
