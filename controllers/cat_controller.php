<?php


require_once("../classes/cat_class.php");


//cat controols

function add_cat_ctr($catname){
    $addcat = new cat_class();
    return $addcat->add_cat($catname);
}


function get_cat_ctr() {
   
    $get_cat = new cat_class();
    $result = $get_cat->getCategoryOptions();

    return $result;
}

function getAllsubcat(){
    $get_cat = new cat_class();
    $result = $get_cat->getfilterCategoryOptions();
}

function get_a_cat_ctr($id){
    $id = (int)$id;
    $a_brand = new cat_class();
    $result = $a_brand->get_a_cat($id);
    return $result;
}

function delete_cat($id){
    $a_brand = new cat_class();
    $result = $a_brand-> delete($id);
    return $result;

}


function getMainCat($id){
    $cat = new cat_class();
    $result = $cat->getMainName($id);
    return $result;
}

function getSubCat($id){

    $cat = new cat_class();
    $result = $cat->getSubName($id);
    return $result;
}

//--INSERT--//

//--SELECT--//

//--UPDATE--//

//--DELETE--//



?>
