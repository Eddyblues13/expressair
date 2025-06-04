<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Payment Portal | Identity Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
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

        .logo-placeholder {
            width: 180px;
            height: 60px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
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

        .feature-list {
            margin: 25px 0;
            list-style: none;
        }

        .feature-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 12px;
        }

        .feature-list li:before {
            content: "âœ“";
            position: absolute;
            left: 0;
            color: var(--secondary);
            font-weight: bold;
        }

        .auth-container {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .auth-header h1 {
            color: var(--primary);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .auth-header p {
            color: #7f8c8d;
            font-size: 15px;
        }

        .auth-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            background-color: #f9f9f9;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.1);
            outline: none;
            background-color: white;
        }

        .form-control.error {
            border-color: var(--accent);
            background-color: #fff9f9;
        }

        .btn-primary {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #16a085;
            transform: translateY(-2px);
        }

        .btn-primary:disabled {
            background: #95a5a6;
            cursor: not-allowed;
            transform: none;
        }

        .security-badge {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #95a5a6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .security-badge i {
            margin-right: 8px;
            color: var(--secondary);
            font-size: 16px;
        }

        .logo {
            height: 30px;
            width: auto;
        }

        .button-spinner {
            display: none;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .error-message {
            color: var(--accent);
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        @keyframes spin {
            to {
                transform: translateY(-50%) rotate(360deg);
            }
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
                <a href="#"><img src="{{ asset('5df16d8f13f4cced330e587b_stellar-logo-solo-1-removebg-preview.png') }}"
                        alt="Logo" class="logo"></a>
            </div>

            <div class="portal-content">
                <h2>Identity Verification</h2>
                <p>To comply with financial regulations, we need to verify your identity before proceeding with your
                    transaction.</p>

                <ul class="feature-list">
                    <li>Bank-level 256-bit AES encryption</li>
                    <li>Multi-signature transaction authorization</li>
                    <li>Real-time transaction monitoring</li>
                    <li>Regulatory compliance (PCI DSS Level 1)</li>
                    <li>24/7 fraud detection systems</li>
                    <li>Instant settlement network</li>
                </ul>

                <p>All information is protected by our $1M security guarantee.</p>
            </div>
        </div>

        <div class="auth-container">
            <div class="auth-header">
                <h1>Verify Your Identity</h1>
                <p>Please enter your full legal name as it appears on official documents</p>
            </div>

            <form id="nameForm" class="auth-form" action="{{ route('process.name') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Full Legal Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name"
                        required>
                    <div class="error-message" id="nameError"></div>
                </div>

                <button type="submit" class="btn-primary" id="submitBtn">
                    <span id="buttonText">Continue to Payment Portal</span>
                    <span class="button-spinner" id="buttonSpinner"></span>
                </button>
            </form>

            <div class="security-badge">
                <i>ðŸ”’</i> <span>All data is encrypted in transit and at rest</span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            toastr.options = {
                positionClass: 'toast-top-right',
                progressBar: true,
                closeButton: true,
                timeOut: 5000,
                preventDuplicates: true
            };

            @if(session('error'))
                toastr.error('{{ session('error') }}');
            @endif
            @if(session('success'))
                toastr.success('{{ session('success') }}');
            @endif

            // Clear errors when typing
            $('#name').on('input', function() {
                $(this).removeClass('error');
                $('#nameError').hide();
            });

            $('#nameForm').on('submit', function (e) {
                e.preventDefault();
                
                // Validate name field
                const name = $('#name').val().trim();
                if (!name) {
                    $('#name').addClass('error');
                    $('#nameError').text('Please enter your full name').show();
                    return;
                }

                const submitBtn = $('#submitBtn');
                const buttonText = $('#buttonText');
                const buttonSpinner = $('#buttonSpinner');
                
                // Show spinner and disable button
                submitBtn.prop('disabled', true);
                buttonText.text('Processing...');
                buttonSpinner.show();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(function () {
                                window.location.href = response.redirect;
                            }, 1500);
                        } else {
                            // Handle specific field errors
                            if (response.errors && response.errors.name) {
                                $('#name').addClass('error');
                                $('#nameError').text(response.errors.name[0]).show();
                            } else {
                                toastr.error(response.message || 'Identity verification failed. Please try again.');
                            }
                            resetButton();
                        }
                    },
                    error: function (xhr) {
                        let errorMsg = 'An error occurred. Please try again.';
                        
                        // Handle validation errors
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if (errors && errors.name) {
                                $('#name').addClass('error');
                                $('#nameError').text(errors.name[0]).show();
                            } else {
                                errorMsg = 'Please check your input and try again.';
                            }
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        
                        toastr.error(errorMsg);
                        resetButton();
                    }
                });

                function resetButton() {
                    submitBtn.prop('disabled', false);
                    buttonText.text('Continue to Payment Portal');
                    buttonSpinner.hide();
                }
            });
        });
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
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
</body>

</html>