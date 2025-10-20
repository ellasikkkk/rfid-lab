<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Manajemen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            padding: 20px;
            overflow-x: hidden;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 8s infinite linear;
            z-index: 0;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }
        
        .logo h1 {
            color: #7c5ac2;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        
        .logo p {
            color: #777;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
            padding-left: 5px;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7c5ac2;
            transition: all 0.3s;
        }
        
        .form-input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            background: #f9f9f9;
        }
        
        .form-input:focus {
            border-color: #7c5ac2;
            box-shadow: 0 0 0 3px rgba(124, 90, 194, 0.2);
            outline: none;
            background: #fff;
        }
        
        .form-input:focus + i {
            color: #a777e3;
            transform: translateY(-50%) scale(1.2);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            transition: color 0.3s;
        }
        
        .password-toggle:hover {
            color: #7c5ac2;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 8px;
            accent-color: #7c5ac2;
            cursor: pointer;
        }
        
        .remember-me label {
            cursor: pointer;
            color: #555;
        }
        
        .forgot-password {
            color: #7c5ac2;
            text-decoration: none;
            transition: color 0.3s;
            font-weight: 500;
        }
        
        .forgot-password:hover {
            color: #6a89cc;
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #7c5ac2, #6a89cc);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(124, 90, 194, 0.3);
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, #6a89cc, #7c5ac2);
            box-shadow: 0 6px 20px rgba(124, 90, 194, 0.4);
            transform: translateY(-2px);
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
            position: relative;
            z-index: 1;
        }
        
        .register-link a {
            color: #7c5ac2;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .register-link a:hover {
            color: #6a89cc;
            text-decoration: underline;
        }
        
        .error-container {
            background: #ffebee;
            color: #d32f2f;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            border-left: 5px solid #d32f2f;
            animation: shake 0.5s ease-in-out;
            position: relative;
            z-index: 1;
        }
        
        .error-container ul {
            list-style: none;
            padding-left: 20px;
        }
        
        .error-container li {
            margin-bottom: 8px;
            position: relative;
        }
        
        .error-container li::before {
            content: '•';
            color: #d32f2f;
            font-weight: bold;
            display: inline-block; 
            width: 1em;
            margin-left: -1em;
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
        
        @keyframes shake {
            0% { transform: translateX(0); }
            20% { transform: translateX(-10px); }
            40% { transform: translateX(10px); }
            60% { transform: translateX(-10px); }
            80% { transform: translateX(10px); }
            100% { transform: translateX(0); }
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }
        
        @media (max-width: 500px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .logo h1 {
                font-size: 28px;
            }
            
            .remember-forgot {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1><i class="fas fa-lock"></i> Login System</h1>
            <p>Silakan masuk ke akun Anda</p>
        </div>
        
        <!-- Menampilkan error dari Laravel -->
        @if($errors->any())
            <div class="error-container">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-with-icon">
                    <input type="email" id="email" name="email" class="form-input" placeholder="Masukkan alamat email" required value="{{ old('email') }}">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <input type="password" id="password" name="password" class="form-input" placeholder="Masukkan password" required>
                    <i class="fas fa-lock"></i>
                    <span class="password-toggle" id="passwordToggle">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            
            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                <a href="#" class="forgot-password">Lupa password?</a>
            </div>
            
            <button type="submit" class="btn-login">Masuk</button>
        </form>
        
        <div class="register-link">
            Belum punya akun? <a href="#">Daftar sekarang</a>
        </div>
    </div>

    <script>
        // Toggle visibility password
        document.getElementById('passwordToggle').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Animasi untuk input field saat fokus
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = '#a777e3';
                this.parentElement.querySelector('i').style.transform = 'translateY(-50%) scale(1.2)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#7c5ac2';
                this.parentElement.querySelector('i').style.transform = 'translateY(-50%) scale(1)';
            });
        });
    </script>
</body>
</html>