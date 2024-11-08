<?php
require_once("../controllers/store_controller.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "hello";
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'storeName' => $_POST['store_name'],
        'phone' => $_POST['phone'],
        'country' => $_POST['country'],
        'zone' => $_POST['zone'],
        'password' => $_POST['password']
    ];

    $response = registerSeller($data);
    if ($response['success']) {
        header('Location: ../login/login.php');
    } else {
        header('Location: ../login/register.php?error=' . $response['message']);
    }
}
?>