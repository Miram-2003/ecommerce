<?php
session_start();
require_once("../controllers/product_controller.php");
require_once("../controllers/cat_controller.php");
require_once('../settings/core.php');

check_login();
$seller_id = $_SESSION['seller_id'];
$name = $_SESSION['seller_name'];
$email = $_SESSION['email'];
$img = $_SESSION['image'];

// Fetch seller's products
$products = get_product_ctr($seller_id);



// Handle product data for editing (example product initialization)
$productToEdit = null;
if (isset($_GET['edit_product_id'])) {
    $productId = $_GET['edit_product_id'];
    foreach ($products as $product) {
        if ($product['product_id'] == $productId) {
            $productToEdit = $product;
            break;
        }
    }
}
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
    </style>
</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><b>POSify</b></a>
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
    <<nav class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="../seller_view/dashboard.php">
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
                <a class="nav-link" href="../sellers_view/orders.php">
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
        <div class="container mt-5">
            <h2 class="mb-4">Product Management</h2>
            <?php if (!empty($products)) { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Main Category</th>
                                <th>Sub Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $index => $product) { 
                                $cat_man = getMainCat($product['main_cat_id']);
                                $cat_sub = getSubCat($product['sub_cat_id']);?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                        <img src="../product_images/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($product['qty']); ?></td>
                                    <td><?php echo htmlspecialchars(string: $cat_man); ?></td>
                                    <td><?php echo htmlspecialchars($cat_sub); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal-<?php echo $product['product_id']; ?>">Edit</button>
                                        <a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>

                                <!-- Edit Product Modal -->
                                <div class="modal fade" id="editProductModal-<?php echo $product['product_id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../actions/update_product.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="productName" class="form-label">Product Name</label>
                                                        <input type="text" class="form-control" id="productName" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="productDescription" class="form-label">Description</label>
                                                        <textarea class="form-control" id="productDescription" name="product_description" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="productPrice" class="form-label">Price</label>
                                                        <input type="number" class="form-control" id="productPrice" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="productQty" class="form-label">Quantity</label>
                                                        <input type="number" class="form-control" id="productQty" name="stock_quantity" value="<?php echo htmlspecialchars($product['qty']); ?>" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Update Product</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit Product Modal -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <p class="text-muted">No products found for this seller.</p>
            <?php } ?>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
