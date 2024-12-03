<?php
session_start();
require_once('controllers/cart_controller.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    ("Location: ../login/customer_login.php");
}

$user_id = intval($_SESSION['user_id']);
$product_id = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);
$action = $_POST['action']; 



if ($action === 'increase') {
    $new_quantity =  $quantity  + 1;
} elseif ($action === 'decrease') {
    $new_quantity = $quantity - 1; // Ensure it doesn't go below 1
} else {
    die("Invalid action.");
}

// Update the cart
if (update_cart_item($user_id, $product_id, $new_quantity)) {
    header("Location: ../customer/cart_view.php?status=updated");
} else {
    header("Location: ../customer/cart_view.php?status=failed");
}
exit();
?>
