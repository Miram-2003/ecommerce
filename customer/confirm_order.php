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
    <link rel="stylesheet" href="../css/navbr.css">
    <link rel="stylesheet" href="../css/confirm_order.css">
   <style>
    .container{
    position: relative;
    left:8%;
    width: 70%;
}
   </style> 

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #004080;">
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
                        <form class="d-flex" action = "../customer/product_search.php" method = "GET">
                            <input class="form-control me-2" type="search" placeholder="Search by product or category" name = 'search' aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>
                    <!-- Cart -->
                    <li class="nav-item me-3">
                        <a class="nav-link" href="../customer/cart_view.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white" id="userDropdown" role="button"  data-bs-toggle="dropdown" aria-expanded="false">
                            <strong><?php echo $name; ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="../login/logout_customer.php">Orders</a></li>
                            <li><a class="dropdown-item" href="../login/logout_customer.php">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
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
                                    <textarea class="form-control info" rows="3" id="delivery_address" name="delivery_address" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Payment Method</label>
                                    <select class="form-select" id="payment_method" name="payment_method" required>
                                        <option value="cash on delivery">Cash on Delivery</option>
                                        <option value="card payment">Card Payment</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-shopping-cart"></i> Place Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Shopify. All rights reserved.</p>
    </footer>

    <script>
        const paymentForm = document.getElementById('paymentForm');

        // Attach an event listener to the form submission
        paymentForm.addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent the form from submitting immediately

            const paymentMethod = document.getElementById('payment_method').value;

            if (paymentMethod === 'card payment') {
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
                amount: (<?php echo $total_price; ?> * 100), // Amount in kobo (multiply by 100 to convert to kobo)
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