<?php
//start session
session_start(); 

//for header redirection
ob_start();

//funtion to check for login

function check_login(){
    if (!isset($_SESSION["user_id"]) && !isset($_SESSION["name"])) {
        header("Location:../login/login.php");
        die();
    }
}



//function to get user ID
function check_id(){

    if (!isset($_SESSION["store_id"])) {
        return false;
    }else{
         return $_SESSION["store_id"];
    }
}




//function to check for role (admin, customer, etc)



?>