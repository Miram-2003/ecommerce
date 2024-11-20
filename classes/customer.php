<?php
require_once("../settings/db_class.php");

class customer_class extends db_connection
{

    public function registerUser($name, $email,  $phone, $region,  $city, $password)
    {
        $ndb = new db_connection();
        $this->db = $ndb->db_conn();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `Users`( `fullName`, `email`,  `contact`, `region`, `city`,`password_hash`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssisss", $name, $email,  $phone, $region, $city,  $hashedPassword);
        return $stmt->execute();
    }

    // Check if an email already exists
    public function emailExists($email)
    {
        $ndb = new db_connection();
        $con = $ndb->db_conn();
        $sql = "SELECT COUNT(*) AS count FROM `Users` WHERE `email` = ?";


        // Use the `db_query` method with prepared statements (assumes PDO or mysqli)
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $email); // Bind the email parameter as a string
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Check if the count is greater than 0
        return $row['count'] > 0;
    }


    // Validate login
    public function validateLogin($email, $password)
    {
        $ndb = new db_connection();
        $con = $ndb->db_conn();
    
        // Check if the email exists
        $sql = "SELECT * FROM Users WHERE email = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 0) {
            // Email not registered
            return ['success' => false, 'error' => 'Email not registered'];
        }
    
        $seller = $result->fetch_assoc();
    
        // Check if the password matches
        if (!password_verify($password, $seller['password_hash'])) {
            // Incorrect password
            return ['success' => false, 'error' => 'Incorrect password or emai address'];
        }
    
        // Email and password are correct
        return ['success' => true, 'seller' => $seller];
    }

    public function getAllSellers()
    {
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
