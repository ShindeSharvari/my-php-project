<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <div class="popup-container" id="forgot-popup" style="display: block; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 10cm; height: 5cm; background-color: rgba(0, 0, 0, 0.5); border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); z-index: 9999;">
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
        function closeForgotPasswordPopup() {
            window.location.href = "index.php"; // Redirect to index.php after closing popup
        }
    </script>
</body>
</html>
<?php
require("connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendMail($email,$reset_token)
{
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'carhub3567@gmail.com';                     //SMTP username
        $mail->Password   = 'isjd kyqm caik hjoo';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('carhub367@gmail.com', 'CAR_HUB');
        $mail->addAddress($email);     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link from CAR_HUB';
        $mail->Body    = "We got a request from you to reset your password! </br>
                          Click the link below:<br>
                          <a href='http://localhost/car_rental_project-main/updatepassword.php?email=$email&reset_token=$reset_token'>
                          Reset Password</a>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['send-reset-link']))
{
    $query="SELECT * FROM `users` WHERE `email`='$_POST[email]'";
    $result=mysqli_query($con,$query);
    if($result)
    {
      if(mysqli_num_rows($result)==1)
      {
         $reset_token=bin2hex(random_bytes(16));
         date_default_timezone_set('Asia/kolkata');
         $date=date("Y-m-d");
         $query="UPDATE `users` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `email`='$_POST[email]'";
         if(mysqli_query($con,$query) && sendMail($_POST['email'],$reset_token))
         {
            echo"
             <script>
             alert('Password reset link sent to mail');
             window.location.href='index.php';
             </script>
             ";
         }
         else
         {
            echo"
             <script>
             alert('server down try again');
             window.location.href='index.php';
             </script>
       ";
         }
      }
    else
      {
       echo"
       <script>
       alert('Email not found');
       window.location.href='index.php';
       </script>
       ";
      }
     }
   else
    {
       echo"
       <script>
       alert('cannot run query');
       window.location.href='index.php';
       </script>
       ";
    }
}

?>