
<?php


require_once("../controllers/product_controller.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id =$_POST["seller"];
    $name = $_POST["productName"];
    $prod_des = $_POST["product_description"];
    $pro_mcat = $_POST["main_cat"];
    $pro_scat = $_POST["sub_cat"];
    $prod_price = $_POST["product_price"];
    $prod_qty = $_POST["stock_quantity"];
    $prod_img = $_POST["product_image"];
 
    
    if(add_product_ctr($pro_cat, $prod_brand, $prod_title, $prod_price, $prod_des, $prod_key)){
        header("Location: ../view/product_view.php");
       
    }else{
        echo "noooo";
    }



}




?>