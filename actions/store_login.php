<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../controllers/store_controller.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['errors']);
    $error =[];
    //$error['emailexist'] = $_SESSION['exist'];
   $email = htmlspecialchars(trim($_POST['email']));
   $password = htmlspecialchars(trim($_POST['password']));
   
   loginSeller($email, $password);



        
}
?>