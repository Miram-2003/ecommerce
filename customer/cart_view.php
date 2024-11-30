<?php
session_start();
require_once('../settings/core.php');
require_once("../controllers/cart_controller.php");
require_once("../controllers/product_controller.php");


check_user_login();
$id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$email  = $_SESSION['email'];

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to view your cart.");
}

$user_id = intval($_SESSION['user_id']);

// Fetch all items in the user's cart
$cart_items = get_cart_items($user_id); // Replace with your function to fetch cart items

$products = get_allproduct();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .cart-item {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cart-summary {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .price-original {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
        }

        .discount-badge {
            background-color: #fce4ec;
            color: #d50000;
            font-size: 0.8rem;
            border-radius: 5px;
            padding: 2px 6px;
            margin-left: 5px;
        }

        .btn-quantity {
            border: 1px solid #ff9800;
            color: #ff9800;
            background-color: #fff;
            font-size: 1.2rem;
            width: 35px;
            height: 35px;
        }

        .btn-quantity:hover {
            background-color: #ff9800;
            color: #fff;
        }

        .checkout-btn {
            background-color: #ff9800;
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            width: 100%;
        }

        main {
            margin-top: 10%;
        }

        .checkout-btn:hover {
            background-color: #e68a00;
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

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
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



        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .product-card .card-body {
            padding: 10px;
        }

        .product-card .product-name {
            font-weight: bold;
            font-size: 1.1rem;
            color: #004080;
        }

        .product-card .product-price {
            color: #28a745;
            font-size: 1rem;
            font-weight: bold;
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #004080;">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="#">POSify</a>

            <!-- Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left-aligned links -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> About</a>
                    </li>
                </ul>

                <!-- Right-aligned links -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Search Bar -->
                    <li class="nav-item me-3">
                        <form class="d-flex" action = "../customer/product_search.php" method = "GET">
                            <input class="form-control lg me-2" type="search" placeholder="Search" name = 'search' aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>
                    <!-- Cart -->
                    <li class="nav-item me-3">
                        <a class="nav-link" href="../customer/cart_view.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><?php echo $name; ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="../login/logout_customer.php">Orders</a></li>
                            <li><a class="dropdown-item" href="../login/logout_customer.php">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="container my-5">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-md-8">
                    <!-- // <h2 class="mb-4">Cart ()</h2> -->
                    <?php if (!empty($cart_items)) { ?>
                        <?php foreach ($cart_items as $item) { ?>
                            <div class="cart-item d-flex align-items-center">
                                <img src="../product_images/<?php echo htmlspecialchars($item['product_image']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" style="width: 100px; height: 100px; object-fit: cover; margin-right: 20px;">
                                <div class="flex-grow-1">
                                    <h5><?php echo htmlspecialchars($item['product_name']); ?></h5>
                                    <p class="mb-1">
                                        <span class="text-primary fw-bold">GHC<?php echo number_format($item['price'], 2); ?></span>
                                        <?php if (isset($item['original_price'])) { ?>
                                            <span class="price-original">GHC<?php echo number_format($item['original_price'], 2); ?></span>
                                            <span class="discount-badge"><?php echo round((($item['original_price'] - $item['price']) / $item['original_price']) * 100); ?>% OFF</span>
                                        <?php } ?>
                                    </p>
                                    <p class="text-success"><?php echo htmlspecialchars($item['stock_status'] ?? 'In Stock'); ?></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <form action="../actions/update_cart.php" method="POST" class="d-inline">
                                        <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                        <input type="hidden" name="quantity" value="<?php echo $item['quantity']; ?>">
                                        <button type="submit" name="action" value="decrease" class="btn btn-quantity">-</button>
                                        <span class="mx-2"><?php echo $item['quantity']; ?></span>
                                        <button type="submit" name="action" value="increase" class="btn btn-quantity">+</button>
                                    </form>
                                </div>
                                <form action="../actions/delete_cart.php" method="POST" class="ms-3">
                                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Remove</button>
                                </form>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p>Your cart is empty.</p>
                        <a href="../customer/customer_index.php"> Continue Shopping </a>
                    <?php } ?>
                </div>

                <!-- Cart Summary -->
                <?php if (!empty($cart_items)) { ?>
                    <div class="col-md-4">
                        <div class="cart-summary">
                            <h5>Cart Summary</h5>
                            <hr>
                            <p>Subtotal: <span class="fw-bold">GHC<?php echo number_format(array_reduce($cart_items, function ($total, $item) {
                                                                        return $total + ($item['price'] * $item['quantity']);
                                                                    }, 0), 2); ?></span></p>
                            <p class="text-muted">Delivery fees not included yet.</p>

                            <a href="../customer/confirm_order.php" class="btn btn-info">Checkout (GHC<?php echo number_format(array_reduce($cart_items, function ($total, $item) {
                                                                                                            return $total + ($item['price'] * $item['quantity']);
                                                                                                        }, 0), 2); ?>)</a>

                        </div>
                    </div>
                <?php } ?>
            </div>
            <hr>

            <br><br><br>
            <div>
                <h2 class="text-center my-4"><a href="../customer/customer_index.php">Browse more products</a></h2>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                if (!empty($products)) {
                    foreach ($products as $product) {
                ?>
                        <div class="col">
                            <div class="card product-card">
                                <img src="../product_images/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="card-body">
                                    <h5 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                                    <a href="product_detail.php?id=<?php echo $product['product_id']; ?>" class="btn btn-custom btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='text-muted text-center'>No products available at the moment.</p>";
                }
                ?>
            </div>

        </div>
    </main>
    <footer>
        <p>&copy; 2024 Shopify. All rights reserved.</p>
    </footer>

</body>

</html>