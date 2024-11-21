
<?php
session_start();

$error = $_SESSION['error'] ?? "";




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            overflow-x: hidden;
            display: flex;
            height: 100vh;
            /* Full height of the screen */
        }

        .form-container {
            width: 50%;
            /* Take up 50% of the width */
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
        }

        .form-box {
            width: 80%;
            background: #fff;
            padding: 2rem;
            /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); */
            border-radius: 8px;
        }

        .image-container {
            width: 50%;
            /* Take up the other 50% */
            background: url('../images/coverimage.jpg') no-repeat center center;
            background-size: 50% 50%;
            background-position: center;

        }

        .error {
            background-color: #f8d7da;
            /* Light red background */
            color: #721c24;
            /* Dark red text */
            padding: 10px;
            /* Add some padding */
            border: 1px solid #f5c6cb;
            /* Add a light red border */
            border-radius: 5px;
            /* Optional: rounded corners */
            margin-bottom: 15px;
            /* Add some space below */
            font-size: 14px;
            /* Adjust font size */
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-box">
            <div class="text-center mb-4">
                <h3 class="text-primary"><i class="fas fa-user-plus"></i>  Login</h3>
            </div>

            <div> <?php if (isset($_SESSION['error'])): ?>
                    <?php echo "<p class= 'error' style='color: red;'>" . htmlspecialchars($error);
                        "</p>" ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
            </div>
            <form action="../actions/customer_login.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
            </form>

            <div class="text-center mt-3">
                <a href="../login/customer_register.php">Don't have an account? Register here</a>
            </div>
        </div>
    </div>

    <div class="image-container"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>