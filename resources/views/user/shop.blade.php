@extends('user.layouts.app')

@section('title', $category->name ?? 'Shop Products')

@section('content')

    <style>
        /* ===== FORCE DARK FOOTER ===== */
        footer, footer.footer-dark {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
            padding: 60px 0 30px !important;
        }

        footer .widget-title,
        footer h5 {
            color: #ffffff !important;
            font-size: 18px !important;
            font-weight: 600 !important;
            margin-bottom: 20px !important;
        }

        footer .text-secondary,
        footer p {
            color: #b0b0b0 !important;
            font-size: 14px !important;
        }

        footer .nav-link {
            color: #b0b0b0 !important;
            font-size: 14px !important;
        }

        footer .nav-link:hover {
            color: #ffffff !important;
        }

        footer .form-control {
            background-color: #ffffff !important;
            color: #2d2d2d !important;
        }

        footer .btn-primary {
            background-color: #007bff !important;
        }

        .social-icon {
            width: 38px;
            height: 38px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #b0b0b0;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        #footer-bottom {
            background-color: #222 !important;
            border-top: 1px solid #404040 !important;
            padding: 20px 0 !important;
        }

        #footer-bottom p {
            color: #b0b0b0 !important;
            font-size: 13px !important;
            margin: 0 !important;
        }

        /* ===== CARD ===== */
        .shop-card {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .shop-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.12);
        }

        /* ===== IMAGE ===== */
        .shop-image {
            height: 200px;
            background: #f6f6f6;
        }

        .shop-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ===== BODY ===== */
        .shop-body {
            padding: 16px;
        }

        .shop-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #222;
        }

        .shop-price {
            font-size: 18px;
            font-weight: bold;
            color: #00a651;
            margin-bottom: 14px;
        }

        /* ===== BUTTON ===== */
        .btn-add-cart {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #00a651;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn-add-cart:hover {
            background: #008a43;
        }

        .btn-add-cart:disabled {
            background: #cccccc;
            cursor: not-allowed;
        }
    </style>

    <div class="container py-5">

        <h2 class="fw-bold mb-4 text-center">
            {{ $category->name ?? 'Shop Products' }}
        </h2>

        @if($products->count() > 0)
            <div class="row g-4 justify-content-center">

                @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">

                        <div class="shop-card">

                            <div class="shop-image">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    onerror="this.src='{{ asset('images/no-image.png') }}'">

                            </div>

                            <div class="shop-body">
                                <h5 class="shop-title">{{ $product->name }}</h5>

                                <p class="shop-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <button class="btn-add-cart" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                    Add to Cart
                                </button>
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        @else
            <div class="alert alert-info text-center">
                Tidak ada produk.
            </div>
        @endif

    </div>

    {{-- ✅ AJAX ADD TO CART --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.btn-add-cart').forEach(btn => {
                btn.addEventListener('click', function () {

                    const productId = this.dataset.id;
                    const productName = this.dataset.name;
                    const original = this.innerHTML;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;

                    this.disabled = true;
                    this.innerHTML = 'Adding...';

                    fetch("{{ route('cart.add') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1
                        })
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.disabled = false;
                            this.innerHTML = original;

                            if (data.success) {
                                alert('✓ ' + productName + ' ditambahkan ke cart');

                                const badge = document.querySelector('.cart-count');
                                if (badge) badge.textContent = data.cart_count;
                            } else {
                                alert('✗ ' + data.message);
                            }
                        })
                        .catch(() => {
                            this.disabled = false;
                            this.innerHTML = original;
                            alert('Terjadi kesalahan');
                        });
                });
            });

        });
    </script>

@endsection