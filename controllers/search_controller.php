<?php

require_once("../controllers/product_controller.php");

function searchItem($search_query) {
    $products = get_allproduct() ; // Ensure this function is defined in your product controller

// Filter products based on the search query
$filtered_products = array_filter($products, function($product) use ($search_query) {
    return stripos($product['name'], $search_query) !== false || stripos($product['description'], $search_query)!== false ; // Case-insensitive search
});

return $filtered_products;
}

?>