<?php
    session_start();
    include('connection.php');
    include('functions.php');
    update_bids();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="auctionsite.css">
        <title> ZABUNI BIDDING SITE</title>
        <link rel="icon" href="images/letterz2.png"> 
        <script src="https://kit.fontawesome.com/d02a27485b.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="head">
            <ul>
                <li> <i class="fa-solid fa-mobile" >   0712345678</i></li>
                <li> <i class="fa-solid fa-envelope" >zabuni@gmail.com</i> </li>
                <li><i class="fa-solid fa-users"><a href="registration.php"></i>Register</a></li>
            </ul>
        </div>
        <hr>
        <div id="top_panel">
            <img src="images/letterz2.png" width="90px" alt="trial">
            <div class="top_panel_container"></div>
            <h1>ZABUNI BIDDING SITE</h1>
        </div>
        <hr>
        <div id="horizontal_nav">
            <ul>
                <li class="active"><a href="index.html"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="login.php"><i class="fa fa-users"></i>Login</a></li>
                <li><a href="about us.php"><i class="fa fa-book"></i>About Us</a></li>
                <li><a href="contact.php"><i class="fa fa-phone"></i>Contact</a></li>
            </ul>
        </div>
        <hr>
        <div class="background_image">
            <h3>Click here to start bidding:<a href="home.php">Bid now</a></h3>
        </div>
    </body>
</html>