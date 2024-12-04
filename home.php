<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSify - Empowering Informal Retailers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbr.css" rel ="stylesheet">

    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), #0056b3);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .features-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .feature-box {
            text-align: center;
            padding: 30px;
            margin-bottom: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-10px);
        }

        .feature-box img {
            max-width: 80px;
            margin-bottom: 20px;
        }

        .cta-section {
            background-color: var(--primary-color);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .testimonial-section {
            padding: 80px 0;
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Posify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                
                 
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-info-circle"></i> Shop</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./login/register.php">Sell with Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ms-2" href="./login/customer_login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ms-2" href="./login/customer_register.php">Register</a>
                    </li>
                </ul>
                <form class="d-flex ms-3" action = "./customer/product_search.php" method = "GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name = 'search' aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">Revolutionize Your Retail Business</h1>
            <p class="lead mb-5">POSify: The all-in-one mobile platform designed specifically for informal retailers in Ghana</p>
            <a href="#" class="btn btn-lg btn-light me-3">Learn More</a>
            <a href="#" class="btn btn-lg btn-outline-light">Start Free Trial</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <h2 class="text-center mb-5">Powerful Features for Your Business</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <img src="/api/placeholder/80/80" alt="POS Icon">
                        <h3>Integrated POS</h3>
                        <p>Track sales, manage inventory, and process transactions seamlessly</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <img src="/api/placeholder/80/80" alt="Payment Icon">
                        <h3>Digital Payments</h3>
                        <p>Accept mobile money, cards, and other cashless payment methods</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <img src="/api/placeholder/80/80" alt="Insights Icon">
                        <h3>Business Insights</h3>
                        <p>Generate financial reports and gain data-driven business intelligence</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="mb-4">Ready to Transform Your Business?</h2>
            <p class="lead mb-4">Join thousands of retailers growing with POSify</p>
            <a href="#" class="btn btn-lg btn-light">Sign Up Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>POSify</h4>
                    <p>Empowering informal retailers through digital innovation</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-white me-3">Privacy Policy</a>
                    <a href="#" class="text-white me-3">Terms of Service</a>
                    <a href="#" class="text-white">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>