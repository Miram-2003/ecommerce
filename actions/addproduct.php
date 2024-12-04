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
        $upload_dir = '../uploads/'; 
       
        $file_tmp = $_FILES['product_image']['tmp_name']; 
        $file_name = basename($_FILES['product_image']['name']); 
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); 
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

        // Additional file checks
        if (empty($file_tmp)) {
            die("Temporary file path is empty");
        }

        // Check file size (optional)
        $max_file_size = 5 * 1024 * 1024; // 5MB
        if ($_FILES['product_image']['size'] > $max_file_size) {
            die("File is too large. Maximum size is 5MB.");
        }

        // Check if file actually exists
        if (!file_exists($file_tmp)) {
            die("Uploaded file does not exist: " . $file_tmp);
        }

        // Permissions check
        if (!is_writable($upload_dir)) {
            die("Upload directory is not writable: " . $upload_dir);
        }

        if (in_array($file_ext, $allowed_exts)) {
            $new_file_name = uniqid('img_', true) . '.' . $file_ext;
            $upload_path = $upload_dir . $new_file_name;

            if (!is_dir($upload_dir)) {
                // Attempt to create directory with full permissions
                if (!mkdir($upload_dir, 0777, true)) {
                    die("Failed to create upload directory");
                }
            }

            // Use more robust file upload method
            if (move_uploaded_file($file_tmp, $upload_path)) {
                $result = add_product_ctr($user_id, $pro_mcat, $pro_scat, $prod_name, $prod_price, $prod_des, $prod_qty, $new_file_name);
                
                if ($result) {
                    header('Location: ../sellers_view/seller_product_view.php');
                    exit();
                } else {
                    die("Error: Failed to save product data.");
                }
            } else {
                // Detailed error checking for move_uploaded_file
                $error = error_get_last();
                die("File move failed: " . ($error['message'] ?? 'Unknown error'));
            }
        } else {
            die("Error: Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
        }
    } 
}
?>