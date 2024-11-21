<?php
session_start();
require_once("../controllers/cart_controller.php");

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to view your cart.");
}

$user_id = intval($_SESSION['user_id']);

// Fetch all items in the user's cart
$cart_items = get_cart_items($user_id); // Replace with your function to fetch cart items


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

        .checkout-btn:hover {
            background-color: #e68a00;
        }
    </style>
</head>

<body>
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
                                <form action="update_cart.php" method="POST" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                    <button type="submit" name="decrease" class="btn btn-quantity">-</button>
                                    <span class="mx-2"><?php echo $item['quantity']; ?></span>
                                    <button type="submit" name="increase" class="btn btn-quantity">+</button>
                                </form>
                            </div>
                            <form action="remove_from_cart.php" method="POST" class="ms-3">
                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Remove</button>
                            </form>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p>Your cart is empty. <a href="index.php">Continue Shopping</a></p>
                <?php } ?>
            </div>

            <!-- Cart Summary -->
            <div class="col-md-4">
                <div class="cart-summary">
                    <h5>Cart Summary</h5>
                    <hr>
                    <p>Subtotal: <span class="fw-bold">GHC<?php echo number_format(array_reduce($cart_items, function ($total, $item) {
                        return $total + ($item['price'] * $item['quantity']);
                    }, 0), 2); ?></span></p>
                    <p class="text-muted">Delivery fees not included yet.</p>
                    <button class="checkout-btn">Checkout (GHC<?php echo number_format(array_reduce($cart_items, function ($total, $item) {
                        return $total + ($item['price'] * $item['quantity']);
                    }, 0), 2); ?>)</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
