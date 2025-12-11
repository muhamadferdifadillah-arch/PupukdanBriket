@extends('user.layouts.app')

@section('title', 'All Categories')

@section('content')
<style>
    .product-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        background: #fff;
        transition: all 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .product-name {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .product-price {
        font-size: 18px;
        font-weight: 700;
        color: #00a651;
        margin-bottom: 15px;
    }

    .btn-add-to-cart {
        width: 100%;
        padding: 10px;
        background: #00a651;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-add-to-cart:hover {
        background: #008a43;
        transform: scale(1.02);
    }

    .btn-add-to-cart:disabled {
        background: #ccc;
        cursor: not-allowed;
    }
</style>

<div class="container py-5">
    <h2 class="mb-4">All Products</h2>


    @if(isset($products) && $products->count() > 0)

        <div class="row g-4">
           @foreach($products ?? [] as $product)

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        
                        <div class="product-name">{{ $product->name }}</div>
                        
                        <div class="product-price">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                        
                        <!-- Tombol Add to Cart -->
                        <button 
                            class="btn-add-to-cart" 
                            data-product-id="{{ $product->id }}"
                            type="button">
                            Add to Cart
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Belum ada produk dalam kategori ini.
        </div>
    @endif
</div>

<!-- AJAX Script untuk Add to Cart -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const buttons = document.querySelectorAll('.btn-add-to-cart');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const btnText = this.textContent;
            
            // Disable button saat proses
            this.disabled = true;
            this.textContent = 'Adding...';
            
            // Ambil CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Kirim request AJAX
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                // Enable button kembali
                this.disabled = false;
                this.textContent = btnText;
                
                if (data.success) {
                    // Tampilkan notifikasi sukses
                    showNotification('success', data.message);
                    
                    // Update cart count di navbar
                    updateCartCount(data.cart_count);
                } else {
                    // Tampilkan error
                    showNotification('error', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.disabled = false;
                this.textContent = btnText;
                showNotification('error', 'Terjadi kesalahan saat menambahkan produk');
            });
        });
    });
    
    // Fungsi untuk tampilkan notifikasi
    function showNotification(type, message) {
        // Gunakan alert sederhana (atau bisa pakai SweetAlert2)
        if (type === 'success') {
            alert('✓ ' + message);
        } else {
            alert('✗ ' + message);
        }
    }
    
    // Fungsi untuk update cart count di navbar
    function updateCartCount(count) {
        const cartBadge = document.querySelector('.cart-count');
        if (cartBadge) {
            cartBadge.textContent = count;
        }
    }
});
</script>
@endsection