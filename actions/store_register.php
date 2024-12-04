<?php
require_once("../controllers/store_controller.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['errors']);
    $error =[];
    //$error['emailexist'] = $_SESSION['exist'];
    $data = [
        'name' => htmlspecialchars(trim($_POST['name'])),
        'email' => htmlspecialchars(trim($_POST['email'])),
        'storeName' => htmlspecialchars(trim($_POST['store_name'])),
        'phone' => htmlspecialchars(trim($_POST['phone'])),
        'country' => htmlspecialchars(trim($_POST['country'])),
        'region' => htmlspecialchars(trim($_POST['region'])),
        'city' => htmlspecialchars(trim($_POST['city'])),
        'password' => htmlspecialchars(trim($_POST['password'])),
        'confirmpass' => htmlspecialchars(trim($_POST['confirm_password'])),
        'imageName' => null,
    ];


    if (empty($data['name']) || $data['name']== ' ') {
        $error['name'] = "Username is required or cannot be empty.";
    }elseif(!preg_match('/^[a-z A-Z_]{3,30}$/', $data['name'])){
        $error['name'] = "User name can not contain numbers or special symbols";
    }

    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || $data['email'] == " ") {
        $error['email'] = "A valid email is required.";
    }

    if (empty($data['storeName']) || $data['storeName']== ' ') {
        $error['store'] = "Store Name is required or cannot be empty.";
    }elseif(!preg_match('/^[a-z A-Z_]{3,15}$/', $data['storeName'])){
        $error['store'] = "Invalid store name";
    }


    if (empty($data['phone']) || $data['phone']== ' ') {
        $error['phone'] = "Contact is required or cannot be empty.";
    }elseif(!preg_match('/^\+?[0-9]{1,4}?[ \-\.]?\(?[0-9]{1,3}?\)?[ \-\.]?[0-9]{3,4}[ \-\.]?[0-9]{3,4}$/', $data['phone'])){
        $error['phone'] = "Invalid number";
    }
    if (empty($data['country']) || $data['country']== ' ') {
        $error['country'] = "Country name is required or cannot be empty.";
    }elseif(!preg_match('/^[a-z A-Z_]{3,15}$/', $data['country'])){
        $error['country'] = "Invalid country name";
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


    
    // Handle Optional Image
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $image = $_FILES['image'];
    
        // Validate the uploaded file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowedTypes)) {
            $error['image'] = "Only JPEG, PNG, and GIF files are allowed.";
        }
    
        if ($image['size'] > 2 * 1024 * 1024) { // 2 MB limit
            $error['image'] = "The image must be less than 2 MB.";
        }
    
        if (empty($errors['image'])) {
            // Save the uploaded file
            $uploadDir ="../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create the directory if not exists
            }
    
            $filename= uniqid() . '-' . basename($image['name']);
            $data['imageName']= $filename;
            $uploadPath = $uploadDir . $filename;
    
            if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
                $error['image'] = "Failed to upload the image.";
                $data['imageName'] = null;
            } 
        }}

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
            
            header("Location: ../login/register.php");
            exit;
        }else{
            
        
           registerSeller($data);
        
        }

    }



    


?>