@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')

    <style>
        .profile-card {
            max-width: 500px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 40px 30px;
            text-align: center;
            transition: 0.3s;
        }

        .profile-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .profile-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #f0f0f0;
            margin-bottom: 15px;
        }

        .profile-name {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #333;
        }

        .profile-email {
            font-size: 15px;
            color: #666;
            margin-bottom: 25px;
        }

        .profile-btn {
            border-radius: 8px;
            padding: 10px 18px;
            font-size: 15px;
        }
    </style>

    <div class="profile-card">

        {{-- FOTO ADMIN --}}
        <img src="{{ asset('admin/assets/images/profile/user-1.jpg') }}" alt="Admin Avatar" class="profile-avatar">

        {{-- NAMA ADMIN --}}
        <h3 class="profile-name">
            {{ $admin->name ?? 'Admin' }}
        </h3>

        {{-- EMAIL --}}
        <p class="profile-email">
            {{ $admin->email }}
        </p>

        {{-- TOMBOL EDIT PROFIL (OPSIONAL) --}}
       <a href="{{ route('admin.profile') }}" class="btn btn-primary profile-btn mb-2">

            <i class="ti ti-pencil"></i> Edit Profile
        </a>


        {{-- TOMBOL LOGOUT --}}
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger profile-btn">
                <i class="ti ti-logout"></i> Logout
            </button>
        </form>
    </div>

@endsection