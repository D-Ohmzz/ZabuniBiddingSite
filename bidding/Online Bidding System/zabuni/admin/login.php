<?php
    session_start();
    include('includes/db.php');
    include('includes/functions.php');
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //Something was posted
        $username=$_POST['username'];
        $password=$_POST['password'];
       if(isset($username) || isset($password))
        {
            //Databsase connection
            $conn = new mysqli('localhost', 'root', '' ,'biddingsystem');
            //read from database
            $query="select * from admin where username = '$username' limit 1";
            $result = mysqli_query($conn, $query);
            if($result == TRUE)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password)
                    {
                        $_SESSION['adminid']=$user_data['adminid'];
                        header("Location: index.php");
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
    <link rel="stylesheet" href="../auctionsite.css">
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
        </ul>
    </div>
    <div class='login_container'>
        <form id="login_form" method="POST">
            <h2>ADMIN LOGIN</h2>
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
            <button type="submit" name="send">SEND</button>
            <button type="reset" name="clear">CLEAR</button>
        </form>
    </div>
</body>