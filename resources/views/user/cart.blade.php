@extends('layouts.user.dashboard')

@section('title', 'Shopping Cart - ManfaatinOnline.com')

@push('styles')
<style>
  :root{
    --primary: #16a34a;
    --primary-dark: #15803d;
    --secondary: #fbbf24;
    --danger: #ef4444;
    --text-dark: #1f2937;
    --text-muted: #6b7280;
    --border: #e5e7eb;
    --bg-light: #f9fafb;
  }

  body { background: #f3f4f6; }

  /* Breadcrumb Navigation */
  .cart-breadcrumb {
    background: white;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border);
    margin-bottom: 2rem;
  }
  
  .breadcrumb-container {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-muted);
  }
  
  .breadcrumb-container a {
    color: var(--text-muted);
    text-decoration: none;
    transition: color 0.2s;
  }
  
  .breadcrumb-container a:hover {
    color: var(--primary);
  }
  
  .breadcrumb-container .active {
    color: var(--text-dark);
    font-weight: 500;
  }

  /* Page Title */
  .cart-header {
    margin-bottom: 2rem;
  }
  
  .cart-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
  }
  
  .cart-subtitle {
    color: var(--text-muted);
    font-size: 0.9375rem;
  }

  /* Cart Container */
  .cart-container {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 1.5rem;
    margin-bottom: 3rem;
  }

  /* Cart Items Section */
  .cart-items-section {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  }

  .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid var(--bg-light);
  }

  .section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0;
  }

  .items-count {
    font-size: 0.875rem;
    color: var(--text-muted);
    background: var(--bg-light);
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
  }

  /* Cart Item Card */
  .cart-item-card {
    display: grid;
    grid-template-columns: 100px 1fr auto;
    gap: 1.25rem;
    padding: 1.25rem;
    border: 1px solid var(--border);
    border-radius: 12px;
    margin-bottom: 1rem;
    transition: all 0.2s ease;
    background: white;
  }

  .cart-item-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.08);
  }

  .item-image {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: 10px;
    overflow: hidden;
    background: var(--bg-light);
  }

  .item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .stock-badge {
    position: absolute;
    bottom: 6px;
    left: 6px;
    background: var(--primary);
    color: white;
    font-size: 0.625rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .item-details {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .item-name {
    font-size: 1.0625rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.375rem;
    line-height: 1.4;
  }

  .item-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 0.75rem;
  }

  .meta-item {
    font-size: 0.8125rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 0.25rem;
  }

  .meta-dot {
    width: 3px;
    height: 3px;
    background: var(--text-muted);
    border-radius: 50%;
  }

  .item-price {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--primary);
  }

  .item-actions {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-end;
  }

  /* Quantity Controls */
  .qty-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .qty-controls {
    display: flex;
    align-items: center;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    overflow: hidden;
    background: white;
  }

  .qty-btn {
    width: 32px;
    height: 32px;
    border: none;
    background: transparent;
    color: var(--text-dark);
    font-size: 1.125rem;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .qty-btn:hover {
    background: var(--bg-light);
    color: var(--primary);
  }

  .qty-btn:active {
    transform: scale(0.95);
  }

  .qty-input {
    width: 40px;
    height: 32px;
    border: none;
    text-align: center;
    font-weight: 600;
    font-size: 0.9375rem;
    color: var(--text-dark);
  }

  .qty-input:focus {
    outline: none;
  }

  .remove-btn {
    background: transparent;
    border: none;
    color: var(--text-muted);
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 6px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .remove-btn:hover {
    background: #fef2f2;
    color: var(--danger);
  }

  /* Summary Sidebar */
  .cart-summary {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    position: sticky;
    top: 20px;
    height: fit-content;
  }

  .summary-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    padding: 0.875rem 0;
    font-size: 0.9375rem;
  }

  .summary-row:not(:last-child) {
    border-bottom: 1px solid var(--bg-light);
  }

  .summary-label {
    color: var(--text-muted);
  }

  .summary-value {
    color: var(--text-dark);
    font-weight: 500;
  }

  .summary-total {
    padding: 1.25rem 0;
    margin-top: 0.5rem;
    border-top: 2px solid var(--bg-light);
  }

  .summary-total .summary-label {
    font-size: 1.0625rem;
    font-weight: 600;
    color: var(--text-dark);
  }

  .summary-total .summary-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
  }

  /* Checkout Button */
  .checkout-btn {
    width: 100%;
    background: var(--primary);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.2s;
    margin-top: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
  }

  .checkout-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25);
  }

  .checkout-btn:active {
    transform: translateY(0);
  }

  /* Promo Code */
  .promo-section {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--bg-light);
  }

  .promo-title {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
  }

  .promo-input-group {
    display: flex;
    gap: 0.5rem;
  }

  .promo-input {
    flex: 1;
    padding: 0.625rem 0.875rem;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s;
  }

  .promo-input:focus {
    outline: none;
    border-color: var(--primary);
  }

  .promo-btn {
    padding: 0.625rem 1.25rem;
    background: var(--bg-light);
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--text-dark);
    cursor: pointer;
    transition: all 0.2s;
  }

  .promo-btn:hover {
    background: var(--primary);
    color: white;
  }

  /* Payment Methods */
  .payment-methods {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--bg-light);
    text-align: center;
  }

  .payment-title {
    font-size: 0.8125rem;
    color: var(--text-muted);
    margin-bottom: 0.75rem;
  }

  .payment-icons {
    display: flex;
    justify-content: center;
    gap: 0.75rem;
    align-items: center;
  }

  .payment-icon {
    height: 20px;
    opacity: 0.6;
    transition: opacity 0.2s;
  }

  .payment-icon:hover {
    opacity: 1;
  }

  /* Empty Cart */
  .empty-cart {
    background: white;
    border-radius: 16px;
    padding: 4rem 2rem;
    text-align: center;
  }

  .empty-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 1.5rem;
    color: #d1d5db;
  }

  .empty-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
  }

  .empty-text {
    color: var(--text-muted);
    margin-bottom: 2rem;
  }

  .shop-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.75rem;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
  }

  .shop-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25);
  }

  /* Continue Shopping Link */
  .continue-shopping {
    margin-top: 1.5rem;
  }

  .continue-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-muted);
    text-decoration: none;
    font-size: 0.9375rem;
    transition: all 0.2s;
  }

  .continue-link:hover {
    color: var(--primary);
    gap: 0.75rem;
  }

  /* Responsive */
  @media (max-width: 991px) {
    .cart-container {
      grid-template-columns: 1fr;
    }

    .cart-summary {
      position: static;
    }

    .cart-item-card {
      grid-template-columns: 80px 1fr;
      gap: 1rem;
    }

    .item-actions {
      grid-column: 2;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
    }

    .qty-wrapper {
      order: 2;
    }
  }

  @media (max-width: 576px) {
    .cart-title {
      font-size: 1.5rem;
    }

    .item-image {
      width: 70px;
      height: 70px;
    }

    .cart-item-card {
      grid-template-columns: 70px 1fr;
      padding: 1rem;
    }

    .item-name {
      font-size: 0.9375rem;
    }

    .item-price {
      font-size: 1rem;
    }
  }

  /* Animations */
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .cart-item-card {
    animation: fadeIn 0.3s ease;
  }
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="cart-breadcrumb">
  <div class="container">
    <div class="breadcrumb-container">
      <a href="{{ route('home') }}">Home</a>
      <span>›</span>
      <span class="active">Shopping Cart</span>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="container">
  
  <!-- Page Header -->
  <div class="cart-header">
    <h1 class="cart-title">Shopping Cart</h1>
    <p class="cart-subtitle">Review your items before checkout</p>
  </div>

  @if($cartItems->count() > 0)
  <div class="cart-container">
    
    <!-- Cart Items -->
    <div class="cart-items-section">
      <div class="section-header">
        <h2 class="section-title">Your Items</h2>
        <span class="items-count">{{ $cartItems->count() }} Product{{ $cartItems->count() > 1 ? 's' : '' }}</span>
      </div>

      <div id="cart-items-list">
        @foreach($cartItems as $item)
        <div class="cart-item-card" data-id="{{ $item->id }}" data-price="{{ $item->price }}">
          
          <!-- Image -->
          <div class="item-image">
            <img src="{{ asset($item->image ?? 'user/images/product-thumb-1.png') }}" alt="{{ $item->name }}">
            <span class="stock-badge">In Stock</span>
          </div>

          <!-- Details -->
          <div class="item-details">
            <div>
              <h3 class="item-name">{{ $item->name }}</h3>
              <div class="item-meta">
                <span class="meta-item">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                  </svg>
                  {{ $item->category ?? 'Organic Fertilizer' }}
                </span>
              </div>
            </div>
            <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
          </div>

          <!-- Actions -->
          <div class="item-actions">
            <button class="remove-btn" onclick="removeItem({{ $item->id }})" title="Remove">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
              </svg>
            </button>

            <div class="qty-wrapper">
              <div class="qty-controls">
                <button class="qty-btn" onclick="decreaseQuantity({{ $item->id }})">−</button>
                <input type="text" class="qty-input" id="qty-{{ $item->id }}" value="{{ $item->quantity }}" readonly>
                <button class="qty-btn" onclick="increaseQuantity({{ $item->id }})">+</button>
              </div>
            </div>
          </div>

        </div>
        @endforeach
      </div>

      <!-- Continue Shopping -->
      <div class="continue-shopping">
        <a href="{{ route('home') }}" class="continue-link">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
          Continue Shopping
        </a>
      </div>
    </div>

    <!-- Summary Sidebar -->
    @php
        $itemsCount = $cartItems->sum('quantity');
        $subtotal   = $cartItems->sum('subtotal');
        $shipping   = 0;
        $tax        = $subtotal * 0.10;
        $grandTotal = $subtotal + $shipping + $tax;
    @endphp

    <aside class="cart-summary">
      <h3 class="summary-title">Order Summary</h3>

      <div class="summary-row">
        <span class="summary-label">Subtotal (<span id="total-items">{{ $itemsCount }}</span> items)</span>
        <span class="summary-value" id="subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
      </div>

      <div class="summary-row">
        <span class="summary-label">Shipping</span>
        <span class="summary-value" id="shipping">{{ $shipping === 0 ? 'FREE' : 'Rp ' . number_format($shipping, 0, ',', '.') }}</span>
      </div>

      <div class="summary-row">
        <span class="summary-label">Tax (10%)</span>
        <span class="summary-value" id="tax">Rp {{ number_format($tax, 0, ',', '.') }}</span>
      </div>

      <div class="summary-row summary-total">
        <span class="summary-label">Total</span>
        <span class="summary-value" id="total">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
      </div>

      <button class="checkout-btn" onclick="checkout()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
          <line x1="1" y1="10" x2="23" y2="10"></line>
        </svg>
        Proceed to Checkout
      </button>

      <!-- Promo Code -->
      <div class="promo-section">
        <div class="promo-title">Have a promo code?</div>
        <div class="promo-input-group">
          <input type="text" class="promo-input" placeholder="Enter code">
          <button class="promo-btn">Apply</button>
        </div>
      </div>

      <!-- Payment Methods -->
      <div class="payment-methods">
        <div class="payment-title">We accept</div>
        <div class="payment-icons">
          <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="payment-icon">
          <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="payment-icon">
          <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="payment-icon">
        </div>
      </div>
    </aside>

  </div>
  @else
  <!-- Empty Cart -->
  <div class="empty-cart">
    <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <circle cx="9" cy="21" r="1"></circle>
      <circle cx="20" cy="21" r="1"></circle>
      <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
    </svg>
    <h2 class="empty-title">Your cart is empty</h2>
    <p class="empty-text">Looks like you haven't added anything yet</p>
    <a href="{{ route('home') }}" class="shop-btn">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="9" cy="21" r="1"></circle>
        <circle cx="20" cy="21" r="1"></circle>
        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
      </svg>
      Start Shopping
    </a>
  </div>
  @endif

</div>
@endsection

@push('scripts')
<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

function increaseQuantity(id) {
  const qtyInput = document.getElementById('qty-' + id);
  const currentQty = parseInt(qtyInput.value) || 0;
  updateCartQuantity(id, currentQty + 1);
}

function decreaseQuantity(id) {
  const qtyInput = document.getElementById('qty-' + id);
  const currentQty = parseInt(qtyInput.value) || 0;
  if (currentQty > 1) updateCartQuantity(id, currentQty - 1);
}

function updateCartQuantity(id, quantity) {
  fetch(`/cart/update/${id}`, {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    },
    body: JSON.stringify({ quantity })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      document.getElementById('qty-' + id).value = quantity;
      document.getElementById('subtotal').textContent = 'Rp ' + data.subtotal;
      document.getElementById('tax').textContent = 'Rp ' + data.tax;
      document.getElementById('total').textContent = 'Rp ' + data.total;
      document.getElementById('total-items').textContent = data.cartCount;

      const cartBadge = document.getElementById('cart-badge');
      if (cartBadge) cartBadge.textContent = data.cartCount;

      showToast('Cart updated successfully', 'success');
    } else {
      showToast(data.message || 'Failed to update cart', 'error');
    }
  })
  .catch(err => {
    console.error(err);
    showToast('Network error occurred', 'error');
  });
}

function removeItem(id) {
  if (!confirm('Remove this item from cart?')) return;

  const cartItem = document.querySelector(`[data-id="${id}"]`);
  if (cartItem) {
    cartItem.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
    cartItem.style.opacity = '0';
    cartItem.style.transform = 'translateX(-20px)';
  }

  fetch(`/cart/remove/${id}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      setTimeout(() => {
        if (cartItem) cartItem.remove();
      }, 300);

      if (data.isEmpty) {
        setTimeout(() => location.reload(), 400);
        return;
      }

      document.getElementById('subtotal').textContent = 'Rp ' + data.subtotal;
      document.getElementById('shipping').textContent = data.shipping === '0' ? 'FREE' : 'Rp ' + data.shipping;
      document.getElementById('tax').textContent = 'Rp ' + data.tax;
      document.getElementById('total').textContent = 'Rp ' + data.total;
      document.getElementById('total-items').textContent = data.cartCount;

      const cartBadge = document.getElementById('cart-badge');
      if (cartBadge) {
        cartBadge.textContent = data.cartCount;
        if (data.cartCount === 0) cartBadge.style.display = 'none';
      }

      showToast('Item removed from cart', 'success');
    } else {
      showToast(data.message || 'Failed to remove item', 'error');
    }
  })
  .catch(err => {
    console.error(err);
    showToast('Network error occurred', 'error');
  });
}

function checkout() {
  window.location.href = '{{ route("checkout") ?? "/checkout" }}';
}

function showToast(message, type = 'info') {
  console.log(`[${type.toUpperCase()}] ${message}`);
  // Integrate with your toast notification system here
}
</script>
@endpush