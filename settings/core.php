<?php

function check_login(){
    if (!isset($_SESSION["seller_id"]) && !isset($_SESSION["seller_name"])) {
        header("Location:../login/login.php");
        die();
    }
}


function check_id(){

    if (!isset($_SESSION["store_id"])) {
        return false;
    }else{
         return $_SESSION["store_id"];
    }
}




//function to check for role (admin, customer, etc)



?>