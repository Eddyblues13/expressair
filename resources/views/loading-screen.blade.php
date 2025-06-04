<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Payment Portal | Processing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
           /* Same root variables and base styles */
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

        .portal-content h2 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .portal-content p {
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .auth-container {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .loading-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .loading-header h1 {
            color: var(--primary);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .loading-header p {
            color: #7f8c8d;
            font-size: 15px;
        }

        .loading-animation {
            width: 100%;
            max-width: 400px;
            margin: 30px 0;
        }

        .loading-stage {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 6px;
            background-color: #f9f9f9;
            position: relative;
            transition: all 0.3s;
        }

        .loading-stage.active {
            background-color: rgba(26, 188, 156, 0.1);
            border-left: 4px solid var(--secondary);
        }

        .loading-stage.completed {
            background-color: rgba(26, 188, 156, 0.1);
        }

        .loading-stage.completed::before {
            content: "✓";
            position: absolute;
            left: 15px;
            color: var(--secondary);
            font-weight: bold;
        }

        .loading-stage-text {
            margin-left: 30px;
        }

        .spinner {
            border: 5px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 5px solid var(--secondary);
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .connection-failed {
            color: var(--accent);
            text-align: center;
            margin-top: 20px;
            display: none;
        }

        .btn-retry {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
            display: none;
        }

        .btn-retry:hover {
            background: #16a085;
            transform: translateY(-2px);
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
        .processing-animation {
            text-align: center;
            margin: 30px 0;
        }
        
        .processing-stages {
            margin-top: 30px;
        }
        
        .processing-stage {
            padding: 15px;
            margin-bottom: 15px;
            background: #f9f9f9;
            border-radius: 6px;
            position: relative;
            transition: all 0.3s;
        }
        
        .processing-stage.active {
            background: rgba(26, 188, 156, 0.1);
            border-left: 4px solid var(--secondary);
        }
        
        .processing-stage.completed::before {
            content: "✓";
            position: absolute;
            left: 15px;
            color: var(--secondary);
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="portal-container">
        <div class="portal-info">
            <div class="logo-container">
                <a href="#"><img src="5df16d8f13f4cced330e587b_stellar-logo-solo-1-removebg-preview.png" alt="Finflow Logo" class="logo"></a>
            </div>
            
            <div class="portal-content">
                <h2>Secure Verification</h2>
                <p>We're performing enhanced verification checks to ensure the security of your account and transactions.</p>
                
                <ul class="feature-list">
                    <li>Real-time identity validation</li>
                    <li>Document verification</li>
                    <li>Regulatory compliance checks</li>
                    <li>Fraud prevention screening</li>
                    <li>Secure account setup</li>
                </ul>
                
                <p>This process typically takes 15-30 seconds. Please do not refresh your browser.</p>
            </div>
        </div>
        
        <div class="auth-container">
            <div class="auth-header">
                <h1>Processing Your Request</h1>
                <p>{{ $message }}</p>
            </div>
            
            <div class="processing-animation">
                <div class="spinner" style="margin: 0 auto;"></div>
            </div>
            
            <div class="processing-stages">
                <div class="processing-stage active" id="stage1">
                    <div>Verifying your information</div>
                </div>
                <div class="processing-stage" id="stage2">
                    <div>Checking security parameters</div>
                </div>
                <div class="processing-stage" id="stage3">
                    <div>Finalizing your access</div>
                </div>
            </div>
            
            @if(session('new_user'))
            <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle"></i> 
                A temporary account has been created for verification.
            </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                positionClass: 'toast-top-right',
                progressBar: true,
                closeButton: true,
                timeOut: 5000,
                preventDuplicates: true
            };

            // Show any error messages
            @if(session('error'))
                toastr.error('{{ session('error') }}');
            @endif

            // Animate processing stages
            const stages = [
                { id: 'stage1', duration: 5000 },
                { id: 'stage2', duration: 5000 },
                { id: 'stage3', duration: 5000 }
            ];

            function animateStages() {
                stages.forEach((stage, index) => {
                    setTimeout(() => {
                        $(`#${stage.id}`).addClass('active');
                        setTimeout(() => {
                            $(`#${stage.id}`).removeClass('active').addClass('completed');
                        }, stage.duration - 500);
                    }, index * stage.duration);
                });
            }

            animateStages();

            // Check verification status every 5 seconds
            const checkStatus = setInterval(() => {
                $.get("{{ route('check.verification') }}", function(data) {
                    if (data.verified) {
                        clearInterval(checkStatus);
                        toastr.success('Verification complete! Redirecting...');
                        setTimeout(() => {
                            window.location.href = "{{ route('payment.portal') }}";
                        }, 1500);
                    }
                }).fail(() => {
                    toastr.error('Error checking verification status');
                });
            }, 5000);
        });
    </script>
</body>
</html>