<script src="{{ asset('vendors/jquery/jquery-3.2.1.min.js') }}"></script>

<!-- jQuery UI for Datepicker -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- ClockPicker for Time Selection -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.js"></script>

<!-- Initialize Datepicker and ClockPicker -->
<script>
    $(document).ready(function() {
        console.log('Initializing datepicker and clockpicker...');
        
        // Initialize Datepicker for booking date
        $('#bookingDate').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            maxDate: '+3M',
            showAnim: 'fadeIn',
            changeMonth: false,
            changeYear: false,
            dayNamesMin: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                         'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 
                             'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            onSelect: function(dateText) {
                $(this).trigger('change');
                console.log('Date selected:', dateText);
            }
        });
        console.log('Datepicker initialized');

        // Initialize ClockPicker for booking time
        $('#bookingTime').clockpicker({
            placement: 'bottom',
            align: 'center',
            donetext: 'Pilih',
            autoclose: true,
            twelvehour: false,
            vibrate: false,
            afterDone: function() {
                $('#bookingTime').trigger('change');
                console.log('Time selected:', $('#bookingTime').val());
            }
        });
        console.log('ClockPicker initialized');
    });
</script>

<script src="{{ asset('vendors/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendors/magnefic-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('vendors/easing.min.js') }}"></script>
<script src="{{ asset('vendors/superfish.min.js') }}"></script>
<script src="{{ asset('vendors/nice-select/jquery.nice-select.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>







<script>
    const rooms = @json($units);

    const addons = {
        @foreach($addons as $addon)
            "{{ $addon->id }}": {
                id: "{{ $addon->id }}",
                name: "{{ $addon->addons_title }}",
                price: {{ $addon->price }},
                stock: {{ $addon->stock ?? 0 }},
                quantity: 0
            },
        @endforeach
    };



    let selectedRoom = null;
    let selectedDuration = null;

    // Initialize
    function init() {
        renderRooms();
        updateOrderSummary();
        attachEventListeners();
        attachFormValidation();
    }

    // Validate Form
    function validateForm() {
        const fullName = document.getElementById('fullName').value.trim();
        const phoneNumber = document.getElementById('phoneNumber').value.trim();
        const bookingDate = document.getElementById('bookingDate').value;
        const bookingTime = document.getElementById('bookingTime').value;
        const duration = document.getElementById('duration').value;

        return fullName !== '' && phoneNumber !== '' && bookingDate !== '' && bookingTime !== '' && duration !== '' && selectedRoom !== null;
    }

    // Attach Form Validation
    function attachFormValidation() {
        const formInputs = ['fullName', 'phoneNumber', 'bookingDate', 'bookingTime', 'duration'];

        formInputs.forEach(inputId => {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('input', updateOrderSummary);
                input.addEventListener('change', updateOrderSummary);
            }
        });
    }

    // Render Rooms
    function renderRooms() {
        const roomsGrid = document.getElementById('roomsGrid');
        roomsGrid.innerHTML = '';

        rooms.forEach(room => {
            const roomCard = document.createElement('div');
            roomCard.className = `room-card ${room.status.replace(/\s+/g, '-')} ${room.type}`;
            roomCard.dataset.roomId = room.id;

            if (room.status === 'tersedia') {
                roomCard.addEventListener('click', () => selectRoom(room));
            }

            roomCard.innerHTML = `
                <span class="room-name">${room.name}</span>
                <span class="room-status">${room.status === 'tersedia' ? 'Tersedia' : 'Tidak Tersedia'}</span>
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
        
        // Trigger validation check explicitly
        const formValid = validateForm();
        const payNowBtn = document.getElementById('payNowBtn');
        payNowBtn.disabled = !formValid;
    }

    // Change addon quantity
    function changeQuantity(addonId, change) {     
        const currentQty = addons[addonId].quantity;
        const newQty = currentQty + change;
        const availableStock = addons[addonId].stock;

        if (newQty >= 0 && newQty <= availableStock) {
            addons[addonId].quantity = newQty;
            document.getElementById(`qty-${addonId}`).textContent = newQty;

            updateOrderSummary();
        } else if (newQty > availableStock) {
            alert(`Stock tidak mencukupi. Stock tersedia: ${availableStock}`);
        }
    }



    // Update Order Summary
    function updateOrderSummary() {
        const selectedRoomElement = document.getElementById('selectedRoom');
        const totalAmountElement = document.getElementById('totalAmount');
        const totalDpElement = document.getElementById('totalDpAmount');
        const payNowBtn = document.getElementById('payNowBtn');
        const submitBookingBtn = document.getElementById('submitBooking');
        const selectedDurationElement = document.getElementById('selectedDuration');
        const durationSelect = document.getElementById("duration");
        const pricePerHour = {{ $room->price }};

        
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

        // Duration
        durationSelect.addEventListener('change', function() {
            const selectedDuration = this.value; // Ambil nilai dari select

            if (selectedDuration) {
                selectedDurationElement.textContent = `${selectedDuration} Jam`;
            } else {
                selectedDurationElement.textContent = '-';
            }
        });

        // Calculate addons total
            let addonsTotal = 0;
            let addonsListHTML = '';
            let hasAddons = false;
            
            for (const [id, addon] of Object.entries(addons)) {
                if (addon.quantity > 0) {
                    hasAddons = true;
                    const itemTotal = addon.price * addon.quantity;
                    addonsTotal += itemTotal;
                    
                    addonsListHTML += `
                        <div class="addon-summary-item">
                            <span class="addon-summary-name">${addon.name} x${addon.quantity}</span>
                            <span class="addon-summary-price">${formatRupiah(itemTotal)}</span>
                        </div>
                    `;
                }
            }
            
            // Update addons list
            if (hasAddons) {
                document.getElementById('addonsList').innerHTML = addonsListHTML;
            } else {
                document.getElementById('addonsList').innerHTML = '<p style="color: #666; font-size: 14px;">Belum ada add-ons</p>';
            }

        // Update total amount
        let totalAmount = pricePerHour + addonsTotal;
        let totalDp = totalAmount / 2;
        if (selectedDuration) {
            totalAmount = totalAmount * parseInt(selectedDuration);
            totalDp = totalAmount / 2;
        }

        totalAmountElement.textContent = `Rp ${totalAmount.toLocaleString('id-ID')}`;
        totalDpElement.textContent = `Rp ${totalDp.toLocaleString('id-ID')}`;


        // Simpan nilai ke hidden input (angka mentah, tanpa format)
        document.getElementById('total_harga').value = Math.round(totalAmount);
        document.getElementById('total_dp').value = Math.round(totalDp);
        document.getElementById('unit_id').value = selectedRoom ? selectedRoom.id : '';
        document.getElementById('addons_price').value = Math.round(addonsTotal);

        // Update button states - only check form validation
        const formValid = validateForm();
        payNowBtn.disabled = !formValid;
        // submitBookingBtn.disabled = !formValid;
    }

    function formatRupiah(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }

    // Check Room Availability
    function checkRoomAvailability() {
        const bookingDate = $('#bookingDate').val();
        const bookingTime = $('#bookingTime').val();
        const duration = $('#duration').val();
        const roomId = '{{ $room->id }}';

        // Only check if all fields are filled
        if (!bookingDate || !bookingTime || !duration) {
            return;
        }

        // Show loading state
        const roomsGrid = $('#roomsGrid');
        roomsGrid.html('<div style="text-align: center; padding: 20px; color: #666;">Memeriksa ketersediaan...</div>');

        // Clear selected room
        selectedRoom = null;
        updateOrderSummary();

        // Send AJAX request
        $.ajax({
            url: '/check-availability',
            method: 'POST',
            data: {
                booking_date: bookingDate,
                booking_time: bookingTime,
                duration: duration,
                room_id: roomId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && response.units) {
                    // Update rooms data
                    rooms.length = 0; // Clear array
                    response.units.forEach(unit => {
                        rooms.push(unit);
                    });
                    
                    // Re-render rooms
                    renderRooms();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error checking availability:', error);
                roomsGrid.html('<div style="text-align: center; padding: 20px; color: #ff4444;">Gagal memeriksa ketersediaan. Silakan coba lagi.</div>');
            }
        });
    }


    // Event Listeners
    function attachEventListeners() {
        const payNowBtn = document.getElementById('payNowBtn');
        const durationSelect = document.getElementById('duration');

        payNowBtn.addEventListener('click', () => {
            processPayment();
        });


        durationSelect.addEventListener('change', (e) => {
            selectedDuration = e.target.value;
            updateOrderSummary();
        });

        // Add jQuery event listeners for availability checking
        $('#bookingDate, #bookingTime, #duration').on('change', function() {
            checkRoomAvailability();
        });
    }


    // Remove the form submit event listener - use AJAX instead
                       
    // Remove duplicate event listener - using only the jQuery version below

    //------- initialize menu --------//   
    $('.nav-menu').superfish({
        animation: {
            opacity: 'show'
        },
        speed: 400
    });

  //* Navbar Fixed
    var window_width = $(window).width(),
		window_height = window.innerHeight,
		header_height = $('.default-header').height(),
		header_height_static = $('.site-header.static').outerHeight(),
		fitscreen = window_height - header_height;

	$('.fullscreen').css('height', window_height);
	$('.fitscreen').css('height', fitscreen);
	var nav_offset_top = $('header').height() + 50;
	function navbarFixed() {
		if ($('.header_area').length) {
			$(window).scroll(function() {
				var scroll = $(window).scrollTop();
				if (scroll >= nav_offset_top) {
					$('.header_area').addClass('navbar_fixed');
				} else {
					$('.header_area').removeClass('navbar_fixed');
				}
			});
		}
	}
	navbarFixed();

  
  //------- mobile navigation --------//  
  if ($('#nav-menu-container').length) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="lnr lnr-menu"></i></button>');
    $('body').append('<div id="mobile-body-overly"></div>');
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="lnr lnr-chevron-down"></i>');

    $(document).on('click', '.menu-has-children i', function(e) {
      $(this).next().toggleClass('menu-item-active');
      $(this).nextAll('ul').eq(0).slideToggle();
      $(this).toggleClass("lnr-chevron-up lnr-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function(e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }

    // Start the app
    init();
</script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    // Process Payment
    function processPayment() {
        const form = document.getElementById('bookingForm');
        
        // Disable button to prevent double submit
        const payNowBtn = document.getElementById('payNowBtn');
        payNowBtn.disabled = true;
        payNowBtn.textContent = 'Memproses...';

        // Clear previous addon inputs
        const existingAddonInputs = form.querySelectorAll('input[name^="addons["]');
        existingAddonInputs.forEach(input => input.remove());

        // Add new addon inputs for addons with quantity > 0
        for (const [id, addon] of Object.entries(addons)) {
            if (addon.quantity > 0) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `addons[${id}]`;
                input.value = addon.quantity;
                form.appendChild(input);
            }
        }

        let formData = $("#bookingForm").serialize();
        console.log("Sending payment request...");

        $.ajax({
            url: "/create-payment",
            method: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log("Payment response:", response);
                if (response.snapToken) {
                    snap.pay(response.snapToken, {
                        onSuccess: function(result) {
                            console.log("Payment success:", result);
                            // Redirect to invoice page
                            window.location.href = '/invoice/' + response.bookingId;
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran");
                            window.location.reload();
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal");
                            payNowBtn.disabled = false;
                            payNowBtn.textContent = 'Bayar Sekarang';
                        },
                        onClose: function() {
                            payNowBtn.disabled = false;
                            payNowBtn.textContent = 'Bayar Sekarang';
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token pembayaran");
                    payNowBtn.disabled = false;
                    payNowBtn.textContent = 'Bayar Sekarang';
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
                
                let errorMessage = "Terjadi kesalahan saat memproses pembayaran";
                
                // Check if there's a specific error message from the server
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
                
                alert(errorMessage);
                payNowBtn.disabled = false;
                payNowBtn.textContent = 'Bayar Sekarang';
                
                // If it's a conflict error, refresh availability
                if (xhr.status === 422) {
                    checkRoomAvailability();
                }
            }
        });
    }
</script>
