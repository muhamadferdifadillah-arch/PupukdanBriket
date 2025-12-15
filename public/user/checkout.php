<?php
session_start();
require_once 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data user
$user_query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Ambil data keranjang
$cart_query = "SELECT c.*, p.name, p.image 
               FROM cart c 
               JOIN products p ON c.product_id = p.id 
               WHERE c.user_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if (empty($cart_items)) {
    header('Location: cart.php');
    exit();
}

$total = 0;
foreach ($cart_items as $item) {
    $total += $item['subtotal'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ManfaatinOnline</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .checkout-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        .checkout-form {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .order-summary {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            height: fit-content;
        }
        
        .summary-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f4b641;
        }
        
        .summary-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .summary-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .summary-item-details {
            flex: 1;
        }
        
        .summary-item-name {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .summary-item-qty {
            color: #666;
            font-size: 14px;
        }
        
        .summary-item-price {
            font-weight: 600;
            color: #f4b641;
        }
        
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: 700;
            padding-top: 20px;
            margin-top: 20px;
            border-top: 2px solid #f4b641;
        }
        
        .place-order-btn {
            width: 100%;
            background: #28a745;
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }
        
        .place-order-btn:hover {
            background: #218838;
        }
        
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        
        .payment-method {
            border: 2px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s;
        }
        
        .payment-method:hover,
        .payment-method.active {
            border-color: #f4b641;
            background: #fffbf0;
        }
        
        .payment-method input[type="radio"] {
            display: none;
        }
        
        @media (max-width: 768px) {
            .checkout-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="checkout-container">
        <div class="checkout-form">
            <h2>📋 Informasi Pengiriman</h2>
            <form id="checkoutForm" method="POST" action="process_checkout.php">
                <div class="form-group">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="customer_name" value="<?= $user['name'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="customer_email" value="<?= $user['email'] ?>">
                </div>
                
                <div class="form-group">
                    <label>Nomor Telepon *</label>
                    <input type="tel" name="customer_phone" value="<?= $user['phone'] ?? '' ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Alamat Lengkap *</label>
                    <textarea name="shipping_address" required placeholder="Masukkan alamat lengkap untuk pengiriman"></textarea>
                </div>
                
                <h3 style="margin-top: 30px;">💳 Metode Pembayaran</h3>
                <div class="payment-methods">
                    <label class="payment-method active">
                        <input type="radio" name="payment_method" value="COD" checked>
                        <div>💵 COD</div>
                    </label>
                    <label class="payment-method">
                        <input type="radio" name="payment_method" value="Transfer">
                        <div>🏦 Transfer</div>
                    </label>
                    <label class="payment-method">
                        <input type="radio" name="payment_method" value="e-wallet">
                        <div>📱 E-Wallet</div>
                    </label>
                </div>
                
                <button type="submit" class="place-order-btn">
                    ✅ Buat Pesanan
                </button>
            </form>
        </div>
        
        <div class="order-summary">
            <div class="summary-title">📦 Ringkasan Pesanan</div>
            
            <?php foreach ($cart_items as $item): ?>
                <div class="summary-item">
                    <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                    <div class="summary-item-details">
                        <div class="summary-item-name"><?= $item['name'] ?></div>
                        <div class="summary-item-qty">Qty: <?= $item['quantity'] ?></div>
                        <div class="summary-item-price">
                            Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="summary-total">
                <span>Total Pembayaran</span>
                <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script>
        // Payment method selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
                this.classList.add('active');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });
    </script>
</body>
</html>