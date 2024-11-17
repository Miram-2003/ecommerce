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
        $loginResult = $store->validateLogin($email, $password);
    
        if ($loginResult['success']) {
            // Login successful, start a session and store seller info
        
            $seller = $loginResult['seller'];
            $_SESSION['seller_id'] = $seller['store_id'];
            $_SESSION['seller_name'] = $seller['store_name'];
            $_SESSION['email'] = $seller['email'];
           
            header("Location: ../sellers_view/dashboard.php");
            exit();
        } else {
            // Login failed, set error message
          
            $_SESSION['error'] = $loginResult['error'];
            
           
            header("Location: ../login/login.php");
            exit();
        }
    }
    
    // Fetch all sellers (admin feature)
   function getAllSellers() {
        $store = new store_class();
        return $store->getAllSellers();
    }

?>
