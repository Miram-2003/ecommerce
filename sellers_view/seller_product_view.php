<?php
session_start();
require_once("../controllers/product_controller.php");

// Get seller ID (this can be dynamic, e.g., from session or request)
$seller_id = $_SESSION['seller_id'];
$products = get_product_ctr($seller_id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                        <?php foreach ($products as $index => $product) { ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td>
                                    <img src="../product_images/<?php echo htmlspecialchars($product['img']); ?>" 
                                         alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td><?php echo htmlspecialchars($product['description']); ?></td>
                                <td>$<?php echo number_format($product['price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($product['qty']); ?></td>
                                <td><?php echo htmlspecialchars($product['main_cat_id']); ?></td>
                                <td><?php echo htmlspecialchars($product['sub_cat_id']); ?></td>
                                <td>
                                    <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="text-muted">No products found for this seller.</p>
        <?php } ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
