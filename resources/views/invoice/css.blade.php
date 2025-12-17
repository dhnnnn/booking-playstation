    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-info h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 5px;
        }

        .company-info p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h2 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
        }

        .invoice-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .meta-box h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .meta-box p {
            margin: 5px 0;
            line-height: 1.6;
        }

        .meta-box strong {
            color: #333;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            background: #28a745;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .booking-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .booking-details h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 10px;
        }

        .detail-grid .label {
            color: #666;
        }

        .detail-grid .value {
            font-weight: 600;
            color: #333;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }

        .items-table thead {
            background: #333;
            color: white;
        }

        .items-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        .items-table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .items-table tbody tr:hover {
            background: #f8f9fa;
        }

        .items-table tfoot tr {
            border-top: 2px solid #333;
        }

        .items-table tfoot td {
            padding: 15px;
            font-weight: 600;
            font-size: 16px;
        }

        .total-row {
            background: #f8f9fa;
        }

        .total-row td {
            font-size: 18px;
            color: #333;
        }

        .actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            justify-content: center;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-print {
            background: #007bff;
            color: white;
        }

        .btn-print:hover {
            background: #0056b3;
        }

        .btn-home {
            background: #6c757d;
            color: white;
        }

        .btn-home:hover {
            background: #545b62;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 14px;
        }

        .note {
            font-style: italic;
            margin-top: 10px;
            font-size: 12px;
        }

        /* Print styles - Optimized for single page */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .invoice-container {
                max-width: 100%;
                box-shadow: none;
                padding: 15px !important;
                border-radius: 0;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            /* Compress header */
            .invoice-header {
                padding-bottom: 10px !important;
                margin-bottom: 15px !important;
                page-break-after: avoid;
                display: flex !important;
                justify-content: space-between !important;
                align-items: flex-start !important;
                flex-direction: row !important;
            }

            .company-info h1 {
                font-size: 24px !important;
                margin-bottom: 3px !important;
            }

            .company-info p {
                font-size: 11px !important;
                line-height: 1.4 !important;
                margin: 2px 0 !important;
            }

            .invoice-title h2 {
                font-size: 28px !important;
                margin-bottom: 5px !important;
            }

            .invoice-title p {
                font-size: 11px !important;
                margin-top: 2px !important;
            }

            /* Compress meta section */
            .invoice-meta {
                gap: 15px !important;
                margin-bottom: 15px !important;
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
            }

            .meta-box h3 {
                font-size: 11px !important;
                margin-bottom: 5px !important;
            }

            .meta-box p {
                margin: 3px 0 !important;
                font-size: 12px !important;
                line-height: 1.4 !important;
            }

            .status-badge {
                padding: 3px 8px !important;
                font-size: 10px !important;
            }

            /* Compress booking details */
            .booking-details {
                padding: 12px !important;
                margin-bottom: 15px !important;
            }

            .booking-details h3 {
                margin-bottom: 8px !important;
                font-size: 14px !important;
            }

            .detail-grid {
                gap: 5px !important;
                font-size: 12px !important;
                display: grid !important;
                grid-template-columns: 150px 1fr !important;
            }

            .detail-grid .label {
                padding: 2px 0 !important;
            }

            .detail-grid .value {
                padding: 2px 0 !important;
            }

            /* Compress table */
            .items-table {
                margin: 15px 0 !important;
                page-break-inside: avoid;
            }

            .items-table th {
                padding: 8px 10px !important;
                font-size: 12px !important;
            }

            .items-table td {
                padding: 8px 10px !important;
                font-size: 12px !important;
            }

            .items-table tbody tr td small {
                font-size: 10px !important;
            }

            .items-table tfoot td {
                padding: 8px 10px !important;
                font-size: 13px !important;
            }

            .total-row td {
                font-size: 14px !important;
            }

            /* Compress footer */
            .invoice-footer {
                margin-top: 15px !important;
                padding-top: 10px !important;
                font-size: 11px !important;
            }

            .invoice-footer p {
                margin: 3px 0 !important;
            }

            .note {
                font-size: 10px !important;
                margin-top: 3px !important;
            }

            /* Force single page */
            @page {
                size: A4;
                margin: 10mm;
            }

            html, body {
                height: auto;
            }
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .invoice-container {
                padding: 20px;
            }

            .invoice-header {
                flex-direction: column;
                gap: 20px;
            }

            .invoice-title {
                text-align: left;
            }

            .invoice-meta {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .items-table {
                font-size: 14px;
            }

            .items-table th,
            .items-table td {
                padding: 10px 5px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>