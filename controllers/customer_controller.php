<?php
require_once("../classes/customer.php");
    function registerSeller($data) {
        $store = new customer_class();
        
     
        if (($store->emailExists($data['email']))) {
            $_SESSION['errors'] = ['email' => 'Email already exists.'];
          
            header('Location: ../login/customer_register.php') ;
            
        }


        // Register the seller
        $result = $store->registerUser(
            $data['name'],
            $data['email'],
           
           
            $data['phone'],
            
            $data['region'],
            $data['city'],
            $data['password'],
      
          
        );

        if ($result) {
            header('Location:../login/customer_login.php');
            exit();
        } else {
            header('Location:../login/customer_register.php');
            exit();
        }
    }

    // Login a seller
    function loginSeller($email, $password) {
        $store = new customer_class();
        $loginResult = $store->validateLogin($email, $password);
    
        if ($loginResult['success']) {
            // Login successful, start a session and store seller info
        
            $seller = $loginResult['seller'];
            $_SESSION['seller_id'] = $seller['store_id'];
            $_SESSION['seller_name'] = $seller['store_name'];
            $_SESSION['email'] = $seller['email'];
            $_SESSION['image'] = $seller['img'];
           
            header("Location: ../customer/customer_index.php");
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
