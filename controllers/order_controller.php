<?php

require_once('classes/order_class.php');

function create_order($invoice, $user_id, $total_price, $payment_method, $delivery_address ) {
    $order = new order_class;
    return $order->place_order($invoice, $user_id, $total_price, $payment_method, $delivery_address );
}

function get_order_details($order_id) {
    $order = new order_class;
    return $order->get_order_details($order_id);
}

function get_order_items($order_id) {
    $order = new order_class;
    return $order->get_order_items($order_id);
}


function get_orders($user_id) {
    $order = new order_class;
    return $order-> get_order_history($user_id);
}


 function update_order_status($order_id, $status) {
    $order = new order_class;
    return $order->update_order_status($order_id, $status);

 }
?>