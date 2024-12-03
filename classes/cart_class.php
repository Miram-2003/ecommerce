<?php

require_once("settings/db_class.php");
class cart_class extends db_connection {

    public function get_cart_item($user_id, $product_id) {
        $sql = "SELECT * FROM `cart` WHERE `user_id` = '$user_id' AND   `product_id` = '$product_id'";
        return $this->db_fetch_one($sql);
    }

    public function update_cart_item($user_id, $product_id, $quantity) {
        $sql = "UPDATE `cart` SET `quantity` = '$quantity' WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
        return $this->db_query($sql);
    }
    
    function add_new_cart_item($user_id, $product_id, $quantity, $price) {
        $sql = "INSERT INTO `cart` (`user_id`, `product_id`, `quantity`, `price`) VALUES ('$user_id', '$product_id', '$quantity', '$price')";
        return $this->db_query($sql);
    }



    function fetch_cart_items($user_id) {
        // SQL query to get cart items with product details
        $sql = "SELECT c.product_id, c.quantity, c.price, p.name AS product_name, p.img AS product_image 
                FROM 
                    cart c
                JOIN 
                    products p ON c.product_id = p.product_id
                WHERE 
                    c.user_id ='$user_id'";
    
        // Execute the query and fetch the results
        return $this->db_fetch_all($sql);
    }

  function update_cart_item_in_db($user_id, $product_id, $quantity) {
        $sql = "UPDATE `cart` SET `quantity`='$quantity'  WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
    
        return $this->db_query($sql);
    }

    function remove_cart_item($user_id, $product_id) {
        $sql = "DELETE FROM `cart` WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
        return $this->db_query($sql);
    }


    function clear_cart($user_id) {
        $sql = "DELETE FROM cart WHERE user_id = $user_id";
        return $this->db_query($sql);
    }
    
    
    
    
    

}




?>