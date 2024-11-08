
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }
</style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3><i class="fas fa-user-plus"></i> Seller Registration</h3>
                    </div>
                    <div class="card-body">
                        <form action="../actions/store_register.php" method="POST">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="store_name"><i class="fas fa-store"></i> Store Name</label>
                                <input type="text" class="form-control" id="store_name" name="store_name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="country"><i class="fas fa-globe"></i> Country</label>
                                <input type="text" class="form-control" id="country" name="country" required>
                            </div>
                            <div class="form-group">
                                <label for="zone"><i class="fas fa-map-marker-alt"></i> Zone/District</label>
                                <input type="text" class="form-control" id="zone" name="zone" required>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i> Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password"><i class="fas fa-lock"></i> Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-paper-plane"></i> Register</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="login.php">Already have an account? Login here</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
