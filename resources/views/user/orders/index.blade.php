@extends('user.layouts.app')

@section('title', 'Pesanan Saya - Manfaatin')

@section('content')

<div class="orders-wrapper py-5" style="background:#f5f7fa;">
    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold">Pesanan Saya</li>
            </ol>
        </nav>

        <div class="mb-4">
            <h2 class="fw-bold text-dark">Pesanan Saya</h2>
            <p class="text-muted">Kelola dan lacak semua pesanan Anda</p>
        </div>

        <!-- Flash Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Filter Tabs -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('user.orders.index', ['status' => 'all']) }}" 
                       class="btn {{ $status == 'all' ? 'btn-success' : 'btn-outline-secondary' }} btn-sm">
                        Semua
                    </a>
                    <a href="{{ route('user.orders.index', ['status' => 'pending']) }}" 
                       class="btn {{ $status == 'pending' ? 'btn-success' : 'btn-outline-secondary' }} btn-sm">
                        Menunggu Pembayaran
                    </a>
                    <a href="{{ route('user.orders.index', ['status' => 'processing']) }}" 
                       class="btn {{ $status == 'processing' ? 'btn-success' : 'btn-outline-secondary' }} btn-sm">
                        Diproses
                    </a>
                    <a href="{{ route('user.orders.index', ['status' => 'shipped']) }}" 
                       class="btn {{ $status == 'shipped' ? 'btn-success' : 'btn-outline-secondary' }} btn-sm">
                        Dikirim
                    </a>
                    <a href="{{ route('user.orders.index', ['status' => 'delivered']) }}" 
                       class="btn {{ $status == 'delivered' ? 'btn-success' : 'btn-outline-secondary' }} btn-sm">
                        Selesai
                    </a>
                    <a href="{{ route('user.orders.index', ['status' => 'cancelled']) }}" 
                       class="btn {{ $status == 'cancelled' ? 'btn-success' : 'btn-outline-secondary' }} btn-sm">
                        Dibatalkan
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Box -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
                <form action="{{ route('user.orders.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Cari nomor pesanan atau nama produk..." 
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Orders List -->
        @if($orders->isEmpty())
        <div class="text-center py-5">
            <img src="{{ asset('user/images/empty-order.svg') }}" 
                 alt="Belum Ada Pesanan" 
                 style="max-width: 300px; opacity: 0.5;"
                 onerror="this.style.display='none'">
            <h4 class="mt-4 text-muted">Belum Ada Pesanan</h4>
            <p class="text-muted">Mulai belanja dan temukan produk favorit Anda</p>
            <a href="{{ route('shop.index') }}" class="btn btn-success mt-3">
                <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
            </a>
        </div>
        @else
        <div class="orders-list">
            @foreach($orders as $order)
            <div class="card shadow-sm border-0 mb-3 order-card">
                <div class="card-body p-4">
                    
                    <!-- Order Header -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">{{ $order->order_number }}</h6>
                            <small class="text-muted">
                                <i class="far fa-calendar me-1"></i>
                                {{ date('d M Y, H:i', strtotime($order->created_at)) }}
                            </small>
                        </div>
                        <div>
                            @php
                            $statusConfig = [
                                'pending' => ['badge' => 'warning', 'icon' => 'clock', 'text' => 'Menunggu Pembayaran'],
                                'processing' => ['badge' => 'info', 'icon' => 'cog', 'text' => 'Diproses'],
                                'shipped' => ['badge' => 'primary', 'icon' => 'truck', 'text' => 'Dikirim'],
                                'delivered' => ['badge' => 'success', 'icon' => 'check-circle', 'text' => 'Selesai'],
                                'cancelled' => ['badge' => 'danger', 'icon' => 'times-circle', 'text' => 'Dibatalkan'],
                            ];
                            $config = $statusConfig[$order->status] ?? ['badge' => 'secondary', 'icon' => 'question', 'text' => ucfirst($order->status)];
                            @endphp
                            
                            <span class="badge bg-{{ $config['badge'] }} px-3 py-2">
                                <i class="fas fa-{{ $config['icon'] }} me-1"></i>
                                {{ $config['text'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Order Info -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <small class="text-muted d-block">Penerima</small>
                            <strong>{{ $order->customer_name }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Telepon</small>
                            <strong>{{ $order->customer_phone }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Kurir</small>
                            <strong class="text-uppercase">{{ $order->courier }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Pembayaran</small>
                            <strong class="text-capitalize">{{ str_replace('-', ' ', $order->payment_method) }}</strong>
                        </div>
                    </div>

                    <!-- Total Amount -->
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <div>
                            <small class="text-muted">Total Belanja</small>
                            <h5 class="mb-0 text-success fw-bold">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </h5>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('user.orders.show', $order->id) }}" 
                               class="btn btn-outline-success btn-sm">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            
                            @if($order->status == 'pending')
                            <form action="{{ route('user.orders.cancel', $order->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-times me-1"></i>Batalkan
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

<style>
.order-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.order-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}
</style>

@endsection