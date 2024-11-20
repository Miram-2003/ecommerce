<?php
session_start();
require_once("../controllers/cat_controller.php");

//require_once("../functions/product_function.php");
require_once('../settings/core.php');

check_login();
$id = $_SESSION['seller_id'];
$name = $_SESSION['seller_name'];
$email  = $_SESSION['email'];
$img = $_SESSION['image'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retailer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            background-color: #004080;
            color: white;
            height: 100vh;
            position: fixed;
            top: 0%;
            left: 0;
            width: 16%;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #0056b3;
            color: white;
        }

        .nav {
            margin-top: 100px;
        }


        .navbar {
            background-color: #004080;
            color: white;
            position: fixed;
            top: 0;
            left: 0%;
            width: 100%;
            z-index: 1030;
        }

        .navbar .nav-link {
            color: white;
        }

        .navbar .nav-link:hover {
            color: #f8f9fa;
        }

        main {
            margin-left: 16%;
            margin-top: 56px;
            height: calc(100vh - 56px);
            overflow-y: auto;
            padding: 20px;
        }


        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><b>POSify</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-bell"></i> Notifications</a>
                    </li>



                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../storeimages/<?php echo $img; ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong><?php echo $name; ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">

                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../login/logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <nav class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="../sellers_view/dashboard.php">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-box"></i> Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                    <li>
                        <a class="dropdown-item" href="../sellers_view/add_product_view.php">Add Product</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../sellers_view/seller_product_view.php">Manage Products</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-line"></i> Analytics
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cash-register"></i> POS
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-bullhorn"></i> Marketing
                </a>
            </li>

        </ul>
    </nav>


    <main>
        <div class="container">
            <div class="form-container">
                <h2 class="form-title">Add New Product</h2>
                <form action="../actions/addproduct.php" method="POST" enctype="multipart/form-data">
                    <!-- Product Name -->
                    <input type="hidden" name="seller" value="<?php echo $id ?>">
                    <div class="mb-4">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="product_name" placeholder="Enter product name" required>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" name="product_description" rows="4" placeholder="Enter product description" required></textarea>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="product_price" placeholder="Enter product price" step="0.01" required>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="mb-4">
                        <label for="stockQuantity" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="stockQuantity" name="stock_quantity" placeholder="Enter stock quantity" required>
                    </div>

                    <!-- Main Category -->
                    <div class="mb-4">
                        <?php echo get_cat_ctr(); ?>

                    </div>

                    <!-- Subcategory -->
                    <!-- <div class="mb-4">
                    <label for="subCategory" class="form-label">Subcategory</label>
                    <select class="form-select" id="subCategory" name="sub_category" required>
                        <option value="" disabled selected>Select Subcategory</option>
                        Add options dynamically based on the selected main category -->
                    <!-- </select>
                </div> -->

                    <!-- Product Image -->
                    <div class="mb-4">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="product_image" accept="image/*" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Add Product</button>
                    </div>
                </form>
            </div>
        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>