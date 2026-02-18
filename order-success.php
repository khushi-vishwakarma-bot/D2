<?php
session_start();
require_once('db.php');

// 1. Get the Order ID from the URL
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    header("Location: index.php");
    exit();
}

$order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

// 2. Fetch order details from the database
$sql = "SELECT * FROM orders WHERE id = '$order_id' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $order = mysqli_fetch_assoc($result);
} else {
    echo "Order not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success | DesiDelight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .success-card {
            max-width: 600px;
            margin: 50px auto;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .check-icon {
            font-size: 50px;
            color: #198754;
            background: #d1e7dd;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px;
        }
        .receipt-label { color: #6c757d; font-size: 0.9rem; }
        .receipt-value { font-weight: 600; color: #212529; }
        @media print {
            .btn-print { display: none; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card success-card p-4 p-md-5">
        <div class="text-center">
            <div class="check-icon">✓</div>
            <h2 class="fw-bold text-success">Order Placed!</h2>
            <p class="text-muted">Thank you for choosing DesiDelight. Your homemade meal is on its way!</p>
        </div>

        <hr class="my-4">

        <div class="row g-3">
            <div class="col-6">
                <p class="receipt-label mb-0">Order ID</p>
                <p class="receipt-value">#DD-<?php echo $order['id']; ?></p>
            </div>
            <div class="col-6 text-end">
                <p class="receipt-label mb-0">Date</p>
                <p class="receipt-value"><?php echo date("d M Y", strtotime($order['order_date'])); ?></p>
            </div>

            <div class="col-12">
                <p class="receipt-label mb-1">Items Ordered</p>
                <p class="receipt-value p-2 bg-light rounded" style="font-size: 0.95rem;">
                    <?php echo $order['items']; ?>
                </p>
            </div>

            <div class="col-6">
                <p class="receipt-label mb-0">Customer Name</p>
                <p class="receipt-value"><?php echo htmlspecialchars($order['customer_name']); ?></p>
            </div>
            <div class="col-6 text-end">
                <p class="receipt-label mb-0">Total Amount</p>
                <p class="receipt-value text-success h5">₹<?php echo number_format($order['total_amount'], 2); ?></p>
            </div>

            <div class="col-12">
                <p class="receipt-label mb-0">Delivery Address</p>
                <p class="receipt-value small"><?php echo nl2br(htmlspecialchars($order['address'])); ?></p>
            </div>
            
            <div class="col-12">
                <p class="receipt-label mb-0">Contact Phone</p>
                <p class="receipt-value"><?php echo htmlspecialchars($order['phone']); ?></p>
            </div>
        </div>

        <div class="mt-4 pt-3 border-top text-center">
            <p class="text-muted small">Payment Mode: <strong>Cash on Delivery</strong></p>
            <div class="d-grid gap-2 d-md-block">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-print px-4">Print Receipt</button>
                <a href="products.php" class="btn btn-success px-4">Order More</a>
            </div>
        </div>
    </div>
    
    <div class="text-center mb-5">
        <a href="index.php" class="text-decoration-none text-muted">← Back to Homepage</a>
    </div>
</div>

</body>
</html>