// Cart data object
const cartData = {};

// Initialize cart data from DOM
function initializeCart() {
  document.querySelectorAll('.cart-item').forEach(item => {
    const id = item.getAttribute('data-id');
    const price = parseFloat(item.getAttribute('data-price'));
    const quantity = parseInt(document.getElementById('qty-' + id).value);
    
    cartData[id] = {
      price: price,
      quantity: quantity,
      element: item
    };
  });
  
  updateCartTotals();
}

// Update cart totals
function updateCartTotals() {
  let subtotal = 0;
  let totalItems = 0;

  for (let id in cartData) {
    subtotal += cartData[id].price * cartData[id].quantity;
    totalItems += cartData[id].quantity;
  }

  const shipping = subtotal > 0 ? 5 : 0;
  const tax = subtotal * 0.1;
  const total = subtotal + shipping + tax;

  document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
  document.getElementById('shipping').textContent = '$' + shipping.toFixed(2);
  document.getElementById('tax').textContent = '$' + tax.toFixed(2);
  document.getElementById('total').textContent = '$' + total.toFixed(2);
  document.getElementById('total-items').textContent = totalItems;
  
  const cartBadge = document.getElementById('cart-badge');
  if (cartBadge) {
    cartBadge.textContent = totalItems;
    if (totalItems === 0) {
      cartBadge.style.display = 'none';
    } else {
      cartBadge.style.display = 'inline-block';
    }
  }
}

// Increase quantity
function increaseQuantity(id) {
  if (cartData[id]) {
    cartData[id].quantity++;
    document.getElementById('qty-' + id).value = cartData[id].quantity;
    updateCartTotals();
    
    // TODO: Update cart in session/database via AJAX
    // updateCartInDatabase(id, cartData[id].quantity);
  }
}

// Decrease quantity
function decreaseQuantity(id) {
  if (cartData[id] && cartData[id].quantity > 1) {
    cartData[id].quantity--;
    document.getElementById('qty-' + id).value = cartData[id].quantity;
    updateCartTotals();
    
    // TODO: Update cart in session/database via AJAX
    // updateCartInDatabase(id, cartData[id].quantity);
  }
}

// Remove item
function removeItem(id) {
  if (confirm('Are you sure you want to remove this item?')) {
    const item = cartData[id].element;
    
    // Fade out animation
    item.style.transition = 'opacity 0.3s, transform 0.3s';
    item.style.opacity = '0';
    item.style.transform = 'translateX(-20px)';
    
    setTimeout(() => {
      item.remove();
      delete cartData[id];
      updateCartTotals();
      
      // Check if cart is empty
      if (Object.keys(cartData).length === 0) {
        showEmptyCart();
      }
      
      // TODO: Remove from cart in session/database via AJAX
      // removeCartItemFromDatabase(id);
    }, 300);
  }
}

// Show empty cart
function showEmptyCart() {
  document.getElementById('cart-items').innerHTML = `
    <div class="empty-cart">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="9" cy="21" r="1"></circle>
        <circle cx="20" cy="21" r="1"></circle>
        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
      </svg>
      <h3 class="mb-3">Your cart is empty</h3>
      <p class="text-muted mb-4">Add some products to get started!</p>
      <a href="/" class="btn btn-primary btn-lg">Browse Products</a>
    </div>
  `;
}

// Checkout
function checkout() {
  if (Object.keys(cartData).length === 0) {
    alert('Your cart is empty!');
    return;
  }
  
  const total = document.getElementById('total').textContent;
  alert('Proceeding to checkout...\n\nTotal: ' + total);
  
  // TODO: Redirect to checkout page
  // window.location.href = '/checkout';
}

// AJAX helper functions (untuk integrasi dengan backend)
function updateCartInDatabase(productId, quantity) {
  fetch('/cart/update', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
      product_id: productId,
      quantity: quantity
    })
  })
  .then(response => response.json())
  .then(data => {
    console.log('Cart updated:', data);
  })
  .catch(error => {
    console.error('Error updating cart:', error);
  });
}

function removeCartItemFromDatabase(productId) {
  fetch('/cart/remove', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
      product_id: productId
    })
  })
  .then(response => response.json())
  .then(data => {
    console.log('Item removed:', data);
  })
  .catch(error => {
    console.error('Error removing item:', error);
  });
}

// Initialize cart when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  initializeCart();
});