<?php
session_start();
include('connection.php');
include('functions.php');
$user_data=check_login($conn);
$user_id=$user_data['userid'];
$message=NULL;
$messageerr=NULL;
$flag = true;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //firstname
    if(empty($_POST['message']))
    {
        $messageerr = "Fill in your message/issue";
        $flag = false;
    }else
    {
        $message=$_POST['message'];
    }
    if($flag)
    {
        //Database connection
        $conn = new mysqli($dbhost, $dbuser, $dbpass ,$dbname);
        //Inserting the new category into the database
        $savemessage="insert into contact (userid,message) values('$user_id','$message')";
        $run_save=mysqli_query($conn,$savemessage);
        if($run_save)
        {
         echo "<script> alert('Your message has been sent, thank you')</script>";
         echo "<script> window.open('index.php','_self') </script>";
        }

    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="auctionsite.css">
        <title> ZABUNI AUCTION SITE</title>
        <link rel="icon" href="letterz2.png"> 
        <script src="https://kit.fontawesome.com/d02a27485b.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            .error{
                color:red;
                font-size:15px;
            }
        </style>
    </head>
    <body>
        <div id="head">
            <ul>
                <li> <i class="fa-solid fa-mobile" >0712345678</i></li>
                <li> <i class="fa-solid fa-envelope" >zabuni@gmail.com</i> </li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"><a href="logout.php"></i> LOGOUT</a></li>
                
            </ul>
        </div>
        <hr>
        <div id="top_panel">
            <img src="images/letterz2.png" width="90px" alt="trial">
            <div class="top_panel_container"></div>
            <h1>ZABUNI AUCTION SITE</h1>
        </div>
        <hr>
        <div id="horizontal_nav">
            <ul>
                <li class="active"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="login.php"><i class="fa fa-users"></i>Login</a></li>
                <li><a href="about us.php"><i class="fa fa-book"></i>About Us</a></li>
                <li><a href="contact.php"><i class="fa fa-phone"></i>Contact</a></li>
            </ul>
        </div>
        <hr>
        <div class="contact_form">
            <h2>Contact Us</h2>
            <p>You can reach us via our email:Zabuniauction@gmail.com or through our mobile number:079889503</p>
            <p>You can also fill out the form below incase of any querries</p>
            <form id="login_form" action= " " method="POST">
                <h2>Contact Form</h2>
                <hr>
                <div class="login_input">
                    <label>Message</label>
                    <textarea id="message" type="text"name="message"placeholder="Enter your message/issue here"></textarea>
                    <span class="error">* <?php echo $messageerr;?></span>
                </div>
                <div class="login_registration">
                    <l>Back to main page: <a href="index.php"> Homepage </a></l>
                </div>
                <button type="submit" name="send">SEND</button>
                <button type="reset" name="clear">CLEAR</button>
            </form>
        </div>
    </body>
</html>