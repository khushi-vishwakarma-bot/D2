<?php
session_start();
include('db.php');

// --- LOGIC HANDLING ---

// 1. Remove Item
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header("Location: cart.php");
    exit();
}

// 2. Clear Entire Cart
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}

// 3. Update Quantity (Plus/Minus)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Check if item exists and is actually an array before updating
    if (isset($_SESSION['cart'][$id]) && is_array($_SESSION['cart'][$id])) {
        if ($_GET['action'] == 'add') {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } elseif ($_GET['action'] == 'reduce') {
            if ($_SESSION['cart'][$id]['quantity'] > 1) {
                $_SESSION['cart'][$id]['quantity'] -= 1;
            } else {
                unset($_SESSION['cart'][$id]); 
            }
        }
    }
    header("Location: cart.php");
    exit();
}

$total_bill = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | DesiDelight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-name { font-weight: 600; color: #333; }
        .qty-btn { width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none; }
        .card { border-radius: 15px; border: none; }
        .table thead { background-color: #f8f9fa; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand text-success fw-bold" href="index.php">DesiDelight</a>
        <a href="products.php" class="btn btn-outline-light btn-sm">← Back to Menu</a>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="fw-bold mb-4">Your Food Basket 🛒</h2>

            <?php if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])): ?>
                <div class="card shadow-sm overflow-hidden">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Item</th>
                                    <th>Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th>Subtotal</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $id => $item): 
                                    // Validation check: if someone accidentally added bad data to session
                                    if (!is_array($item) || !isset($item['price'])) continue;

                                    $price = (float)$item['price'];
                                    $qty = (int)$item['quantity'];
                                    $subtotal = $price * $qty;
                                    $total_bill += $subtotal;
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="product-name"><?php echo htmlspecialchars($item['name'] ?? 'Unknown Item'); ?></span>
                                    </td>
                                    <td>₹<?php echo number_format($price, 2); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="cart.php?action=reduce&id=<?php echo $id; ?>" class="btn btn-outline-secondary qty-btn">-</a>
                                            <span class="mx-3 fw-bold"><?php echo $qty; ?></span>
                                            <a href="cart.php?action=add&id=<?php echo $id; ?>" class="btn btn-outline-secondary qty-btn">+</a>
                                        </div>
                                    </td>
                                    <td class="fw-bold">₹<?php echo number_format($subtotal, 2); ?></td>
                                    <td class="text-end pe-4">
                                        <a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-sm btn-link text-danger text-decoration-none">Remove</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer bg-white p-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <a href="cart.php?clear=1" class="text-muted small" onclick="return confirm('Clear everything?')">Empty Cart</a>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <h5 class="text-muted mb-1">Grand Total:</h5>
                                <h3 class="text-success fw-bold mb-3">₹<?php echo number_format($total_bill, 2); ?></h3>
                                <a href="checkout.php" class="btn btn-success btn-lg px-5 shadow-sm fw-bold">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="mb-4"><span style="font-size: 4rem;">🥣</span></div>
                    <h3 class="fw-bold">Your cart is empty</h3>
                    <p class="text-muted mb-4">You haven't added any items to your cart yet.</p>
                    <a href="products.php" class="btn btn-success btn-lg px-5">Browse Homemade Food</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="text-center text-muted mt-5 py-4">
    <small>&copy; <?php echo date("Y"); ?> DesiDelight - Homemade with Love</small>
</footer>

</body>
</html>