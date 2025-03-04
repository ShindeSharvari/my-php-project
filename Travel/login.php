<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php
            include 'connection.php';

            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'];
                $password = $_POST['password'];

                // here we fetch the hashed password from the database based on the provided email
                $stmt = $con->prepare("SELECT  email, password FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result( $email, $hashed_password);
                    $stmt->fetch();

                    // This verify the entered password with the hashed password from the database
                    if (password_verify($password, $hashed_password)) {
                        // Passwords match, set session and redirect to success page
                        $_SESSION['email'] = $email;
                        header("Location: success.php");
                        exit();
                    } else {
                        echo '<script>alert("Invalid email or password")</script>';
                    }
                } else {
                    echo '<script>alert("Invalid email or password")</script>';
                }

                $stmt->close();
            }

            mysqli_close($con);
?>

    <style>
        body {
            background-image: url('images/login1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .container-login {
            display: flex;
            justify-content: right;
            align-items: center;
            height: 100%;
            margin-right: 70px;
        }
        .login-form {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 80%;
            text-align: center;
        }
        .login-form h2 {
            margin-bottom: 30px;
            font-size: 200%;
            font-weight: bolder;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .form-control {
            margin-bottom: 20px;
            border-radius: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 20px;
            padding: 10px 20px;
        }
        .forgot-btn{
            background-color: transparent;
             color: orange;
             border: none; 
             padding: 10px 20px; 
             cursor: pointer; 
             border-radius: 5px; 
             font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container-login">
    <div class="login-form">
        <h2>Login</h2>
        <form method="POST">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()" style="position: absolute; right: 120px; top: 47%; transform: translateY(-50%); cursor: pointer;font-size: 20px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <div class="forgot-btn"> 
              <button type="button" class="forgot-btn" onclick="window.location.href='forgotpassword.php'">Forgot password?</button>
            </div>
            <p class="link"><strong style="color: white;">Don't have an account?</strong><strong> <a href="register.php">Register</a></strong></p>
        </form>
    </div>
</div>
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
