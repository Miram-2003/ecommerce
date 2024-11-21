<?php
require_once("../settings/db_class.php");
class order_class extends db_connection{
  
    function create_order_in_db($user_id,  $total_price) {
        $sql = "INSERT INTO orders (customer_id, total_amount) VALUES ($user_id,  $total_price)";
      if( $this->db_query($sql)){
        return $this->db->insert_id;
      }else{
        return false;
      };
    }
    
    function add_order_item_in_db($order_id, $product_id, $quantity, $price) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (1, $product_id, $quantity, $price)";
        return $this->db_query($sql);
    }
    
}


?>