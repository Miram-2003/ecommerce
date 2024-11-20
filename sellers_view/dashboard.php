<?php
session_start();
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
                <a class="nav-link" href="../sellers_view/seller_order.php">
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>
        <p>Welcome to your dashboard! Here’s where you’ll see an overview of your store’s performance.</p>
        <p>Scroll down to test the fixed sidebar and navbar functionality.</p>
        <div style="height: 1500px;">Extra content to scroll...</div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>