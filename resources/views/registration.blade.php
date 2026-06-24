<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Estudify</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            padding: 3rem;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-header h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            gap: 1rem;
        }

        .step-indicator {
            flex: 1;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            position: relative;
        }

        .step-indicator.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Alert Styles */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: #ffe0e0;
            border-left: 4px solid #e74c3c;
            color: #c0392b;
        }

        .alert-success {
            background: #e0ffe0;
            border-left: 4px solid #27ae60;
            color: #1e8449;
        }

        .alert ul {
            list-style: none;
            margin: 0;
        }

        .alert li {
            padding: 0.25rem 0;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 1.3rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input.is-invalid {
            border-color: #e74c3c;
        }

        input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .error-message:before {
            content: "⚠";
        }

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 0.5rem;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
            display: none;
        }

        .password-strength.active {
            display: block;
        }

        .strength-meter {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease, background 0.3s ease;
        }

        .strength-meter.weak {
            width: 33%;
            background: #e74c3c;
        }

        .strength-meter.medium {
            width: 66%;
            background: #f39c12;
        }

        .strength-meter.strong {
            width: 100%;
            background: #27ae60;
        }

        .strength-text {
            font-size: 0.75rem;
            margin-top: 0.2rem;
            color: #666;
        }

        /* Terms & Conditions */
        .terms-section {
            margin: 1.5rem 0;
            padding: 1rem;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 0.7rem;
        }

        .terms-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 0.2rem;
            cursor: pointer;
            accent-color: #667eea;
        }

        .terms-checkbox label {
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .terms-checkbox a {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s;
        }

        .terms-checkbox a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Buttons */
        .btn-register {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-register:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-register:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        @media (max-width: 600px) {
            .register-container {
                padding: 2rem;
            }

            .register-header h1 {
                font-size: 1.5rem;
            }

            .progress-steps {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>📚 Estudify</h1>
            <p>Create Your Account</p>
        </div>

        <!-- Progress Indicator -->
        <div class="progress-steps">
            <div class="step-indicator active"></div>
            <div class="step-indicator"></div>
            <div class="step-indicator"></div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Registration Form -->
        <form action="{{ route('register.post') }}" method="POST" id="registrationForm">
            @csrf

            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                    autofocus
                    class="@error('name') is-invalid @enderror"
                >
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username Field -->
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Choose a unique username"
                    required
                    class="@error('username') is-invalid @enderror"
                >
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email address"
                    required
                    class="@error('email') is-invalid @enderror"
                >
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Fields -->
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create a strong password"
                        required
                        class="@error('password') is-invalid @enderror"
                    >
                    <div class="password-strength">
                        <div class="strength-meter"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        required
                        class="@error('password_confirmation') is-invalid @enderror"
                    >
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn-register">Create Account</button>

            <!-- Login Link -->
            <p class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </p>
        </form>
    </div>

    <script>
        // Password Strength Indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthMeter = document.querySelector('.strength-meter');
            const strengthText = document.getElementById('strengthText');
            const strengthContainer = document.querySelector('.password-strength');

            if (password.length === 0) {
                strengthContainer.classList.remove('active');
                return;
            }

            strengthContainer.classList.add('active');

            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /\d/.test(password);
            const hasSpecialChar = /[!@#$%^&*]/.test(password);

            let strength = 0;
            if (password.length >= 8) strength++;
            if (hasUpperCase && hasLowerCase) strength++;
            if (hasNumbers) strength++;
            if (hasSpecialChar) strength++;

            strengthMeter.classList.remove('weak', 'medium', 'strong');

            if (strength <= 1) {
                strengthMeter.classList.add('weak');
                strengthText.textContent = 'Weak password - Use letters, numbers, and special characters';
            } else if (strength <= 2) {
                strengthMeter.classList.add('medium');
                strengthText.textContent = 'Medium strength - Add more variety to your password';
            } else {
                strengthMeter.classList.add('strong');
                strengthText.textContent = 'Strong password ✓';
            }
        });

        // Confirm Password Match
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            if (this.value && this.value !== password) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        // Form Submit
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
        });
    </script>
</body>
</html>