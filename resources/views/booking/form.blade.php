<section class="booking-form-section">
    <h2 class="section-title">Detail Booking</h2>
        <form class="booking-form" id="bookingForm" autocomplete="off" method="POST" >

            @csrf

            <div class="form-group">
                <label for="fullName" class="form-label">Nama Lengkap</label>
                <input type="text" id="fullName" name="fullName" class="form-input" placeholder="Masukkan nama lengkap" required>
            </div>
                
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="Masukkan nomor email aktif" required>
            </div>
            
            <div class="form-group">
                <label for="phoneNumber" class="form-label">No. Telepon</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" class="form-input" placeholder="Masukkan nomor telepon" required>
            </div>
                
            <div class="form-row">
                <div class="form-group">
                    <label for="bookingDate" class="form-label">Tanggal Booking</label>
                    <input type="date" id="bookingDate" name="bookingDate" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="bookingTime" class="form-label">Jam Booking</label>
                    <input type="time" id="bookingTime" name="bookingTime" class="form-input" required>
                </div>
            </div>
                
            <div class="form-group">
                <label for="duration" class="form-label">Berapa Jam</label>
                <select id="duration" name="duration" class="form-input" required>
                    <option value="">Pilih durasi</option>
                    <option value="1">1 Jam</option>
                    <option value="2">2 Jam</option>
                    <option value="3">3 Jam</option>
                    <option value="4">4 Jam</option>
                    <option value="5">5 Jam</option>
                    <option value="6">6 Jam</option>
                    <option value="7">7 Jam</option>
                    <option value="8">8 Jam</option>
                </select>

            </div>
            
            @include('booking.ruangan')
            
            @include('booking.addons')
            
            <input type="hidden" name="total_harga" id="total_harga">
            <input type="hidden" name="total_dp" id="total_dp">
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" name="unit_id" id="unit_id" value="">
            <input type="hidden" name="room_price" id="room_price" value="{{ $room->price }}">
            <input type="hidden" name="addons_price" id="addons_price" value="0">
            
        </form>

</section>