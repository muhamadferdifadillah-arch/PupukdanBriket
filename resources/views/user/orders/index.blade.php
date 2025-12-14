@extends('user.layouts.app')

@section('title', 'Pesanan Saya - Manfaatin')

@section('content')
<div class="orders-page" style="background: #f8f9fa; min-height: 100vh; padding: 40px 0;">

    <div class="container">

        {{-- Breadcrumb & Header --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb" style="background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #6c757d; text-decoration: none;">Home</a></li>
                <li class="breadcrumb-item active" style="color: #2d3748;">Pesanan Saya</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold mb-1" style="color: #2d3748; font-size: 2rem;">Pesanan Saya</h1>
                <p class="text-muted mb-0">Kelola dan lacak semua pesanan Anda</p>
            </div>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Search Bar --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body p-3">
                <form action="{{ route('user.orders.index') }}" method="GET">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="border-radius: 8px 0 0 8px; border-color: #e9ecef;">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-start-0 shadow-none"
                                       placeholder="Cari nomor pesanan atau nama produk..."
                                       value="{{ request('search') }}"
                                       style="border-radius: 0 8px 8px 0; border-color: #e9ecef;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success w-100" type="submit" style="border-radius: 8px; padding: 10px;">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body p-3">
                <div class="d-flex flex-wrap gap-2">

                    @php
                        $statuses = [
                            'all' => ['label'=>'Semua', 'color'=>'#6c757d'],
                            'pending' => ['label'=>'Menunggu Pembayaran', 'color'=>'#ffc107'],
                            'processing' => ['label'=>'Diproses', 'color'=>'#0dcaf0'],
                            'shipped' => ['label'=>'Dikirim', 'color'=>'#0d6efd'],
                            'completed' => ['label'=>'Selesai', 'color'=>'#198754'],
                            'cancelled' => ['label'=>'Dibatalkan', 'color'=>'#dc3545'],
                        ];
                    @endphp

                    @foreach($statuses as $key => $row)
                    <a href="{{ $key === 'all' ? route('user.orders.index') : route('user.orders.index', ['status'=>$key]) }}"
                       class="status-tab {{ (!request('status') && $key === 'all') || request('status') == $key ? 'active' : '' }}"
                       style="padding: 10px 20px; border-radius: 8px; text-decoration: none; border: 1px solid {{ (!request('status') && $key === 'all') || request('status') == $key ? $row['color'] : '#dee2e6' }}; color: {{ (!request('status') && $key === 'all') || request('status') == $key ? 'white' : '#6c757d' }}; background: {{ (!request('status') && $key === 'all') || request('status') == $key ? $row['color'] : 'white' }}; font-size: 0.9rem; transition: all 0.2s;">
                        {{ $row['label'] }}
                    </a>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- Orders List --}}
        @if($orders->count() > 0)
            <div class="row">
                @foreach($orders as $order)
                @php
                    $orderItems = DB::table('order_items')->where('order_id', $order->id)->get();
                @endphp
                
                <div class="col-12 mb-3">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px; transition: all 0.2s;">

                        <div class="card-body p-4">

                            {{-- Order Header --}}
                            <div class="d-flex justify-content-between align-items-start mb-3 pb-3 border-bottom">
                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <h6 class="mb-0 fw-bold">{{ $order->order_number }}</h6>

                                        {{-- Status Badge --}}
                                        @php
                                            $statusConfig = [
                                                'completed'=>['bg'=>'#198754', 'text'=>'Selesai'],
                                                'shipped'=>['bg'=>'#0d6efd', 'text'=>'Dikirim'],
                                                'processing'=>['bg'=>'#0dcaf0', 'text'=>'Diproses'],
                                                'pending'=>['bg'=>'#ffc107', 'text'=>'Menunggu Pembayaran'],
                                                'cancelled'=>['bg'=>'#dc3545', 'text'=>'Dibatalkan']
                                            ];
                                            $currentStatus = $statusConfig[$order->status] ?? ['bg'=>'#6c757d', 'text'=>'Unknown'];
                                        @endphp

                                        <span class="badge" style="background: {{ $currentStatus['bg'] }}; font-size: 0.75rem; padding: 4px 10px; font-weight: 500;">
                                            {{ $currentStatus['text'] }}
                                        </span>
                                    </div>

                                    <small class="text-muted">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}
                                    </small>
                                </div>

                                <button class="btn btn-sm btn-light toggle-btn" 
                                        data-bs-toggle="collapse"
                                        data-bs-target="#orderDetail{{ $order->id }}"
                                        style="border-radius: 6px; border: 1px solid #e9ecef; padding: 6px 12px;">
                                    <i class="fas fa-chevron-down" style="font-size: 0.85rem;"></i>
                                </button>
                            </div>

                            {{-- Product List Quick View --}}
                            <div class="mb-3">
                                @foreach($orderItems as $item)
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <img src="{{ asset($item->product_image ?? 'user/images/product-thumb-1.png') }}"
                                         style="width:60px; height:60px; object-fit:cover; border-radius:8px; border: 1px solid #e9ecef;">

                                    <div class="flex-grow-1">
                                        <h6 class="mb-1" style="font-size: 0.95rem;">{{ $item->product_name }}</h6>
                                        <small class="text-muted">{{ $item->quantity }}x Rp {{ number_format($item->price,0,',','.') }}</small>
                                    </div>

                                    <div class="text-end">
                                        <div class="fw-semibold" style="color: #2d3748;">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{-- Total --}}
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <span class="text-muted">Total Pesanan</span>
                                <h5 class="mb-0 fw-bold" style="color: #198754;">
                                    Rp {{ number_format($order->total_amount,0,',','.') }}
                                </h5>
                            </div>

                            {{-- Collapse Detail --}}
                            <div class="collapse mt-3" id="orderDetail{{ $order->id }}">
                                <div class="border-top pt-3">

                                    {{-- Shipping Info --}}
                                    <div class="mb-3">
                                        <h6 class="fw-semibold mb-2" style="font-size: 0.95rem;">Informasi Pengiriman</h6>
                                        
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block">Nama Penerima</small>
                                                <p class="mb-0" style="font-size: 0.9rem;">{{ $order->customer_name }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block">Nomor Telepon</small>
                                                <p class="mb-0" style="font-size: 0.9rem;">{{ $order->customer_phone }}</p>
                                            </div>
                                            <div class="col-12">
                                                <small class="text-muted d-block">Alamat Pengiriman</small>
                                                <p class="mb-0" style="font-size: 0.9rem;">{{ $order->shipping_address }}</p>
                                            </div>
                                            @if($order->courier)
                                            <div class="col-md-6">
                                                <small class="text-muted d-block">Kurir</small>
                                                <p class="mb-0 text-uppercase" style="font-size: 0.9rem;">{{ $order->courier }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Order Summary --}}
                                    <div class="bg-light p-3 rounded" style="border-radius: 8px;">
                                        <h6 class="fw-semibold mb-3" style="font-size: 0.95rem;">Ringkasan Pembayaran</h6>
                                        
                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="text-muted">Subtotal Produk</small>
                                            <small class="fw-medium">Rp {{ number_format($order->subtotal ?? 0,0,',','.') }}</small>
                                        </div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="text-muted">Tax (10%)</small>
                                            <small class="fw-medium">Rp {{ number_format($order->tax ?? 0,0,',','.') }}</small>
                                        </div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="text-muted">Ongkos Kirim</small>
                                            <small class="fw-medium">Rp {{ number_format($order->shipping_cost ?? 0,0,',','.') }}</small>
                                        </div>

                                        <hr style="margin: 10px 0;">

                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-semibold">Total Pembayaran</span>
                                            <span class="fw-bold text-success">Rp {{ number_format($order->total_amount,0,',','.') }}</span>
                                        </div>

                                        <small class="text-muted d-block mt-2">
                                            Metode: {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}
                                        </small>
                                    </div>

                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex gap-2 mt-3 flex-wrap">
                                
                                @if($order->status == 'completed')
                                    <button class="btn btn-outline-success btn-sm flex-grow-1" style="border-radius: 8px;">
                                        <i class="fas fa-star me-1"></i>Beri Ulasan
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
                                        <i class="fas fa-redo me-1"></i>Beli Lagi
                                    </button>

                                @elseif($order->status == 'shipped')
                                    <form method="POST" action="{{ route('user.orders.complete',$order->id) }}" class="flex-grow-1">
                                        @csrf
                                        <button class="btn btn-success btn-sm w-100" style="border-radius: 8px;">
                                            <i class="fas fa-check me-1"></i>Pesanan Diterima
                                        </button>
                                    </form>
                                    <button class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                                        <i class="fas fa-truck me-1"></i>Lacak
                                    </button>

                                @elseif($order->status == 'pending')
                                    <a href="{{ route('user.orders.pay',$order->id) }}" class="btn btn-success btn-sm flex-grow-1" style="border-radius: 8px;">
                                        <i class="fas fa-wallet me-1"></i>Bayar Sekarang
                                    </a>
                                    <form method="POST" action="{{ route('user.orders.cancel',$order->id) }}">
                                        @csrf
                                        <button class="btn btn-outline-danger btn-sm" style="border-radius: 8px;"
                                                onclick="return confirm('Yakin batalkan pesanan?')">
                                            <i class="fas fa-times me-1"></i>Batalkan
                                        </button>
                                    </form>

                                @elseif($order->status == 'processing')
                                    <button class="btn btn-outline-primary btn-sm flex-grow-1" style="border-radius: 8px;">
                                        <i class="fas fa-comments me-1"></i>Hubungi Penjual
                                    </button>

                                @elseif($order->status == 'cancelled')
                                    <button class="btn btn-outline-secondary btn-sm flex-grow-1" style="border-radius: 8px;">
                                        <i class="fas fa-shopping-cart me-1"></i>Pesan Lagi
                                    </button>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->withQueryString()->links() }}
            </div>

        @else
        {{-- Empty State --}}
        <div class="text-center py-5">
            <div style="max-width: 400px; margin: 0 auto;">
                <div class="mb-4">
                    <i class="fas fa-shopping-bag" style="font-size: 5rem; color: #dee2e6;"></i>
                </div>
                <h5 class="fw-bold mb-2" style="color: #2d3748;">Belum Ada Pesanan</h5>
                <p class="text-muted mb-4">Mulai belanja dan temukan produk favorit Anda</p>
                <a href="{{ route('home') }}" class="btn btn-success" style="border-radius: 8px; padding: 10px 30px;">
                    <i class="fas fa-shopping-cart me-2"></i>Mulai Belanja
                </a>
            </div>
        </div>
        @endif

    </div>
</div>

{{-- Minimal Styling --}}
<style>
.card {
    transition: all 0.2s ease;
}

.card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}

.status-tab:hover {
    background: #f8f9fa !important;
    border-color: #dee2e6 !important;
}

.status-tab.active:hover {
    opacity: 0.9;
}

.toggle-btn[aria-expanded="true"] i {
    transform: rotate(180deg);
}

.toggle-btn i {
    transition: transform 0.2s ease;
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
    .status-tab {
        font-size: 0.8rem !important;
        padding: 8px 15px !important;
    }
    
    h1 {
        font-size: 1.5rem !important;
    }
}
</style>
@endsection