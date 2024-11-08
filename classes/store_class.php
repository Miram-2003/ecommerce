<?php
require_once("../settings/db_class.php");

class store_class extends db_connection {

    public function registerStore($name, $email, $storeName, $phone, $country, $zone, $password) {
        $ndb = new db_connection();
        $this->db = $ndb->db_conn();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO stores (fullName, email, store_name, contact, country, District, password_hash)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssisss", $name, $email, $storeName, $phone, $country, $zone, $hashedPassword);
        return $stmt->execute();
    }

    // Check if an email already exists
    public function emailExists($email) {
        $ndb = new db_connection();
        $sql = "SELECT COUNT(*) FROM `stores` WHERE `email` = '$email'";
        $result =$this->db_fetch_one($sql);
        $count = $result['COUNT(*)'];
        return $count > 0;

        

    }

    // Validate login
    public function validateLogin($email, $password) {
        $ndb = new db_connection();
        $this->db = $ndb->db_connect();
        $sql = "SELECT * FROM stores WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $seller = $result->fetch_assoc();
        if ($seller && password_verify($password, $seller['password'])) {
            return $seller; 
        }
        return false; 
    }

  
    public function getAllSellers() {
        $ndb = new db_connection();
        $this->db = $ndb->db_connect();

        $sql = "SELECT * FROM stores";

        $result = $this->db->query($sql);
        $sellers = [];
        while ($row = $result->fetch_assoc()) {
            $sellers[] = $row;
        }

        return $sellers;
    }
}

?>
