<?php
session_start();
require_once("../controllers/cart_controller.php");
require_once('../controllers/order_controller.php');
require_once('../controllers/product_controller.php');
require_once('../settings/core.php');
require_once("../controllers/cat_controller.php");
check_user_login();


$name = $_SESSION['user_name'];



if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order = get_order_details($order_id);
    $order_details = get_order_items($order_id);
}

$cart_items = get_cart_items($user_id);
$num =  count($cart_items);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbr.css">
    <link rel="stylesheet" href="../css/order_details.css">
    <link rel="stylesheet" href= "../css/side.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #004080;">
        <div class="container-fluid">
        
            <a class="navbar-brand" href="#">POSify</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
               
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> About</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                  
                    <li class="nav-item me-3" action="../customer/product_search.php" method="GET">
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search by product or category" name='search' aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>
                    
                    <li class="nav-item me-3">
                        <a class="nav-link cart-container" href="../customer/cart_view.php">
                            <i class="fas fa-shopping-cart"></i>
                            <?php if ($num > 0): ?>
                                <span class="cart-badge"><?php echo $num; ?></span>
                            <?php endif; ?>
                            Cart
                        </a>
                    </li>
                    
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

    <div class="container mt-3 pt-4">
   
        <?php echo getAllsubcat(); ?>
    </div>
    
    <div class="container mt-5" style=" margin-top: 8rem !important;">
        <a href="../customer/orders_view.php"><i class="fas fa-arrow-left fa-2x"></i></a>
        <span style="margin-left: 10px; font-size:x-large;"><b>Order Details</b></span>
        <hr>
        <div class="order-summary">
            <p><b>Order no: <?php echo htmlspecialchars($order['invoice_no']); ?></b></p>
            <p><?php echo count($order_details); ?> Items</p>
            <p>Placed on: <?php echo date("d-m-Y", strtotime($order['created_at'])); ?></p>
            <p class="total">Total: GHC <?php echo number_format($order['total_amount'], 2); ?></p>
            <hr>
        </div>

        <h4 class="mt-4">Items in Your Order:</h4>
        <div class="order-items">
            <?php foreach ($order_details as $item) :
                $product_id = $item['product_id'];
                $product = get_a_product_ctr($product_id); ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="product-info">
                                <img src="../product_images/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                                <div>
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p>QTY: <?php echo htmlspecialchars($item['quantity']); ?></p>
                                    <p class="card-text">
                                        Price: GHC <?php echo number_format($item['price'], 2); ?><br>
                                        Total: GHC <?php echo number_format($item['price'] * $item['quantity'], 2); ?><br>
                                        <span class="status"><?php echo htmlspecialchars($order['status']); ?></span>
                                    </p>
                                </div>
                            </div>
                            <a href="../customer/product_detail.php?id=<?php echo htmlspecialchars($product_id); ?>" class="btn btn-success">Buy Again</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="order-summarry">
                    <h4>Payment Information</h4>
                    <hr>
                    <p>Payment Method: <br> <?php echo htmlspecialchars($order['payment_method']); ?></p>
                    <p>Payment Details: </p>
                    <p>Items total (delivery fee inclusive): GHC <?php echo number_format($order['total_amount'], 2); ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="order-summarry">
                    <h4>Delivery Information</h4>
                    <hr>
                    <p>Delivery Address: <?php echo htmlspecialchars($order['delivery_address']); ?></p>
                    <p>Delivering Date: <?php echo date("d-m-Y", strtotime(($order['created_at']) . ' +1 day')); ?></p>
                </div>
            </div>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>