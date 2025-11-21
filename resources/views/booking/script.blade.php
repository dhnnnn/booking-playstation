<script src="{{ asset('vendors/jquery/jquery-3.2.1.min.js') }}"></script>
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
        cocacola: { name: 'Coca Cola', price: 5000, quantity: 0 },
        sprite: { name: 'Sprite', price: 5000, quantity: 0 },
        chips: { name: 'Keripik', price: 10000, quantity: 0 },
        popcorn: { name: 'Popcorn', price: 8000, quantity: 0 },
        controller: { name: 'Extra Controller', price: 15000, quantity: 0 },
        coklat: { name: 'Coklat', price: 12000, quantity: 0 }
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

        return fullName !== '' && phoneNumber !== '' && bookingDate !== '' && bookingTime !== '' && duration !== '';
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
    }

    // Change addon quantity
    function changeQuantity(addonId, change) {
        const currentQty = addons[addonId].quantity;
        const newQty = currentQty + change;
            
        if (newQty >= 0) {
            addons[addonId].quantity = newQty;
            document.getElementById(`qty-${addonId}`).textContent = newQty;
            updateOrderSummary();
        }
    }

    // Update Order Summary
    function updateOrderSummary() {
        const selectedRoomElement = document.getElementById('selectedRoom');
        const totalAmountElement = document.getElementById('totalAmount');
        const totalDpElement = document.getElementById('totalDpAmount');
        const payNowBtn = document.getElementById('payNowBtn');
        const payLaterBtn = document.getElementById('payLaterBtn');
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

        // Update button states - only check form validation
        const formValid = validateForm();
        payNowBtn.disabled = !formValid;
        payLaterBtn.disabled = !formValid;
        // submitBookingBtn.disabled = !formValid;
    }

    function formatRupiah(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }

    // Event Listeners
    function attachEventListeners() {
        const payNowBtn = document.getElementById('payNowBtn');
        const payLaterBtn = document.getElementById('payLaterBtn');
        const durationSelect = document.getElementById('duration');

        payNowBtn.addEventListener('click', () => {
            //
        });

        payLaterBtn.addEventListener('click', () => {
            //
        });

        durationSelect.addEventListener('change', (e) => {
            selectedDuration = e.target.value;
            updateOrderSummary();
        });
    }

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

