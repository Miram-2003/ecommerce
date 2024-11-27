<?php

require_once('../classes/order_class.php');

function create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address ) {
    $order = new order_class;
    return $order->place_order($invoice, $user_id, $total_price, $payment_method, $delivery_address );
}

// function add_order_item($order_id, $product_id, $quantity, $price) {
//     $order = new order_class;
//     return $order->add_order_item_in_db($order_id, $product_id, $quantity, $price);
// }

?>