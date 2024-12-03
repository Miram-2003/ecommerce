<?php
session_start();
require_once('../settings/core.php');
require_once("../controllers/cart_controller.php");
<<<<<<< HEAD
require_once("../controllers/product_controller.php");
=======
require_once("..//product_controller.php");
>>>>>>> 36ca3a85af2e2bd486847e90c534ae7039930fe5
require_once("../controllers/cat_controller.php");



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
$cart_items = get_cart_items($user_id);
$num =  count($cart_items);


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

    <link rel="stylesheet" href="../css/navbr.css">
    <link rel="stylesheet" href="../css/side.css">
    <link rel="stylesheet" href="../css/cart.css">

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
                        <form class="d-flex" action="../customer/product_search.php" method="GET">
                            <input class="form-control lg me-2" type="search" placeholder="Search" name='search' aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>
                    <!-- Cart -->
                    <li class="nav-item me-3">
                        <a class="nav-link cart-container" href="../customer/cart_view.php">
                            <i class="fas fa-shopping-cart"></i>
                            <?php if ($num > 0): ?>
                                <span class="cart-badge"><?php echo $num; ?></span>
                            <?php endif; ?>
                            Cart
                        </a>
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
    <div class="container mt-5 pt-4">

        <?php echo getAllsubcat(); ?>
    </div>

    <main>
        <div class="container my-3">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>