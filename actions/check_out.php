<?php
session_start();
require_once('../controllers/cart_controller.php');
require_once('../controllers/order_controller.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to proceed with checkout.");
}

$user_id = intval($_SESSION['user_id']);

// Fetch all cart items
$cart_items = get_cart_items($user_id);

if (empty($cart_items)) {
    die("Your cart is empty. Add items to proceed.");
}

// Calculate total price
$total_price = array_reduce($cart_items, function ($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);

// Create a new order
$order_id = create_order($user_id, $total_price);

if (!$order_id) {
    die("Failed to create order. Please try again.");
}

// Add each cart item to the order
foreach ($cart_items as $item) {
    $result = add_order_item($order_id, $item['product_id'], $item['quantity'], $item['price']);
    if (!$result) {
        die("Failed to process order items. Please try again.");
    }
}

// Clear the cart after successful checkout
clear_cart($user_id);
// Redirect to a success page
header("Location: ../customer/payment.php?order_id=$order_id");
exit();
?>

