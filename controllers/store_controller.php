<?php
require_once("../classes/store_class.php");

    function registerSeller($data) {
        $store = new store_class();
        if (empty($data['name']) || empty($data['email']) || empty($data['storeName']) ||
            empty($data['phone']) || empty($data['country']) || empty($data['zone']) || empty($data['password'])) {
            return ['success' => false, 'message' => 'All fields are required.'];
        }

        // Check if the email already exists
        if ($store->emailExists($data['email'])) {
            return ['success' => false, 'message' => 'Email already exists.'];
        }

        // Register the seller
        $result = $store->registerStore(
            $data['name'],
            $data['email'],
            $data['storeName'],
            $data['phone'],
            $data['country'],
            $data['zone'],
            $data['password']
        );

        if ($result) {
            return ['success' => true, 'message' => 'Seller registered successfully.'];
        } else {
            return ['success' => false, 'message' => 'Failed to register seller. Please try again.'];
        }
    }

    // Login a seller
   function loginSeller($email, $password) {
        $seller = validateLogin($email, $password);

        if ($seller) {
            // Start a session and store seller info
            session_start();
            $_SESSION['seller_id'] = $seller['id'];
            $_SESSION['seller_name'] = $seller['fullName'];
            return ['success' => true, 'message' => 'Login successful.'];
        } else {
            return ['success' => false, 'message' => 'Invalid email or password.'];
        }
    }

    // Fetch all sellers (admin feature)
   function getAllSellers() {
        return $this->storeModel->getAllSellers();
    }

?>
