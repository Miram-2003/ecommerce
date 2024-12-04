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
$total_price = array_reduce($cart_items, function ($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);
$total_price = $total_price + 50 + (0.05 * $total_price);

if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    $delivery_address = $_POST['delivery_address'];  // Get the delivery address from the form
    $invoice = rand(10000, 99999);
    var_dump($payment_method);

    // Calculate the total price
   
    // Add delivery fee and VAT
   
    $currency = 'GHS';  
    $date = date('Y-m-d H:i:s');
    $date_de = date('Y-m-d', strtotime($date . ' + 1 day'));
  
    if ($payment_method == 'cash on delivery') {
      
       
        $order_id = create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address);
       
        sendOrderConfirmationEmailCash($customer_email, $customer_name, $invoice, $payment_method,  $total_price, $currency, $date, $date_de);
        header("Location: ../customer/orders_view.php"); 
        exit();
    }
 } else { 
        if (isset($_GET['reference'])) {
           
            $invoice = $_GET['reference'];
            $delivery_address = $_GET['delivery_address']; 
           var_dump($invoice, $delivery_address);
            
            $payment_method = "card payment";
         
            $payment_status = verify_payment( $invoice);
         
           
            $order_id = create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address);
            if ($payment_status->status == true) {
                $status = "paid";
                $email = $payment_status->data->customer->email;
                update_order_status($order_id, $status);
              
                echo $email;
                //sendOrderConfirmationEmailOnline($customer_email, $customer_name, $invoice, $payment_method, $total_price, $currency, $date, $date_de);

                header("Location: ../customer/orders_view.php");
                //exit();
            } else {
                // If payment failed, show an error message
                echo "Payment failed. Please try again.";
                //header("Location: ../customer/cart_view.php");  // Optionally, redirect to the cart page
                //exit();
            }
        }
    }

