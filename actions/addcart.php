<?php

session_start();
require_once("../controllers/cart_controller.php");

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to add items to your cart.");
}

// Get user ID from the session
$user_id = $_SESSION['user_id'];

// Check if required POST data is set
if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['price'])) {
    $product_id = intval( htmlspecialchars($_POST['product_id']));
    $quantity = intval( htmlspecialchars($_POST['quantity']));
    $price = floatval( htmlspecialchars($_POST['price']));

    // Validate quantity
    if ($quantity < 1) {
        die("Invalid quantity.");
    }

    // Add product to the cart
    $result = add_to_cart_ctr($user_id, $product_id, $quantity, $price);

    if ($result) {
        // Redirect to cart page or show success message
        header("Location: ../customer/cart_view.php");
    } else {
        die("Failed to add product to the cart.");
    }
} else {
    die("Invalid request.");
}



?>