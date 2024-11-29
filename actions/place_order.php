<?php
session_start();

require_once("../controllers/order_controller.php");
require_once("../controllers/payment_controller.php");
require_once("../controllers/cart_controller.php");


$user_id = $_SESSION['user_id'];
if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    $delivery_address = $_POST['delivery_address'];  // Get the delivery address from the form
    $invoice = rand(10000, 99999);

    $cart_items = get_cart_items($user_id);
    $total_price = array_reduce($cart_items, function ($total, $item) {
        return $total + ($item['price'] * $item['quantity']);
    }, 0);

    $total_price = $total_price + 50 + (0.05 * $total_price);  // Add delivery fee and 5% VAT

    if ($payment_method === 'cash_on_delivery') {
        $order_id = create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address);
        header("Location: ../customer/orders_view.php");  // Redirect to the action page
        exit();
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
        var_dump($order_id);

       $payment =  recordPayment( $amount, $user_id, $order_id, $currency, $date, $method, $reference);
        if($payment){
            $status = 'paid';
            update_order_status($order_id, $status);
        }

        header("Location: ../customer/orders_view.php");  // Redirect to the action page
    } else {
    
        $order_id = create_order($invoice, $user_id, $amount, $payment_method, $delivery_address);

        header("Location: ../customer/orders_view.php");  // Redirect to the action page
    }
}
?>
