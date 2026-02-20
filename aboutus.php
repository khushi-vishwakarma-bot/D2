<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | DesiDelight</title>
    <style>
        :root {
            --primary-color: #d35400; /* Deep Orange/Desi Spice Tone */
            --secondary-color: #2c3e50;
            --bg-light: #fdfaf6;
            --text-dark: #333;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            line-height: 1.6;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        /* Hero Section */
        .about-hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1596797038583-1c198f457399?auto=format&fit=crop&w=1200&q=80'); /* Replace with your actual product image */
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        /* Content Section */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 50px 20px;
        }

        .story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .story-text h2 {
            color: var(--primary-color);
            font-size: 2.2rem;
        }

        .story-image img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* Values Section */
        .values {
            background: white;
            padding: 60px 0;
            text-align: center;
            margin-top: 40px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .value-card {
            padding: 30px;
            border-bottom: 4px solid var(--primary-color);
            transition: transform 0.3s;
        }

        .value-card:hover {
            transform: translateY(-10px);
        }

        .value-card h3 {
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .story-grid { grid-template-columns: 1fr; }
            .hero-content h1 { font-size: 2.5rem; }
        }
    </style>
</head>
<body>

    <section class="about-hero">
        <div class="hero-content">
            <h1>DesiDelight</h1>
            <p>Bringing Tradition to Your Doorstep</p>
        </div>
    </section>

    <div class="container">
        <section class="story-grid">
            <div class="story-text">
                <h2>Our Story</h2>
                <p>Founded in 2026, <strong>DesiDelight</strong> was born out of a simple passion: to reconnect people with the authentic tastes and crafts of our heritage. We noticed that in the rush of modern life, the "Desi" touch was being replaced by mass-produced alternatives.</p>
                <p>We work directly with local artisans and farmers to ensure that every product you receive is a masterpiece of quality and tradition. From our kitchen to your home, we deliver delight in every box.</p>
            </div>
            <div class="story-image">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=600&q=80" alt="DesiDelight Quality">
            </div>
        </section>
    </div>

    <section class="values">
        <div class="container">
            <h2>Why Choose Us?</h2>
            <div class="values-grid">
                <div class="value-card">
                    <h3>Authentic Sourcing</h3>
                    <p>We never compromise on the roots. Every item is 100% authentic and ethically sourced.</p>
                </div>
                <div class="value-card">
                    <h3>Premium Quality</h3>
                    <p>Rigorous quality checks ensure that DesiDelight stands for excellence in every bite or use.</p>
                </div>
                <div class="value-card">
                    <h3>Homegrown Love</h3>
                    <p>We are a brand that celebrates local communities and supports small-scale creators.</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>