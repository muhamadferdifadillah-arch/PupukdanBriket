@extends('user.layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')

<div class="order-success-wrapper py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">

                <!-- Success Card -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-5 text-center">

                        <!-- Animated Success Icon -->
                        <div class="success-icon mb-4">
                            <div class="checkmark-circle">
                                <div class="background"></div>
                                <div class="checkmark draw"></div>
                            </div>
                        </div>

                        <h2 class="fw-bold text-dark mb-2">Pesanan Berhasil!</h2>
                        <p class="text-muted mb-4">
                            Terima kasih telah berbelanja. Pesanan Anda sedang diproses.
                        </p>

                        <!-- Order Number -->
                        <div class="alert alert-success d-flex align-items-center justify-content-center gap-2 mb-4">
                            <i class="fas fa-receipt"></i>
                            <div>
                                <small class="d-block">Nomor Pesanan</small>
                                <strong class="fs-5">{{ $orderNumber }}</strong>
                            </div>
                        </div>

                        <!-- Order Details Preview -->
                        @if($order)
                        <div class="bg-light rounded-3 p-4 mb-4 text-start">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Status</span>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-clock me-1"></i>Menunggu Pembayaran
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Metode Pembayaran</span>
                                <strong>{{ ucfirst($order->payment_method) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Pengiriman</span>
                                <strong>
                                    @if($order->courier === 'pickup')
                                        <i class="fas fa-store text-primary me-1"></i>Jemput di Tempat
                                    @else
                                        {{ strtoupper($order->courier) }}
                                    @endif
                                </strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold fs-5">Total Pembayaran</span>
                                <span class="fw-bold fs-5 text-success">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 mb-3">
                            <a href="{{ route('user.orders.show', $orderNumber) }}" 
                               class="btn btn-success btn-lg rounded-3">
                                <i class="fas fa-eye me-2"></i>
                                Lihat Detail Pesanan
                            </a>
                            <a href="{{ route('user.orders.index') }}" 
                               class="btn btn-outline-primary rounded-3">
                                <i class="fas fa-list me-2"></i>
                                Daftar Pesanan Saya
                            </a>
                            <a href="{{ route('home') }}" 
                               class="btn btn-outline-secondary rounded-3">
                                <i class="fas fa-home me-2"></i>
                                Kembali ke Beranda
                            </a>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-info border-0 text-start">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Langkah Selanjutnya:</strong>
                            <ul class="mb-0 mt-2 ps-3">
                                <li>Lakukan pembayaran sesuai metode yang dipilih</li>
                                <li>Konfirmasi pembayaran di halaman detail pesanan</li>
                                <li>Pesanan akan diproses setelah pembayaran dikonfirmasi</li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Additional Info -->
                <div class="text-center mt-4 text-white">
                    <p class="mb-2">
                        <i class="fas fa-headset me-2"></i>
                        Butuh bantuan? Hubungi Customer Service
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://wa.me/6281234567890" class="text-white text-decoration-none" target="_blank">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="mailto:support@example.com" class="text-white text-decoration-none">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
/* Success Animation */
.success-icon {
    display: inline-block;
}

.checkmark-circle {
    width: 150px;
    height: 150px;
    position: relative;
    display: inline-block;
    vertical-align: top;
    margin: 0 auto;
}

.checkmark-circle .background {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: #28a745;
    position: absolute;
    animation: scale-up 0.5s ease-in-out;
}

.checkmark-circle .checkmark {
    border-radius: 5px;
}

.checkmark-circle .checkmark.draw:after {
    animation-delay: 0.3s;
    animation-duration: 0.5s;
    animation-timing-function: ease;
    animation-name: checkmark;
    animation-fill-mode: forwards;
}

.checkmark-circle .checkmark:after {
    opacity: 1;
    height: 75px;
    width: 37.5px;
    transform-origin: left top;
    border-right: 6px solid #fff;
    border-top: 6px solid #fff;
    border-radius: 2.5px !important;
    content: '';
    left: 35px;
    top: 75px;
    position: absolute;
    transform: scaleX(-1) rotate(135deg);
}

@keyframes scale-up {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes checkmark {
    0% {
        height: 0;
        width: 0;
        opacity: 1;
    }
    20% {
        height: 0;
        width: 37.5px;
        opacity: 1;
    }
    40% {
        height: 75px;
        width: 37.5px;
        opacity: 1;
    }
    100% {
        height: 75px;
        width: 37.5px;
        opacity: 1;
    }
}

.card {
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

@endsection