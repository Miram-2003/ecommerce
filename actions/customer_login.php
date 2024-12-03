<?php

require_once("controllers/customer_controller.php");
session_start();

if (isset($_POST["submit"])) {
    unset($_SESSION['errors']);
    $error = [];
    //$error['emailexist'] = $_SESSION['exist'];
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    loginUser($email, $password);
}

?>