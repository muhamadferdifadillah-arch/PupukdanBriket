<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Produsen - Manfaatin</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}">
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
            border: 1px solid #e8e8e8;
            animation: slideUp 0.5s ease-out;
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

        .login-header {
            background: white;
            padding: 50px 30px 40px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
        }

        .logo-container {
            background: white;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e8e8e8;
        }

        .logo-icon {
            font-size: 45px;
        }

        .login-header p {
            font-size: 14px;
            color: #718096;
            margin: 0;
            font-weight: 500;
        }

        .login-body {
            padding: 40px 35px;
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 14px;
            display: block;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
            color: #2d3748;
            width: 100%;
        }

        .form-control:focus {
            border-color: #cbd5e0;
            box-shadow: 0 0 0 4px rgba(203, 213, 224, 0.2);
            outline: none;
            background: white;
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .btn-login {
            background: #2d3748;
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(45, 55, 72, 0.2);
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45, 55, 72, 0.3);
            background: #1a202c;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 14px 18px;
            margin-bottom: 24px;
            animation: slideDown 0.3s ease-out;
            font-size: 14px;
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
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .footer-text {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #f0f0f0;
            color: #718096;
            font-size: 13px;
            line-height: 1.6;
        }

        .footer-text strong {
            color: #2d3748;
            display: block;
            margin-top: 4px;
        }

        .mb-4 {
            margin-bottom: 24px;
        }

        .text-danger {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <!-- Header dengan Logo -->
        <div class="login-header">
            <div class="logo-container">
               <img src="{{ asset('User/images/logom.png') }}" alt="Logo" style="width: 50px; height: 50px;">
            </div>
            <p style="margin-top: 16px; font-weight: 600; font-size: 15px; color: #4a5568;">Portal Produsen Organik</p>
        </div>

        <!-- Body Form -->
        <div class="login-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    <strong>⚠️ Error!</strong> {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <strong>✓ Berhasil!</strong> {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('produsen.login.post') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" 
                           name="email" 
                           class="form-control" 
                           placeholder="produsen@manfaatin.com"
                           value="{{ old('email') }}"
                           required 
                           autofocus>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Masukkan password Anda"
                           required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login">
                    🔐 Login Sekarang
                </button>

                <div class="footer-text">
                    Sistem Manajemen Produsen
                    <strong>Manfaatin - Organic Fertilizer</strong>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>