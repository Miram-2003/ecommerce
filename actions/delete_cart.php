<?php
session_start();
require_once("../controllers/cart_controller.php");

$user_id = intval($_SESSION['user_id']);
$product_id = intval($_POST['product_id']);

delete_cart_item($user_id, $product_id); // Add your logic to remove cart item
header("Location: ../customer/cart_view.php");
?>
