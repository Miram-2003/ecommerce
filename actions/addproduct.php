<?php
require_once("../controllers/product_controller.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $user_id = htmlspecialchars($_POST["seller"]);
    $prod_name = htmlspecialchars($_POST["product_name"]);
    $prod_des = htmlspecialchars($_POST["product_description"]);
    $pro_mcat = htmlspecialchars($_POST["main_cat"]);
    $pro_scat = htmlspecialchars($_POST["sub_cat"]);
    $prod_price = htmlspecialchars($_POST["product_price"]);
    $prod_qty = htmlspecialchars($_POST["stock_quantity"]);

  
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../product_images/'; // Directory to store uploaded images
        $file_tmp = $_FILES['product_image']['tmp_name']; // Temporary file path
        $file_name = basename($_FILES['product_image']['name']); // Original file name
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // File extension
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif']; 

        // Validate file type
        if (in_array($file_ext, $allowed_exts)) {
     
            $new_file_name = uniqid('img_', true) . '.' . $file_ext;
            $upload_path = $upload_dir . $new_file_name;

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            
            if (move_uploaded_file($file_tmp, $upload_path)) {
              
                $result = add_product_ctr($user_id, $pro_mcat, $pro_scat, $prod_name, $prod_price, $prod_des, $prod_qty, $new_file_name);
                if ($result) {
                  
                    header('Location: ../sellers_view/seller_product_view.php');
                    exit(); 
                } else {
                    echo "Error: Failed to save product data.";
                }
            } else {
                echo "Error: Failed to upload the image.";
            }
        } else {
            echo "Error: Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Error: No image file uploaded or an error occurred.";
    }
}
?>
