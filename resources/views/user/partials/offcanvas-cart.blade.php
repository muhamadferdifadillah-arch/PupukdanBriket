<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
                <span class="badge bg-primary rounded-pill" id="cartCount">{{ $cartCount ?? 0 }}</span>
            </h4>
            
            <ul class="list-group mb-3" id="cartItems">
                @forelse($cartItems ?? [] as $item)
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">{{ $item->product->name ?? 'Product not found' }}</h6>
                        <small class="text-body-secondary">Qty: {{ $item->quantity ?? 0 }}</small>
                    </div>
                    <span class="text-body-secondary">
                        ${{ number_format(($item->price ?? 0) * ($item->quantity ?? 0), 2) }}
                    </span>
                </li>
                @empty
                <li class="list-group-item text-center">
                    <p class="mb-0">Your cart is empty</p>
                    <small class="text-muted">Add items to get started</small>
                </li>
                @endforelse
                
                @if(isset($cartItems) && count($cartItems) > 0)
                <li class="list-group-item d-flex justify-content-between">
                    <span><strong>Total (USD)</strong></span>
                    <strong id="cartTotal">${{ number_format($cartTotal ?? 0, 2) }}</strong>
                </li>
                @endif
            </ul>
  
            @if(isset($cartItems) && count($cartItems) > 0)
            <a href="{{ route('user.checkout') }}" class="w-100 btn btn-primary btn-lg">Continue to checkout</a>
            <a href="{{ route('user.cart') }}" class="w-100 btn btn-outline-primary mt-2">View Cart</a>
            @else
            <a href="{{ route('home') }}" class="w-100 btn btn-primary btn-lg">Start Shopping</a>
            @endif
        </div>
    </div>
</div>