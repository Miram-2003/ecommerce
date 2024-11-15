<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
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
                    <h3><i class="fas fa-user-plus"></i> Seller Registration</h3>
                </div>
                
                    <form id="registrationForm" action="../actions/store_register.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i> Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div id="nameError" class="error"></div>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div id="emailError" class="error"></div>
                            
                        </div>
                        <div class="form-group">
                            <label for="store_name"><i class="fas fa-store"></i> Store Name</label>
                            <input type="text" class="form-control" id="store_name" name="store_name" required>
                            <div id="storeError" class="error"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                            <div id="phoneError" class="error"></div>
                        </div>
                        <div class="form-group">
                            <label for="country"><i class="fas fa-globe"></i> Country</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                            <div id="countryError" class="error"></div>
                        </div>
                        <div class="form-group">
                            <label for="region"><i class="fas fa-map-marker-alt"></i> Region</label>
                            <input type="text" class="form-control" id="region" name="region" required>
                            <div id="regionError" class="error"></div>
                        </div>
                        <div class="form-group">
                            <label for="zone"><i class="fas fa-map-marker-alt"></i>City/Town</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                            <div id="cityError" class="error"></div>
                        </div>

                        <div class="form-group">
                            <label for="logo"><i class="fas fa-store-alt"></i>City/Town</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            <div id="logoError" class="error"></div>
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div id="passwordError" class="error"></div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password"><i class="fas fa-lock"></i> Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <div id="confirmPasswordError" class="error"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Register</button>
                    </form>
               
                <div class="card-footer text-center">
                    <a href="login.php">Already have an account? Login here</a>
                </div>
            </div>
        </div>
    </div>

    <div class="image-container">
       
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src = "../js/register.js"></script>
</body>
</html>


