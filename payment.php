<?php
session_start();
require_once('../controllers/cart_controller.php');
require_once('../controllers/payment_controller.php');

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: ../view/login_customer.php");
    exit;
}

// Retrieve customer ID from the session
$customer_id = $_SESSION['customer_id'];

// Initialize controllers
$paymentController = new PaymentController();
$cartController = new CartController();

// Fetch customer details
$customerDetails = $paymentController->getCustomerDetails($customer_id);

// Fetch total cost from the cart
$totalCost = $cartController->getTotalCost($customer_id);

if (!$customerDetails) {
    die("Customer details not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Your Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="../view/customer_display_product_view.php">
                <i class="bi bi-arrow-left"></i> Back to Shop
            </a>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="bg-success text-white py-4">
        <div class="container text-center">
            <h4>Complete Your Payment</h4>
        </div>
    </header>

    <!-- Main Content -->
    <main class="my-5">
        <div class="container">
            <!-- Payment Form Section -->
            <section id="payment" class="shadow-lg p-5 rounded bg-light">
                <h2 class="text-center text-success mb-4">Enter Payment Details</h2>
                <form id="paymentForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email-address" class="form-label">Email Address</label>
                            <input type="email" id="email-address" class="form-control" name="email" value="<?= htmlspecialchars($customerDetails['customer_email']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" id="amount" class="form-control" name="amount" value="<?= htmlspecialchars($totalCost); ?>" step="0.01" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first-name" class="form-label">Customer Name</label>
                            <input type="text" id="customer-name" class="form-control" name="name" value="<?= htmlspecialchars($customerDetails['customer_name']); ?>" required>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-success btn-lg" id="payButton">
                            <i class="fas fa-credit-card"></i> Pay Now
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    
    <!-- Footer Section -->
    <footer class="bg-success text-white py-3 mt-5">
        <div class="container text-center">
            <p>&copy; 2024 Your Website</p>
        </div>
    </footer>

    <!-- Paystack Script -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        var paymentForm = document.getElementById('paymentForm');

        // Handle the button click
        document.getElementById('payButton').addEventListener('click', payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();

            var email = document.getElementById('email-address').value;
            var amount = document.getElementById('amount').value * 100; // Convert to the smallest currency unit
            var name = document.getElementById('customer-name').value;

            var handler = PaystackPop.setup({
                key: 'pk_test_66bf7bf7bfec6fa6bc97905046c1db69d51c8f00', // Replace with your Paystack public key
                email: email,
                amount: amount, 
                currency: 'GHS', // Set your desired currency
                ref: '' + Math.floor(Math.random() * 1000000000 + 1), // Generate a random reference
                callback: function(response) {
                    // When Paystack returns a response, redirect to backend for verification
                    window.location.href = "../actions/payment_action.php?reference=" + response.reference;
                },
                onClose: function() {
                    alert('Transaction was not completed.');
                },
            });
            handler.openIframe();
        }
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>
</html>
