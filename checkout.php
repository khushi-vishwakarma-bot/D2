<?php
session_start();
require_once('db.php'); // Uses require_once to ensure DB connection is mandatory

// 1. Protection: Redirect if cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: products.php");
    exit();
}

// 2. Calculate Total
$total_bill = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_bill += ($item['price'] * $item['quantity']);
}

// 3. Handle Order Processing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    
    // Sanitize Inputs
    $name    = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $phone   = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $address = htmlspecialchars(strip_tags(trim($_POST['address'])));
    $user_email = $_SESSION['user'] ?? 'Guest';

    // Format items list: "Pizza (x2), Burger (x1)"
    $items_detail = [];
    foreach ($_SESSION['cart'] as $item) {
        $items_detail[] = $item['name'] . " (x" . $item['quantity'] . ")";
    }
    $final_summary = implode(", ", $items_detail);

    // 4. Secure Database Insertion (Prepared Statement)
    $query = "INSERT INTO orders (user_email, customer_name, address, phone, total_amount, items) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // "ssssds" = string, string, string, string, double, string
        mysqli_stmt_bind_param($stmt, "ssssds", $user_email, $name, $address, $phone, $total_bill, $final_summary);
        
        if (mysqli_stmt_execute($stmt)) {
            $new_order_id = mysqli_insert_id($conn);
            
            // Success: Clear cart and redirect to success page
            unset($_SESSION['cart']);
            header("Location: order-success.php?order_id=" . $new_order_id);
            exit();
        } else {
            $error = "Database Error: Could not save your order.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $error = "Server Error: Could not prepare the request.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout | DesiDelight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --desi-green: #198754; }
        body { background-color: #f4f7f6; }
        .checkout-container { max-width: 1000px; margin-top: 50px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.05); }
        .payment-method { border: 2px solid var(--desi-green); background: #f0fff4; padding: 15px; border-radius: 10px; }
    </style>
</head>
<body>

<div class="container checkout-container mb-5">
    <div class="row g-4">
        
        <div class="col-md-7">
            <h4 class="fw-bold mb-4">Complete Your Order</h4>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="card p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Recipient Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Mobile Number</label>
                        <input type="tel" name="phone" class="form-control" placeholder="10-digit number" pattern="[0-9]{10}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium">Delivery Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Flat No, Building, Area, City" required></textarea>
                    </div>

                    <h5 class="fw-bold mb-3">Payment Method</h5>
                    <div class="payment-method mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" checked>
                            <label class="form-check-label fw-bold text-success">
                                Cash on Delivery (COD)
                            </label>
                            <div class="text-muted small">Pay with cash when your food is delivered to your door.</div>
                        </div>
                    </div>

                    <button type="submit" name="place_order" class="btn btn-success btn-lg w-100 py-3 fw-bold">
                        Place Order • ₹<?php echo number_format($total_bill, 2); ?>
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">Order Summary</h5>
                <div class="cart-preview overflow-auto" style="max-height: 300px;">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="d-block fw-bold"><?php echo $item['name']; ?></span>
                            <small class="text-muted">Quantity: <?php echo $item['quantity']; ?></small>
                        </div>
                        <span class="fw-medium">₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span>₹<?php echo number_format($total_bill, 2); ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-muted">Delivery Fee</span>
                    <span class="text-success fw-bold">FREE</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                    <span class="h5 fw-bold">Total Amount</span>
                    <span class="h4 fw-bold text-success">₹<?php echo number_format($total_bill, 2); ?></span>
                </div>
            </div>
            
            <div class="mt-3 text-center">
                <a href="cart.php" class="text-decoration-none text-muted small">← Return to Shopping Cart</a>
            </div>
        </div>

    </div>
</div>

</body>
</html>