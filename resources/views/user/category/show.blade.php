@extends('user.layouts.app')

@section('content')

    <div class="container py-5">

        <h2 class="mb-4 fw-bold">{{ $category->name }}</h2>

        @if ($products->count() > 0)

            <div class="row g-4">

                @foreach ($products as $product)
                    <div class="col-md-3 col-sm-6">

                        <div class="product-item">
                            <figure>
                                <a href="#">
                                    <img src="{{ asset($product->image) }}" class="card-img-top"
                                        style="height: 200px; object-fit: cover;">
                                </a>
                            </figure>

                            <div class="p-3 text-center">
                                <h3 class="fs-6 fw-normal mb-2">{{ $product->name }}</h3>
                                <div class="d-flex justify-content-center gap-2 mb-3">
                                    <span class="text-dark fw-bold fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                
                                <!-- TOMBOL AJAX - TIDAK PAKAI FORM -->
                                <button 
                                    type="button" 
                                    class="btn btn-primary w-100 btn-add-to-cart"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}">
                                    Add to Cart
                                </button>
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>

        @else

            <p class="text-muted mt-3">Tidak ada produk untuk kategori ini.</p>

        @endif

    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const buttons = document.querySelectorAll('.btn-add-to-cart');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const originalText = this.textContent;
            
            this.disabled = true;
            this.textContent = 'Adding...';
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
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
                this.disabled = false;
                this.textContent = originalText;
                
                if (data.success) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: productName + ' berhasil ditambahkan ke keranjang',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    } else {
                        alert('✓ ' + data.message);
                    }
                    
                    const cartBadge = document.querySelector('.cart-count');
                    if (cartBadge) {
                        cartBadge.textContent = data.cart_count;
                    }
                    
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-success');
                    setTimeout(() => {
                        this.classList.remove('btn-success');
                        this.classList.add('btn-primary');
                    }, 1000);
                } else {
                    alert('✗ ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.disabled = false;
                this.textContent = originalText;
                alert('Terjadi kesalahan saat menambahkan produk');
            });
        });
    });
});
</script>
@endpush