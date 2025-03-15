<!DOCTYPE html>
<html lang="en">
<head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/register.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    </head>
    <body>
        <script src="./js/auth.js"></script>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="<?= BASE_URL ?>/signup" method="POST" id="signup-form">
                    <h1>Create Account</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your email for registration</span>
                    <input type="text" name="name" placeholder="Name" id="username" required="">
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password"name="password" placeholder="Password" required="">
                    <input type="password" name="adminkey" placeholder="adminkey" required="">
                    <button><a href="">Sign Up</a></button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="<?= BASE_URL ?>/login" method="POST" id="login-form">
                    <h1>Sign in</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your account</span>
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="password" placeholder="Password" required="">
                    <a href="#">Forgot your password?</a>
                    <button><a href="">Sign In</a></button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= BASE_URL ?>/assets/js/register.js"></script>
    
</body>
</html>
