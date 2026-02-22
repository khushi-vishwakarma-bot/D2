<?php
session_start();

// Create cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Product list with real image URLs (Unsplash)
$products = [
    1 => [
        "name" => "Laptop",
        "price" => 55000,
        "image" => "https://images.unsplash.com/photo-1517336714731-489689fd1ca8"
    ],
    2 => [
        "name" => "Smartphone",
        "price" => 25000,
        "image" => "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9"
    ],
    3 => [
        "name" => "Headphones",
        "price" => 3000,
        "image" => "https://images.unsplash.com/photo-1505740420928-5e560c06d30e"
    ]
];

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modern E-Commerce</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            padding: 30px;
        }

        .product {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 250px;
            padding: 15px;
            text-align: center;
            transition: 0.3s;
        }

        .product:hover {
            transform: translateY(-5px);
        }

        .product img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }

        .price {
            font-size: 18px;
            color: #27ae60;
            margin: 10px 0;
        }

        button {
            background: #27ae60;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #219150;
        }

        .cart {
            background: white;
            margin: 30px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .cart h2 {
            margin-top: 0;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<header>
    My Online Store
</header>

<h2 style="text-align:center; margin-top:20px;">Products</h2>

<div class="container">
    <?php foreach ($products as $id => $product) { ?>
        <div class="product">
            <img src="<?php echo $product['image']; ?>?auto=format&fit=crop&w=400&q=80">
            <h3><?php echo $product['name']; ?></h3>
            <div class="price">₹<?php echo $product['price']; ?></div>

            <form method="POST">
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
    <?php } ?>
</div>

<div class="cart">
    <h2>Shopping Cart</h2>

    <?php
    if (!empty($_SESSION['cart'])) {
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $quantity) {
            $product = $products[$id];
            $subtotal = $product['price'] * $quantity;
            $total += $subtotal;

            echo "<p>{$product['name']} (Qty: $quantity) - ₹$subtotal</p>";
        }
        echo "<div class='total'>Total: ₹$total</div>";
    } else {
        echo "<p>Cart is empty.</p>";
    }
    ?>
</div>

</body>
</html>