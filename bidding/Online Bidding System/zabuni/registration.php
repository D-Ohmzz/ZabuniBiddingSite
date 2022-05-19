<?php
    session_start();
    include('connection.php');
    $firstname = $lastname = $username = $email = $password = $passwordconfirmation = NULL;
    $firstnameerr = $lastnameerr = $usernameerr = $emailerr = $passworderr = $passwordconfirmationerr =NULL;
    $flag = true;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //firstname
        if(empty($_POST['firstname']))
        {
            $firstnameerr = "Fill in your firstname";
            $flag = false;
        }else
        {
            $firstname=test_input($_POST['firstname']);
        }
        //lastname
        if(empty($_POST['lastname']))
        {
            $lastnameerr = "Fill in your lastname";
            $flag = false;
        }else
        {
            $lastname=test_input($_POST['lastname']);
        }
        //username
        if(empty($_POST['username']))
        {
            $usernameerr = "Fill in your username";
            $flag = false;
        }else
        {
            $username=test_input($_POST['username']);
        }
        //email
        if(empty($_POST['email']))
        {
            $emailerr = "Fill in your email";
            $flag = false;
        }elseif($_POST['email'])
        {
            $email=test_input($_POST['email']);
        }
        //password
        if(empty($_POST['password']))
        {
            $passworderr = "Fill in your password";
            $flag = false;
        }else
        {
            $password=test_input($_POST['password']);
        }
        //passwordconfirmation
        if(empty($_POST['passwordconfirmation']) || $_POST['passwordconfirmation']!=$_POST['password'])
        {
            $passwordconfirmationerr = "Passwords don't match";
            $flag = false;
        }
                
        if($flag)
        {
            //Database connection
            $conn = new mysqli($dbhost, $dbuser, $dbpass ,$dbname);
            //Inserting the collected data into the users table
            //Hashing password to protect against msqli injection
            $hashpass=md5($password);
            $stmt = $conn->prepare("INSERT INTO users(firstname,lastname,username,email,password) 
            VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss",$firstname,$lastname,$username,$email,$hashpass);
            $execval = $stmt->execute();
            echo $execval;
            if($execval == TRUE)
            {
            echo "<script>alert('Registartion Successful!')</script>";
            header("Location: login.php");
            }
            $stmt->close();
            $conn->close();
    
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="auctionsite.css">
        <title> REGISTRATION FORM</title>
        <link rel="icon" href="letterz2.png">
        <script src="https://kit.fontawesome.com/d02a27485b.js" crossorigin="anonymous"></script>
        <metaname name="viewport" content="width=device-width, initial-scale=1.0">
        <script defer src=" "></script>
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
                <li> <i class="fa-solid fa-mobile" >   0712345678</i></li>
                <li><h2>ZABUNI BIDDING SITE</h2></li>
                <li> <i class="fa-solid fa-envelope" >zabuni@gmail.com</i> </li>
                <li><a href="index.php"><i class="fa fa-home"></i> Back to Mainpage</a></li>
            </ul>
        </div>
        <div class='registrations_container'>
            <form id="registrations_form" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> " method="POST">
                <h2>Registration Form</h2>
                <hr>
                <div class="registrations_input">
                    <label>First Name</label>
                    <input id="firstname" type="text"name="firstname">
                    <span class="error">* <?php echo $firstnameerr;?></span>    
                </div>
                <div class="registrations_input">
                    <label>Last Name</label>
                    <input id="lastname" type="text"name="lastname">
                    <span class="error">* <?php echo $lastnameerr;?></span>
                </div>
                <div class="registrations_input">
                    <label>Username</label>
                    <input id="username" type="text"name="username">
                    <span class="error">* <?php echo $usernameerr;?></span>
                </div>
                <div class="registrations_input">
                    <label>Email</label>
                    <input id="email" type="text" name="email">
                    <span class="error">* <?php echo $emailerr;?></span>
                </div>
                <div class="registrations_input">
                    <label>Password</label>
                    <input id="password" type="password"name="password">
                    <span class="error">* <?php echo $passworderr;?></span>
                </div>
                <div class="registrations_input">
                    <label>Password Confirmation</label>
                    <input id="passwordconfirmation" type="password" name="passwordconfirmation">
                    <span class="error">* <?php echo $passwordconfirmationerr;?></span>
                </div>
                <button type="submit" name="send">SUBMIT <div class ="error"></div></button>
                <button type="reset" name="clear">CLEAR</button>
            </form>
        </div>
    </body>
</html>