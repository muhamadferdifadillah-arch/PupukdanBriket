@extends('layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="max-w-2xl mx-auto mt-10 px-4">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-user-plus mr-2"></i>Tambah Pengguna Baru
            </h1>
            <p class="text-gray-600 mt-1">Lengkapi form berikut untuk menambahkan pengguna baru</p>
        </div>

        <!-- Form -->
        <form action="{{ route('pengguna.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama lengkap"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('name') border-red-500 @enderror">
                @error('name') 
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Username <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="username" 
                       value="{{ old('username') }}"
                       placeholder="Masukkan username"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('username') border-red-500 @enderror">
                @error('username') 
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="nama@email.com"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('email') border-red-500 @enderror">
                @error('email') 
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="password" 
                           name="password" 
                           id="password"
                           placeholder="Minimal 8 karakter"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('password') border-red-500 @enderror">
                    <button type="button" 
                            onclick="togglePassword('password')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                </div>
                @error('password') 
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Konfirmasi Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation"
                           placeholder="Ulangi password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <button type="button" 
                            onclick="togglePassword('password_confirmation')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-eye" id="password_confirmation-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Role -->
            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Role <span class="text-red-500">*</span>
                </label>
                <select name="role" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('role') border-red-500 @enderror">
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role') 
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="ml-2 text-gray-700">Aktifkan pengguna</span>
                </label>
            </div>

            <!-- Divider -->
            <hr class="my-6">

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-2">
                <a href="{{ route('pengguna.index') }}" 
                   class="text-gray-600 hover:text-gray-800 font-medium transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg shadow-md transition duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i>Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
<script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-icon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Auto-generate username dari nama (opsional)
    document.querySelector('input[name="name"]').addEventListener('input', function(e) {
        const username = document.querySelector('input[name="username"]');
        if (username.value === '') {
            username.value = e.target.value.toLowerCase().replace(/\s+/g, '');
        }
    });
</script>
@endpush