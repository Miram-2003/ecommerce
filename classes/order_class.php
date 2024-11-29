<?php
require_once("../settings/db_class.php");
require_once("../controllers/cart_controller.php");

class order_class extends db_connection{
  
  function place_order($invoice, $user_id, $total_price, $payment_method, $delivery_address ) {
    // Connect to the database
    $conn =$this->db_conn();

    // Create the order
    $query = "INSERT INTO orders (`invoice_no`, `customer_id`,  `total_amount`, `payment_method`,  `delivery_address`)
              VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iidss", $invoice, $user_id, $total_price, $payment_method, $delivery_address);
    $stmt->execute();
    
    // Get the last inserted order ID
    $order_id = $stmt->insert_id;

    $cart_items = get_cart_items($user_id);
    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        
        $item_query = "INSERT INTO order_items (order_id, product_id, quantity, price)
                       VALUES (?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_query);
        $item_stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $item_stmt->execute();
    }

    // Clear the cart after order is placed
    clear_cart($user_id);
  return $order_id;
}


function get_order_details($order_id) {
    // Connect to the database
    $conn = $this->db_conn();

    // Get the order details
    $query = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function get_order_items($order_id) {
 
    $conn = $this->db_conn();

  
    $query = "SELECT * FROM order_items WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);



}
  function get_order_history($user_id) {
    // Connect to the database
    $conn = $this->db_conn();

    // Get the order history
    $query = "SELECT * FROM orders WHERE customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
  function update_order_status($order_id, $status) {
    // Connect to the database
    $conn = $this->db_conn();

    // Update the order status
    $query = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $order_id);
    return $stmt->execute();

}
}
?>