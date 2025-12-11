@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        {{-- Left Column: Profile Card --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body text-center p-5">
                    {{-- Avatar --}}
                    <div class="position-relative d-inline-block mb-4">
                        @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" 
                             alt="Avatar"
                             class="rounded-circle shadow"
                             style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #fff;">
                        @else
                        <div class="rounded-circle bg-gradient shadow d-inline-flex align-items-center justify-content-center"
                             style="width: 150px; height: 150px; font-size: 4rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: 5px solid #fff;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        @endif
                        <span class="position-absolute bottom-0 end-0 p-2 bg-success border border-light rounded-circle"
                              style="width: 20px; height: 20px;"
                              title="Active"></span>
                    </div>

                    {{-- User Info --}}
                    <h3 class="fw-bold mb-2">{{ $user->name }}</h3>
                    <p class="text-muted mb-4">
                        <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                    </p>

                    {{-- Edit Button --}}
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-lg w-100 shadow-sm">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </a>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted mb-3">Quick Stats</h6>
                    <div class="d-flex justify-content-between mb-3">
                        <span><i class="fas fa-shopping-bag text-primary me-2"></i>Orders</span>
                        <strong>0</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span><i class="fas fa-heart text-danger me-2"></i>Wishlist</span>
                        <strong>0</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-calendar text-success me-2"></i>Member Since</span>
                        <strong>{{ $user->created_at->format('M Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Account Details --}}
        <div class="col-lg-8">
            {{-- Account Information Card --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h4 class="mb-0">
                        <i class="fas fa-user-circle text-primary me-2"></i>Account Information
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small mb-1">FULL NAME</p>
                                <h6 class="mb-0">{{ $user->name }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small mb-1">EMAIL ADDRESS</p>
                                <h6 class="mb-0">{{ $user->email }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small mb-1">MEMBER SINCE</p>
                                <h6 class="mb-0">{{ $user->created_at->format('d M Y') }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small mb-1">ACCOUNT STATUS</p>
                                <h6 class="mb-0">
                                    <span class="badge bg-success-subtle text-success px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i>Active
                                    </span>
                                </h6>
                            </div>
                        </div>
                        @if($user->role)
                        <div class="col-md-12">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted small mb-1">ROLE</p>
                                <h6 class="mb-0">
                                    <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-info' }} px-3 py-2">
                                        <i class="fas fa-{{ $user->role === 'admin' ? 'crown' : 'user' }} me-1"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </h6>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Security Card --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h4 class="mb-0">
                        <i class="fas fa-shield-alt text-warning me-2"></i>Security Settings
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3">
                        <div>
                            <h6 class="mb-1">Password</h6>
                            <p class="text-muted small mb-0">Last changed {{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                            <i class="fas fa-key me-1"></i>Change
                        </a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 border rounded">
                        <div>
                            <h6 class="mb-1">Two-Factor Authentication</h6>
                            <p class="text-muted small mb-0">Add an extra layer of security</p>
                        </div>
                        <span class="badge bg-secondary">Coming Soon</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}
</style>
@endsection