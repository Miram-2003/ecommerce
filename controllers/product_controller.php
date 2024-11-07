<?php
require("../classes/product_class.php");


function add_product_ctr($pro_cat, $prod_brand, $prod_title, $prod_price, $prod_des, $prod_key){
    $addproduct = new product_class();
    return $addproduct->add_product($pro_cat, $prod_brand, $prod_title, $prod_price, $prod_des, $prod_key);
}


function get_product_ctr() {
   
    $get_product = new product_class();
    $result = $get_product->get_product();

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