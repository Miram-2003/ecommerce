<?php

require_once("../controllers/product_controller.php");

function displayproduct(){
    $result = get_product_ctr();
        foreach ($result as $row) {
            echo "<div>". $row['product_title']."<div>";

            echo "<div>". $row['product_price']."<div>";

            echo "<button>
            <a href=\"../view/add_cart.php?id=" . $row['product_id'] . "\"> Add to Cart</a>
            </button>";

            echo "<br><br>";
    
}
}

function display__option(){
    $result = get_brand_ctr(); // Fetch brand data
    $option = "<select name='brand'>";  
    $option .= "<option></option>";    // Start the select element

    foreach($result as $row){
        // Append each option to the select element
        $option .= "<option value ='".$row['brand_id']."'> ".$row['brand_name']." </option>";
    }

    $option .= "</select>";    // Close the select element
    return $option;
}




?>