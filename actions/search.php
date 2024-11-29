<?php
require_once('../controllers/product_controller.php');

// Initialize the search query
$search_query = 'TV';

// Check if the search parameter is set
// if (isset($_GET['search'])) {
//     $search_query = trim($_GET['search']);
// }

// Fetch all products from the database
$products = get_allproduct() ; // Ensure this function is defined in your product controller

// Filter products based on the search query
$filtered_products = array_filter($products, function($product) use ($search_query) {
    return stripos($product['name'], $search_query) !== false; // Case-insensitive search
});

// Example function to display filtered products
function display_products($products) {
    foreach ($products as $product) {
        echo "<div class='product'>";
        echo "<h5>" . htmlspecialchars($product['name']) . "</h5>";
        echo "<p>Price: GHC " . number_format($product['price'], 2) . "</p>";
        echo "<p>Category: " . htmlspecialchars($product['category']) . "</p>";
        echo "</div>";
    }
}

// Display the filtered products
display_products($filtered_products);
?>