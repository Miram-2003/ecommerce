<?php

require_once('../classes/order_class.php');

function create_order($user_id, $total_price) {
    $order = new order_class;
    return $order->create_order_in_db($user_id, $total_price);
}

function add_order_item($order_id, $product_id, $quantity, $price) {
    $order = new order_class;
    return $order->add_order_item_in_db($order_id, $product_id, $quantity, $price);
}

?>