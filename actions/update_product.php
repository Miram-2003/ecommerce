<?php
require_once("../controllers/product_controller.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $prod_name = htmlspecialchars($_POST["product_name"]);
 
    $prod_des = htmlspecialchars($_POST["product_description"]);
    $pro_id = htmlspecialchars($_POST["product_id"]);
  

    $prod_price = htmlspecialchars($_POST["product_price"]);
    
    $prod_qty = htmlspecialchars($_POST["stock_quantity"]);
   

    $update = updateproduct($prod_name , $prod_des, $prod_price, $prod_qty, $pro_id);
   var_dump($update);
    echo "..";
    if($update){
        header("Location: ../sellers_view/seller_product_view.php");
        exit();
    }

}


   ?>