<?php


include("../controllers/product_controller.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $pro_cat = $_POST["cat"];
    $prod_brand = $_POST["brand"];
    $prod_title = $_POST["title"];
    $prod_price = $_POST["price"];
    $prod_des = $_POST["desc"];
    $prod_key = $_POST["word"];

    echo $pro_cat, $prod_brand, $prod_title, $prod_price, $prod_des, $prod_key;
    if(add_product_ctr($pro_cat, $prod_brand, $prod_title, $prod_price, $prod_des, $prod_key)){
        header("Location: ../view/product_view.php");
       
    }else{
        echo "noooo";
    }



}




?>