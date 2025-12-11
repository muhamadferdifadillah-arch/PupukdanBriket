@extends('user.layouts.app')

@section('title', 'Pesanan Saya - Manfaatin')

@section('content')
<div class="orders-page" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; padding-bottom: 50px;">

    {{-- Hero Header --}}
    <div class="orders-header" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color:#78350f; padding:60px 0; margin-bottom:40px; position: relative; overflow: hidden;">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-wrapper" style="background: rgba(120,53,15,0.15); padding: 15px; border-radius: 15px;">
                            <i class="fas fa-shopping-bag" style="font-size: 2.5rem; color: #78350f;"></i>
                        </div>
                        <div>
                            <h1 class="mb-0 fw-bold" style="font-size: 2.5rem;">Pesanan Saya</h1>
                            <p class="mb-0 opacity-90" style="font-size: 1.1rem;">Kelola dan lacak semua pesanan Anda dengan mudah</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="stats-card p-3" style="background: rgba(120,53,15,0.1); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(120,53,15,0.2);">
                        <small class="d-block opacity-90">Total Pesanan</small>
                        <h2 class="mb-0 fw-bold">{{ $orders->total() }}</h2>
                    </div>
                </div>
            </div>
        </div>
        {{-- Decorative Elements --}}
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(245,158,11,0.2); border-radius: 50%; z-index: 1;"></div>
        <div style="position: absolute; bottom: -100px; left: -100px; width: 400px; height: 400px; background: rgba(251,191,36,0.15); border-radius: 50%; z-index: 1;"></div>
    </div>

    <div class="container">

        {{-- Search & Filter Section --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-body p-4">
                        <form action="{{ route('user.orders') }}" method="GET">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-10">
                                    <div class="input-group input-group-lg" style="border-radius: 15px; overflow: hidden;">
                                        <span class="input-group-text bg-white border-0" style="padding-left: 20px;">
                                            <i class="fas fa-search text-primary"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-0 shadow-none"
                                               placeholder="Cari nomor pesanan atau nama produk..."
                                               value="{{ request('search') }}"
                                               style="font-size: 1rem;">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-warning w-100 btn-lg text-white" type="submit" style="border-radius: 15px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border: none;">
                                        <i class="fas fa-search me-2"></i>Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Filter Pills --}}
        <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden;">
            <div class="card-body p-3">
                <div class="d-flex flex-wrap gap-2 justify-content-center">

                    @php
                        $statuses = [
                            'all' => ['icon'=>'list','label'=>'Semua', 'color'=>'#6c757d'],
                            'pending' => ['icon'=>'clock','label'=>'Menunggu', 'color'=>'#ffc107'],
                            'processing' => ['icon'=>'box','label'=>'Diproses', 'color'=>'#0dcaf0'],
                            'shipping' => ['icon'=>'truck','label'=>'Dikirim', 'color'=>'#0d6efd'],
                            'completed' => ['icon'=>'check-circle','label'=>'Selesai', 'color'=>'#198754'],
                            'cancelled' => ['icon'=>'times-circle','label'=>'Dibatalkan', 'color'=>'#dc3545'],
                        ];
                    @endphp

                    @foreach($statuses as $key => $row)
                    <a href="{{ $key === 'all' ? route('user.orders') : route('user.orders', ['status'=>$key]) }}"
                       class="status-pill {{ (!request('status') && $key === 'all') || request('status') == $key ? 'active' : '' }}"
                       style="padding: 12px 24px; border-radius: 50px; text-decoration: none; transition: all 0.3s; border: 2px solid {{ $row['color'] }}; color: {{ (!request('status') && $key === 'all') || request('status') == $key ? 'white' : $row['color'] }}; background: {{ (!request('status') && $key === 'all') || request('status') == $key ? $row['color'] : 'white' }}; font-weight: 600;">
                        <i class="fas fa-{{ $row['icon'] }} me-2"></i>{{ $row['label'] }}
                    </a>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- Orders List --}}
        @if($orders->count() > 0)
            <div class="row">
                @foreach($orders as $order)
                <div class="col-12 mb-4">
                    <div class="card border-0 shadow-lg order-card" style="border-radius: 25px; overflow: hidden; transition: all 0.3s;">

                        <div class="card-body p-4">

                            {{-- Order Header --}}
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="col-auto">
                                    <div class="order-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-receipt text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="fw-bold fs-5">{{ $order->order_number }}</span>

                                            {{-- Status Badge --}}
                                            @php
                                                $statusConfig = [
                                                    'completed'=>['bg'=>'#198754', 'text'=>'Selesai'],
                                                    'shipping'=>['bg'=>'#0d6efd', 'text'=>'Dikirim'],
                                                    'processing'=>['bg'=>'#0dcaf0', 'text'=>'Diproses'],
                                                    'pending'=>['bg'=>'#ffc107', 'text'=>'Menunggu'],
                                                    'cancelled'=>['bg'=>'#dc3545', 'text'=>'Dibatalkan']
                                                ];
                                                $currentStatus = $statusConfig[$order->status] ?? ['bg'=>'#6c757d', 'text'=>'Unknown'];
                                            @endphp

                                            <span class="badge" style="background: {{ $currentStatus['bg'] }}; padding: 6px 15px; border-radius: 20px; font-size: 0.85rem;">
                                                {{ $currentStatus['text'] }}
                                            </span>
                                        </div>

                                        <small class="text-muted d-flex align-items-center gap-2">
                                            <i class="far fa-calendar"></i>
                                            {{ $order->created_at->format('d F Y, H:i') }} WIB
                                        </small>
                                    </div>
                                </div>

                                {{-- Toggle Button --}}
                                <button class="btn btn-light toggle-btn" 
                                        data-bs-toggle="collapse"
                                        data-bs-target="#orderDetail{{ $order->id }}"
                                        style="border-radius: 12px; padding: 10px 20px; border: 2px solid #e9ecef;">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>

                            {{-- Quick Preview --}}
                            @php $firstItem = $order->orderItems->first(); @endphp
                            @if($firstItem)
                            <div class="row align-items-center g-3 mb-3">
                                <div class="col-auto">
                                    <div class="product-image-wrapper" style="width: 100px; height: 100px; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                        <img src="{{ $firstItem->product->image 
                                                ? asset('storage/'.$firstItem->product->image)
                                                : 'https://via.placeholder.com/100' }}"
                                                style="width:100%; height:100%; object-fit:cover;">
                                    </div>
                                </div>

                                <div class="col">
                                    <h6 class="fw-bold mb-1" style="color: #2d3748;">{{ $firstItem->product->name }}</h6>
                                    <p class="small text-muted mb-2">
                                        <span class="badge bg-light text-dark">{{ $firstItem->quantity }}x</span>
                                        <span class="ms-2">@ Rp {{ number_format($firstItem->price,0,',','.') }}</span>
                                    </p>

                                    @if($order->orderItems->count() > 1)
                                        <small class="text-primary fw-semibold">
                                            <i class="fas fa-plus-circle me-1"></i>
                                            {{ $order->orderItems->count() - 1 }} produk lainnya
                                        </small>
                                    @endif
                                </div>

                                <div class="col-auto text-end">
                                    <small class="text-muted d-block mb-1">Total Belanja</small>
                                    <div class="fw-bold fs-4" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                        Rp {{ number_format($order->total_amount,0,',','.') }}
                                    </div>
                                </div>
                            </div>
                            @endif

                            {{-- Collapse Detail --}}
                            <div class="collapse" id="orderDetail{{ $order->id }}">
                                <div class="border-top pt-4 mt-3">

                                    <h6 class="fw-bold mb-3" style="color: #f59e0b;">
                                        <i class="fas fa-box-open me-2"></i> Detail Produk
                                    </h6>

                                    @foreach($order->orderItems as $item)
                                    <div class="d-flex gap-3 mb-3 p-3" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%); border-radius: 15px;">
                                        <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://via.placeholder.com/80' }}"
                                             style="width:80px;height:80px;object-fit:cover;border-radius:12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">{{ $item->product->name }}</h6>
                                            <small class="text-muted d-block mb-2">Jumlah: {{ $item->quantity }}</small>
                                            <div class="fw-bold" style="color: #f59e0b;">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    {{-- Shipping Info --}}
                                    @if($order->tracking_number)
                                    <div class="p-4 rounded-3 mt-4" style="background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%); border-left: 5px solid #0d6efd;">
                                        <h6 class="fw-bold mb-3" style="color: #0d6efd;">
                                            <i class="fas fa-truck me-2"></i> Informasi Pengiriman
                                        </h6>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Alamat Pengiriman</small>
                                                <p class="mb-0 fw-semibold">{{ $order->shipping_address }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Nomor Telepon</small>
                                                <p class="mb-0 fw-semibold">{{ $order->phone }}</p>
                                            </div>
                                            @if($order->courier)
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Kurir</small>
                                                <p class="mb-0 fw-semibold text-uppercase">{{ $order->courier }}</p>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Nomor Resi</small>
                                                <span class="badge bg-primary" style="font-size: 0.9rem; padding: 8px 15px;">
                                                    {{ $order->tracking_number }}
                                                </span>
                                            </div>
                                        </div>

                                        @if($order->status == 'shipping')
                                            <a href="#" class="btn btn-primary mt-3" style="border-radius: 10px;">
                                                <i class="fas fa-map-marker-alt me-2"></i>Lacak Paket
                                            </a>
                                        @endif
                                    </div>
                                    @endif

                                    {{-- Order Summary --}}
                                    <div class="p-4 mt-4" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 15px;">
                                        <h6 class="fw-bold mb-3">Ringkasan Pembayaran</h6>
                                        
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal Produk</span>
                                            <span class="fw-semibold">Rp {{ number_format($order->orderItems->sum(fn($i)=>$i->price * $i->quantity),0,',','.') }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Ongkos Kirim</span>
                                            <span class="fw-semibold">Rp {{ number_format($order->shipping_cost ?? 0,0,',','.') }}</span>
                                        </div>

                                        @if($order->discount > 0)
                                        <div class="d-flex justify-content-between mb-2 text-success">
                                            <span>Diskon</span>
                                            <span class="fw-semibold">- Rp {{ number_format($order->discount,0,',','.') }}</span>
                                        </div>
                                        @endif

                                        <hr class="my-3">

                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fs-5 fw-bold">Total Pembayaran</span>
                                            <span class="fs-4 fw-bold" style="color: #f59e0b;">
                                                Rp {{ number_format($order->total_amount,0,',','.') }}
                                            </span>
                                        </div>

                                        <small class="text-muted mt-2 d-block">
                                            <i class="fas fa-credit-card me-1"></i>
                                            Metode Pembayaran: <span class="fw-semibold">{{ ucfirst($order->payment_method) }}</span>
                                        </small>
                                    </div>

                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex gap-2 mt-4 flex-wrap">
                                
                                @if($order->status == 'completed')
                                    <a class="btn btn-success flex-grow-1" style="border-radius: 12px; padding: 12px;">
                                        <i class="fas fa-star me-2"></i>Beri Ulasan
                                    </a>
                                    <a class="btn btn-outline-success" style="border-radius: 12px; padding: 12px;">
                                        <i class="fas fa-redo me-2"></i>Beli Lagi
                                    </a>

                                @elseif($order->status == 'shipping')
                                    <form method="POST" action="{{ route('user.orders.complete',$order->id) }}" class="flex-grow-1">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-success w-100" style="border-radius: 12px; padding: 12px;">
                                            <i class="fas fa-check me-2"></i>Pesanan Diterima
                                        </button>
                                    </form>
                                    <a class="btn btn-outline-primary" style="border-radius: 12px; padding: 12px;">
                                        <i class="fas fa-headset me-2"></i>Hubungi
                                    </a>

                                @elseif($order->status == 'pending')
                                    <a href="{{ route('user.orders.pay',$order->id) }}" class="btn btn-warning flex-grow-1 text-white" style="border-radius: 12px; padding: 12px;">
                                        <i class="fas fa-wallet me-2"></i>Bayar Sekarang
                                    </a>
                                    <form method="POST" action="{{ route('user.orders.cancel',$order->id) }}">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-outline-danger" style="border-radius: 12px; padding: 12px;"
                                                onclick="return confirm('Yakin batalkan pesanan?')">
                                            <i class="fas fa-times me-2"></i>Batalkan
                                        </button>
                                    </form>

                                @elseif($order->status == 'processing')
                                    <a class="btn btn-outline-primary flex-grow-1" style="border-radius: 12px; padding: 12px;">
                                        <i class="fas fa-comments me-2"></i>Hubungi Penjual
                                    </a>

                                @elseif($order->status == 'cancelled')
                                    <a class="btn btn-outline-secondary flex-grow-1" style="border-radius: 12px; padding: 12px;">
                                        <i class="fas fa-shopping-cart me-2"></i>Pesan Lagi
                                    </a>
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
            <div class="empty-state-wrapper" style="max-width: 400px; margin: 0 auto;">
                <div class="empty-icon mb-4" style="width: 150px; height: 150px; margin: 0 auto; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 40px rgba(251, 191, 36, 0.3);">
                    <i class="fas fa-box-open text-white" style="font-size: 4rem;"></i>
                </div>
                <h4 class="fw-bold mb-2">Belum Ada Pesanan</h4>
                <p class="text-muted mb-4">Yuk mulai belanja dan temukan produk favorit Anda!</p>
                <a href="{{ route('home') }}" class="btn btn-lg btn-warning text-white" style="border-radius: 15px; padding: 12px 40px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border: none;">
                    <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                </a>
            </div>
        </div>
        @endif

    </div>
</div>

{{-- Enhanced Styling --}}
<style>
.order-card {
    transition: all 0.3s ease;
}

.order-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.12) !important;
}

.status-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.toggle-btn:hover {
    background: #fef3c7 !important;
    border-color: #fbbf24 !important;
}

.product-image-wrapper {
    transition: transform 0.3s ease;
}

.product-image-wrapper:hover {
    transform: scale(1.05);
}

/* Smooth collapse animation */
.collapse {
    transition: height 0.35s ease;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
}

/* Button hover effects */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Animate toggle icon */
.toggle-btn[aria-expanded="true"] i {
    transform: rotate(180deg);
    transition: transform 0.3s ease;
}

.toggle-btn i {
    transition: transform 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .orders-header h1 {
        font-size: 1.8rem !important;
    }
    
    .status-pill {
        font-size: 0.85rem;
        padding: 8px 16px !important;
    }
}
</style>
@endsection