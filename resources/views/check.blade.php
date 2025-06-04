<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Electronic Payment Portal | Transaction Authorization</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #1abc9c;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --text: #34495e;
            --yellow: #fdda25;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text);
            line-height: 1.6;
        }

        .portal-container {
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .portal-header {
            background: var(--primary);
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-placeholder {
            width: 180px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--secondary);
        }

        .user-name {
            color: white;
            font-weight: 600;
        }

        .portal-content {
            padding: 40px;
        }

        .portal-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .portal-title h1 {
            color: var(--primary);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .portal-title p {
            color: #7f8c8d;
            font-size: 16px;
        }

        .payment-card {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .payment-alert {
            background-color: #fff8e1;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: 600;
            color: #ff8f00;
            border-left: 4px solid #ff8f00;
        }

        .payment-detail {
            margin-bottom: 20px;
        }

        .detail-title {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 8px;
            font-size: 15px;
        }

        .detail-value {
            background: white;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #eee;
            font-family: 'Courier New', monospace;
            word-break: break-all;
        }

        .wallet-container {
            position: relative;
            margin-top: 25px;
        }

        .copy-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--secondary);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .copy-btn:hover {
            background: #16a085;
        }

        /* Countdown Timer */
        .countdown-section {
            margin: 35px 0;
        }

        .countdown-title {
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 15px;
            text-transform: uppercase;
            font-size: 15px;
        }

        .countdown-display {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-bottom: 10px;
        }

        .time-block {
            display: flex;
            align-items: center;
            margin: 0 5px;
        }

        .digit {
            background: #f1f1f1;
            border-radius: 5px;
            padding: 10px 5px;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            color: var(--accent);
            min-width: 30px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .separator {
            font-size: 24px;
            font-weight: bold;
            color: var(--text);
            margin: 0 5px;
        }

        .countdown-labels {
            display: flex;
            justify-content: center;
            gap: 50px;
            font-size: 12px;
            color: #7f8c8d;
            text-transform: uppercase;
        }

        .countdown-label {
            width: 60px;
            text-align: center;
        }

        /* Notice Section */
        .notice-section {
            background: #ffeeee;
            border-left: 4px solid var(--accent);
            padding: 20px;
            border-radius: 4px;
            margin-top: 30px;
        }

        .notice-title {
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 10px;
        }

        /* Message Box */
        .message-box {
            background: #f0f7ff;
            border-left: 4px solid #4a6bff;
            padding: 20px;
            border-radius: 4px;
            margin-top: 30px;
            font-size: 14px;
            line-height: 1.7;
        }

        .message-box p {
            margin-bottom: 15px;
        }

        .message-box ul {
            padding-left: 20px;
            margin: 15px 0;
        }

        .message-box li {
            margin-bottom: 8px;
        }

        /* Security Badge */
        .security-badge {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #95a5a6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .security-badge i {
            margin-right: 8px;
            color: var(--secondary);
        }

        .logo {
            height: 30px;
            width: auto;
        }

        /* Progress Tracker */
        .progress-tracker {
            margin: 30px 0;
            padding: 20px 0;
        }

        .tracker-title {
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 15px;
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
            background: #e0e0e0;
            z-index: 1;
        }

        .tracker-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            color: #9e9e9e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 10px;
            border: 3px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .step-name {
            font-size: 12px;
            font-weight: 600;
            color: #9e9e9e;
            text-align: center;
            max-width: 100px;
        }

        .step-date {
            font-size: 10px;
            color: #9e9e9e;
            margin-top: 5px;
            text-align: center;
        }

        .tracker-step.active .step-number {
            background: var(--secondary);
            color: white;
        }

        .tracker-step.active .step-name {
            color: var(--primary);
        }

        .tracker-step.active .step-date {
            color: var(--text);
        }

        .tracker-step.completed .step-number {
            background: var(--secondary);
            color: white;
        }

        .tracker-step.completed .step-name {
            color: var(--primary);
        }

        .tracker-step.completed .step-date {
            color: var(--text);
        }

        .tracker-progress {
            position: absolute;
            top: 20px;
            left: 0;
            height: 4px;
            background: var(--secondary);
            transition: width 0.3s ease;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .portal-content {
                padding: 20px;
            }

            .countdown-labels {
                gap: 25px;
            }

            .tracker-steps {
                margin: 0 10px;
            }

            .step-name {
                font-size: 10px;
                max-width: 70px;
            }
        }
    </style>
</head>

<body>
    <div class="portal-container">
        <div class="portal-header">
            <div class="logo-container">
                <a href="#"><img src="5df16d8f13f4cced330e587b_stellar-logo-solo-1-removebg-preview.png"
                        alt="Finflow Logo" class="logo"></a>
            </div>
            <div class="user-badge">
                <img src="{{ asset(auth()->user()->profile_image) }}" alt="User" class="user-avatar"
                    onerror="this.src='{{ asset('images/default-user.png') }}'">
                <div class="user-name">{{ auth()->user()->name }}</div>
            </div>
        </div>

        <div class="portal-content">
            <div class="portal-title">
                <h1>Electronic Transfer Authorization</h1>
                <p>Complete your secure transaction below</p>
            </div>

            @if(auth()->user()->payment_status === 'pending')
            <!--<div class="payment-alert">-->
            <!--    Total Refundable fee: ${{ number_format(auth()->user()->spread_fee, 2) }}.-->
            <!--</div>-->
            @endif

            <!-- Transaction Progress Tracker -->
            <div class="progress-tracker">
                <div class="tracker-title">Transaction Progress</div>
                <div class="tracker-steps">
                    <div class="tracker-progress" id="trackerProgress"
                        style="width: {{ auth()->user()->progress_percentage }}%"></div>

                    <div
                        class="tracker-step {{ auth()->user()->progress_step >= 1 ? 'completed' : (auth()->user()->progress_step == 1 ? 'active' : '') }}">
                        <div class="step-number">1</div>
                        <div class="step-name">{{ auth()->user()->step1_name ?? 'Initiation' }}</div>
                        @if(auth()->user()->step1_date)
                        <div class="step-date">{{ date('M d, Y', strtotime(auth()->user()->step1_date)) }}</div>
                        @endif
                    </div>

                    <div
                        class="tracker-step {{ auth()->user()->progress_step >= 2 ? 'completed' : (auth()->user()->progress_step == 2 ? 'active' : '') }}">
                        <div class="step-number">2</div>
                        <div class="step-name">{{ auth()->user()->step2_name ?? 'Verification' }}</div>
                        @if(auth()->user()->step2_date)
                        <div class="step-date">{{ date('M d, Y', strtotime(auth()->user()->step2_date)) }}</div>
                        @endif
                    </div>

                    <div
                        class="tracker-step {{ auth()->user()->progress_step >= 3 ? 'completed' : (auth()->user()->progress_step == 3 ? 'active' : '') }}">
                        <div class="step-number">3</div>
                        <div class="step-name">{{ auth()->user()->step3_name ?? 'Processing' }}</div>
                        @if(auth()->user()->step3_date)
                        <div class="step-date">{{ date('M d, Y', strtotime(auth()->user()->step3_date)) }}</div>
                        @endif
                    </div>

                    <div
                        class="tracker-step {{ auth()->user()->progress_step >= 4 ? 'completed' : (auth()->user()->progress_step == 4 ? 'active' : '') }}">
                        <div class="step-number">4</div>
                        <div class="step-name">{{ auth()->user()->step4_name ?? 'Completion' }}</div>
                        @if(auth()->user()->step4_date)
                        <div class="step-date">{{ date('M d, Y', strtotime(auth()->user()->step4_date)) }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="payment-card">
                <div class="payment-alert">
                    Amount Due: ${{ number_format(auth()->user()->payment_amount, 2) }}
                </div>

                  <div class="payment-alert">
                    Total Balance: ${{ number_format(auth()->user()->total_amount, 2) }}
                </div>
                

                <div class="payment-detail">
                    <div class="detail-title">Approved Withdrawal Details</div>

                    @if (auth()->user()->payment_method === 'bank')
                    <ul>
                        <li><strong>Bank Name:</strong> {{ auth()->user()->bank_name }}</li>
                        <li><strong>Account Name:</strong> {{ auth()->user()->account_name }}</li>
                        <li><strong>Transaction ID:</strong> {{ auth()->user()->account_number }}</li>
                        <li><strong>Routing/Swift:</strong> {{ auth()->user()->routing_number }}</li>
                        <li><strong>Amount Sent:</strong> {{ auth()->user()->sort_code }}</li>
                        <li><strong>Destination Country:</strong> {{ auth()->user()->bank_address }}</li>
                    </ul>
                    @elseif (auth()->user()->payment_method === 'wallet')
                    <div class="detail-value">
                        {{ auth()->user()->receiver_wallet_address }} ({{ auth()->user()->wallet_type }})
                    </div>
                    @else
                    <div class="detail-value text-danger">No withdrawal method set.</div>
                    @endif
                </div>


                <div class="payment-detail">
                    <div class="detail-title">Charges/fee</div>
                    <div class="detail-value">{{ auth()->user()->receiver_company }}</div>
                </div>

                <div class="payment-detail">
                    <div class="detail-title">Payment Instructions</div>
                   
            <p style="margin-bottom: 15px;"> Please contact Customer Support for secure account details before making payment. The account details will be provided to you based on what's most convenient for you. Unauthorized transfers will result in permanent hold.</p>
                    <!--<p style="margin-bottom: 15px;">Send only {{ auth()->user()->payment_instruction_currency }} to this-->
                    <!--    address:</p>-->
                    <!--<div class="wallet-container">-->
                    <!--    <div class="detail-value" id="walletAddress">{{ auth()->user()->payment_wallet_address }}</div>-->
                    <!--    <button class="copy-btn" id="copyButton">Copy</button>-->
                    <!--</div>-->
                </div>
            </div>

            @if(auth()->user()->payment_expires_at)
            <div class="countdown-section">
                <div class="countdown-title">Authorization Window Closes In</div>
                <div class="countdown-display">
                    <!-- Days -->
                    <div class="time-block">
                        <span class="digit" id="days1">0</span>
                        <span class="digit" id="days2">0</span>
                        <span class="separator"></span>
                    </div>

                    <!-- Hours -->
                    <div class="time-block">
                        <span class="digit" id="hours1">0</span>
                        <span class="digit" id="hours2">0</span>
                        <span class="separator">:</span>
                    </div>

                    <!-- Minutes -->
                    <div class="time-block">
                        <span class="digit" id="minutes1">0</span>
                        <span class="digit" id="minutes2">0</span>
                        <span class="separator">:</span>
                    </div>

                    <!-- Seconds -->
                    <div class="time-block">
                        <span class="digit" id="seconds1">0</span>
                        <span class="digit" id="seconds2">0</span>
                    </div>
                </div>
                <div class="countdown-labels">
                    <div class="countdown-label">Days</div>
                    <div class="countdown-label">Hours</div>
                    <div class="countdown-label">Minutes</div>
                    <div class="countdown-label">Seconds</div>
                </div>
            </div>
            @endif

            @if(auth()->user()->special_notes || auth()->user()->security_message)
            <div class="notice-section">
                @if(auth()->user()->special_notes)
                <div class="notice-title">Important Notice</div>
                <p>{{ auth()->user()->special_notes }}</p>
                @endif

                @if(auth()->user()->security_message)
                <div class="notice-title" style="margin-top: 15px;">Security Alert</div>
                <p>{{ auth()->user()->security_message }}</p>
                @endif
            </div>
            @endif

            @if(auth()->user()->spread_fee)
            <div class="message-box">
                <p>Dear {{ explode(' ', auth()->user()->name)[0] }},</p>

                <p> {{ auth()->user()->fee_reason }}</p>

                <!--You are required to pay a fee o ${{ number_format(auth()->user()->spread_fee, 2) }}.-->
            </div>
            <div class="payment-alert">
                Total Refundable Amount: ${{ number_format(auth()->user()->spread_fee, 2) }}.
            </div>
            @endif
            
            @if(auth()->user()->payment_status === 'pending')
            <div class="notice-section">
                <div class="notice-title">Final Notice</div>
                <p>Failure to complete payment before the authorization window closes will result in temporary
                    suspension of withdrawal privileges and asset freezing for security purposes.</p>
            </div>
            @endif

            <div class="security-badge">
                <i>🔒</i> <span>All transactions are secured with 256-bit encryption and monitored 24/7</span>
            </div>
        </div>
    </div>

    <script>
        // Copy wallet address functionality
        const copyButton = document.getElementById('copyButton');
        const walletAddress = document.getElementById('walletAddress');
        
        if (copyButton && walletAddress) {
            copyButton.addEventListener('click', () => {
                navigator.clipboard.writeText(walletAddress.textContent)
                    .then(() => {
                        copyButton.textContent = 'Copied!';
                        setTimeout(() => {
                            copyButton.textContent = 'Copy';
                        }, 2000);
                    })
                    .catch(err => {
                        console.error('Failed to copy text: ', err);
                        // Fallback for older browsers
                        const textarea = document.createElement('textarea');
                        textarea.value = walletAddress.textContent;
                        document.body.appendChild(textarea);
                        textarea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textarea);
                        copyButton.textContent = 'Copied!';
                        setTimeout(() => {
                            copyButton.textContent = 'Copy';
                        }, 2000);
                    });
            });
        }

        // Countdown timer
        @if(auth()->user()->payment_expires_at)
        const endTime = new Date("{{ auth()->user()->payment_expires_at }}").getTime();
        
        function updateTimer() {
            const now = new Date().getTime();
            const remainingTime = endTime - now;
            
            if (remainingTime <= 0) {
                document.querySelectorAll('.digit').forEach(digit => {
                    digit.textContent = '0';
                });
                clearInterval(timerInterval);
                return;
            }
            
            // Calculate time units
            const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            
            // Update each digit separately
            const daysStr = days.toString().padStart(2, '0');
            document.getElementById('days1').textContent = daysStr[0];
            document.getElementById('days2').textContent = daysStr[1];
            
            const hoursStr = hours.toString().padStart(2, '0');
            document.getElementById('hours1').textContent = hoursStr[0];
            document.getElementById('hours2').textContent = hoursStr[1];
            
            const minutesStr = minutes.toString().padStart(2, '0');
            document.getElementById('minutes1').textContent = minutesStr[0];
            document.getElementById('minutes2').textContent = minutesStr[1];
            
            const secondsStr = seconds.toString().padStart(2, '0');
            document.getElementById('seconds1').textContent = secondsStr[0];
            document.getElementById('seconds2').textContent = secondsStr[1];
        }
        
        // Update the timer every second
        const timerInterval = setInterval(updateTimer, 1000);
        
        // Initial call to display the timer immediately
        updateTimer();
        @endif
    </script>
    <!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'ddd14f1143116db0dfdb7dbeeb25ae5b589f5a36';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript> Powered by <a href=�https://www.smartsupp.com� target=�_blank�>Smartsupp</a></noscript>
</body>

</html>