<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Manfaatin Admin</title>
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
            <div class="mb-8">
                <!-- Logo -->
                <div class="mb-6">
                    <img src="{{ asset('User/images/logom.png') }}" alt="Logo Manfaatin" class="h-12 w-auto">
                </div>
                
                <!-- Heading -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">Sign up.</h1>
                <p class="text-gray-600 text-base">Create your admin account to get started.</p>
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

            <!-- Form Register ADMIN -->
            <form action="{{ route('admin.register.post') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            placeholder="Full Name"
                            class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-gray-50 focus:bg-white @error('name') border-red-500 @enderror"
                            required
                        >
                    </div>
                    @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
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
                <div class="mb-4">
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
                            onclick="togglePassword('password', 'eyeIcon1')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <i class="fas fa-eye" id="eyeIcon1"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation"
                            placeholder="Confirm Password"
                            class="w-full pl-12 pr-12 py-3.5 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-gray-50 focus:bg-white"
                            required
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <i class="fas fa-eye" id="eyeIcon2"></i>
                        </button>
                    </div>
                </div>

                <!-- Role Selection -->
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-700 mb-3">Register as</p>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- User -->
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="user" class="peer sr-only" {{ old('role', 'user') == 'user' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 rounded-lg transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-gray-300">
                                <i class="fas fa-user text-2xl mx-auto block mb-2 text-gray-400 peer-checked:text-blue-600"></i>
                                <p class="font-semibold text-sm text-center text-gray-700 peer-checked:text-blue-600">User</p>
                                <p class="text-xs text-gray-500 text-center mt-1">Basic access</p>
                            </div>
                        </label>

                        <!-- Admin -->
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="admin" class="peer sr-only" {{ old('role') == 'admin' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 rounded-lg transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-gray-300">
                                <i class="fas fa-shield-alt text-2xl mx-auto block mb-2 text-gray-400 peer-checked:text-blue-600"></i>
                                <p class="font-semibold text-sm text-center text-gray-700 peer-checked:text-blue-600">Admin</p>
                                <p class="text-xs text-gray-500 text-center mt-1">Full access</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white py-3.5 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-200 shadow-lg shadow-blue-500/30"
                >
                    Sign up
                </button>

                <!-- Login Link -->
                <p class="text-center text-gray-600 text-sm mt-6">
                    Already have an account? 
                    <a href="{{ route('admin.login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                        Log in.
                    </a>
                </p>
            </form>
        </div>
        <!-- End Card Container -->
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
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
        document.querySelector('input[name="name"]').focus();
    </script>
</body>
</html>