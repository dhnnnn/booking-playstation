<section class="booking-form-section">
    <h2 class="section-title">Detail Booking</h2>
        <form class="booking-form" id="bookingForm" autocomplete="off">
            <div class="form-group">
                <label for="fullName" class="form-label">Nama Lengkap</label>
                <input type="text" id="fullName" name="fullName" class="form-input" placeholder="Masukkan nama lengkap" required>
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

            <div class="form-btn-group">
                <button type="submit" class="btn-form" id="submitBooking" disabled>
                    <svg class="btn-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Konfirmasi Booking
                </button>
            </div>                        
        </form>

</section>