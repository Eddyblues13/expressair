<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VFunds | Identity Verification</title>
    <style>
        :root {
            --vfunds-primary: #4361ee; /* Deep purple */
            --vfunds-secondary: #4361ee; /* Royal blue */
            --vfunds-accent: #4361ee; /* Vibrant pink */
            --vfunds-light: #f8f9ff;
            --vfunds-dark: #14213d;
            --vfunds-text: #2b2d42;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }
        
        body {
            background: radial-gradient(circle at 10% 20%, rgba(248, 249, 255, 0.9) 0%, rgba(220, 224, 255, 0.9) 90%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--vfunds-text);
            line-height: 1.6;
        }
        
        .vfunds-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(67, 97, 238, 0.15);
            overflow: hidden;
            display: flex;
            min-height: 500px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .vfunds-graphic {
            flex: 1;
            background: linear-gradient(135deg, var(--vfunds-primary) 0%, var(--vfunds-secondary) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .vfunds-graphic::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }
        
        .vfunds-graphic::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(247,37,133,0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }
        
        .vfunds-logo {
            width: 200px;
            margin-bottom: 30px;
            z-index: 5;
        }
        
        .vfunds-slogan {
            color: white;
            font-size: 18px;
            font-weight: 500;
            text-align: center;
            opacity: 0.9;
            margin-bottom: 40px;
            z-index: 2;
        }
        
        .vfunds-features {
            list-style: none;
            z-index: 2;
        }
        
        .vfunds-features li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            color: rgba(255,255,255,0.9);
        }
        
        .vfunds-features li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--vfunds-accent);
            font-weight: bold;
            font-size: 18px;
        }
        
        .vfunds-processing {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: white;
        }
        
        .processing-header {
            margin-bottom: 40px;
            max-width: 350px;
        }
        
        .processing-header h1 {
            color: var(--vfunds-dark);
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 700;
            background: linear-gradient(to right, var(--vfunds-primary), var(--vfunds-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .processing-header p {
            color: #5a6a7a;
            font-size: 16px;
        }
        
        .vfunds-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(67, 97, 238, 0.1);
            border-radius: 50%;
            border-top: 4px solid var(--vfunds-accent);
            margin: 30px 0;
            animation: spin 1s linear infinite;
            position: relative;
        }
        
        .vfunds-spinner::after {
            content: "";
            position: absolute;
            width: 70px;
            height: 70px;
            border: 2px solid rgba(67, 97, 238, 0.05);
            border-radius: 50%;
            top: -7px;
            left: -7px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .status-tracker {
            width: 100%;
            max-width: 350px;
            margin-bottom: 30px;
        }
        
        .status-step {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            opacity: 0.5;
            transition: all 0.3s;
        }
        
        .status-step.active {
            opacity: 1;
        }
        
        .status-step.completed .step-icon {
            background: var(--vfunds-secondary);
            color: white;
        }
        
        .step-icon {
            width: 30px;
            height: 30px;
            background: #f0f2ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--vfunds-secondary);
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .step-text {
            text-align: left;
            flex-grow: 1;
        }
        
        .step-text h4 {
            font-size: 15px;
            margin-bottom: 3px;
            color: var(--vfunds-dark);
        }
        
        .step-text p {
            font-size: 13px;
            color: #7f8c9a;
        }
        
        .new-user-notice {
            background-color: #f8f9ff;
            border-left: 3px solid var(--vfunds-accent);
            padding: 15px;
            margin-top: 20px;
            text-align: left;
            max-width: 350px;
            width: 100%;
            border-radius: 8px;
        }
        
        .new-user-notice h4 {
            color: var(--vfunds-dark);
            margin-bottom: 8px;
            font-size: 15px;
        }
        
        .new-user-notice p {
            color: #5a6a7a;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .vfunds-container {
                flex-direction: column;
                min-height: auto;
            }
            
            .vfunds-graphic {
                padding: 30px 20px;
            }
            
            .vfunds-processing {
                padding: 40px 20px;
            }
            
            .vfunds-logo {
                width: 140px;
                margin-bottom: 20px;
            }
        }
        .logo-container {
            margin-bottom: 30px;
            text-align: center;
        }

        .logo {
            height: 30px;
            width: auto;
        }
    </style>
</head>
<body>
    <div class="vfunds-container">
        <div class="logo-container">
                <a href="#">
                    <img src="{{ asset('5df16d8f13f4cced330e587b_stellar-logo-solo-1-removebg-preview.png') }}"
                        alt="Logo" class="logo">
                </a>
            </div>
        <div class="vfunds-graphic">
            
            <p class="vfunds-slogan">Next-generation financial verification</p>
            
            <ul class="vfunds-features">
                <li>Military-grade encryption</li>
                <li>Real-time compliance checks</li>
                <li>Global transaction monitoring</li>
                <li>Instant fraud detection</li>
            </ul>
        </div>
        
        <div class="vfunds-processing">
            <div class="processing-header">
                <h1>Securing Your Account</h1>
                <p>We're verifying your identity through our global financial network</p>
            </div>
            
            <div class="vfunds-spinner"></div>
            
            <div class="status-tracker" id="statusTracker">
                <div class="status-step" id="step1">
                    <div class="step-icon">1</div>
                    <div class="step-text">
                        <h4>Initializing Verification</h4>
                        <p>Starting security protocols</p>
                    </div>
                </div>
                
                <div class="status-step" id="step2">
                    <div class="step-icon">2</div>
                    <div class="step-text">
                        <h4>Checking Government Databases</h4>
                        <p>Validating official records</p>
                    </div>
                </div>
                
                <div class="status-step" id="step3">
                    <div class="step-icon">3</div>
                    <div class="step-text">
                        <h4>Verifying Financial History</h4>
                        <p>Reviewing transaction patterns</p>
                    </div>
                </div>
                
                <div class="status-step" id="step4">
                    <div class="step-icon">4</div>
                    <div class="step-text">
                        <h4>Securing Your Account</h4>
                        <p>Applying final protections</p>
                    </div>
                </div>
            </div>
            
            @if(session('new_user'))
            <div class="new-user-notice">
                <h4>New Account Detected</h4>
                <p>We're configuring your personalized security profile with enhanced protection settings tailored to your transaction patterns.</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        const steps = [
            { id: "step1", delay: 1000 },
            { id: "step2", delay: 4000 },
            { id: "step3", delay: 7000 },
            { id: "step4", delay: 10000 }
        ];
        
        function activateStep(stepId) {
            const step = document.getElementById(stepId);
            if (step) {
                step.classList.add('active');
                
                // After 2 seconds, mark as completed
                setTimeout(() => {
                    step.classList.add('completed');
                }, 2000);
            }
        }
        
        // Initialize first step immediately
        setTimeout(() => {
            activateStep(steps[0].id);
        }, 500);
        
        // Activate subsequent steps
        steps.forEach((step, index) => {
            if (index > 0) {
                setTimeout(() => {
                    activateStep(step.id);
                    
                    // Redirect after last step completes
                    if (index === steps.length - 1) {
                        setTimeout(() => {
                            window.location.href = "{{ route('name.input', ['access_code' => $access_code]) }}";
                        }, 3000);
                    }
                }, step.delay);
            }
        });
    </script>
</body>
</html>