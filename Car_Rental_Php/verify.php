<?php
require("Connection.php");

if (isset($_GET['email']) && isset($_GET['v_code'])) {
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];

    // Prepare the SELECT query with placeholders
    $query = "SELECT * FROM `users` WHERE `email`=? AND `verification_code`=?";
    $stmt = mysqli_prepare($con, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $v_code);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['is_verified'] == 0) {
                // Prepare the UPDATE query with placeholders
                $update = "UPDATE `users` SET `is_verified`=1 WHERE `email`=?";
                $stmt_update = mysqli_prepare($con, $update);

                // Bind the parameter
                mysqli_stmt_bind_param($stmt_update, "s", $email);

                // Execute the UPDATE query
                if (mysqli_stmt_execute($stmt_update)) {
                    echo "<script>alert('Email verification successful'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Oops, something went wrong while updating'); window.location.href='index.php';</script>";
                }
            } else {
                echo "<script>alert('Email already registered'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Cannot find the user with provided email and verification code'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Cannot run query'); window.location.href='index.php';</script>";
    }
}
?>
