<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: url("../images/carbg2.jpg");
            background-position: center;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ff7200;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<?php
require_once('connection.php');
session_start();
$email = $_SESSION['email'];

$query = "SELECT booking.*, cars.CAR_NAME 
          FROM booking 
          INNER JOIN cars ON booking.CAR_ID = cars.CAR_ID 
          WHERE booking.EMAIL = '$email' 
          ORDER BY booking.BOOK_ID DESC";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Your code to display the booking details in a table goes here
?>

    <div class="container">
        <h1>Your Booking Details</h1>
        <table>
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Car Name</th>
                    <th>Pickup Place</th>
                    <th>Book Date</th>
                    <th>Duration</th>
                    <th>Phone Number</th>
                    <th>Drop Off Place</th>
                    <th>Return Date</th>
                    <th>Payment</th>
                    <th>Booking Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['CAR_ID']; ?></td>
                        <td><?php echo $row['CAR_NAME']; ?></td>
                        <td><?php echo $row['BOOK_PLACE']; ?></td>
                        <td><?php echo $row['BOOK_DATE']; ?></td>
                        <td><?php echo $row['DURATION']; ?></td>
                        <td><?php echo $row['PHONE_NUMBER']; ?></td>
                        <td><?php echo $row['DESTINATION']; ?></td>
                        <td><?php echo $row['RETURN_DATE']; ?></td>
                        <td><?php echo $row['PRICE']; ?></td>
                        <td><?php echo $row['BOOK_STATUS']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo '<h1>No Booking Details Found</h1>';
}
?>
</body>
</html>
