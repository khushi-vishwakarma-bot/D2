<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DesiDelight | Authentic Homemade Goodness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .brand-font { font-family: 'Playfair+Display', serif; }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1596797038558-b1291873634c?q=80&w=1920');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
        }
        .trust-badge { border: 1px solid #dee2e6; padding: 20px; border-radius: 10px; transition: 0.3s; }
        .trust-badge:hover { box-shadow: 0 10px 20px rgba(0,0,0,0.05); border-color: #198754; }
        
        /* Veg Marking Styles */
        .veg-symbol {
            width: 18px;
            height: 18px;
            border: 2px solid #0f8444;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
            vertical-align: middle;
        }
        .veg-dot {
            width: 10px;
            height: 10px;
            background-color: #0f8444;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand brand-font fs-3 text-success" href="index.php">DesiDelight</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php">All Products</a></li>
                
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="btn btn-outline-success ms-lg-3" href="login.php">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 brand-font mb-4">Taste the Tradition</h1>
        <p class="lead mb-5">100% Homemade, Preservative-Free Snacks & Sweets delivered to your doorstep.</p>
        <a href="products.php" class="btn btn-success btn-lg px-5">Shop Now</a>
    </div>
</header>

<section class="container my-5 py-5 text-center">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="trust-badge">
                <h3 class="fs-1">🏠</h3>
                <h5 class="fw-bold">Truly Homemade</h5>
                <p class="text-muted">Prepared in small batches by local home-chefs.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="trust-badge">
                <h3 class="fs-1">🧼</h3>
                <h5 class="fw-bold">Hygiene First</h5>
                <p class="text-muted">FSSAI compliant kitchen and safety standards.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="trust-badge">
                <h3 class="fs-1">📦</h3>
                <h5 class="fw-bold">Freshly Packed</h5>
                <p class="text-muted">We pack only after you place your order.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-light py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="brand-font display-6">Featured Favorites</h2>
                <p class="text-muted">Most loved treats from DesiDelight</p>
            </div>
            <a href="products.php" class="btn btn-link text-success">View All →</a>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm p-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <p class="text-uppercase small text-success fw-bold mb-0">Homemade Sweets</p>
                            <div class="veg-symbol" title="Vegetarian"><div class="veg-dot"></div></div>
                        </div>
                        <h5 class="card-title fw-bold">Kaju Katli</h5>
                        <p class="text-dark fw-bold mb-1">₹600 <small class="text-muted fw-normal">(500g)</small></p>
                        <p class="text-muted small">Premium Cashews, Sugar, Saffron.</p>
                        <a href="product-details.php?id=14" class="btn btn-sm btn-success w-100 mt-2">View Details</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm p-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <p class="text-uppercase small text-success fw-bold mb-0">Pickles & Chutneys</p>
                            <div class="veg-symbol" title="Vegetarian"><div class="veg-dot"></div></div>
                        </div>
                        <h5 class="card-title fw-bold">Amla Pickle</h5>
                        <p class="text-dark fw-bold mb-1">₹150 <small class="text-muted fw-normal">(400g)</small></p>
                        <p class="text-muted small">Gooseberry, Fenugreek, Spices.</p>
                        <a href="product-details.php?id=4" class="btn btn-sm btn-success w-100 mt-2">View Details</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm p-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <p class="text-uppercase small text-success fw-bold mb-0">Homemade Snacks</p>
                            <div class="veg-symbol" title="Vegetarian"><div class="veg-dot"></div></div>
                        </div>
                        <h5 class="card-title fw-bold">Thepla Chips</h5>
                        <p class="text-dark fw-bold mb-1">₹130 <small class="text-muted fw-normal">(200g)</small></p>
                        <p class="text-muted small">Wheat Flour, Methi, Spices.</p>
                        <a href="product-details.php?id=12" class="btn btn-sm btn-success w-100 mt-2">View Details</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm p-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <p class="text-uppercase small text-success fw-bold mb-0">Ready-to-Cook</p>
                            <div class="veg-symbol" title="Vegetarian"><div class="veg-dot"></div></div>
                        </div>
                        <h5 class="card-title fw-bold">Fresh Dosa Batter</h5>
                        <p class="text-dark fw-bold mb-1">₹65 <small class="text-muted fw-normal">(1kg)</small></p>
                        <p class="text-muted small">Parboiled Rice, Lentils.</p>
                        <a href="product-details.php?id=24" class="btn btn-sm btn-success w-100 mt-2">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="py-5 bg-dark text-white text-center mt-5">
    <div class="container">
        <h2 class="brand-font mb-4">DesiDelight</h2>
        <ul class="list-inline mb-4">
            <li class="list-inline-item mx-3"><a href="#" class="text-white text-decoration-none">Privacy Policy</a></li>
            <li class="list-inline-item mx-3"><a href="#" class="text-white text-decoration-none">Terms of Service</a></li>
            <li class="list-inline-item mx-3"><a href="#" class="text-white text-decoration-none">Shipping Info</a></li>
        </ul>
        <p class="text-muted small">© 2026 DesiDelight Homemade Food Products. Made with ❤️ in India.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
