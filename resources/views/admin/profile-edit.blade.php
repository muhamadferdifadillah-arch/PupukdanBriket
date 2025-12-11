@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')

<style>
    .edit-wrapper {
        min-height: 75vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding-top: 40px;
    }

    .edit-card {
        width: 520px;
        background: #ffffff;
        border-radius: 14px;
        padding: 35px 30px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        transition: 0.3s;
    }
    .edit-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }

    .edit-avatar {
        width: 105px;
        height: 105px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #e9e9e9;
        margin-bottom: 18px;
    }

    label {
        font-weight: 600;
        margin-bottom: 6px;
    }
</style>

<div class="edit-wrapper">

    <div class="edit-card">

        <div class="text-center mb-4">
            <img src="{{ asset('admin/assets/images/profile/user-1.jpg') }}" class="edit-avatar" alt="Avatar">
            <h3 class="fw-bold mb-0">{{ $admin->name }}</h3>
            <p class="text-muted">{{ $admin->email }}</p>
        </div>

        <!-- FORM EDIT -->
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ $admin->name }}"
                       class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $admin->email }}"
                       class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label>Password Baru (Opsional)</label>
                <input type="password" name="password"
                       placeholder="Kosongkan jika tidak diganti"
                       class="form-control rounded-3">
            </div>

            <div class="mb-4">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control rounded-3">
            </div>

            <button class="btn btn-primary w-100 py-2 rounded-3 mb-2">
                <i class="ti ti-device-floppy"></i> Simpan Perubahan
            </button>

            <a href="{{ route('admin.profile') }}" class="btn btn-light w-100 py-2 rounded-3">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </form>

    </div>

</div>

@endsection
