<?php
    session_start();
    include('connection.php');
    include('functions.php');
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //Something was posted
        $username=$_POST['username'];
        $password=$_POST['password'];
        //Hshing users passwrod to protect against attacks
        $hashpass=md5($_POST['password']);
       if(isset($username) || isset($password))
        {
            //Databsase connection
            $conn = new mysqli($dbhost, $dbuser, $dbpass ,$dbname);;
            //read from database
            $query="SELECT * FROM users WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if($result == TRUE)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $hashpass)
                    {
                        $_SESSION['userid']=$user_data['userid'];
                        echo "<script>alert('Login Successful!')</script>";
                        header("Location: home.php");
                        die;
                    }
                    else
                    {
                        echo"<script> alert('Invalid Username or Password !') </script>";
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="auctionsite.css">
    <title> ACCOUNT LOGIN </title>
    <link rel="icon" href="letterz2.png">
    <script src="https://kit.fontawesome.com/d02a27485b.js" crossorigin="anonymous"></script>
    <metaname name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src=" "></script>
</head>
<body>
    <div id="head">
        <ul>
            <li> <i class="fa-solid fa-mobile" >   0712345678</i></li>
            <li><h2>ZABUNI BIDDING SITE</h2></li>
            <li> <i class="fa-solid fa-envelope" >zabuni@gmail.com</i> </li>
            <li><a href="index.php"><i class="fa fa-home"></i> Back to Mainpage</a></li>
        </ul>
    </div>
    <div class='login_container'>
        <form id="login_form" method="POST">
            <h2>Account Login</h2>
            <hr>
            <div class="login_input">
                <label>Username</label>
                <input id="username" type="text" name="username" placeholder="Enter your username">
                <div class ="error"></div>
            </div>
            <div class="login_input">
                <label>Password</label>
                <input id="password" type="password"name= "password" placeholder="Enter your password">
                <div class ="error"></div>
            </div>
            <div class="login_registration">
                <l>Don't have an account? Register below:<a href="registration.php"> Register </a></l>
            </div>
            <button type="submit" name="send">SEND</button>
            <button type="reset" name="clear">CLEAR</button>
        </form>
    </div>
</body>