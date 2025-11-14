    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD Gaming | Rental Playstation </title>

    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/magnefic-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/nice-select/nice-select.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            /* Neon Colors */
            --color-cyan: 6 182 212;
            --color-cyan-glow: 34 211 238;
            --color-magenta: 236 72 153;
            --color-magenta-glow: 244 114 182;
            --color-purple: 168 85 247;
            --color-purple-glow: 192 132 252;
            --color-gray: 71 85 105;
            
            /* Semantic Colors */
            --color-available: var(--color-cyan);
            --color-occupied: var(--color-magenta);
            --color-vip: var(--color-purple);
            --color-manager: var(--color-gray);
            
            /* Shadows & Glows */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.5);
            --shadow-cyan-glow: 0 0 20px rgba(6, 182, 212, 0.4);
            --shadow-magenta-glow: 0 0 20px rgba(236, 72, 153, 0.4);
            --shadow-purple-glow: 0 0 20px rgba(168, 85, 247, 0.4);
            
            /* Transitions */
            --transition-base: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-smooth: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Spacing */
            --spacing-unit: 0.25rem;
        }


        .content-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 2rem;
            align-items: start;
            padding-top: 200px;
        }

        /* Legend */
        .legend {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            border: 1px solid rgba(148, 163, 184, 0.1);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: rgb(148 163 184);
        }

        .legend-indicator {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

 

        /* Rooms Grid */
        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .room-card {
            background: rgb(24 28 44);
            border-radius: 1rem;
            padding: 2rem 1.5rem;
            border: 2px solid;
            cursor: pointer;
            transition: all var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .room-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            opacity: 0;
            transition: opacity var(--transition-smooth);
        }

        .room-card.tersedia {
            border-color: rgb(var(--color-available));
        }

        .room-card.tersedia::before {
            background: rgb(var(--color-cyan-glow));
            box-shadow: var(--shadow-cyan-glow);
        }

        .room-card.tersedia:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 25px rgba(var(--color-available), 0.3);
        }

        .room-card.tersedia:hover::before {
            opacity: 1;
        }

        .room-card.tidak-tersedia {
            border-color: rgb(var(--color-occupied));
            cursor: not-allowed;
            opacity: 0.6;
        }

        .room-card.selected {
            transform: scale(1.02);
            box-shadow: 0 0 30px rgba(var(--color-cyan-glow), 0.5);
        }

        .room-card.selected::after {
            content: '✓';
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            width: 24px;
            height: 24px;
            background: rgb(var(--color-cyan));
            color: #ffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 700;
            animation: checkmarkPop 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes checkmarkPop {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        .room-name {
            font-size: 1.5rem;
            font-weight: 700;
            display: block;
            margin-bottom: 0.5rem;
        }

        .room-card.tersedia .room-name {
            color: rgb(var(--color-cyan));
        }

        .room-card.tidak-tersedia .room-name {
            color: rgb(var(--color-occupied));
        }

        .room-card.vip .room-name {
            /* color: rgb(var(--color-vip)); */
        }

        .room-card.manager .room-name {
            color: rgb(148 163 184);
        }

        .room-status {
            font-size: 0.875rem;
            color: rgb(148 163 184);
            text-transform: capitalize;
        }

        /* Packages Section */
        .packages-section {
            margin-top: 3rem;
        }

        .section-title {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: rgb(248 250 252);
        }

        .packages-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .package-card {
            background: rgb(24 28 44);
            border: 2px solid rgba(148 163 184, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            cursor: pointer;
            transition: all var(--transition-smooth);
            position: relative;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .package-card:hover {
            border-color: rgb(var(--color-cyan));
            transform: translateX(4px);
            box-shadow: 0 0 20px rgba(var(--color-cyan), 0.2);
        }

        .package-card.selected {
            border-color: rgb(var(--color-cyan));
            background: rgba(var(--color-cyan), 0.1);
            box-shadow: 0 0 20px rgba(var(--color-cyan), 0.3);
        }

        .package-radio {
            width: 24px;
            height: 24px;
            border: 2px solid rgb(148 163 184);
            border-radius: 50%;
            position: relative;
            flex-shrink: 0;
            transition: all var(--transition-base);
        }

        .package-card.selected .package-radio {
            border-color: rgb(var(--color-cyan));
            background: rgb(var(--color-cyan));
        }

        .package-card.selected .package-radio::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: rgb(24 28 44);
            border-radius: 50%;
        }

        .package-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .package-info {
            flex: 1;
        }

        .package-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.25rem;
        }

        .package-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: rgb(248 250 252);
        }

        .package-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .badge-popular {
            background: rgb(var(--color-magenta));
            color: white;
        }

        .badge-value {
            background: rgb(var(--color-magenta));
            color: white;
        }

        .badge-premium {
            background: rgba(148 163 184, 0.2);
            color: rgb(148 163 184);
        }

        .package-description {
            font-size: 0.875rem;
            color: rgb(148 163 184);
            line-height: 1.5;
        }

        .package-price {
            text-align: right;
            flex-shrink: 0;
        }

        .price-label {
            font-size: 0.75rem;
            color: rgb(100 116 139);
            display: block;
            margin-bottom: 0.25rem;
        }

        .price-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: rgb(var(--color-cyan));
        }

        /* Order Summary */
        .order-summary {
            position: static;
            top: 6rem;
        }

        .summary-card {
            background: rgb(12, 14, 20);
            border-radius: 1.5rem;
            border: 1px solid rgba(148 163 184, 0.2);
            overflow: hidden;
        }

        .summary-header {
            background: rgba(var(--color-cyan), 0.1);
            padding: 1.5rem;
            border-bottom: 1px solid rgba(var(--color-cyan), 0.2);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .summary-icon {
            width: 24px;
            height: 24px;
            color: rgb(var(--color-cyan));
        }

        .summary-header h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: rgb(248 250 252);
        }

        .summary-content {
            padding: 1.5rem;
        }

        .summary-section {
            margin-bottom: 1.5rem;
        }

        .summary-section:last-child {
            margin-bottom: 0;
        }

        .summary-label {
            font-size: 0.875rem;
            color: rgb(100 116 139);
            display: block;
            margin-bottom: 0.5rem;
        }

        .room-option{
            display: flex;
            justify-content: space-between;
        }

        .selected-room {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .room-name {
            font-weight: 600;
            color: rgb(248 250 252);
        }

        .room-type {
            font-size: 0.875rem;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            background: rgb(var(--color-cyan));
            color: rgb(14, 17, 28);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .selected-package {
            padding: 0.75rem 1rem;
            background: rgba(14 17 28, 0.5);
            border-radius: 0.5rem;
            border: 1px solid rgba(148 163 184, 0.1);
            color: rgb(148 163 184);
            font-size: 0.975rem;
            min-height: 3rem;
            display: flex;
            align-items: center;
        }

        .summary-divider {
            height: 1px;
            background: rgba(148 163 184, 0.1);
            /* margin: 1.5rem 0; */
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: rgba(var(--color-cyan), 0.05);
            border: 1px solid rgba(var(--color-cyan), 0.2);
            border-top: 1px solid gray;
        }

        .summary-dp-total{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: rgba(var(--color-cyan), 0.05);
            border: 1px solid rgba(var(--color-cyan), 0.2);
        }

        .total-label {
            font-size: 0.875rem;
            color: rgb(148 163 184);
            font-weight: 500;
        }

        .dp-label{
            font-size: 0.875rem;
            color: rgb(148 163 184);
            font-weight: 500; 
        }

        .total-amount {
            font-size: 18px;
            font-weight: 700;
            /* color: rgb(var(--color-cyan)); */
            /* text-shadow: 0 0 10px rgba(var(--color-cyan), 0.3); */
            text-decoration: line-through;
        }

        .total-dp-amount{
            font-size: 23px;
            font-weight: 700;
            color: rgb(var(--color-cyan));
            text-shadow: 0 0 10px rgba(var(--color-cyan), 0.3);
        }

        .summary-actions {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .btn {
            width: 100%;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-smooth);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-family: inherit;
        }

        .btn-icon {
            width: 20px;
            height: 20px;
        }

        .btn-primary {
            background: rgb(var(--color-cyan));
            color: rgb(14 17 28);
            box-shadow: 0 0 20px rgba(var(--color-cyan), 0.4);
        }

        .btn-primary:not(:disabled):hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(var(--color-cyan), 0.6);
        }

        .btn-primary:not(:disabled):active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: transparent;
            color: rgb(148 163 184);
            border: 2px solid rgba(148 163 184, 0.3);
        }

        .btn-secondary:not(:disabled):hover {
            border-color: rgb(148 163 184);
            color: rgb(248 250 252);
        }

        .btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            box-shadow: none;
        }

        .summary-note {
            padding: 1.5rem;
            font-size: 0.8125rem;
            color: rgb(148 163 184);
            line-height: 1.6;
            border-top: 1px solid rgba(148 163 184, 0.1);
        }

        /* Footer Badge */

        /* Booking Form Section */
        .booking-form-section {
            margin-top: 0px;
            margin-bottom: 3rem;
        }

        .booking-form {
            color: #ffffff; 
            background-color: rgb(12, 14, 20); 
            border-radius: 1rem;
            padding: 2rem;
            border: 1px solid rgba(148 163 184, 0.2);
        }

        .form-group {
            margin-bottom: 1.5rem;
            
        }

        .form-group:last-child {
            margin-bottom: 2.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-label {
            display: block;
            font-size: 1rem;
            color: #ffffff; 
            background-color: rgb(12, 14, 20); 
            margin-bottom: 0.5rem;
            font-family: inherit;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form-input {
            width: 100%;
            height: 3rem;
            padding: 0.15rem 1rem;
            background: rgba(14 17 28, 0.5);
            border: 2px solid rgba(148 163 184, 0.2);
            border-radius: 0.5rem; 
            color: rgb(100 116 139); 
            background-color: #212529; 
            font-size: 1rem;
            transition: all var(--transition-base);
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form-input option {
            background-color: #212529;
            color: rgb(100 116 139);
            padding: 0.5rem;
        }


        .form-input:focus {
            outline: none;
            border-color: rgb(var(--color-cyan));
            box-shadow: 0 0 0 3px rgba(var(--color-cyan), 0.1);
        }

        .form-input::placeholder {
            color: rgb(100 116 139);
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form-btn-group{
            padding-top: 50px;
        }
        

        .btn-form {
            width: 100%;
            padding: 1rem 2rem;
            background: rgb(var(--color-cyan));
            color: rgb(14 17 28);
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-smooth);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-family: inherit;
            box-shadow: 0 0 20px rgba(var(--color-cyan), 0.4);
        }

        

        /* Responsive Design */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding-top: 150px;
            }

            .order-summary {
                position: static;
                margin-top: 2rem;
            }

            .rooms-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 1.25rem;
            }

            .booking-form {
                padding: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .content-grid {
                padding-top: 120px;
            }

            .legend {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                padding: 0.75rem;
            }

            .legend-item {
                font-size: 0.8125rem;
            }

            .rooms-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 1rem;
            }

            .room-card {
                padding: 1.25rem 1rem;
                min-height: 120px;
            }

            .room-name {
                font-size: 1.25rem;
            }

            .booking-form {
                padding: 2rem;
            }

            .form-input {
                height: 3.5rem;
                font-size: 1rem;
            }

            .btn-form {
                padding: 1rem 1.5rem;
                font-size: 1rem;
                min-height: 48px;
            }

            .summary-card {
                margin-bottom: 2rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .content-grid {
                padding-top: 100px;
            }

            .rooms-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
                gap: 0.875rem;
            }

            .room-card {
                padding: 1rem 0.75rem;
                min-height: 100px;
            }

            .room-name {
                font-size: 1.125rem;
            }

            .booking-form {
                padding: 2rem;
            }

            .form-group {
                margin-bottom: 1.25rem;
            }

            .form-label {
                font-size: 0.8125rem;
            }

            .form-input {
                height: 3rem;
                font-size: 0.9375rem;
            }

            .btn-form {
                padding: 0.875rem 1.25rem;
                font-size: 0.9375rem;
                min-height: 44px;
            }

            .legend {
                padding: 0.5rem;
            }

            .summary-header {
                padding: 1rem;
            }

            .summary-content {
                padding: 1rem;
            }

            .summary-actions {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .content-grid {
                padding-top: 200px;
                gap: 1rem;
            }

            .rooms-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
            }

            .room-card {
                padding: 0.875rem 0.5rem;
                min-height: 90px;
            }

            .room-name {
                font-size: 1rem;
                margin-bottom: 0.25rem;
            }

            .room-status {
                font-size: 0.75rem;
            }

            .booking-form {
                padding: 0.875rem;
                margin-bottom: 2rem;
            }

            .form-row {
                gap: 1rem;
            }

            .form-input {
                height: 2.75rem;
                font-size: 0.875rem;
            }

            .btn-form {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
                min-height: 44px;
            }

            .section-title {
                font-size: 1.25rem;
                margin-bottom: 1rem;
            }

            .legend {
                margin-bottom: 1.5rem;
            }

            .summary-card {
                border-radius: 1rem;
            }

            .summary-header h3 {
                font-size: 1rem;
            }

            .total-amount {
                font-size: 1.5rem;
            }
        }
    </style>