<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Belanja - Manfaatin</title>

  <link rel="icon" type="image/png" href="{{ asset('user/images/logom.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

  <style>
    .cart-header {
      background: linear-gradient(135deg, #00a651 0%, #00c86f 100%);
      color: white;
      padding: 40px 0;
      margin-bottom: 40px;
    }

    .cart-header h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin: 0;
    }

    .cart-table {
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .cart-row {
      border-bottom: 1px solid #e8e8e8;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
      transition: background-color 0.2s;
    }

    .cart-row:last-child {
      border-bottom: none;
    }

    .cart-row:hover {
      background-color: #f9f9f9;
    }

    .item-img {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #00a651 0%, #00c86f 100%);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 40px;
      flex-shrink: 0;
    }

    .item-info {
      flex: 1;
    }

    .item-name {
      font-weight: 600;
      font-size: 16px;
      color: #333;
      margin-bottom: 5px;
    }

    .item-price {
      color: #00a651;
      font-weight: 600;
    }

    .qty-wrapper {
      display: flex;
      align-items: center;
      gap: 8px;
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 5px 10px;
    }

    .qty-btn {
      background: none;
      border: none;
      cursor: pointer;
      color: #00a651;
      font-weight: 600;
      font-size: 16px;
      width: 25px;
      height: 25px;
      padding: 0;
    }

    .qty-input {
      width: 40px;
      text-align: center;
      border: none;
      font-weight: 600;
      padding: 0;
    }

    .item-total {
      font-weight: 600;
      color: #333;
      min-width: 100px;
      text-align: right;
    }

    .remove-btn {
      background: none;
      border: none;
      color: #dc3545;
      cursor: pointer;
      font-size: 20px;
      padding: 5px 10px;
      flex-shrink: 0;
    }

    .cart-summary {
      background: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      margin-top: 30px;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
      font-size: 16px;
      color: #666;
    }

    .summary-row.total {
      border-top: 2px solid #e8e8e8;
      padding-top: 15px;
      font-weight: 700;
      font-size: 18px;
      color: #333;
    }

    .btn-checkout {
      width: 100%;
      background: linear-gradient(135deg, #00a651 0%, #00c86f 100%);
      color: white;
      border: none;
      padding: 15px;
      border-radius: 6px;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
      transition: all 0.3s;
    }

    .btn-checkout:hover {
      box-shadow: 0 4px 12px rgba(0, 166, 81, 0.3);
      transform: translateY(-2px);
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      background: white;
      border-radius: 8px;
    }

    @media (max-width: 768px) {
      .cart-row {
        flex-direction: column;
      }

      .item-total,
      .remove-btn {
        width: 100%;
        text-align: right;
      }
    }
  </style>
</head>

<body>

  <!-- Header -->
  <div class="cart-header">
    <div class="container-lg">
      <a href="/" style="display: inline-block; margin-bottom: 20px;">
        <img src="{{ asset('user/images/logom.png') }}" alt="logo" style="width: 80px; height: auto;">
      </a>
      <h1>🛒 Keranjang Belanja</h1>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-lg" style="min-height: 60vh;">
    <div class="row">
      <!-- Cart Items -->
      <div class="col-lg-8">
        <div id="cartContainer" class="cart-table">
          <!-- Items akan dimuat dari localStorage -->
        </div>
      </div>

      <!-- Summary -->
      <div class="col-lg-4">
        <div class="cart-summary" style="position: sticky; top: 20px;">
          <h5 style="font-size: 18px; font-weight: 700; margin-bottom: 20px;">Ringkasan Pesanan</h5>

          <div class="summary-row">
            <span>Subtotal</span>
            <span id="subtotalText">$0</span>
          </div>

          <div class="summary-row">
            <span>Ongkir</span>
            <span>Gratis</span>
          </div>

          <div class="summary-row total">
            <span>Total</span>
            <span id="totalText">$0</span>
          </div>

          <button class="btn-checkout" onclick="goCheckout()">Lanjut ke Pembayaran</button>
          <div style="text-align: center; margin-top: 15px;">
            <a href="/" style="color: #00a651; text-decoration: none; font-weight: 600;">← Lanjut Belanja</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="py-5 bg-dark text-light mt-5">
    <div class="container-lg">
      <p style="margin: 0;">© 2024 Manfaatin. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Fungsi untuk render keranjang
    function renderCart() {
      const cart = JSON.parse(localStorage.getItem('manfaatin_cart') || '[]');
      const container = document.getElementById('cartContainer');

      if (cart.length === 0) {
        container.innerHTML = `
          <div class="empty-state">
            <div style="font-size: 80px; margin-bottom: 20px; opacity: 0.5;">🛒</div>
            <h2 style="font-size: 24px; color: #333; margin-bottom: 10px;">Keranjang Anda Kosong</h2>
            <p style="color: #666; margin-bottom: 20px;">Belum ada produk di keranjang Anda</p>
            <a href="/" style="color: white; text-decoration: none; background: #00a651; padding: 10px 30px; border-radius: 6px; display: inline-block;">← Kembali Belanja</a>
          </div>
        `;
        document.getElementById('subtotalText').textContent = '$0';
        document.getElementById('totalText').textContent = '$0';
        return;
      }

      let html = '';
      let subtotal = 0;

      cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;

        html += `
          <div class="cart-row">
            <div class="item-img">📦</div>
            <div class="item-info">
              <div class="item-name">${item.name || 'Produk'}</div>
              <div class="item-price">$${parseFloat(item.price).toFixed(2)}</div>
            </div>
            <div class="qty-wrapper">
              <button class="qty-btn" onclick="updateQty(${index}, -1)">−</button>
              <input type="number" class="qty-input" value="${item.quantity}" readonly>
              <button class="qty-btn" onclick="updateQty(${index}, 1)">+</button>
            </div>
            <div class="item-total">$${itemTotal.toFixed(2)}</div>
            <button class="remove-btn" onclick="removeFromCart(${index})">✕</button>
          </div>
        `;
      });

      container.innerHTML = html;

      // Update totals
      document.getElementById('subtotalText').textContent = '$' + subtotal.toFixed(2);
      document.getElementById('totalText').textContent = '$' + subtotal.toFixed(2);
    }

    // Update quantity
    function updateQty(index, change) {
      const cart = JSON.parse(localStorage.getItem('manfaatin_cart') || '[]');

      if (cart[index]) {
        cart[index].quantity += change;

        if (cart[index].quantity <= 0) {
          cart.splice(index, 1);
        }

        localStorage.setItem('manfaatin_cart', JSON.stringify(cart));
        renderCart();
      }
    }

    // Remove from cart
    function removeFromCart(index) {
      if (confirm('Hapus item ini dari keranjang?')) {
        const cart = JSON.parse(localStorage.getItem('manfaatin_cart') || '[]');
        cart.splice(index, 1);
        localStorage.setItem('manfaatin_cart', JSON.stringify(cart));
        renderCart();
      }
    }

    // Checkout
    function goCheckout() {
      const cart = JSON.parse(localStorage.getItem('manfaatin_cart') || '[]');
      if (cart.length === 0) {
        alert('Keranjang Anda kosong!');
        return;
      }
      alert('Terima kasih! Lanjut ke halaman pembayaran...');
      // window.location.href = '/checkout';
    }

    // Load cart on page load
    document.addEventListener('DOMContentLoaded', renderCart);
  </script>
</body>

</html>