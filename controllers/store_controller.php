<?php
require_once("../classes/store_class.php");
    function registerSeller($data) {
        $store = new store_class();
        
     
        if (($store->emailExists($data['email']))) {
            $_SESSION['errors'] = ['email' => 'Email already exists.'];
          
            header('Location: ../login/register.php') ;
            
        }


        // Register the seller
        $result = $store->registerStore(
            $data['name'],
            $data['email'],
            $data['storeName'],
            $data['phone'],
            $data['country'],
            $data['region'],
            $data['city'],
            $data['password'],
            $data["imageName"]
        );

        if ($result) {
            header('Location: ../login/login.php');
            exit();
        } else {
            header('Location: ../login/register.php');
            exit();
        }
    }

    // Login a seller
   function loginSeller($email, $password) {
        $store = new store_class();
        $seller = $store->validateLogin($email, $password);

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
        $store = new store_class();
        return $store->getAllSellers();
    }

?>
M.I.R.2003,iam