<?php
session_start();
require_once("controllers/order_controller.php");
require_once("controllers/cat_controller.php");

// Update this with your actual controller
require_once('../controllers/product_controller.php'); // Update this with your actual controller

$user_id = intval($_SESSION['user_id']);
$name = $_SESSION['user_name'];
$email  = $_SESSION['email'];
$orders = get_orders($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/navbr.css">
    <link rel="stylesheet" href="../css/order_veiw.css">
    <link rel="stylesheet" href="../css/side.css">
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
                            <input class="form-control me-2" type="search" placeholder="Search by product or category" name='search' aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>
                    <!-- Cart -->
                    <li class="nav-item me-3">
                        <a class="nav-link" href="../customer/cart_view.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><?php echo htmlspecialchars($name); ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="../customer/orders_view.php">Orders</a></li>
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
    <div class="container mt-5 pt-4 order-status-summary ">
        <!-- Order Status Summary -->
        <div class="mb-4">
            <h5>Orders</h5>
            <div>
                <span class="badge bg-success">Ongoing/Delivered ()</span>
                <span class="badge bg-danger">Canceled/Returned ()</span>
            </div>
        </div>

        <?php
        // Check if there are any orders
        if (empty($orders)) {
            echo "<p>No orders found.</p>";
        } else {
            echo '<div class="container mt-1 pt-1">';
            foreach ($orders as $order) {
                $order_id = $order['order_id'];
                $order_details = get_order_items($order_id);

                foreach ($order_details as $item) {
                    $product_id = $item['product_id'];
                    $product = get_a_product_ctr($product_id); // Corrected function call

                    // Ensure the product has an image
                    $product_image = !empty($product['img']) ? "../product_images/" . $product['img'] : 'path/to/default/image.jpg'; // Default image if none exists

                    // Display order information
                    echo '<div class="order-item d-flex align-items-start">';
                    echo '<img src="' . htmlspecialchars($product_image) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';
                    echo '<div class="product-info ms-3">';
                    echo '<div class="product-name">' . htmlspecialchars($product['name']) . '</div>';
                    echo '<div class="order-id">Order ' . htmlspecialchars($order['invoice_no']) . '</div>';
                    echo '<div class="order-status">' . htmlspecialchars($order['status']) . '</div>'; // Assuming 'status' exists
                    echo '<div class="order-date">On ' . date("l, d-m", strtotime($order['created_at'])) . '</div>'; // Format the date
                    echo '</div>'; // Close product-info
                    echo '<a href="../customer/order_details.php?order_id=' . htmlspecialchars($order_id) . '" class="btn btn-link see-details">SEE DETAILS</a>';
                    echo '</div>'; // Close order-item
                }
            }
            echo '</div>';
        }
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>