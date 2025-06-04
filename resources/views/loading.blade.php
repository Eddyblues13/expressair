<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Payment Portal | Processing</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #1abc9c;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --text: #34495e;
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
            max-width: 900px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }

        .portal-info {
            flex: 1;
            background: var(--primary);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
        }

        .logo-container {
            margin-bottom: 30px;
            text-align: center;
        }

        .logo {
            height: 30px;
            width: auto;
        }

        .auth-container {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .processing-header {
            margin-bottom: 30px;
        }

        .processing-header h1 {
            color: var(--primary);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .processing-header p {
            color: #7f8c8d;
            font-size: 15px;
        }

        .spinner {
            border: 5px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 5px solid var(--secondary);
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 30px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .status-message {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            max-width: 400px;
            width: 100%;
        }

        .new-user-notice {
            background-color: rgba(26, 188, 156, 0.1);
            border-left: 4px solid var(--secondary);
            padding: 15px;
            margin-top: 20px;
            text-align: left;
            max-width: 400px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .portal-container {
                flex-direction: column;
            }

            .portal-info,
            .auth-container {
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="portal-container">
        <div class="portal-info">
            <div class="logo-container">
                <a href="#">
                    <img src="{{ asset('5df16d8f13f4cced330e587b_stellar-logo-solo-1-removebg-preview.png') }}"
                        alt="Logo" class="logo">
                </a>
            </div>
        </div>

        <div class="auth-container">
            <div class="processing-header">
                <h1>Verifying Your Identity</h1>
                <p>This may take a moment while we validate your information</p>
            </div>

            <div class="spinner"></div>

            <div class="status-message" id="statusMessage">
                <p>Initializing verification...</p>
            </div>

            @if(session('new_user'))
            <div class="new-user-notice">
                <p><strong>First time user detected</strong></p>
                <p>We're connecting your profile to the IMF database with enhanced security settings.Check back later</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        const messages = [
            "Connecting to IMF server...",
            "Checking IMF database...",
            "transferring data to portal...",
            // "Checking government databases...",
            "Validating personal information...",
            "Securing your account..."
        ];
    
        let index = 0;
        const statusDiv = document.querySelector('.status-message');
    
        function updateStatusMessage() {
            if (index < messages.length) {
                statusDiv.innerHTML = `<p>${messages[index]}</p>`;
                index++;
            } else {
                // Redirect after the last message (18 seconds total - 6 messages × 3 seconds)
                // Pass the user ID and status to the verification route
                window.location.href = "{{ route('verify.user', ['user_id' => $user->id ?? 0, 'status' => $status ?? 'pending']) }}";
            }
        }
    
        updateStatusMessage(); // Start immediately
        setInterval(updateStatusMessage, 5000); // Every 3 seconds
    </script>
</body>

</html>