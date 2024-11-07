<?php
include("../controllers/general_controller.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $brandname = $_POST["brand"];
    if(add_brand_ctr($brandname)){
        header("Location: ../view/brand_view.php");
       
    }else{
        echo "noooo";
    }



}

?>