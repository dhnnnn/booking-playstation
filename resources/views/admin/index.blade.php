<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    <div class="container">
        <header>
            @include('admin.header')
        </header>

        <main>
            <div class="dashboard-header">
                <h2>DASHBOARD</h2>
            </div>
            
            <section class="stats-grid">
                <div class="card card-yellow">
                    <i class="fa-solid fa-ticket"></i>
                    <div class="card-content">
                        <p>TOTAL BOOKINGS</p>
                        <h3>{{ $totalBookings }}</h3>
                    </div>
                </div>
                <div class="card card-yellow">
                    <i class="fa-solid fa-gamepad"></i>
                    <div class="card-content">
                        <p>ACTIVE SESSIONS</p>
                        <h3>{{ $activeBookings }}</h3>
                    </div>
                </div>
                <div class="card card-yellow">
                    <i class="fa-solid fa-chair"></i>
                    <div class="card-content">
                        <p>AVAILABLE</p>
                        <h3>{{ $availableRooms }}</h3>
                    </div>
                </div>
                <div class="card card-dark-purple">
                    <i class="fa-solid fa-calendar-day"></i>
                    <div class="card-content">
                        <p>TODAY'S BOOKING</p>
                        <h3>{{ $todayBookings }}</h3>
                    </div>
                </div>
                <div class="card card-dark-purple">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <div class="card-content">
                        <p>REVENUE</p>
                        <h3>Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </section>

            <div class="main-content-grid">
                <section class="widget recent-bookings">
                    <h3 class="widget-title">RECENT BOOKINGS</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>BOOKING ID</th>
                                <th>NAME</th>
                                <th>ROOM</th>
                                <th>START</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_code }}</td>
                                <td>{{ $booking->full_name }}</td>
                                <td>{{ $booking->roomUnit->room->room_title ?? 'N/A' }} - {{ $booking->roomUnit->unit_name ?? 'N/A' }}</td>
                                <td>{{ $booking->booking_time }}</td>
                                <td>
                                    @if($booking->status == 'confirmed')
                                        <span class="status completed">Confirmed</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="status pending">Pending</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="status pending">Cancelled</span>
                                    @else
                                        <span class="status active">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px;">No recent bookings</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                     <a href="{{url('/bookings')}}"><button class="view-all-btn">VIEW ALL <i class="fa-solid fa-arrow-right"></i></button></a>
                </section>

                <section class="widget room-availability">
                    <h3 class="widget-title">ROOM AVAILABILITY</h3>
                    <div class="room-grid">
                        @foreach($roomUnits as $unit)
                            <div class="room-item {{ $unit->status == 'available' ? 'available' : 'used' }} {{ Str::contains(strtolower($unit->room->room_title ?? ''), 'vip') ? 'vip' : '' }}">
                                <p>{{ $unit->unit_name }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="widget actions-widget">
                    <h3 class="widget-title">QUICK LINKS</h3>
                     <div class="action-buttons">
                        <a href="{{url('/bookings')}}"><button class="action-btn">CREATE NEW BOOKING</button></a>
                        <a href="{{url('/rooms')}}"><button class="action-btn">MANAGE ROOMS</button></a>
                        <a href="{{url('/reports')}}"><button class="action-btn">GENERATE REPORT</button></a>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>