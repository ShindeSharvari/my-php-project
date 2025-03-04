<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>CAR RENTAL</title>
    <script type="text/javascript">
    window.addEventListener("load", function() {
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    });
</script>
    <link  rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
require_once('connection.php');

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    if(empty($email) || empty($pass)) {
        echo '<script>alert("Please fill in both email and password")</script>';
    } else {
        $query = "SELECT * FROM users WHERE EMAIL='$email' AND is_verified=1"; // Only select verified email addresses
        $res = mysqli_query($con, $query);
        
        if($res && $row = mysqli_fetch_assoc($res)) {
            $db_password = $row['PASSWORD'];
            if(password_verify($pass, $db_password)) {
                // Start session and redirect to cardetails.php
                session_start();
                $_SESSION['email'] = $email;
                header("location: cardetails.php");
                exit(); // Ensure no further code execution after redirection
            } else {
                echo '<script>alert("Invalid password")</script>';
            }
        } else {
            echo '<script>alert("Invalid email or email not verified")</script>';
        }
    }
}
?>

    <div class="hai">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">CAR_HUB</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="aboutus.html">ABOUT</a></li>
                    <li><a href="services.html">SERVICES</a></li>
                    
                    <li><a href="contactus.html">CONTACT</a></li>
                </ul>
            </div>
            
          
        </div>
        <div class="content">
            <h1>Rent Your Car <br><span>Your journey starts here!</span></h1>
            <p class="par">Rent a smile with us<br>
                Just rent a car of your wish from our vast collection.<br>Enjoy every moment with your family<br>
                 Join us to make this family vast.  </p>
            <button class="cn"><a href="register.php">JOIN US</a></button>
            <div class="form">
                <h2>Login Here</h2>
                <form method="POST"> 
                <input type="email" name="email" placeholder="Enter Email Here">
        <div class="password-wrapper">
            <input type="password" name="pass" id="password" placeholder="Enter Password Here" style="padding-right: 20px;"> <!-- Adjust padding-right value according to icon width -->
            <span class="toggle-password" onclick="togglePasswordVisibility()" style="position: absolute; right: 20px; top: 40%; transform: translateY(-50%); cursor: pointer;font-size: 20px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
        </div>
        <input class="btnn" type="submit" value="Login" name="login"></input>
           <!--  This is for same page popup box But it not working
            <div class="forgot-btn"> 
                <button type="button" style="background-color: transparent; color: orange; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; font-size: 16px;" onclick="document.getElementById('forgot-popup').style.display='block'">Forgot password?</button>
            </div> -->
            <div class="forgot-btn"> 
              <button type="button" style="background-color: transparent; color: orange; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; font-size: 16px;" onclick="window.location.href='forgotpassword.php'">Forgot password?</button>
            </div>

            <p class="link">Don't have an account?<br>
            <a href="register.php">Sign up</a> here</a></p>
        </div>
    </div>
</div>
<!--    This is not working when time gets I will check it
    <div class="popup-container" id="forgot-popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 10cm; height: 5cm; background-color: rgba(0, 0, 0, 0.5); border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); z-index: 9999;">
    <div class="forgot popup" style="padding: 40px;">
        <span class="popup-close" onclick="closeForgotPasswordPopup()" style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-weight: bold; font-size:30px ;color: white;">&times;</span>
        <form method="POST" action="forgotpassword.php">
            <h2 style="color: orange; text-align: left; margin-bottom: 20px;">Reset Password</h2>
            <input type="email" placeholder="Enter Email Address" name="email" style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 16px; color: black; background-color: rgba(255, 255, 255, 0.5);" required>
            <button type="submit" name="send-reset-link" style="display: block; margin: 0 auto; background-color: orange; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">SEND RESET LINK</button>
        </form>
    </div>
</div>

<script>
    function openForgotPasswordPopup() {
        document.getElementById("forgot-popup").style.display = "block";
    }

    function closeForgotPasswordPopup() {
        document.getElementById("forgot-popup").style.display = "none";
    }
</script> -->
<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var toggleIcon = document.querySelector(".toggle-password i");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>
</body>
</html>
