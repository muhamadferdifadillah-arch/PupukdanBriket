@extends('layouts.user.dashboard')

@section('title', 'Checkout - Manfaatin')

@section('content')
<div class="checkout-page" style="background: #f8f9fa; min-height: 100vh; padding: 40px 0;">
    
    <div class="container">
        
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb" style="background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #6c757d; text-decoration: none;">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" style="color: #6c757d; text-decoration: none;">Shopping Cart</a></li>
                <li class="breadcrumb-item active" style="color: #2d3748;">Checkout</li>
            </ol>
        </nav>

        {{-- Header --}}
        <div class="mb-4">
            <h1 class="fw-bold mb-1" style="color: #2d3748; font-size: 2rem;">Checkout</h1>
            <p class="text-muted mb-0">Lengkapi informasi pengiriman dan pembayaran Anda</p>
        </div>

        <form action="{{ route('user.checkout.process') }}" method="POST" id="checkoutForm">
            @csrf
            
            <div class="row">
                {{-- Left Column - Forms --}}
                <div class="col-lg-7 mb-4">
                    
                    {{-- Shipping Address --}}
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #2d3748;">
                                <i class="fas fa-map-marker-alt me-2" style="color: #198754;"></i>
                                Alamat Pengiriman
                            </h5>
                            
                            <div class="mb-3">
                                <label class="form-label small text-muted">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" class="form-control" required
                                       style="border-radius: 8px; border-color: #e9ecef;"
                                       placeholder="Masukkan nama lengkap"
                                       value="{{ old('full_name', auth()->user()->name ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small text-muted">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" required
                                       style="border-radius: 8px; border-color: #e9ecef;"
                                       placeholder="Contoh: 08123456789"
                                       value="{{ old('phone', auth()->user()->phone ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small text-muted">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" rows="3" required
                                          style="border-radius: 8px; border-color: #e9ecef;"
                                          placeholder="Jalan, Nomor Rumah, RT/RW">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Provinsi <span class="text-danger">*</span></label>
                                    <select name="province_id" id="province" class="form-select" required
                                            style="border-radius: 8px; border-color: #e9ecef;">
                                        <option value="">Pilih Provinsi</option>
                                        {{-- Options will be loaded via AJAX --}}
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Kota/Kabupaten <span class="text-danger">*</span></label>
                                    <select name="city_id" id="city" class="form-select" required
                                            style="border-radius: 8px; border-color: #e9ecef;">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mt-0">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Kecamatan</label>
                                    <input type="text" name="district" class="form-control"
                                           style="border-radius: 8px; border-color: #e9ecef;"
                                           placeholder="Nama kecamatan"
                                           value="{{ old('district') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" name="postal_code" class="form-control" required
                                           style="border-radius: 8px; border-color: #e9ecef;"
                                           placeholder="12345"
                                           value="{{ old('postal_code') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Shipping Method --}}
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #2d3748;">
                                <i class="fas fa-truck me-2" style="color: #198754;"></i>
                                Metode Pengiriman
                            </h5>

                            <div class="shipping-options">
                                <div class="form-check mb-3 p-3 border rounded" style="border-radius: 8px !important;">
                                    <input class="form-check-input" type="radio" name="courier" id="jne" value="jne" required>
                                    <label class="form-check-label w-100" for="jne">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>JNE Regular</strong>
                                                <small class="d-block text-muted">Estimasi 2-3 hari</small>
                                            </div>
                                            <span class="fw-semibold text-success">Rp 15.000</span>
                                        </div>
                                    </label>
                                </div>

                                <div class="form-check mb-3 p-3 border rounded" style="border-radius: 8px !important;">
                                    <input class="form-check-input" type="radio" name="courier" id="jnt" value="jnt">
                                    <label class="form-check-label w-100" for="jnt">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>J&T Express</strong>
                                                <small class="d-block text-muted">Estimasi 2-4 hari</small>
                                            </div>
                                            <span class="fw-semibold text-success">Rp 12.000</span>
                                        </div>
                                    </label>
                                </div>

                                <div class="form-check p-3 border rounded" style="border-radius: 8px !important;">
                                    <input class="form-check-input" type="radio" name="courier" id="sicepat" value="sicepat">
                                    <label class="form-check-label w-100" for="sicepat">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>SiCepat REG</strong>
                                                <small class="d-block text-muted">Estimasi 2-3 hari</small>
                                            </div>
                                            <span class="fw-semibold text-success">Rp 13.000</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #2d3748;">
                                <i class="fas fa-credit-card me-2" style="color: #198754;"></i>
                                Metode Pembayaran
                            </h5>

                            <div class="payment-options">
                                <div class="form-check mb-3 p-3 border rounded" style="border-radius: 8px !important;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" required>
                                    <label class="form-check-label" for="bank_transfer">
                                        <i class="fas fa-university me-2"></i>
                                        <strong>Transfer Bank</strong>
                                        <small class="d-block text-muted ms-4">BCA, Mandiri, BNI, BRI</small>
                                    </label>
                                </div>

                                <div class="form-check mb-3 p-3 border rounded" style="border-radius: 8px !important;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="ewallet" value="ewallet">
                                    <label class="form-check-label" for="ewallet">
                                        <i class="fas fa-wallet me-2"></i>
                                        <strong>E-Wallet</strong>
                                        <small class="d-block text-muted ms-4">GoPay, OVO, Dana, ShopeePay</small>
                                    </label>
                                </div>

                                <div class="form-check p-3 border rounded" style="border-radius: 8px !important;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod">
                                    <label class="form-check-label" for="cod">
                                        <i class="fas fa-money-bill-wave me-2"></i>
                                        <strong>Cash on Delivery (COD)</strong>
                                        <small class="d-block text-muted ms-4">Bayar saat barang diterima</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Right Column - Order Summary --}}
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px; position: sticky; top: 20px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3" style="color: #2d3748;">Ringkasan Pesanan</h5>

                            {{-- Product List --}}
                            <div class="order-items mb-3" style="max-height: 300px; overflow-y: auto;">
                                @php
                                    // Sample data - replace with actual cart items
                                    $cartItems = [
                                        ['name' => 'Pupuk Organik Premium', 'quantity' => 2, 'price' => 50000, 'image' => 'https://via.placeholder.com/60'],
                                        ['name' => 'Arang Sekam Padi', 'quantity' => 1, 'price' => 25000, 'image' => 'https://via.placeholder.com/60'],
                                    ];
                                    $subtotal = 125000;
                                    $shipping = 15000;
                                    $discount = 0;
                                    $total = $subtotal + $shipping - $discount;
                                @endphp

                                @foreach($cartItems as $item)
                                <div class="d-flex gap-2 mb-3 pb-3 border-bottom">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #e9ecef;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1" style="font-size: 0.9rem;">{{ $item['name'] }}</h6>
                                        <small class="text-muted">{{ $item['quantity'] }}x Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                                        <div class="fw-semibold mt-1" style="color: #2d3748; font-size: 0.9rem;">
                                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{-- Promo Code --}}
                            <div class="mb-3">
                                <label class="form-label small text-muted">Kode Promo</label>
                                <div class="input-group">
                                    <input type="text" name="promo_code" class="form-control" 
                                           placeholder="Masukkan kode promo"
                                           style="border-radius: 8px 0 0 8px; border-color: #e9ecef;">
                                    <button class="btn btn-outline-success" type="button" 
                                            style="border-radius: 0 8px 8px 0;">
                                        Terapkan
                                    </button>
                                </div>
                            </div>

                            <hr>

                            {{-- Price Summary --}}
                            <div class="price-summary">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal ({{ count($cartItems) }} item)</span>
                                    <span class="fw-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Ongkos Kirim</span>
                                    <span class="fw-medium shipping-cost">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                                </div>

                                @if($discount > 0)
                                <div class="d-flex justify-content-between mb-2 text-success">
                                    <span>Diskon</span>
                                    <span class="fw-medium">- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                                </div>
                                @endif

                                <hr class="my-3">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fw-bold" style="font-size: 1.1rem;">Total Pembayaran</span>
                                    <span class="fw-bold text-success" style="font-size: 1.3rem;" id="totalAmount">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-success w-100 py-3" style="border-radius: 8px; font-weight: 600;">
                                    <i class="fas fa-lock me-2"></i>
                                    Proses Pembayaran
                                </button>

                                <small class="d-block text-center text-muted mt-3">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Transaksi Anda aman dan terenkripsi
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Icons --}}
                    <div class="text-center mt-3">
                        <small class="text-muted d-block mb-2">Kami menerima</small>
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" style="height: 20px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" style="height: 20px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Gopay_logo.svg" alt="GoPay" style="height: 20px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO" style="height: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

{{-- Styling --}}
<style>
.form-control:focus,
.form-select:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
}

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.form-check-input:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
}

.form-check {
    transition: all 0.2s ease;
}

.form-check:has(.form-check-input:checked) {
    background-color: #f0fdf4;
    border-color: #198754 !important;
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.order-items::-webkit-scrollbar {
    width: 6px;
}

.order-items::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.order-items::-webkit-scrollbar-thumb {
    background: #198754;
    border-radius: 10px;
}

.card {
    transition: all 0.2s ease;
}

/* Responsive */
@media (max-width: 991px) {
    .card[style*="position: sticky"] {
        position: relative !important;
    }
}
</style>

{{-- JavaScript for dynamic shipping cost --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const courierRadios = document.querySelectorAll('input[name="courier"]');
    const shippingCostElement = document.querySelector('.shipping-cost');
    const totalAmountElement = document.getElementById('totalAmount');
    
    const subtotal = {{ $subtotal }};
    const discount = {{ $discount }};
    
    const shippingCosts = {
        'jne': 15000,
        'jnt': 12000,
        'sicepat': 13000
    };
    
    courierRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            const shippingCost = shippingCosts[this.value];
            const total = subtotal + shippingCost - discount;
            
            shippingCostElement.textContent = 'Rp ' + shippingCost.toLocaleString('id-ID');
            totalAmountElement.textContent = 'Rp ' + total.toLocaleString('id-ID');
        });
    });
    
    // Form validation
    const form = document.getElementById('checkoutForm');
    form.addEventListener('submit', function(e) {
        const courier = document.querySelector('input[name="courier"]:checked');
        const payment = document.querySelector('input[name="payment_method"]:checked');
        
        if (!courier) {
            e.preventDefault();
            alert('Silakan pilih metode pengiriman');
            return false;
        }
        
        if (!payment) {
            e.preventDefault();
            alert('Silakan pilih metode pembayaran');
            return false;
        }
    });
});
</script>
@endsection