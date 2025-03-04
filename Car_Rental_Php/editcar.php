<?php
require_once('connection.php');

// Check if car ID is provided in the URL
if(isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Fetch car details from the database
    $query = "SELECT * FROM cars WHERE CAR_ID = '$car_id'";
    $result = mysqli_query($con, $query);
    $car_data = mysqli_fetch_assoc($result);
}

// Handle form submission
if(isset($_POST['submit'])) {
    // Retrieve form data
    $car_name = $_POST['car_name'];
    $fuel_type = $_POST['fuel_type'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $available = $_POST['available'];

    // Update car details in the database
    $update_query = "UPDATE cars SET CAR_NAME = '$car_name', FUEL_TYPE = '$fuel_type', CAPACITY = '$capacity', PRICE = '$price', AVAILABLE = '$available' WHERE CAR_ID = '$car_id'";
    $update_result = mysqli_query($con, $update_query);

    if($update_result) {
        echo '<script>alert("CAR Updated SUCCESFULLY")</script>';
        echo '<script> window.location.href = "adminvehicle.php";</script>';
        // Redirect back to the admin page after successful update
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-image: url("../images/caredit.avif");
            background-size: cover;
            background-position: center;
        }
        .main {
            width: 400px;
            margin: 100px auto 0;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
            color: #fff;
        }
        .main h1 {
            text-align: center;
            padding: 20px;
            font-family: sans-serif;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 18px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 7px;
            border: 1px solid #ddd;
            border-radius: 3px;
            background-color: #fff;
            box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.3);
            outline: 0;
        }
        input[type="submit"] {
            width: 100%;
            height: 40px;
            background: #ff7200;
            border: none;
            margin-top: 20px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
            transition: 0.4s ease;
        }
        input[type="submit"]:hover {
            background: #fff;
            color: #ff7200;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1>Edit Car Details</h1>
        <form method="POST">
            <label for="car_name">Car Name:</label>
            <input type="text" id="car_name" name="car_name" value="<?php echo $car_data['CAR_NAME']; ?>"><br>
            
            <label for="fuel_type">Fuel Type:</label>
            <input type="text" id="fuel_type" name="fuel_type" value="<?php echo $car_data['FUEL_TYPE']; ?>"><br>
            
            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" value="<?php echo $car_data['CAPACITY']; ?>"><br>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $car_data['PRICE']; ?>"><br>
            
            <label for="available">Available:</label>
            <input type="text" id="available" name="available" value="<?php echo $car_data['AVAILABLE']; ?>"><br>
            
            <input type="submit" name="submit" value="Update">
        </form>
    </div>
</body>
</html>
