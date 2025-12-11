@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative" style="background: linear-gradient(135deg, #FDB813 0%, #FFE082 100%); padding: 100px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">
                    <span class="text-success">Organic</span> Fertilizer<br>
                    <span class="text-success">Environmentally</span><br>
                    Friendly
                </h1>
                <p class="lead mb-4 text-dark">Fresh, organic products delivered right to your doorstep. Support local farmers and enjoy the best quality produce.</p>
                <a href="#products" class="btn btn-success btn-lg px-5 py-3 rounded-pill shadow">
                    <i class="fas fa-shopping-basket me-2"></i>Shop Now
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="https://images.unsplash.com/photo-1610348725531-843dff563e2c?w=600" alt="Organic Products" class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-0" style="margin-top: -50px; position: relative; z-index: 10;">
    <div class="container">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="feature-card bg-primary text-white p-4 d-flex align-items-center" style="min-height: 150px;">
                    <div class="icon-wrapper me-4" style="font-size: 3rem;">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Fresh from farm</h5>
                        <p class="mb-0 opacity-75">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card bg-secondary text-white p-4 d-flex align-items-center" style="min-height: 150px;">
                    <div class="icon-wrapper me-4" style="font-size: 3rem;">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">100% Organic</h5>
                        <p class="mb-0 opacity-75">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card bg-danger text-white p-4 d-flex align-items-center" style="min-height: 150px;">
                    <div class="icon-wrapper me-4" style="font-size: 3rem;">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Free delivery</h5>
                        <p class="mb-0 opacity-75">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category Section -->
<section class="category-section py-5 mt-5" id="categories">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-2">Category</h2>
                <p class="text-muted">Browse our organic product categories</p>
            </div>
            <a href="#" class="btn btn-primary rounded-pill px-4">
                View All <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-lg-2 col-md-4 col-6">
                <div class="category-card text-center p-4 rounded-3 bg-light h-100 hover-shadow transition">
                    <div class="category-icon mb-3" style="font-size: 3rem;">
                        {{ $category['icon'] }}
                    </div>
                    <h6 class="fw-bold mb-2">{{ $category['name'] }}</h6>
                    <p class="text-muted small mb-0">{{ $category['product_count'] }} Products</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="products-section py-5 bg-light" id="products">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Featured Products</h2>
            <p class="text-muted">Fresh arrivals and best sellers</p>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-lg-3 col-md-6">
                <div class="product-card bg-white rounded-3 overflow-hidden shadow-sm h-100 hover-lift transition" data-product-id="{{ $loop->index }}">
                    <div class="position-relative">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-100" style="height: 250px; object-fit: cover;">
                        @if($product['discount'])
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3">-{{ $product['discount'] }}%</span>
                        @endif
                        <div class="product-actions position-absolute bottom-0 start-0 end-0 p-3 d-flex gap-2 justify-content-center" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                            <button class="btn btn-sm btn-light rounded-circle btn-add-cart" 
                                    data-product-id="{{ $loop->index }}"
                                    data-product-name="{{ $product['name'] }}"
                                    data-product-price="{{ $product['price'] }}"
                                    title="Add to Cart">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle" title="Add to Wishlist">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle" title="Quick View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-3">
                        <span class="badge bg-light text-success small mb-2">{{ $product['category'] }}</span>
                        <h6 class="fw-bold mb-2">{{ $product['name'] }}</h6>
                        <div class="d-flex align-items-center mb-2">
                            <div class="text-warning me-2">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < floor($product['rating']))
                                        <i class="fas fa-star"></i>
                                    @elseif($i < $product['rating'])
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <small class="text-muted">({{ $product['reviews'] }})</small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-bold text-success fs-5">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                @if($product['original_price'] > $product['price'])
                                <br><small class="text-muted text-decoration-line-through">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</small>
                                @endif
                            </div>
                            <button class="btn btn-success btn-sm rounded-pill px-3 btn-add-cart-quick"
                                    data-product-id="{{ $loop->index }}"
                                    data-product-name="{{ $product['name'] }}"
                                    data-product-price="{{ $product['price'] }}">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Best Selling Products Section --}}
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Best Selling Products</h2>
            <a href="#" class="btn btn-primary">View All</a>
        </div>

        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300' }}" 
                         class="card-img-top" alt="{{ $product->name }}"
                         style="height: 250px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted small">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        
                        {{-- Price --}}
                        <div class="d-flex align-items-center mb-2">
                            @if($product->discount_price)
                                <span class="text-decoration-line-through text-muted me-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                <span class="text-danger fw-bold">
                                    Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="fw-bold text-success">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>

                        {{-- Rating --}}
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <small class="text-muted">({{ $product->reviews_count ?? 0 }})</small>
                        </div>

                        {{-- Add to Cart Button --}}
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-white mb-4 mb-lg-0">
                <h3 class="fw-bold mb-3">Subscribe to Our Newsletter</h3>
                <p class="mb-0">Get the latest updates on new products and upcoming sales</p>
            </div>
            <div class="col-lg-6">
                <div class="input-group input-group-lg shadow">
                    <input type="email" class="form-control" placeholder="Enter your email address">
                    <button class="btn btn-dark px-4" type="button">
                        <i class="fas fa-paper-plane me-2"></i>Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transform: translateY(-5px);
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.product-actions {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-actions {
    opacity: 1;
}

.category-card {
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.category-card:hover {
    border-color: #28a745;
    background-color: #f8f9fa !important;
}

.transition {
    transition: all 0.3s ease;
}
</style>

<!-- Cart Management Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Attach event listeners ke semua tombol "Add to Cart"
    const addCartButtons = document.querySelectorAll('.btn-add-cart, .btn-add-cart-quick');
    
    addCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = parseFloat(this.getAttribute('data-product-price'));
            
            addToCart(productId, productName, productPrice, 1);
        });
    });
});

function addToCart(productId, productName, productPrice, quantity = 1) {
    // Get cart from localStorage
    let cart = JSON.parse(localStorage.getItem('manfaatin_cart') || '[]');

    // Check if product already in cart
    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: quantity
        });
    }

    // Save to localStorage
    localStorage.setItem('manfaatin_cart', JSON.stringify(cart));
    
    // Show notification
    showNotification(`${productName} ditambahkan ke keranjang!`);
    
    // Update cart badge if exists
    updateCartBadge(cart.length);
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'alert alert-success alert-dismissible fade show position-fixed';
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(notification);

    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

function updateCartBadge(count) {
    const cartBadge = document.querySelector('[data-cart-badge]');
    if (cartBadge) {
        cartBadge.textContent = count;
        cartBadge.style.display = 'inline-block';
    }
}

// Load cart count on page load
window.addEventListener('load', function() {
    const cart = JSON.parse(localStorage.getItem('manfaatin_cart') || '[]');
    if (cart.length > 0) {
        updateCartBadge(cart.length);
    }
});
</script>

@endsection