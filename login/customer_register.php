
<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            overflow-x: hidden;
        }
        .form-container {
            width: 45%;
            padding: 3rem;
            /* overflow-y: auto; */
            height: 100vh;
            margin-left: 10%;
        }
        .form-container .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error{
            color : red;
        }
        .image-container {
            position: fixed;
            top: 0;
            right: 0;
            width: 50%;
            height: 100vh;
            background: url('../images/coverimage.jpg') no-repeat center center;
            background-size: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="container">
            <div class="">
                <div class=" text-center text-primary">
                    <h3><i class="fas fa-user-plus"></i>  Registration</h3>
                </div>
                
                    <form id="registrationForm" action="../actions/customer_register.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i> Name</label>
                            <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($old['name'] ?? '') ?>">
                            <div id="nameError" class="error"><?= htmlspecialchars($errors['name'] ?? '') ?></div>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" id="email" name="email" required  value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                            <div id="emailError" class="error"><?= htmlspecialchars($errors['email'] ?? '') ?></div>
                            <div id="emailError" class="error"><?= htmlspecialchars( $errors['emailexist']  ?? '') ?></div>
                            
                        </div>
                       
                        <div class="form-group">
                            <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
                            <div id="phoneError" class="error"><?= htmlspecialchars($errors['phone'] ?? '') ?></div>
                        </div>
                        <div class="form-group">
                            <label for="region"><i class="fas fa-globe"></i>Region</label>
                            <input type="text" class="form-control" id="region" name="region" required value="<?= htmlspecialchars($old['region'] ?? '') ?>">
                            <div id="regionError" class="error"><?= htmlspecialchars($errors['region'] ?? '') ?></div>
                        </div>
                       
                        <div class="form-group">
                            <label for="zone"><i class="fas fa-map-marker-alt"></i>City/Town</label>
                            <input type="text" class="form-control" id="city" name="city" required value="<?= htmlspecialchars($old['city'] ?? '') ?>">
                            <div id="cityError" class="error"><?= htmlspecialchars($errors['city'] ?? '') ?></div>
                        </div>

                        
                        <div class="form-group">
                            <label for="password"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" class="form-control" id="password" name="password" required value="<?= htmlspecialchars($old['password'] ?? '') ?>">
                            <div id="passwordError" class="error"><?= htmlspecialchars($errors['password'] ?? '') ?></div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password"><i class="fas fa-lock"></i> Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required >
                            <div id="confirmPasswordError" class="error"><?= htmlspecialchars($errors['conpass'] ?? '') ?></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Register</button>
                    </form>
               
                <div class="card-footer text-center">
                    <a href="../login/customer_login.php">Already have an account? Login here</a>
                </div>
            </div>
        </div>
    </div>

    <div class="image-container">
       
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src = "../js/register.js"></script> -->
</body>
</html>


