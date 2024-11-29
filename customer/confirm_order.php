<?php
session_start();
require_once("../controllers/cart_controller.php");

$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$email  = $_SESSION['email'];

$user_email = $_SESSION['email']; // Assuming email is stored in the session
$user_contact = $_SESSION['contact']; // Assuming contact_number is stored in the session
$cart_items = get_cart_items($user_id);
$total_price = array_reduce($cart_items, function ($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);

$total_price = ($total_price + 50 + 20);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation | YourStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --text-color: #2c3e50;
            --background-color: #f4f6f7;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .order-confirmation-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
            max-width: 800px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--background-color);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .order-header h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin: 0;
        }

        .order-header .order-number {
            color: var(--text-color);
            opacity: 0.7;
        }

        .table-order {
            margin-bottom: 30px;
        }

        .table-order th {
            background-color: var(--background-color);
            color: var(--text-color);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .table-order td {
            vertical-align: middle;
            border-color: var(--background-color);
        }

        .order-total {
            text-align: right;
            font-size: 1.2em;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .info-section {
            background-color: var(--background-color);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .info-section h5 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .icon-label {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .order-confirmation-container {
                padding: 20px;
                margin-top: 20px;
            }
        }


        .navbar {
            background-color: #004080;
            color: white;
        }

        .navbar .nav-link {
            color: white;
        }

        .navbar .nav-link:hover {
            color: #cce5ff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="#">POSify</a>

            <!-- Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left-aligned links -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> About</a>
                    </li>
                </ul>

                <!-- Right-aligned links -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Search Bar -->
                    <li class="nav-item me-3">
                        <form class="d-flex">
                            <input class="form-control lg me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>
                    <!-- Cart -->
                    <li class="nav-item me-3">
                        <a class="nav-link" href="../customer/cart_view.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><?php echo $name; ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="../login/logout_customer.php">Orders</a></li>
                            <li><a class="dropdown-item" href="../login/logout_customer.php">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="order-confirmation-container">
            <div class="order-header">
                <h2>Order Confirmation</h2>
            </div>

            <table class="table table-order table-hover">
                <thead>
                    <tr>
                        <th><b>Product</b></th>
                        <th><b>Quantity</b></th>
                        <th><b>Price (GHC)</b></th>
                        <th><b>Subtotal (GHC)</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item) { ?>
                        <tr>
                            <td>
                                <div class="icon-label">
                                    <i class="fas fa-box text-muted"></i>
                                    <?php echo htmlspecialchars($item['product_name']); ?>
                                </div>
                            </td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td> <?php echo number_format($item['price'], 2); ?></td>
                            <td><strong><?php echo number_format($item['price'] * $item['quantity'], 2); ?></strong></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tbody>
                    <tr>
                        <td>
                            <strong> Delivery fees </strong>
                        </td>

                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                            <strong> 50.00 </strong>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong> Taxes </strong>
                        </td>

                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                            <strong> 20.00 </strong>
                        </td>
                    </tr>


                </tbody>
            </table>

            <div class="order-total mb-4">
                Total: GHC<?php echo $total_price; ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="info-section">
                        <h5><i class="fas fa-user-circle"></i> Contact Information</h5>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_contact); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($user_email); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-section">
                        <h5><i class="fas fa-truck"></i> Delivery Information</h5>
                        <form id="paymentForm" action="../actions/place_order.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Delivery Address</label>
                                <textarea class="form-control" rows="3" id="delivery_address" name="delivery_address" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="cash_on_delivery">Cash on Delivery</option>
                                    <option value="card_payment">Card Payment</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-shopping-cart"></i> Place Order
                            </button>
                        </form>

                        <script>
                            const paymentForm = document.getElementById('paymentForm');

                            // Attach an event listener to the form submission
                            paymentForm.addEventListener("submit", function(e) {
                                e.preventDefault(); // Prevent the form from submitting immediately

                                const paymentMethod = document.getElementById('payment_method').value;

                                if (paymentMethod === 'card_payment') {
                                    // Trigger the Paystack payment if 'card_payment' is selected
                                    payWithPaystack();
                                } else {
                                    // If 'cash_on_delivery' is selected, submit the form normally
                                    paymentForm.submit();
                                }
                            });

                            function payWithPaystack() {
                                let handler = PaystackPop.setup({
                                    key: 'pk_test_2d971b6500fc1b1c143dfc4ed9e02794511be64f', // Replace with your public key
                                    email: '<?php echo $email; ?>', // Email of the customer
                                    amount: (<?php echo $total_price; ?> *100), // Amount in kobo (multiply by 100 to convert to kobo)
                                    currency: 'GHS', // Use 'GHS' for Ghana Cedis
                                    ref: '' + Math.floor((Math.random() * 1000000000) + 1), // Generates a random reference
                                    onClose: function() {
                                        alert('Transaction was not completed, window closed.');
                                    },
                                    callback: function(response) {
                                        let message = 'Payment complete! Reference: ' + response.reference;
                                        alert(message);

                                        // Redirect after successful payment to your callback URL
                                        window.location.replace("../actions/place_order.php?reference=" + response.reference + "&delivery_address=" + encodeURIComponent(document.getElementById('delivery_address').value));
                                    }
                                });

                                handler.openIframe(); // Opens the Paystack payment modal
                            }
                        </script>


                        <script src="https://js.paystack.co/v1/inline.js"></script>

</body>

</html>