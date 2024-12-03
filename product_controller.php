<?php
require_once("product_class.php");


function add_product_ctr($user_id, $pro_mcat, $pro_scat, $prod_name, $prod_price, $prod_des, $prod_qty, $prod_img){
    $addproduct = new product_class();
    return $addproduct->add_product($user_id, $pro_mcat, $pro_scat, $prod_name, $prod_price, $prod_des, $prod_qty, $prod_img);
}


function get_product_ctr($id) {
   
    $get_product = new product_class();
    $result = $get_product->get_product_by_seller($id);
    return $result;
}

function get_allproduct() {
   
    $get_product = new product_class();
    $result = $get_product->get_all_product();
    return $result;
}




function get_a_product_ctr($id){
    $id = (int)$id;
    $a_product = new product_class();
    $result = $a_product->get_a_product($id);
    return $result;
}

function delete_product($id){
    $a_product = new product_class();
    $result = $a_product-> delete($id);
    return $result;

}


?>