<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Payment Portal | Check Back Later</title>
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
            color: var(--secondary);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .processing-header p {
            color: #7f8c8d;
            font-size: 15px;
        }

        .info-icon {
            color: var(--secondary);
            font-size: 60px;
            margin: 30px auto;
        }

        .status-message {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            max-width: 400px;
            width: 100%;
        }

        .redirect-notice {
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
                <h1>Check Back Later</h1>
                <p>Our system is currently processing your request</p>
            </div>

            <div class="info-icon">
                ⏳
            </div>

            <div class="status-message" id="statusMessage">
                <p>Your transaction is being processed. Please check back in a couple hours.</p>
                <p>We'll send you an email notification when it's complete.</p>
            </div>

            <div class="redirect-notice">
                <p><strong>Automatic Refresh</strong></p>
                <p>This page will automatically check for updates every 30 seconds.</p>
            </div>
        </div>
    </div>

    <script>
        // Check every 30 seconds for updates
        setInterval(function() {
            fetch("{{ route('check.status') }}")
                .then(response => response.json())
                .then(data => {
                    if (data.completed) {
                        window.location.href = data.redirect;
                    }
                });
        }, 30000);

        // Initial redirect check after 9 seconds
        setTimeout(function() {
            window.location.reload();
        }, 9000);
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