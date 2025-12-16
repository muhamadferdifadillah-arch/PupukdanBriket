<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Produsen - Manfaatin</title>
    
    <!-- Tambahkan Favicon di sini -->
    <link rel="icon" type="image/png" href="{{ asset('User/images/logom.png') }}">
    <!-- Atau bisa juga menggunakan .ico file -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4">
    
    <div class="w-full max-w-md animate-fade-in">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10">
            <!-- Logo & Title Section -->
            <div class="mb-10">
                <!-- Logo -->
                <div class="mb-8">
                    <img src="{{ asset('user/images/logom.png') }}" alt="Logo Manfaatin" class="h-12 w-auto">
                </div>
                
                <!-- Heading -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">Log in.</h1>
                <p class="text-gray-600 text-base">Grow with us — log in to your account.</p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
            @endif

            <!-- Form Login USER -->
            <form action="{{ route('user.login.post') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="admin@manfaatin.com"
                            class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-gray-50 focus:bg-white @error('email') border-red-500 @enderror"
                            required
                        >
                    </div>
                    @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            placeholder="••••••••"
                            class="w-full pl-12 pr-12 py-3.5 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-gray-50 focus:bg-white @error('password') border-red-500 @enderror"
                            required
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white py-3.5 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-200 shadow-lg shadow-blue-500/30"
                >
                    Log in
                </button>

                <!-- Register Link -->
                <p class="text-center text-gray-600 text-sm mt-6">
                    Don't have an account? 
                    <a href="{{ route('user.register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                        Sign up.
                    </a>
                </p>
            </form>
        </div>
        <!-- End Card Container -->
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Auto focus pada input pertama
        document.querySelector('input[name="email"]').focus();
    </script>
</body>
</html>