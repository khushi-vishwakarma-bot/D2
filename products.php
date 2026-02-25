<?php
session_start();
include('db.php');
//filter input
$search = $_GET['search'] ?? '';
$spice  = $_GET['spice'] ?? '';
$custom = isset($_GET['custom']);
$made   = isset($_GET['made']);

// 1. Expanded Product Database (5 new items added per category)
$products = [
    // --- Pickles & Chutneys ---
    ["id" => 1, "name" => "Mango Pickle", "cat" => "Pickles & Chutneys", "price" => 100, "weight" => "500g", "ing" => "Raw Mango, Mustard Oil, Spices", "shelf" => "12 Months", "storage" => "Store in a cool, dry place."],
    ["id" => 2, "name" => "Lemon Pickle", "cat" => "Pickles & Chutneys", "price" => 140, "weight" => "500g", "ing" => "Lemon, Salt, Chili Powder", "shelf" => "12 Months", "storage" => "Use a dry spoon only."],
    ["id" => 3, "name" => "Garlic Pickle", "cat" => "Pickles & Chutneys", "price" => 160, "weight" => "250g", "ing" => "Garlic cloves, Vinegar, Spices", "shelf" => "9 Months", "storage" => "Refrigerate after opening."],
    ["id" => 4, "name" => "Amla Pickle", "cat" => "Pickles & Chutneys", "price" => 150, "weight" => "400g", "ing" => "Indian Gooseberry, Fenugreek, Oil", "shelf" => "12 Months", "storage" => "Keep in a cool dry place."],
    ["id" => 5, "name" => "Green Chilli Pickle", "cat" => "Pickles & Chutneys", "price" => 120, "weight" => "250g", "ing" => "Green Chillies, Mustard, Lemon Juice", "shelf" => "6 Months", "storage" => "Store in airtight jar."],
    ["id" => 6, "name" => "Tomato Chutney", "cat" => "Pickles & Chutneys", "price" => 110, "weight" => "300g", "ing" => "Ripe Tomatoes, Garlic, Red Chilli", "shelf" => "1 Month", "storage" => "Must be refrigerated."],
    ["id" => 7, "name" => "Coconut Chutney Powder", "cat" => "Pickles & Chutneys", "price" => 90, "weight" => "200g", "ing" => "Dry Coconut, Lentils, Garlic", "shelf" => "3 Months", "storage" => "Store in airtight container."],
    // New Pickles
    ["id" => 27, "name" => "Sweet Ginger Pickle", "cat" => "Pickles & Chutneys", "price" => 130, "weight" => "250g", "ing" => "Ginger, Jaggery, Spices", "shelf" => "6 Months", "storage" => "Store in glass jar."],
    ["id" => 28, "name" => "Grated Mango Chutney", "cat" => "Pickles & Chutneys", "price" => 120, "weight" => "300g", "ing" => "Mango, Sugar, Nigella seeds", "shelf" => "12 Months", "storage" => "Keep in cool place."],
    ["id" => 29, "name" => "Onion Garlic Chutney", "cat" => "Pickles & Chutneys", "price" => 80, "weight" => "150g", "ing" => "Dry Onion, Garlic, Chilli", "shelf" => "4 Months", "storage" => "Store in dry place."],
    ["id" => 30, "name" => "Dates & Tamarind Chutney", "cat" => "Pickles & Chutneys", "price" => 140, "weight" => "400g", "ing" => "Dates, Tamarind, Cumin", "shelf" => "3 Months", "storage" => "Refrigerate after opening."],
    ["id" => 31, "name" => "Red Chilli Thecha", "cat" => "Pickles & Chutneys", "price" => 90, "weight" => "100g", "ing" => "Dry Chillies, Garlic, Peanuts", "shelf" => "2 Months", "storage" => "Keep in airtight jar."],

    // --- Homemade Snacks ---
    ["id" => 8, "name" => "Chakli", "cat" => "Homemade Snacks", "price" => 120, "weight" => "250g", "ing" => "Rice Flour, Gram Flour, Butter", "shelf" => "2 Months", "storage" => "Keep in airtight jar."],
    ["id" => 9, "name" => "Namak Para", "cat" => "Homemade Snacks", "price" => 90, "weight" => "250g", "ing" => "Refined Flour, Carom Seeds, Ghee", "shelf" => "3 Months", "storage" => "Store in a dry place."],
    ["id" => 10, "name" => "Banana Chips", "cat" => "Homemade Snacks", "price" => 100, "weight" => "250g", "ing" => "Raw Banana, Coconut Oil, Salt", "shelf" => "3 Months", "storage" => "Seal immediately after use.],
    ["id" => 11, "name" => "Murukku", "cat" => "Homemade Snacks", "price" => 110, "weight" => "250g", "ing" => "Rice Flour, Urad Dal, Sesame", "shelf" => "2 Months", "storage" => "Keep away from moisture."],
    ["id" => 12, "name" => "Thepla Chips", "cat" => "Homemade Snacks", "price" => 130, "weight" => "200g", "ing" => "Wheat Flour, Methi, Spices", "shelf" => "2 Months", "storage" => "Store in a cool place."],
    // New Snacks
    ["id" => 32, "name" => "Methi Puri", "cat" => "Homemade Snacks", "price" => 110, "weight" => "250g", "ing" => "Wheat Flour, Dried Methi", "shelf" => "2 Months", "storage" => "Airtight container."],
    ["id" => 33, "name" => "Cornflakes Mixture", "cat" => "Homemade Snacks", "price" => 95, "weight" => "250g", "ing" => "Cornflakes, Nuts, Curry Leaves", "shelf" => "3 Months", "storage" => "Keep in dry place."],
    ["id" => 34, "name" => "Potato Wafers", "cat" => "Homemade Snacks", "price" => 85, "weight" => "150g", "ing" => "Potatoes, Rock Salt, Oil", "shelf" => "1 Month", "storage" => "Seal after opening."],
    ["id" => 35, "name" => "Mini Samosa (Dry)", "cat" => "Homemade Snacks", "price" => 150, "weight" => "250g", "ing" => "Flour, Spices, Moong Dal", "shelf" => "2 Months", "storage" => "Cool dry place."],
    ["id" => 36, "name" => "Ragi Murukku", "cat" => "Homemade Snacks", "price" => 140, "weight" => "250g", "ing" => "Finger Millet, Rice Flour", "shelf" => "2 Months", "storage" => "Airtight jar."],

    // --- Homemade Sweets ---
    ["id" => 13, "name" => "Besan Ladoo", "cat" => "Homemade Sweets", "price" => 300, "weight" => "500g", "ing" => "Gram Flour, Ghee, Sugar", "shelf" => "1 Month", "storage" => "Do not refrigerate."],
    ["id" => 14, "name" => "Kaju Katli", "cat" => "Homemade Sweets", "price" => 600, "weight" => "500g", "ing" => "Cashew Nuts, Sugar, Saffron", "shelf" => "20 Days", "storage" => "Keep in a cool dry place."],
    ["id" => 15, "name" => "Dry Fruit Barfi", "cat" => "Homemade Sweets", "price" => 450, "weight" => "500g", "ing" => "Dates, Almonds, Cashews, Ghee", "shelf" => "2 Months", "storage" => "Keep in a cool place."],
    ["id" => 16, "name" => "Mohanthal", "cat" => "Homemade Sweets", "price" => 350, "weight" => "500g", "ing" => "Gram Flour, Ghee, Cardamom", "shelf" => "15 Days", "storage" => "Store in airtight box."],
    // New Sweets
    ["id" => 37, "name" => "Rava Ladoo", "cat" => "Homemade Sweets", "price" => 280, "weight" => "500g", "ing" => "Semolina, Ghee, Coconut", "shelf" => "1 Month", "storage" => "Store in dry place."],
    ["id" => 38, "name" => "Coconut Barfi", "cat" => "Homemade Sweets", "price" => 250, "weight" => "500g", "ing" => "Fresh Coconut, Sugar, Milk", "shelf" => "7 Days", "storage" => "Refrigerate."],
    ["id" => 39, "name" => "Atta Pinni", "cat" => "Homemade Sweets", "price" => 380, "weight" => "500g", "ing" => "Wheat Flour, Edible Gum, Ghee", "shelf" => "2 Months", "storage" => "Keep in cool place."],
    ["id" => 40, "name" => "Gulab Jamun (Mix)", "cat" => "Homemade Sweets", "price" => 200, "weight" => "500g", "ing" => "Khoya, Sugar Syrup", "shelf" => "3 Days", "storage" => "Keep refrigerated."],
    ["id" => 41, "name" => "Peanut Chikki", "cat" => "Homemade Sweets", "price" => 150, "weight" => "400g", "ing" => "Peanuts, Jaggery", "shelf" => "4 Months", "storage" => "Store in dry place."],

    // --- Masalas & Spices ---
    ["id" => 17, "name" => "Garam Masala", "cat" => "Masalas & Spices", "price" => 80, "weight" => "100g", "ing" => "Cinnamon, Cardamom, Cloves", "shelf" => "12 Months", "storage" => "Store in glass bottle."],
    ["id" => 18, "name" => "Sambar Powder", "cat" => "Masalas & Spices", "price" => 70, "weight" => "100g", "ing" => "Coriander, Cumin, Fenugreek", "shelf" => "12 Months", "storage" => "Keep in a cool dry place."],
    ["id" => 19, "name" => "Turmeric Powder", "cat" => "Masalas & Spices", "price" => 60, "weight" => "100g", "ing" => "Pure Dried Turmeric Roots", "shelf" => "18 Months", "storage" => "Keep away from sunlight."],
    // New Masalas
    ["id" => 42, "name" => "Biryani Masala", "cat" => "Masalas & Spices", "price" => 90, "weight" => "100g", "ing" => "Star Anise, Bay Leaf, Pepper", "shelf" => "12 Months", "storage" => "Store in glass jar."],
    ["id" => 43, "name" => "Chai Masala", "cat" => "Masalas & Spices", "price" => 120, "weight" => "50g", "ing" => "Dry Ginger, Cardamom, Tulsi", "shelf" => "12 Months", "storage" => "Airtight container."],
    ["id" => 44, "name" => "Pav Bhaji Masala", "cat" => "Masalas & Spices", "price" => 75, "weight" => "100g", "ing" => "Dried Mango, Fennel, Cloves", "shelf" => "12 Months", "storage" => "Cool dry place."],
    ["id" => 45, "name" => "Rasam Powder", "cat" => "Masalas & Spices", "price" => 70, "weight" => "100g", "ing" => "Lentils, Pepper, Cumin", "shelf" => "12 Months", "storage" => "Glass bottle."],
    ["id" => 46, "name" => "Godha Masala", "cat" => "Masalas & Spices", "price" => 85, "weight" => "100g", "ing" => "Sesame, Coconut, Spices", "shelf" => "9 Months", "storage" => "Keep in dry place."],

    // --- Healthy & Organic ---
    ["id" => 20, "name" => "Millet Cookies", "cat" => "Healthy & Organic", "price" => 200, "weight" => "250g", "ing" => "Ragi, Jaggery, Butter", "shelf" => "4 Months", "storage" => "Store in airtight box."],
    ["id" => 21, "name" => "Peanut Butter", "cat" => "Healthy & Organic", "price" => 250, "weight" => "350g", "ing" => "Roasted Peanuts, Sea Salt", "shelf" => "6 Months", "storage" => "Refrigeration optional."],
    ["id" => 22, "name" => "Oats Ladoo", "cat" => "Healthy & Organic", "price" => 280, "weight" => "400g", "ing" => "Rolled Oats, Jaggery, Nuts", "shelf" => "1 Month", "storage" => "Keep in a dry place."],
    // New Healthy
    ["id" => 47, "name" => "Flax Seed Mukhwas", "cat" => "Healthy & Organic", "price" => 120, "weight" => "150g", "ing" => "Flax seeds, Lime juice, Salt", "shelf" => "6 Months", "storage" => "Dry container."],
    ["id" => 48, "name" => "Amla Candy (Dry)", "cat" => "Healthy & Organic", "price" => 180, "weight" => "250g", "ing" => "Amla, Ginger, Honey", "shelf" => "12 Months", "storage" => "Store in glass jar."],
    ["id" => 49, "name" => "Makhana Roasted", "cat" => "Healthy & Organic", "price" => 220, "weight" => "100g", "ing" => "Fox nuts, Olive oil, Pepper", "shelf" => "2 Months", "storage" => "Airtight bag."],
    ["id" => 50, "name" => "Jaggery Powder", "cat" => "Healthy & Organic", "price" => 90, "weight" => "500g", "ing" => "Sugarcane Juice (Organic)", "shelf" => "12 Months", "storage" => "Cool dry place."],
    ["id" => 51, "name" => "Quinoa Puffs", "cat" => "Healthy & Organic", "price" => 160, "weight" => "100g", "ing" => "Quinoa, Herbs", "shelf" => "3 Months", "storage" => "Seal after use."],

    // --- Ready-to-Cook ---
    ["id" => 23, "name" => "Idli Batter", "cat" => "Ready-to-Cook", "price" => 60, "weight" => "1kg", "ing" => "Rice, Urad Dal, Fenugreek", "shelf" => "5 Days", "storage" => "MUST be refrigerated."],
    ["id" => 24, "name" => "Dosa Batter", "cat" => "Ready-to-Cook", "price" => 65, "weight" => "1kg", "ing" => "Parboiled Rice, Lentils", "shelf" => "5 Days", "storage" => "Keep refrigerated."],
    ["id" => 25, "name" => "Dhokla Mix", "cat" => "Ready-to-Cook", "price" => 95, "weight" => "500g", "ing" => "Gram Flour, Citric Acid, Salt", "shelf" => "6 Months", "storage" => "Store in a dry place."],
    ["id" => 26, "name" => "Upma Mix", "cat" => "Ready-to-Cook", "price" => 85, "weight" => "250g", "ing" => "Suji, Spices, Ghee, Nuts", "shelf" => "3 Months", "storage" => "Store in airtight container."],
    // New Ready to Cook
    ["id" => 52, "name" => "Poha Mix", "cat" => "Ready-to-Cook", "price" => 75, "weight" => "250g", "ing" => "Beaten Rice, Peanuts, Onions", "shelf" => "4 Months", "storage" => "Cool place."],
    ["id" => 53, "name" => "Vada Mix", "cat" => "Ready-to-Cook", "price" => 110, "weight" => "400g", "ing" => "Urad Dal Powder, Spices", "shelf" => "6 Months", "storage" => "Store in dry place."],
    ["id" => 54, "name" => "Handvo Mix", "cat" => "Ready-to-Cook", "price" => 130, "weight" => "500g", "ing" => "Rice, Lentils, Spices", "shelf" => "6 Months", "storage" => "Airtight container."],
    ["id" => 55, "name" => "Moong Dal Halwa Mix", "cat" => "Ready-to-Cook", "price" => 180, "weight" => "250g", "ing" => "Lentils, Ghee, Sugar", "shelf" => "3 Months", "storage" => "Keep in cool place."],
    ["id" => 56, "name" => "Thalipeeth Bhajani", "cat" => "Ready-to-Cook", "price" => 120, "weight" => "500g", "ing" => "Mixed Roasted Grains", "shelf" => "6 Months", "storage" => "Dry place."]
];

// 2. Handle Add to Cart Logic
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $_SESSION['cart'][$id] = [
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'quantity' => (isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id]['quantity'] + 1 : 1)
    ];
    $message = "Added to cart!";
}

$current_cat = $_GET['category'] ?? 'All';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DesiDelight | Homemade Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card { border: none; transition: 0.3s; background: #fff; border-radius: 12px; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .details-small { font-size: 0.8rem; color: #666; line-height: 1.4; }
        .btn-success { background-color: #198754; }
        .sticky-nav { position: sticky; top: 0; z-index: 1000; }
        .cat-btn { white-space: nowrap; }
        
        /* Veg Marking Styles */
        .veg-icon {
            width: 15px;
            height: 15px;
            border: 2px solid #0f8444;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
        }
        .veg-dot {
            width: 7px;
            height: 7px;
            background-color: #0f8444;
            border-radius: 50%;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-nav shadow-sm">
<a href="wishlist.php">❤️ Wishlist</a>
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">DesiDelight</a>
        <div class="d-flex align-items-center">
            <a href="index.php" class="btn btn-sm btn-light me-2">Home</a>
            <a class="nav-link text-white fw-bold" href="cart.php">🛒 Cart <span class="badge bg-white text-success rounded-pill"><?php echo count($_SESSION['cart'] ?? []); ?></span></a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <?php if(isset($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="text-center mb-5">
        <h2 class="fw-bold">Our Homemade Menu</h2>
        <p class="text-muted">Over 50+ homemade items prepared with traditional recipes.</p>
    </div>

    <div class="d-flex flex-nowrap overflow-auto justify-content-start justify-content-md-center align-items-center gap-2 mb-5 pb-2">
        <a href="products.php" class="btn btn-dark btn-sm px-3 cat-btn">All</a>
        <?php 
        $cats = ['Pickles & Chutneys', 'Homemade Snacks', 'Homemade Sweets', 'Masalas & Spices', 'Healthy & Organic', 'Ready-to-Cook'];
        foreach($cats as $c): ?>
            <a href="products.php?category=<?php echo urlencode($c); ?>" 
               class="btn <?php echo ($current_cat == $c) ? 'btn-success' : 'btn-outline-success'; ?> btn-sm px-3 cat-btn">
               <?php echo $c; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="row g-4">
        <?php foreach($products as $p): ?>
            <?php if($current_cat == 'All' || $p['cat'] == $current_cat): ?>
            <div class="col-md-4 col-lg-3">
                <div class="card h-100 product-card p-3 shadow-sm">
                    <div class="card-body p-0 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start">
                            <small class="text-success fw-bold"><?php echo $p['cat']; ?></small>
                            <div class="veg-icon" title="Vegetarian">
                                <div class="veg-dot"></div>
                            </div>
                        </div>
                        
                        <h5 class="fw-bold mt-1 mb-1"><?php echo $p['name']; ?></h5>
                        <p class="text-dark fw-bold mb-1">₹<?php echo $p['price']; ?> <small class="text-muted fw-normal">(<?php echo $p['weight']; ?>)</small></p>
                        
                        <div class="details-small mt-3 mb-3 flex-grow-1">
                            <div class="mb-1"><strong>Ingredients:</strong> <?php echo $p['ing']; ?></div>
                            <div class="mb-1"><strong>Shelf Life:</strong> <?php echo $p['shelf']; ?></div>
                            <div><strong>Storage:</strong> <?php echo $p['storage']; ?></div>
                        </div>

                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $p['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $p['price']; ?>">
                            <button type="submit" name="add_to_cart" class="btn btn-success w-100 btn-sm py-2 fw-bold">Add to Cart</button>
                        </form>
                        <div class="card-body p-0 d-flex flex-column">
    ...
    <form method="POST" action="">
        <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $p['name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $p['price']; ?>">
        <button type="submit" name="add_to_cart" class="btn btn-success w-100 btn-sm py-2 fw-bold">Add to Cart</button>
    </form>

    <!-- Wishlist button -->
    <form method="POST" action="add_to_wishlist.php">
        <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $p['name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $p['price']; ?>">
        <button type="submit" name="add_to_wishlist" class="btn btn-danger w-100 btn-sm py-2 fw-bold mt-2">
            ❤️ Add to Wishlist
        </button>
    </form>
</div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>