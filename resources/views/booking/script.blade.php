<script src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('vendors/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('vendors/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendors/magnefic-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('vendors/easing.min.js') }}"></script>
<script src="{{ asset('vendors/superfish.min.js') }}"></script>
<script src="{{ asset('vendors/nice-select/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('vendors/mail-script.js') }}"></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
    

<script>
    const rooms = [
        { id: 'REG 1', name: 'REG 1', status: 'available', type: 'regular' },
        { id: 'REG 2', name: 'REG 2', status: 'occupied', type: 'regular' },
        { id: 'REG 3', name: 'REG 3', status: 'available', type: 'regular' },
        { id: 'REG 4', name: 'REG 4', status: 'occupied', type: 'regular' },
        { id: 'VIP 1', name: 'VIP 1', status: 'available', type: 'vip' },
        { id: 'REG 5', name: 'REG 5', status: 'available', type: 'regular' },
        { id: 'REG 6', name: 'REG 6', status: 'available', type: 'regular' },
        { id: 'REG 7', name: 'REG 7', status: 'occupied', type: 'regular' },
        { id: 'REG 8', name: 'REG 8', status: 'available', type: 'regular' },
        { id: 'MGR 1', name: 'MGR 1', status: 'available', type: 'manager' },
        { id: 'MGR 2', name: 'MGR 2', status: 'available', type: 'manager' },
        { id: 'VIP 2', name: 'VIP 2', status: 'occupied', type: 'vip' }
    ];

   
    let selectedRoom = null;
    let selectedDuration = null;

    // Initialize
    function init() {
        renderRooms();
        renderPackages();
        updateOrderSummary();
        attachEventListeners();
    }

    // Render Rooms
    function renderRooms() {
        const roomsGrid = document.getElementById('roomsGrid');
        roomsGrid.innerHTML = '';
        
        rooms.forEach(room => {
            const roomCard = document.createElement('div');
            roomCard.className = `room-card ${room.status} ${room.type}`;
            roomCard.dataset.roomId = room.id;
            
            if (room.status === 'available') {
                roomCard.addEventListener('click', () => selectRoom(room));
            }
            
            roomCard.innerHTML = `
                <span class="room-name">${room.name}</span>
                <span class="room-status">${room.status === 'available' ? 'Available' : 'Occupied'}</span>
            `;
            
            roomsGrid.appendChild(roomCard);
        });
    }
    

    // Select Room
    function selectRoom(room) {
        // Remove previous selection
        document.querySelectorAll('.room-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        // Set new selection
        selectedRoom = room;
        const roomCard = document.querySelector(`[data-room-id="${room.id}"]`);
        roomCard.classList.add('selected');
        
        updateOrderSummary();
    }

    // Select Package
    function selectPackage(pkg) {
        // Remove previous selection
        document.querySelectorAll('.package-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        // Set new selection
        selectedPackage = pkg;
        const packageCard = document.querySelector(`[data-package-id="${pkg.id}"]`);
        packageCard.classList.add('selected');
        
        updateOrderSummary();
    }

    // Update Order Summary
    function updateOrderSummary() {
        const selectedRoomElement = document.getElementById('selectedRoom');
        const selectedPackageElement = document.getElementById('selectedPackage');
        const totalAmountElement = document.getElementById('totalAmount');
        const selectedDurationElement = document.getElementById('selectedDuration');
        const payNowBtn = document.getElementById('payNowBtn');
        const payLaterBtn = document.getElementById('payLaterBtn');
        const submitBookingBtn = document.getElementById('submitBooking');

        // Update room selection
        if (selectedRoom) {
            selectedRoomElement.innerHTML = `
                <span class="room-name">${selectedRoom.name}</span>
                <span class="room-type">${selectedRoom.type}</span>
            `;
        } else {
            selectedRoomElement.innerHTML = `
                <span class="room-name">-</span>
                <span class="room-type">-</span>
            `;
        }

        // Update package selection
        if (selectedPackage) {
            selectedPackageElement.textContent = selectedPackage.name;
        } else {
            selectedPackageElement.textContent = 'Belum ada paket dipilih';
        }

        // Duration
        if (selectedDuration) {
            selectedDurationElement.textContent = `${selectedDuration} Jam`;
        } else {
            selectedDurationElement.textContent = '-';
        }

        // Update total
        const total = selectedPackage ? selectedPackage.price : 0;
        totalAmountElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;

        // Update button states
        const canProceed = selectedRoom && selectedPackage;
        payNowBtn.disabled = !canProceed;
        payLaterBtn.disabled = !canProceed;
        submitBookingBtn.disabled = !canProceed;
    }

    // Event Listeners
    function attachEventListeners() {
        const payNowBtn = document.getElementById('payNowBtn');
        const payLaterBtn = document.getElementById('payLaterBtn');
        const durationSelect = document.getElementById('duration');
        
        payNowBtn.addEventListener('click', () => {
            if (selectedRoom && selectedPackage) {
                showNotification('Pembayaran berhasil!', 'success');
                // In a real app, this would process the payment
                resetBooking();
            }
        });
        
        payLaterBtn.addEventListener('click', () => {
            if (selectedRoom && selectedPackage) {
                showNotification('Booking berhasil! Silakan bayar di kasir.', 'info');
                // In a real app, this would create a reservation
                resetBooking();
            }
        });

        durationSelect.addEventListener('change', (e) => {
            selectedDuration = e.target.value;
            updateOrderSummary();
        });
    }

    // Reset Booking
    function resetBooking() {
        selectedRoom = null;
        selectedPackage = null;
        
        document.querySelectorAll('.room-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        document.querySelectorAll('.package-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        updateOrderSummary();
    }

    // Show Notification
    function showNotification(message, type = 'success') {
        // Create notification element
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: ${type === 'success' ? 'rgba(6, 182, 212, 0.95)' : 'rgba(168, 85, 247, 0.95)'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
        `;
        notification.textContent = message;
        
        // Add animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
        
        document.body.appendChild(notification);
        
        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease-in';
            setTimeout(() => {
                document.body.removeChild(notification);
                document.head.removeChild(style);
            }, 300);
        }, 3000);
    }

    // Start the app
    init();
</script>