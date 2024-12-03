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

echo $user_id;
if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    $delivery_address = $_POST['delivery_address'];  // Get the delivery address from the form
    $invoice = rand(10000, 99999);

    $cart_items = get_cart_items($user_id);
    $total_price = array_reduce($cart_items, function ($total, $item) {
        return $total + ($item['price'] * $item['quantity']);
    }, 0);

    $total_price = $total_price + 50 + (0.05 * $total_price);  // Add delivery fee and 5% VAT
    $currency = 'GHS';  
    $date = date('Y-m-d H:i:s');
    $date_de = date('Y-m-d', strtotime($date. ' + 1 day'));
  
    if ($payment_method == 'cash_on_delivery') {
        echo "..fd";
        $order_id = create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address);
        var_dump($order_id);
        sendOrderConfirmationEmailCash($customer_email, $customer_name, $invoice, $payment_method,  $total_price, $currency, $date, $date_de);
        echo "..fd";
        header("Location: ../customer/cart_view.php");  // Redirect to the action page
        exit();
    }else{
        echo "no";
    }
}


if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];
    $delivery_address = $_GET['delivery_address']; 
    $pay = verify_payment($reference); 
    $payment_method = 'card_payment';
    
    

    if($pay->status == true){
        $data = $pay->data;

        $invoice = $data->receipt_number;
        $amount = $data->amount;
        $amount = $amount / 100;
        $method = $data->channel;
        $currency = $data->currency;
        $reference = $data->reference;
        $date = $data->paid_at;

        $order_id = create_order($invoice, $user_id, $amount, $payment_method, $delivery_address);
        

       $payment =  recordPayment( $amount, $user_id, $order_id, $currency, $date, $method, $reference);
        if($payment){
            $status = 'paid';
            $date_de = date('Y-m-d', strtotime($date. ' + 1 day'));
            update_order_status($order_id, $status);
            sendOrderConfirmationEmail($customer_email, $customer_name, $invoice, $payment_method, $amount, $currency, $date, $date_de);  
            header("Location: ../customer/cart_view.php");         
        }

         // Redirect to the action page
    } else {
    
        $order_id = create_order($invoice, $user_id, $amount, $payment_method, $delivery_address);

        header("Location: ../customer/cart_view.php");  // Redirect to the action page
    }
}
?>
