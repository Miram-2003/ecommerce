<?php
session_start();

require_once("../controllers/order_controller.php");
require_once("../controllers/payment_controller.php");
require_once("../controllers/cart_controller.php");
require_once("../controllers/mails.php");

$user_id = $_SESSION['user_id'];
$customer_email = $_SESSION['email'];
$customer_name = $_SESSION['user_name'];
$cart_items = get_cart_items($user_id);

if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    $delivery_address = $_POST['delivery_address'];  // Get the delivery address from the form
    $invoice = rand(10000, 99999);

    // Calculate the total price
    $total_price = array_reduce($cart_items, function ($total, $item) {
        return $total + ($item['price'] * $item['quantity']);
    }, 0);

    // Add delivery fee and VAT
    $total_price = $total_price + 50 + (0.05 * $total_price);  
    $currency = 'GHS';  
    $date = date('Y-m-d H:i:s');
    $date_de = date('Y-m-d', strtotime($date . ' + 1 day'));
  
    if ($payment_method == 'cash_on_delivery') {
        // Create order for cash on delivery
        $order_id = create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address);
        var_dump($order_id);  // Debugging
        sendOrderConfirmationEmailCash($customer_email, $customer_name, $invoice, $payment_method,  $total_price, $currency, $date, $date_de);
        header("Location: ../customer/cart_view.php");  // Redirect after placing the order
        exit();
    } else {
        // Handle online payment (e.g., verify payment)
        if (isset($_GET['reference'])) {
            $reference = $_GET['reference'];
            $delivery_address = $_GET['delivery_address']; 

            // Verify the payment
            $payment_status = verify_payment($reference);
            
            if ($payment_status == 'success') {
                // If payment is successful, create the order
                $order_id = create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address);
                sendOrderConfirmationEmailOnline($customer_email, $customer_name, $invoice, $payment_method, $total_price, $currency, $date, $date_de);

                // Redirect to a success page (order confirmation)
                header("Location: ../customer/order_confirmation.php?order_id=" . $order_id);
                exit();
            } else {
                // If payment failed, show an error message
                echo "Payment failed. Please try again.";
                header("Location: ../customer/cart_view.php");  // Optionally, redirect to the cart page
                exit();
            }
        }
    }
}
