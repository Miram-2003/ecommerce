<?php

require_once("classes/cart_class.php");
function add_to_cart_ctr($user_id, $product_id, $quantity, $price){

    $cart = new cart_class();
   

    // Check if the product is already in the cart
    $existingCartItem = $cart->get_cart_item($user_id, $product_id);

    if ($existingCartItem) {
        // Update quantity if the product is already in the cart
        $new_quantity = $existingCartItem['quantity'] + $quantity;
        return $cart-> update_cart_item($user_id, $product_id, $new_quantity);
    } else {
        // Insert a new cart item
        return  $cart->add_new_cart_item($user_id, $product_id, $quantity, $price);
    }
}


function get_cart_items($user_id) {
    $cart = new cart_class();
    // Call the model function to get cart items
    return $cart->fetch_cart_items($user_id);
}

function update_cart_item($user_id, $product_id, $quantity) {
    $cart = new cart_class();
    if ($quantity <= 0) {
        $cart->remove_cart_item($user_id, $product_id);
        return true;
    }

    return $cart->update_cart_item_in_db($user_id, $product_id, $quantity);
}

function delete_cart_item($user_id, $product_id) {
    $cart = new cart_class();
   return $cart->remove_cart_item($user_id, $product_id);




}

function clear_cart($user_id){
    $cart = new cart_class();
    return $cart->clear_cart($user_id);
}

