<?php
require_once("../controllers/product_controller.php");
require_once("../controllers/cat_controller.php");

session_start();
require_once('../settings/core.php');

check_user_login();
$id = $_SESSION['seller_id'];
$name = $_SESSION['seller_name'];
$email  = $_SESSION['email'];
$img = $_SESSION['image'];


// Get the product ID from the query string
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Product ID is required.");
}

$product_id = intval($_GET['id']);


// Fetch the product details using the controller function
$product = get_a_product_ctr($product_id);

$cat_man = getMainCat($product['main_cat_id']);
$cat_sub = getSubCat($product['sub_cat_id']);?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #004080;
            color: white;
        }

        .navbar .nav-link {
            color: white;
        }

        .navbar .nav-link:hover {
            color: #cce5ff;
        }

        .product-detail {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .product-detail img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product-price {
            color: #28a745;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .btn-custom {
            background-color: #0056b3;
            color: white;
        }

        .btn-custom:hover {
            background-color: #004080;
            color: white;
        }

        footer {
            margin-top: 60%;
            background-color: #004080;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Shopify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sell with Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ms-2" href="#">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="../product_images/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="product-detail">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p class="product-price">GHC<?php echo number_format($product['price'], 2); ?></p>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($cat_man); ?></p>
                    <p><strong>Subcategory:</strong> <?php echo htmlspecialchars($cat_sub); ?></p>
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-custom btn-lg w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Shopify. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
