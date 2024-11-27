<?php
require_once("../classes/customer.php");
    function registerUser($data) {
        $User = new customer_class();
        
     
        if (($User->emailExists($data['email']))) {
            $_SESSION['errors'] = ['email' => 'Email already exists.'];
          
            header('Location: ../login/customer_register.php') ;
            
        }


        // Register the User
        $result = $User->registerUser(
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

    // Login a User
    function loginUser($email, $password) {
        $User = new customer_class();
        $loginResult = $User->validateLogin($email, $password);
    
        if ($loginResult['success']) {
            // Login successful, start a session and user$User User info
          
            $User = $loginResult['user'];
            $_SESSION['user_id'] = $User['user_id'];
            $_SESSION['user_name'] = $User['fullName'];
            $_SESSION['email'] = $User['email'];
            $_SESSION['contact'] = $User['contact'];
         
           
             header("Location: ../customer/customer_index.php");
             exit();
        } else {
            // Login failed, set error message
          
            $_SESSION['error'] = $loginResult['error'];
            
           
            header("Location: ../login/customer_login.php");
            exit();
        }
    }
    
    // Fetch all Users (admin feature)
   function getAllUsers() {
        $User = new customer_class();
        return $User->getAllUsers();
    }

?>
