@extends('user.layouts.app')

@section('title', 'Detail Pesanan - ManfaatinOnline')

@section('content')

    <div class="order-detail-wrapper py-5" style="background:#f5f7fa;">
        <div class="container">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.orders.index') }}" class="text-muted text-decoration-none">Pesanan Saya</a>
                    </li>
                    <li class="breadcrumb-item active text-dark fw-semibold">Detail Pesanan</li>
                </ol>
            </nav>

            <div class="mb-4">
                <h2 class="fw-bold text-dark">Detail Pesanan</h2>
                <p class="text-muted">{{ $order->order_number }}</p>
            </div>

            <div class="row g-4">

                <!-- Left Column -->
                <div class="col-lg-8">

                    <!-- Order Status Timeline -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Status Pesanan</h5>

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

                            <div class="alert alert-{{ $config['badge'] }} d-flex align-items-center">
                                <i class="fas fa-{{ $config['icon'] }} fa-2x me-3"></i>
                                <div>
                                    <strong class="d-block">{{ $config['text'] }}</strong>
                                    <small>Pesanan Anda sedang {{ strtolower($config['text']) }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product List -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Produk Dipesan</h5>

                            @foreach($orderItems as $item)
                                <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                    <img src="{{ asset($item->product_image ?? 'user/images/product-thumb-1.png') }}"
                                        alt="{{ $item->product_name }}" class="rounded"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold">{{ $item->product_name }}</h6>
                                        <small class="text-muted">{{ $item->quantity }} x Rp
                                            {{ number_format($item->price, 0, ',', '.') }}</small>
                                    </div>
                                    <div class="text-end">
                                        <strong class="text-success">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-map-marker-alt text-success me-2"></i>
                                Alamat Pengiriman
                            </h5>
                            <div class="mb-2">
                                <strong>{{ $order->customer_name }}</strong>
                            </div>
                            <div class="mb-2">
                                <i class="fas fa-phone text-muted me-2"></i>{{ $order->customer_phone }}
                            </div>
                            <div class="text-muted">
                                <i class="fas fa-home text-muted me-2"></i>

                                {{ $order->shipping_address ?? '' }}

                                @if(!empty($order->district))
                                    , {{ $order->district }}
                                @endif

                                @if(!empty($order->postal_code))
                                    , {{ $order->postal_code }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">

                    <!-- Order Summary -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Nomor Pesanan</span>
                                </div>
                                <strong>{{ $order->order_number }}</strong>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Tanggal Pesanan</span>
                                </div>
                                <strong>{{ date('d M Y, H:i', strtotime($order->created_at)) }}</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax (10%)</span>
                                <strong>Rp {{ number_format($order->tax, 0, ',', '.') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Ongkos Kirim ({{ strtoupper($order->courier) }})</span>
                                <strong>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <span class="fw-bold fs-5">Total</span>
                                <span class="fw-bold fs-5 text-success">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-credit-card text-success me-2"></i>
                                Metode Pembayaran
                            </h5>
                            <div class="alert alert-light mb-0">
                                <strong class="text-capitalize">
                                    {{ str_replace('-', ' ', $order->payment_method) }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-3 d-grid gap-2">
                        <a href="{{ route('user.orders.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>

                        @if($order->status == 'pending')
                            <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-times me-2"></i>Batalkan Pesanan
                                </button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection