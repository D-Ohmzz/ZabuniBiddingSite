<?php
    session_start();
    include('connection.php');
    include('functions.php');
    update_bids();
    //Validation such that only logged in users can place a bid for a product
    $user_data=check_login($conn);
    //creating an empty variable called bidamount that will hold the bidamount once it is posted
    $bidamount = NULL;
    //creating an empty variable called bidamount err that will hold the error message 
    $bidamounterr = NULL;
    $flag = true;
    if(isset($_GET['product']))
	{
		$productid=$_GET['product'];    
		echo '<link rel="stylesheet" href ="auctionsite.css" media="all" />';
		global $conn;
		$get_product="select * from products where productid='$productid'";
		$run_product=mysqli_query($conn,$get_product);
		while($row_cat_pro=mysqli_fetch_array($run_product))
			{

				$productid=$row_cat_pro['productid'];	
				$productname=$row_cat_pro['productname'];
				$startbid=$row_cat_pro['startbid'];
				$regularprice=$row_cat_pro['regularprice'];
				$bidendtime=$row_cat_pro['bidendtime'];
				$productimage=$row_cat_pro['productimage'];
				$datecreated=$row_cat_pro['datecreated'];
                $startbid=$row_cat_pro['startbid'];
			}
        //getting the highest bid amount for the product from the database
        $get_highest=$conn->query("select MAX(bidamount) as highest from bids where productid ='$productid'");
        while($row=mysqli_fetch_array($get_highest, MYSQLI_ASSOC))
        {
            $highest=$row['highest']; //assigning the highest bid amount to a variable called highest
        }
	}
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $bidamount=$_POST['bidamount'];
        //Validating that the entered bidamount is higher than the current highest bid or starting bid if it is the first bid
        if($_POST['bidamount'] <= $highest || $_POST['bidamount'] <= $startbid)
        {
            $bidamounterr = "Bid amount must be higher than the highest bid/start bid";
            $flag = false;
        }
        if($flag)
        {
            //Database connection
            $conn = new mysqli($dbhost, $dbuser, $dbpass ,$dbname);
            //Inserting the bid into the bids table
            $stmt = $conn->prepare("INSERT INTO bids (userid, productid, bidamount) 
            VALUES(?,?,?)");
            $stmt->bind_param("iii",$user_data["userid"],$productid,$bidamount);
            $execval = $stmt->execute();
            echo $execval;
            if($execval == TRUE)
            {
            echo "<script>alert('Bid has been saved successfully!')</script>";
            header("Location: home.php");
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
        <title> ZABUNI BIDDING SITE</title>
        <link rel="icon" href="images/letterz2.png"> 
        <script src="https://kit.fontawesome.com/d02a27485b.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            .error{
                color:red;
                font-size:18px;
            }
        </style>
    </head>
    <body>
        <div id="head">
            <ul>
                <li> <i class="fa-solid fa-mobile" >  0712345678</i></li>
                <li> <i class="fa-solid fa-envelope" >zabuni@gmail.com</i> </li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"><a href="logout.php"></i> LOGOUT</a></li>
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
                <li class="active"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="about us.php"><i class="fa fa-book"></i>About Us</a></li>
                <li><a href="contact.php"><i class="fa fa-phone"></i>Contact</a></li>
            </ul>
        </div>
        <hr>
		<div class="bid_section">
			<div id="products_box">
				<?php
            	//get_products();
            	get_bidproduct();
				?>
			</div>
			<div class="bid_container">
				<form id="bid_form" method="POST">
					<h4>BIDDING FORM</h4>
                    <p>Start Bid: KSH.<b id="startbid"><?php echo $startbid?></b></p>
                    <p>Current Highest Bid: KSH.<b id="highestbid"><?php echo $highest?></b></p>
					<div class="bid_input">
                    <label>Bid amount</label>
                	<input id="bidamount" type="number"name= "bidamount" placeholder="Enter bidamount">
                    <span class="error">* <?php echo $bidamounterr;?></span>
					</div>
					<button type="submit" name="send">SAVE</button>
					<button type="reset" name="clear">CLEAR</button>
				</form>
			</div>
		</div>   
    </body>
</html>
