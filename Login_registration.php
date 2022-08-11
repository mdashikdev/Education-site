<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registraion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style/primary_style.css">
    <style>
        body{
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ecf3ffbf;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login_container">
        <h3>Login</h3>
        <a class="visit_web" href="home.php">
            Visit Website
        </a>
        <form onsubmit="return false" class="login_form" autocomplete="off">
            <div class="input-field">
                
                <input type="email" name="email" placeholder="Enter your email">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input-field">
                <input type="password" name="pass" placeholder="Enter your password">
                <i class="fa-solid fa-lock"></i>
                <i class="fa-solid fa-eye-slash"></i>
            </div>
            <div class="checkbox-text">
                <div class="checkbox_content">
                    <input type="checkbox" id="checkbox">
                    <label for="checkbox">Remember me</label>
                </div>
                <a href="#">Forgot Password</a>
            </div>
            <input type="submit" value="Login Now">
            <div class="signup_div">
                <input type="checkbox" id="signup_checkbox">
                Not a member? <label for="signup_checkbox">Signup Now</label>
            </div>
        </form>
        
    </div>
    <div class="registraion_container">
        <h3>Register</h3>
        <form class="register_form" onsubmit="return false">
            <div class="input-field">
                <i class="fa-solid fa-user-tie"></i>
                <input type="text" name="nickname" required placeholder="Nickname..">
            </div>
            <div class="input-field">
                <input type="email" name="email" required placeholder="Email">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input-field">
                <input type="password" name="pass" required placeholder="Enter your password">
                <i class="fa-solid fa-lock"></i>
                <i class="fa-solid fa-eye-slash"></i>
            </div>
            <div class="input-field">
                <input type="password" placeholder="Confirm password">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="input-field">
                <input type="text" name="location" required placeholder="Current Home Town">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <input type="submit" value="Register">
            <div class="signup_div">
                Not a member? <label for="signup_checkbox">Login Now</label>
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script/jequery.js"></script>
<script src="script/primary_script.js"></script>
</body>
</html>