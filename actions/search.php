<?php

require_once("../controllers/product_controller.php");


$id = "2";
// if (isset($_GET['cat'])) {
//     $id = trim($_GET['cat']);

    $product=get_product_by_cat($id);

    var_dump( $product);



// }


?>