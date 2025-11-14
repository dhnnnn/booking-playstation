<!DOCTYPE html>
<html lang="id">
<head>
    @include('booking.css')
</head>
<body>
    <!-- =======Header area end======== -->

    <header class="header_area">
        @include('booking.header')
	</header>
    
    <!-- Main Content -->
    <main class="site-main">
        <div class="container">
            <div class="content-grid">
                <!-- Rooms Section -->
                <div class="rooms-section">
                    <!-- Booking Form Section -->
                    @include('booking.form')

                    <!-- Ruangan section -->
                    @include('booking.ruangan')

                    <!-- Addons section -->
                </div>

                <!-- Order Summary Sidebar -->
                <aside class="order-summary">
                    @include('booking.sidebar')
                </aside>

            </div>
        </div>


        @include('home.footer')
    </main>

    <!-- @include('home.script') -->
    @include('booking.script')
    
</body>
</html>