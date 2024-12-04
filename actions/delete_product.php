<?php
include("../controllers/product_controller.php");
if (!isset($_GET["product_id"])) {
    header("Location: ../sellers_view/seller_product_view.php");
    exit;
}else{
    $id = $_GET["product_id"];
    $result = delete_product($id);
    if ($result) {
        header("Location: ../sellers_view/seller_product_view.php");
        exit;
    }else{
        //header("Location: ../sellers_view/seller_product_view.php");
        echo"sorry something went wrrong";
        exit;
    }
        

}
?>