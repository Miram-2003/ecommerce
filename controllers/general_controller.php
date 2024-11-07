<?php

require_once("../classes/brand_class.php");

//sanitize data


//branb controlls

function add_brand_ctr($brandname){
    $addbrand = new general_class();
    return $addbrand->add_brand($brandname);
}

function get_brand_ctr() {
   
    $get_brand = new general_class();
    $result = $get_brand->get_brand();

    return $result;
}

function get_a_brand_ctr($id){
    $id = (int)$id;
    $a_brand = new general_class();
    $result = $a_brand->get_a_brand($id);
    return $result;
}

function delete($id){
    $a_brand = new general_class();
    $result = $a_brand-> delete($id);
    return $result;

}



//--SELECT--//

//--UPDATE--//

//--DELETE--//

?>
