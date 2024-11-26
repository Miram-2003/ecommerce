<?php
session_start();
require_once("../controllers/cart_controller.php");

$user_id = $_SESSION['user_id'];
$cart_items = get_cart_items($user_id);
$total_price = array_reduce($cart_items, function ($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Order Confirmation</h2>
    <h4>Review Your Order</h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart_items as $item) { ?>
            <tr>
                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>GHC<?php echo number_format($item['price'], 2); ?></td>
                <td>GHC<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <h4>Total: GHC<?php echo number_format($total_price, 2); ?></h4>

    <h4>Shipping Information</h4>
    <form action="../actions/place_order.php" method="POST">
        <div class="mb-3">
            <label for="shipping_address" class="form-label">Shipping Address</label>
            <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="cash_on_delivery">Cash on Delivery</option>
                <option value="card_payment">Card Payment</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
</body>
</html>
