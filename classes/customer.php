<?php
require_once("settings/db_class.php");

class customer_class extends db_connection
{

    public function registerUser($name, $email, $phone, $region, $city, $password)
    {
        $db = $this->db_conn();
        if (!$db) {
            return false;
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `Users`(`fullName`, `email`, `contact`, `region`, `city`, `password_hash`) 
                VALUES ('$name', '$email', '$phone', '$region', '$city', '$hashedPassword')";
    
        if (!$this->db_query($sql)) {
            error_log("Error registering user: " . mysqli_error($this->db));
            return false;
        }
    
        return true;
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
        $db = $this->db_conn();
        if (!$db) {
            return ['success' => false, 'error' => 'Database connection failed.'];
        }
    
        $sql = "SELECT * FROM `Users` WHERE `email` = '$email'";
        $result = $this->db_fetch_one($sql);
    
        if (!$result) {
            return ['success' => false, 'error' => 'Email not found.'];
        }
    
        if (!password_verify($password, $result['password_hash'])) {
            return ['success' => false, 'error' => 'Invalid email or password.'];
        }
    
        return ['success' => true, 'user' => $result];
    }
    

    public function getAllusers()
    {
        $ndb = new db_connection();
        $this->db = $ndb->db_conn();

        $sql = "SELECT * FROM stores";

        $result = $this->db->query($sql);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }
}


?>
