<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    include_once 'header.php';
?>

<div class="home__container">
        <img autoplay loop muted class="home__video">
            <source src="./images/Back.jpeg">
        </img>
        <div class="home__content">
            <h3>BEST TRAVEL PARTNER IN THE TOWN</h3>
            <h1><span>MAKE</span> YOUR JOURNEY TO EXPLORE WORLD</h1>
            <p>
            "Embark on an extraordinary journey towards a stronger, more vibrant you with 'Discover Your Adventure'. 
            Join us now and unlock the incredible potential of your wanderlust spirit! Explore breathtaking destinations, immerse yourself in diverse cultures, and create unforgettable memories. 
            Sign up today and let the adventure begin!"
            </p>
            <a href="register.php">
            <button class="btn" href="register.php">Get Started</button>
            </a>
        </div>
    </div>
</div>

<?php
    include_once 'footer.php';
?>

</body>
</html>
