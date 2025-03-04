<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="script/register.js"></script>

  <?php
   include 'connection.php';

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the maximum ID from the database
    $max_id_stmt = $con->prepare("SELECT MAX(id) FROM users WHERE id <> 0");
    $max_id_stmt->execute();
    $max_id_stmt->bind_result($max_id);
    $max_id_stmt->fetch();
    $max_id_stmt->close();

    // Increment the maximum ID for the new registration
    $new_id = $max_id + 1;

    // Prepare the insertion statement
    $stmt = $con->prepare("INSERT INTO users (id, name, email, password, mobileNumber, gender, adventureTypes, hearAboutUs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $new_id, $name, $email, $hashed_password, $mobileNumber, $gender, $adventureTypes, $hearAboutUs);

    // Set parameters
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain text password
    $confirmPassword = $_POST['confirmPassword'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $mobileNumber = $_POST['mobileNumber'];
    $gender = $_POST['gender'];
    $adventureTypes = implode(", ", $_POST['adventureTypes']);
    $hearAboutUs = $_POST['hearAboutUs'];
    
    try {
         // Check if password and confirm password match
           if ($password !== $confirmPassword) {
           echo '<script>alert("Passwords do not match. Please try again."); window.location.href="register.php";</script>';
           exit;
         }
    
        // Execute the insertion statement
        if ($stmt->execute()) {
            $stmt->close();
            
            echo '<script>alert("New record created successfully"); window.location.href = "login.php";</script>';
            exit;
        } else {
            echo '<script>alert("Registration failed. Please try again later.");</script>';
        }
    } catch (mysqli_sql_exception $e) {
        // Handle duplicate entry error
        echo '<script>alert("Registration failed due to duplicate entry. Please try again later.");</script>';
    }
}
?>


  <style>
    body {
      background-image: url('images/reg.webp');  
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-color: #f0f0f0;
    }
    .container-square {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .transparent-box {
        background-color: rgba(0, 0, 0, 0.5); 
        padding: 20px;
        border-radius: 1px;
        color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        height: 92.5vh;
        margin-right: -391px;
        margin-top: -10%;
    }
    .transparent-box2 {
        background-color: rgba(0, 0, 0, 0.5); 
        padding: 20px;
        border-radius: 1px;
        color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        margin-left: -395px; 
        margin-top: -10%;
    }
    .transparent-box h2 {
      color: black;
      text-align: center;
      margin-bottom: 30px;
    }
    .form-control {
      background-color: rgba(255, 255, 255, 0.8); 
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    #confirmPasswordError {
     color: red;
     font-weight: bold;
}
  </style>
</head>
<body>
<div class="container-fluid mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 container-square">
      <div class="transparent-box">
        <h2>Registration Form</h2>
        
        <form method="post">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" onkeyup="checkPasswordMatch();"required>
            <span id="confirmPasswordError" class="error"></span>
          </div>
          <div class="form-group">
              <label for="mobileNumber">Mobile Number:</label>
              <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" 
              maxlength="10" onkeypress="return onlyNumberKey(event)"required>
          </div>

        </div>
    </div>
    <div class="col-md-6 container-square">
      <div class="transparent-box2">
        <form method="post">
          <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
              <option value="">Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="adventureTypes">Preferred Adventure Types:</label><br>
            <input type="checkbox" id="hiking" name="adventureTypes[]" value="hiking">
            <label for="hiking"> Hiking</label><br>
            <input type="checkbox" id="camping" name="adventureTypes[]" value="camping">
            <label for="camping"> Camping</label><br>
            <input type="checkbox" id="sightseeing" name="adventureTypes[]" value="sightseeing">
            <label for="sightseeing"> Sightseeing</label><br>
            <input type="checkbox" id="beach" name="adventureTypes[]" value="beach">
            <label for="beach"> Beach</label><br>
            <input type="checkbox" id="culturalImmersion" name="adventureTypes[]" value="culturalImmersion">
            <label for="culturalImmersion"> Cultural Immersion</label><br>
            <input type="checkbox" id="wildlifeSafari" name="adventureTypes[]" value="wildlifeSafari">
            <label for="wildlifeSafari"> Wildlife Safari</label><br>
            <input type="checkbox" id="adventureSports" name="adventureTypes[]" value="adventureSports">
            <label for="adventureSports"> Adventure Sports</label><br>
          </div>
          <div class="form-group">
            <label for="hearAboutUs">How did you hear about us?</label>
            <select class="form-control" id="hearAboutUs" name="hearAboutUs">
              <option value="">Select</option>
              <option value="socialMedia">Social Media</option>
              <option value="friendFamily">Friend/Family</option>
              <option value="searchEngine">Search Engine</option>
              <option value="advertisement">Advertisement</option>
              <option value="other">Other</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <p class="link">Already have an account?<strong><a href="login.php"> login</a></strong></p>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
