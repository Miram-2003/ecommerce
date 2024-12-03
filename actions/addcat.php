<?php
include("controllers/cat_controller.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $catname = $_POST["cat"];
    if(add_cat_ctr($catname)){
        header("Location: ../view/cat_view.php");
       
    }else{
        echo "noooo";
    }



}

?>