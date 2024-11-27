<?php
session_start();
require_once("../controllers/cart_controller.php");
require_once("../controllers/order_controller.php");
require_once("../controllers/payment.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
// Get user details from session
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['email'];
$user_contact = $_SESSION['contact'];

$invoice = rand(10000, 99999);

// Get the cart items and calculate the total price
$cart_items = get_cart_items($user_id);
$total_price = array_reduce($cart_items, function ($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);


// Get the form data
$delivery_address = isset($_POST['delivery_address']) ? $_POST['delivery_address'] : '';
$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

// Validate required fields
if (empty($delivery_address) || empty($payment_method)) {

    $_SESSION['error'] = "Please fill in all required fields.";
   header("Location: ../customer/confirm_order.php");
    exit;
}

// Place the order in the database
$order_id = create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address ) ;   
// If payment method is "card_payment", redirect to Paystack
if ($payment_method == 'card_payment') {
    $payment_url = initiate_paystack_payment($user_email,$order_id, $total_price); 
    var_dump ($payment_url);// This function sends the order to Paystack for processing
    
    if ($payment_url) {
            header("Location: " . $payment_url); // Redirect to Paystack payment page
        exit;
    } else {
        // If payment_url is null, show an error message
        echo "Error initiating payment. Please try again later.";
        exit;
    }
}


// if ($payment_method == 'cash_on_delivery') {
//     confirm_order($order_id);  // Confirm order for COD
//     $_SESSION['success'] = "Order placed successfully. We will contact you shortly.";
//     header("Location: ../customer/order_summary.php?order_id=" . $order_id);
//     exit;
// }
}else{
// Fallback error if something went wrong
$_SESSION['error'] = "Something went wrong. Please try again later.";
echo "fghjkl";
//header("Location: ../customer/order_confirmation.php");
//exit;
}
?>
