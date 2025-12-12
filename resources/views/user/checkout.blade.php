@extends('layouts.user.dashboard')

@section('title', 'Checkout - Manfaatin')

@section('content')

<div class="checkout-wrapper py-5" style="background:#f5f7fa;">
    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('cart.index') }}" class="text-muted text-decoration-none">Keranjang</a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold">Checkout</li>
            </ol>
        </nav>

        <div class="mb-4">
            <h2 class="fw-bold text-dark">Checkout</h2>
            <p class="text-muted">Lengkapi informasi pengiriman & pembayaran Anda</p>
        </div>

        <form action="{{ route('user.checkout.process') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="row g-4">

                <!-- Left Content -->
                <div class="col-lg-7">

                    <!-- Shipping Address -->
                    <div class="card shadow-sm border-0 mb-4 checkout-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-map-marker-alt text-success me-2"></i>Alamat Pengiriman
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="full_name" class="form-control rounded-3"
                                        value="{{ old('full_name', auth()->user()->name ?? '') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" name="phone" class="form-control rounded-3"
                                        value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="address" class="form-control rounded-3" rows="3" required>{{ old('address', auth()->user()->address ?? '') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Provinsi</label>
                                    <select id="province" name="province_id" class="form-select rounded-3" required>
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Kota/Kabupaten</label>
                                    <select id="city" name="city_id" class="form-select rounded-3" required>
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Kecamatan</label>
                                    <input type="text" name="district" class="form-control rounded-3">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" name="postal_code" class="form-control rounded-3" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Courier -->
                    <div class="card shadow-sm border-0 mb-4 checkout-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-truck text-success me-2"></i>Metode Pengiriman
                            </h5>

                            @foreach([
                                'jne' => ['JNE Regular', 'Estimasi 2–3 Hari', 15000],
                                'jnt' => ['J&T Express', 'Estimasi 2–4 Hari', 12000],
                                'sicepat' => ['SiCepat REG', 'Estimasi 2–3 Hari', 13000],
                            ] as $key => $val)

                            <label class="shipping-option border rounded p-3 mb-3 d-flex justify-content-between align-items-center cursor-pointer">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="radio" name="courier" value="{{ $key }}">
                                    <div>
                                        <strong>{{ $val[0] }}</strong>
                                        <small class="d-block text-muted">{{ $val[1] }}</small>
                                    </div>
                                </div>
                                <span class="fw-semibold text-success">Rp {{ number_format($val[2],0,',','.') }}</span>
                            </label>

                            @endforeach
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card shadow-sm border-0 checkout-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-credit-card text-success me-2"></i>Metode Pembayaran
                            </h5>

                            @foreach([
                                'bank_transfer' => ['Transfer Bank', 'BCA, Mandiri, BNI, BRI', 'fa-university'],
                                'ewallet' => ['E-Wallet', 'Gopay, OVO, Dana, ShopeePay', 'fa-wallet'],
                                'cod' => ['COD (Bayar Ditempat)', 'Pembayaran saat barang tiba', 'fa-money-bill-wave'],
                            ] as $key => $val)

                            <label class="payment-option border rounded p-3 mb-3 d-flex align-items-center gap-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="{{ $key }}">
                                <i class="fas {{ $val[2] }} fs-4 text-success"></i>
                                <div>
                                    <strong>{{ $val[0] }}</strong>
                                    <small class="d-block text-muted">{{ $val[1] }}</small>
                                </div>
                            </label>

                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="card shadow-sm border-0 sticky-top checkout-card" style="top:20px;">
                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-3 text-dark">Ringkasan Pesanan</h5>

                            <hr>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>Rp 125.000</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Ongkos Kirim</span>
                                <strong id="shippingCost">Rp 15.000</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <span class="fw-bold fs-5">Total</span>
                                <span class="fw-bold fs-5 text-success" id="totalAmount">Rp 140.000</span>
                            </div>

                            <button class="btn btn-success w-100 mt-4 py-3 rounded-3 fw-semibold">
                                <i class="fas fa-lock me-2"></i>Proses Pembayaran
                            </button>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<style>
.checkout-card:hover {
    transform: translateY(-2px);
    transition: 0.2s ease;
}
.shipping-option:hover,
.payment-option:hover {
    border-color: #198754 !important;
    background: #f0fff4;
}
.cursor-pointer { cursor: pointer; }
</style>

@endsection
