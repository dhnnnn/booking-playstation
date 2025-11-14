<div class="summary-card">
    <div class="summary-header">
        <svg class="summary-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
            <path d="M9 3V21M15 3V21M3 9H21M3 15H21" stroke="currentColor" stroke-width="2"/>
        </svg>
        <h3>Ringkasan Pesanan</h3>
    </div>

    
    <div class="summary-content">
        <div class="summary-section">
            <label class="summary-label">Room Dipilih</label>
                <div class="room-option">
                    <h5 class="room">{{ $room->room_title }}</h5>
                    <p class="room-price">Rp {{ number_format($room->price, 0, ',', '.') }} <span>/ jam</span> </p>
                </div>   
        </div>

        <div class="summary-section">
            <label class="summary-label">Ruangan Dipilih</label>
            <div class="selected-room" id="selectedRoom">
                <span class="room-name">-</span>
                <span class="room-price">-</span>
            </div>
         </div>

        <!-- <div class="summary-divider"></div> -->

        <div class="summary-section">
            <label class="summary-label">Durasi</label>
            <div class="selected-package" id="selectedDuration">
                -
            </div>
        </div>


        <div class="summary-divider"></div>
            <div class="summary-total">
                <span class="total-label">Total Biaya</span>
                <span class="total-amount" id="totalAmount">Rp {{ number_format($room->price, 0, ',', '.') }}</span>
            </div>
        </div>
        
        

        <div class="summary-actions">
            <button class="btn btn-primary" id="payNowBtn" disabled>
                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="2"/>
                    <path d="M2 10H22" stroke="currentColor" stroke-width="2"/>
                </svg>
                Bayar Sekarang
            </button>
                <button class="btn btn-secondary" id="payLaterBtn" disabled>
                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                    <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Bayar Nanti
            </button>
        </div>
        <p class="summary-note">
            Dengan melakukan pembayaran, Anda menyetujui syarat dan ketentuan yang berlaku di PlayStation Booking kami.
        </p>
    </div>
</div>