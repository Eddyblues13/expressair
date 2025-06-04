<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Package Tracking System | Shipment Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --primary-light: #3d566e;
            --secondary: #3498db;
            --secondary-light: #5dade2;
            --accent: #e74c3c;
            --light: #f8f9fa;
            --lighter: #ffffff;
            --dark: #2c3e50;
            --text: #34495e;
            --text-light: #7f8c8d;
            --border: #e0e0e0;
            --success: #2ecc71;
            --warning: #f39c12;
            --error: #e74c3c;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #dfe6f0 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text);
            line-height: 1.6;
            font-size: 15px;
        }

        .portal-container {
            width: 100%;
            max-width: 1100px;
            background: var(--lighter);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
            margin: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .portal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-placeholder {
            font-weight: 600;
            font-size: 18px;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }

        .logo-placeholder i {
            margin-right: 10px;
            font-size: 22px;
            color: var(--secondary-light);
        }

        .portal-content {
            padding: 40px;
        }

        .portal-title {
            text-align: center;
            margin-bottom: 30px;
            animation: slideUp 0.5s ease-out 0.2s both;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .portal-title h1 {
            color: var(--primary);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .portal-title p {
            color: var(--text-light);
            font-size: 16px;
        }

        .package-card {
            background: var(--lighter);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: var(--transition);
            animation: fadeIn 0.6s ease-out 0.3s both;
        }

        .package-card:hover {
            box-shadow: var(--shadow-md);
        }

        .package-alert {
            background-color: rgba(52, 152, 219, 0.1);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-weight: 500;
            color: var(--primary);
            border-left: 4px solid var(--secondary);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.6s ease-out 0.1s both;
        }

        .package-alert i {
            font-size: 18px;
            color: var(--secondary);
        }

        /* Live Tracking Section */
        .live-tracking {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .live-tracking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .live-tracking-title {
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .live-tracking-title i {
            color: var(--secondary);
        }

        .live-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            background-color: var(--success);
            color: white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 1;
            }
        }

        .tracking-path {
            display: flex;
            align-items: center;
            padding: 15px 0;
            position: relative;
        }

        .tracking-line {
            height: 2px;
            background: var(--border);
            flex-grow: 1;
            position: relative;
        }

        .tracking-progress {
            position: absolute;
            height: 100%;
            background: var(--secondary);
            width: 65%;
            animation: progressAnimation 3s ease-in-out infinite alternate;
        }

        @keyframes progressAnimation {
            0% {
                width: 65%;
            }

            100% {
                width: 68%;
            }
        }

        .tracking-point {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--secondary);
            border: 3px solid white;
            box-shadow: 0 0 0 3px var(--secondary-light);
            position: absolute;
            left: 65%;
            transform: translateX(-50%);
            animation: pointMove 3s ease-in-out infinite alternate;
            z-index: 2;
        }

        @keyframes pointMove {
            0% {
                left: 65%;
            }

            100% {
                left: 68%;
            }
        }

        .tracking-locations {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .location {
            text-align: center;
            flex: 1;
            max-width: 25%;
            position: relative;
        }

        .location.active {
            font-weight: 600;
            color: var(--primary);
        }

        .location-name {
            font-size: 13px;
            margin-bottom: 5px;
        }

        .location-time {
            font-size: 11px;
            color: var(--text-light);
        }

        .current-location {
            background-color: var(--secondary);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .current-location i {
            animation: spin 4s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .package-detail {
            margin-bottom: 20px;
        }

        .detail-title {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-title i {
            font-size: 16px;
        }

        .detail-value {
            background: var(--light);
            padding: 15px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-family: 'Roboto Mono', monospace;
            word-break: break-word;
            line-height: 1.7;
            transition: var(--transition);
        }

        .detail-value:hover {
            background: var(--lighter);
            box-shadow: var(--shadow-sm);
        }

        /* Progress Tracker */
        .progress-tracker {
            margin: 40px 0;
            padding: 25px 0;
            animation: slideUp 0.5s ease-out 0.4s both;
        }

        .tracker-title {
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 25px;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
            position: relative;
        }

        .tracker-title:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: var(--secondary);
        }

        .tracker-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 0 40px;
        }

        .tracker-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--border);
            z-index: 1;
            border-radius: 2px;
        }

        .tracker-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            flex: 1;
            max-width: 25%;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--border);
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 12px;
            border: 3px solid var(--lighter);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .step-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-light);
            text-align: center;
            max-width: 100px;
            transition: var(--transition);
        }

        .step-date {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 5px;
            text-align: center;
            transition: var(--transition);
        }

        .tracker-step.active .step-number {
            background: var(--secondary);
            color: var(--lighter);
            transform: scale(1.1);
            box-shadow: 0 0 0 5px rgba(52, 152, 219, 0.2);
        }

        .tracker-step.active .step-name {
            color: var(--primary);
            font-weight: 700;
        }

        .tracker-step.active .step-date {
            color: var(--primary);
        }

        .tracker-step.completed .step-number {
            background: var(--success);
            color: var(--lighter);
        }

        .tracker-step.completed .step-name {
            color: var(--primary);
        }

        .tracker-step.completed .step-date {
            color: var(--primary);
        }

        .tracker-progress {
            position: absolute;
            top: 20px;
            left: 0;
            height: 4px;
            background: var(--secondary);
            transition: width 0.6s cubic-bezier(0.65, 0, 0.35, 1);
            z-index: 2;
            border-radius: 2px;
        }

        /* Package Details Grid */
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .detail-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        .detail-table th {
            text-align: left;
            padding: 12px 15px;
            background-color: var(--primary);
            color: white;
            font-weight: 500;
            border-radius: 6px 6px 0 0;
        }

        .detail-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
            background-color: var(--light);
            transition: var(--transition);
        }

        .detail-table tr:last-child td {
            border-bottom: none;
            border-radius: 0 0 6px 6px;
        }

        .detail-table tr:hover td {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .detail-label {
            font-weight: 500;
            color: var(--primary);
            min-width: 120px;
            display: inline-block;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background-color: #d4edda;
            color: #155724;
        }

        .status-delivered {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(44, 62, 80, 0.05);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        @media (max-width: 768px) {
            .portal-content {
                padding: 25px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .tracker-steps {
                margin: 0 5px;
            }

            .step-name {
                font-size: 11px;
                max-width: 70px;
            }

            .step-date {
                font-size: 9px;
            }

            .portal-header {
                padding: 15px 20px;
            }

            .package-card {
                padding: 20px;
            }

            .tracking-locations {
                flex-wrap: wrap;
            }

            .location {
                max-width: 50%;
                margin-bottom: 15px;
            }
        }

        @media (max-width: 480px) {
            .tracker-step {
                max-width: 20%;
            }

            .step-number {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .step-name {
                font-size: 9px;
                max-width: 50px;
            }

            .step-date {
                display: none;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="portal-container">
        <div class="portal-header">
            <div class="logo-container">
                <div class="logo-placeholder">
                    <i class="fas fa-shipping-fast"></i>
                    Express Air Delivery TrackPro
                </div>
            </div>
        </div>

        <div class="portal-content">
            <div class="portal-title">
                <h1>Shipment Tracking Details</h1>
                <p>Real-time updates for your package #{{ $package->tracking_number }}</p>
            </div>

            <div class="package-alert">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Current Status:</strong>
                    <span class="status-badge status-{{ strtolower($package->status) }}">
                        {{ $package->status }}
                    </span>
                    • Last updated: <span id="lastUpdated">{{ date('M d, Y H:i') }}</span>
                </div>
            </div>

            <!-- Live Tracking Section -->
            <div class="live-tracking">
                <div class="live-tracking-header">
                    <div class="live-tracking-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Live Package Tracking
                        <span class="live-status">ACTIVE</span>
                    </div>
                </div>

                <div class="tracking-path">
                    <div class="tracking-line">
                        <div class="tracking-progress"></div>
                        <div class="tracking-point"></div>
                    </div>
                </div>

                <div class="tracking-locations">
                    <div class="location">
                        <div class="location-name">New York</div>
                        <div class="location-time">Jun 10, 10:30 AM</div>
                    </div>
                    <div class="location">
                        <div class="location-name">Chicago</div>
                        <div class="location-time">Jun 12, 2:15 PM</div>
                    </div>
                    <div class="location active">
                        <div class="location-name">Denver</div>
                        <div class="location-time">Current Location</div>
                    </div>
                    <div class="location">
                        <div class="location-name">San Francisco</div>
                        <div class="location-time">Est. Jun 15</div>
                    </div>
                </div>

                <div class="current-location">
                    <i class="fas fa-location-arrow"></i>
                    <span id="currentLocation">Currently in Denver, CO - In Transit to Next Facility</span>
                </div>
            </div>

            <!-- Transaction Progress Tracker -->
            <div class="progress-tracker">
                <div class="tracker-title">Shipment Progress</div>
                <div class="tracker-steps">
                    <div class="tracker-progress" style="width: {{ $package->progress_percentage }}%"></div>

                    <div
                        class="tracker-step {{ $package->current_step >= 1 ? 'completed' : ($package->current_step == 1 ? 'active' : '') }}">
                        <div class="step-number">1</div>
                        <div class="step-name">{{ $package->step1_name ?? 'Order Received' }}</div>
                        @if($package->step1_date)
                        <div class="step-date">
                            @if(is_string($package->step1_date))
                            {{ date('M d, Y', strtotime($package->step1_date)) }}
                            @else
                            {{ $package->step1_date->format('M d, Y') }}
                            @endif
                        </div>
                        @endif
                    </div>

                    <div
                        class="tracker-step {{ $package->current_step >= 2 ? 'completed' : ($package->current_step == 2 ? 'active' : '') }}">
                        <div class="step-number">2</div>
                        <div class="step-name">{{ $package->step2_name ?? 'Processing' }}</div>
                        @if($package->step2_date)
                        <div class="step-date">
                            @if(is_string($package->step2_date))
                            {{ date('M d, Y', strtotime($package->step2_date)) }}
                            @else
                            {{ $package->step2_date->format('M d, Y') }}
                            @endif
                        </div>
                        @endif
                    </div>

                    <div
                        class="tracker-step {{ $package->current_step >= 3 ? 'completed' : ($package->current_step == 3 ? 'active' : '') }}">
                        <div class="step-number">3</div>
                        <div class="step-name">{{ $package->step3_name ?? 'In Transit' }}</div>
                        @if($package->step3_date)
                        <div class="step-date">
                            @if(is_string($package->step3_date))
                            {{ date('M d, Y', strtotime($package->step3_date)) }}
                            @else
                            {{ $package->step3_date->format('M d, Y') }}
                            @endif
                        </div>
                        @endif
                    </div>

                    <div
                        class="tracker-step {{ $package->current_step >= 4 ? 'completed' : ($package->current_step == 4 ? 'active' : '') }}">
                        <div class="step-number">4</div>
                        <div class="step-name">{{ $package->step4_name ?? 'Delivered' }}</div>
                        @if($package->step4_date)
                        <div class="step-date">
                            @if(is_string($package->step4_date))
                            {{ date('M d, Y', strtotime($package->step4_date)) }}
                            @else
                            {{ $package->step4_date->format('M d, Y') }}
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="package-card">
                <div class="details-grid">
                    <div>
                        <table class="detail-table">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <i class="fas fa-user"></i> Sender Information
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="detail-label">Name</span></td>
                                    <td>{{ $package->sender_name }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Address</span></td>
                                    <td>{{ $package->sender_address }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">City/State/Zip</span></td>
                                    <td>{{ $package->sender_city }}, {{ $package->sender_state }} {{
                                        $package->sender_zip }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Country</span></td>
                                    <td>{{ $package->sender_country }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Contact</span></td>
                                    <td>
                                        <div>{{ $package->sender_phone }}</div>
                                        <div>{{ $package->sender_email }}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="detail-table">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <i class="fas fa-truck"></i> Shipping Information
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="detail-label">From</span></td>
                                    <td>{{ $package->shipping_from }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">To</span></td>
                                    <td>{{ $package->shipping_to }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Shipped Date</span></td>
                                    <td>
                                        @if($package->shipping_date)
                                        @if(is_string($package->shipping_date))
                                        {{ date('M d, Y', strtotime($package->shipping_date)) }}
                                        @else
                                        {{ $package->shipping_date->format('M d, Y') }}
                                        @endif
                                        @else
                                        Pending
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Est. Delivery</span></td>
                                    <td>
                                        @if($package->estimated_delivery_date)
                                        @if(is_string($package->estimated_delivery_date))
                                        {{ date('M d, Y', strtotime($package->estimated_delivery_date)) }}
                                        @else
                                        {{ $package->estimated_delivery_date->format('M d, Y') }}
                                        @endif
                                        @else
                                        To be determined
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Carrier</span></td>
                                    <td>Express Air Delivery Express</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Service</span></td>
                                    <td>Priority International</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <table class="detail-table">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <i class="fas fa-user-tag"></i> Receiver Information
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="detail-label">Name</span></td>
                                    <td>{{ $package->receiver_name }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Address</span></td>
                                    <td>{{ $package->receiver_address }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">City/State/Zip</span></td>
                                    <td>{{ $package->receiver_city }}, {{ $package->receiver_state }} {{
                                        $package->receiver_zip }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Country</span></td>
                                    <td>{{ $package->receiver_country }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Contact</span></td>
                                    <td>
                                        <div>{{ $package->receiver_phone }}</div>
                                        <div>{{ $package->receiver_email }}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="detail-table">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <i class="fas fa-box-open"></i> Package Details
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="detail-label">Description</span></td>
                                    <td>{{ $package->item_description }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Quantity</span></td>
                                    <td>{{ $package->item_quantity }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Declared Value</span></td>
                                    <td>${{ number_format($package->declared_value, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Total Weight</span></td>
                                    <td>{{ $package->total_weight }} kg</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Boxes</span></td>
                                    <td>{{ $package->number_of_boxes }} ({{ $package->box_weight }} kg each)</td>
                                </tr>
                                <tr>
                                    <td><span class="detail-label">Dimensions</span></td>
                                    <td>30 × 20 × 15 cm (each)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($package->notes)
                <div class="package-detail">
                    <div class="detail-title">
                        <i class="fas fa-sticky-note"></i> Additional Notes
                    </div>
                    <div class="detail-value">
                        {{ $package->notes }}
                    </div>
                </div>
                @endif

                <div class="action-buttons">
                    <button class="btn btn-outline" id="printBtn">
                        <i class="fas fa-print"></i> Print Details
                    </button>
                    <button class="btn btn-primary" id="refreshBtn">
                        <i class="fas fa-sync-alt"></i> Refresh Status
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple animation for the progress bar on load
        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.querySelector('.tracker-progress');
            const currentWidth = progressBar.style.width;
            progressBar.style.width = '0';
            
            setTimeout(() => {
                progressBar.style.width = currentWidth;
            }, 300);
            
            // Add hover effects to cards
            const cards = document.querySelectorAll('.package-card, .detail-table');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });

            // Print button functionality
            document.getElementById('printBtn').addEventListener('click', function() {
                window.print();
            });

            // Refresh button functionality
            document.getElementById('refreshBtn').addEventListener('click', function() {
                const btn = this;
                const icon = btn.querySelector('i');
                
                // Disable button during refresh
                btn.disabled = true;
                icon.classList.add('fa-spin');
                
                // Simulate API call
                setTimeout(() => {
                    // Update last updated time
                    const now = new Date();
                    document.getElementById('lastUpdated').textContent = 
                        now.toLocaleString('en-US', { 
                            month: 'short', 
                            day: '2-digit', 
                            year: 'numeric', 
                            hour: '2-digit', 
                            minute: '2-digit' 
                        });
                    
                    // Randomly update current location for demo purposes
                    const locations = [
                        "Currently in Denver, CO - In Transit to Next Facility",
                        "Currently in Denver, CO - Processed at Distribution Center",
                        "Currently in Salt Lake City, UT - Arrived at Regional Facility",
                        "Currently in Reno, NV - Departed from Regional Facility"
                    ];
                    const randomLocation = locations[Math.floor(Math.random() * locations.length)];
                    document.getElementById('currentLocation').textContent = randomLocation;
                    
                    // Re-enable button
                    btn.disabled = false;
                    icon.classList.remove('fa-spin');
                    
                    // Show refresh confirmation
                    const alertDiv = document.querySelector('.package-alert');
                    alertDiv.innerHTML = `
                        <i class="fas fa-check-circle" style="color: var(--success)"></i>
                        <div>
                            <strong>Status Updated:</strong> 
                            <span class="status-badge status-${'{{ strtolower($package->status) }}'}">
                                {{ $package->status }}
                            </span>
                            • Last updated: ${document.getElementById('lastUpdated').textContent}
                        </div>
                    `;
                    
                    // Flash animation
                    alertDiv.style.animation = 'none';
                    alertDiv.offsetHeight; // Trigger reflow
                    alertDiv.style.animation = 'fadeIn 0.6s ease-out';
                }, 1500);
            });

            // Simulate live tracking updates
            function updateTracking() {
                const trackingProgress = document.querySelector('.tracking-progress');
                const trackingPoint = document.querySelector('.tracking-point');
                const currentWidth = parseFloat(trackingProgress.style.width || '65');
                
                // Increment progress slightly (for demo purposes)
                const newWidth = Math.min(currentWidth + 0.5, 100);
                trackingProgress.style.width = `${newWidth}%`;
                trackingPoint.style.left = `${newWidth}%`;
                
                // Update current location occasionally
                if (Math.random() > 0.8) {
                    const locations = [
                        "Denver, CO - In Transit",
                        "Denver, CO - Processed",
                        "Salt Lake City, UT - Arrived",
                        "Reno, NV - Departed"
                    ];
                    const randomLocation = locations[Math.floor(Math.random() * locations.length)];
                    document.getElementById('currentLocation').textContent = `Currently in ${randomLocation}`;
                }
            }
            
            // Update tracking every 5 seconds
            setInterval(updateTracking, 5000);
        });
    </script>
</body>

</html>