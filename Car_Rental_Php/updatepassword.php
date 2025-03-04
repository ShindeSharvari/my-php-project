<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <style>
        body {
            background-image: url('images/carfg.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: rgba(240, 240, 240, 0.8); 
            width: 10cm; 
            height: 5cm; 
            border-radius: 10px;
            padding: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form h3 {
            margin-bottom: 15px;
            color: #30475e;
        }
        form input {
            width: calc(100% - 30px); 
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"]
        {
            display: block; 
            margin-top: 20px;
            background-color: orange; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px;
        }
        .toggle-password {
            position: absolute;
            top: 40%;
            right: 50px; 
            transform: translateY(-50%); 
            cursor: pointer;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 16px;
            color: #30475e;
            outline: none;
        }
        
    </style>
</head>
<body>

<div class="container">
    <?php
    require("connection.php");

    if(isset($_GET['email']) && isset($_GET['reset_token'])) {
        date_default_timezone_set('Asia/kolkata');
        $date = date("Y-m-d");
        $query = "SELECT * FROM `users` WHERE `email`='" . $_GET['email'] . "' AND `resettoken`='" . $_GET['reset_token'] . "' AND `resettokenexpire`='$date'";
        $result = mysqli_query($con, $query);
        
        if($result) {
            if(mysqli_num_rows($result) == 1) {
                echo "
                <form method='POST'>
                    <h3>Create new password</h3>
                    <input type='password' id='password' placeholder='New Password' name='Password' required>
                    <span class='toggle-password' onclick='togglePasswordVisibility()'>View</span>
                    <button class='close-button' onclick=\"window.location.href='index.php'\">&#10006;</button>
                    <button type='submit' name='updatepassword'>UPDATE</button>
                    <input type='hidden' name='email' value='" . $_GET['email'] . "'>
                </form>
                ";   
            } else {
                echo "
                <script>
                    alert('Invalid or Expired Link');
                    window.location.href='index.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Server Down! Try again later');
                window.location.href='index.php';
            </script>
            ";
        }
    }

    if(isset($_POST['updatepassword'])) {
        // Hash the new password
        $pass = password_hash($_POST['Password'], PASSWORD_BCRYPT);
        $email = $_POST['email'];

        // Update the password in the database
        $update = "UPDATE `users` SET `PASSWORD`='$pass', `resettoken`=NULL, `resettokenexpire`=NULL WHERE `email`='$email'";
        
        if(mysqli_query($con, $update)) {
            echo "
            <script>
                alert('Password Updated Successfully');
                window.location.href='index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Server Down! Try again later');
                window.location.href='index.php';
            </script>
            ";
        }
    }
    ?>
</div>
<script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var passwordIcon = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordIcon.textContent = "Hide"; 
            } else {
                passwordField.type = "password";
                passwordIcon.textContent = "View"; 
            }
        }
    </script>

</body>
</html>
