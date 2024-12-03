<?php
session_start();
require_once("../controllers/product_controller.php");
require_once("../controllers/order_controller.php");
require_once('../settings/core.php');

// Ensure the user is logged in
check_login();

$seller_id = $_SESSION['seller_id'];
$name = $_SESSION['seller_name'];
$email = $_SESSION['email'];
$img = $_SESSION['image'];

// Fetch seller's orders
$order = getOrderforSeller($seller_id);

// Handle product data for editing (example product initialization)
$productToEdit = null;
if (isset($_GET['edit_product_id'])) {
    $productId = $_GET['edit_product_id'];
    foreach ($products as $product) {
        if ($product['product_id'] == $productId) {
            $productToEdit = $product;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retailer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            background-color: #004080;
            color: white;
            height: 100vh;
            position: fixed;
            top: 0%;
            left: 0;
            width: 16%;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #0056b3;
            color: white;
        }

        .nav {
            margin-top: 100px;
        }
        
        .main-content {
            margin-left: 18%;
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center mt-5">Dashboard</h3>
        <nav class="nav flex-column">
            <a class="nav-link active" href="#">Orders</a>
            <a class="nav-link" href="#">Products</a>
            <a class="nav-link" href="#">Profile</a>
            <a class="nav-link" href="#">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="my-4">Seller Orders</h2>
        
        <?php if (isset($order) && !empty($order)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['invoice_no']); ?></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($item['price']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']*$item['price']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders found for this seller.</p>
        <?php endif; ?>
    </div>

</body>

</html>
