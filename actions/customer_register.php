<?php
require_once("controllers/customer_controller.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['errors']);
    $error =[];
    //$error['emailexist'] = $_SESSION['exist'];
    $data = [
        'name' => htmlspecialchars(trim($_POST['name'])),
        'email' => htmlspecialchars(trim($_POST['email'])),
        
        'phone' => htmlspecialchars(trim($_POST['phone'])),
        
        'region' => htmlspecialchars(trim($_POST['region'])),
        'city' => htmlspecialchars(trim($_POST['city'])),
        'password' => htmlspecialchars(trim($_POST['password'])),
        'confirmpass' => htmlspecialchars(trim($_POST['confirm_password'])),
        
    ];


    if (empty($data['name']) || $data['name']== ' ') {
        $error['name'] = "Username is required or cannot be empty.";
    }elseif(!preg_match('/^[a-z A-Z_]{3,30}$/', $data['name'])){
        $error['name'] = "User name can not contain numbers or special symbols";
    }

    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || $data['email'] == " ") {
        $error['email'] = "A valid email is required.";
    }

  


    if (empty($data['phone']) || $data['phone']== ' ') {
        $error['phone'] = "Contact is required or cannot be empty.";
    }elseif(!preg_match('/^\+?[0-9]{1,4}?[ \-\.]?\(?[0-9]{1,3}?\)?[ \-\.]?[0-9]{3,4}[ \-\.]?[0-9]{3,4}$/', $data['phone'])){
        $error['phone'] = "Invalid number";
    }
    

    if (empty($data['region']) || $data['region']== ' ') {
        $error['region'] = "Region name is required or cannot be empty.";
    }elseif(!preg_match('/^[a-z A-Z_]{3,15}$/', $data['region'])){
        $error['region'] = "Invalid region name";
    }


    if (empty($data['city']) || $data['city']== ' ') {
        $error['city'] = "City/Town Name is required or cannot be empty.";
    }elseif(!preg_match('/^[a-z A-Z_]{3,15}$/', $data['city'])){
        $error['city'] = "Invalid city name";
    } 


        if (empty($data['password']) || !preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$.,!%*?&])[A-Za-z\d@$.,!%*?&]{8,}$/', $data['password'])) {
            $error['password'] = "Invalid Password. Password must be \n 
                            -at least 8 characters long \n -and include at least one uppercase letter\n at least one lowercase letter \n at least one number\nat least one special symbol.";
        }

        if(empty($data['confirmpass']) || $data['confirmpass'] == " "){
            $error['conpass'] = "Please confirm your password";
        }elseif($data['password'] !== $data['confirmpass']){
            $error['conpass'] = "Passwords do not match";

        }


    
        if (!empty($error)) {
           // var_dump($error);
            $_SESSION['errors'] = $error;
            $_SESSION['old'] = $data;
          ;
            
           header("Location: ../login/customer_register.php");
            exit;
        }else{
          
        
           registerSeller($data);
        
        }

    }else{
        echo "M.I.R.2003,iam";

    }



    


?>