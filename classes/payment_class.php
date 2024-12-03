<?php
require_once('../settings/db_class.php');

class payment extends db_connection
{
    public function recordPayment( $amt, $customer_id, $order_id, $currency, $payment_date, $mode, $reference)
    {
        $ndb = new db_connection();
        $this->db = $ndb->db_conn();

        $sql = "INSERT INTO `payment`( `amt`, `customer_id`, `order_id`, `currency`, `payment_date`, `mode`, `reference`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiissss",$amt, $customer_id, $order_id, $currency, $payment_date, $mode, $reference);
        return $stmt->execute();
    }

    public function getPaymentDetailsByOrderId($order_id)
    {
        $ndb = new db_connection();
        $this->db = $ndb->db_conn();

        $sql = "SELECT * FROM `payment` WHERE `order_id` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getCustomerPaymentHistory($customer_id)
    {
        $ndb = new db_connection();
        $this->db = $ndb->db_conn();

        $sql = "SELECT * FROM `payment` WHERE `customer_id` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

   
}
?>