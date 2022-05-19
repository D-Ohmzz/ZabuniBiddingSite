<?php
    session_start();
    include('connection.php');
    include('functions.php');
    update_bids();
    $user_data=check_login($conn);
    $userid=$user_data['userid'];
    $user_name=$user_data['username'];
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
                <li class="active"><a href="home.php"><i class="fa fa-arrow-left"></i>Back to Homepage</a></li>
                <li class="active"><a href="mybids.php"><i class="fa fa-home"></i>My Bid History</a></li>
                <li><a href="about us.php"><i class="fa fa-book"></i>About Us</a></li>
                <li><a href="contact.php"><i class="fa fa-phone"></i>Contact</a></li>
                
            </ul>
        </div>
        <hr>
<table width="1078"  align="center" border="2px" bgcolor="bisque">
<tr align="center">
	<td colspan="7"> <h2>Latest Bid Information For This Product</h2></td>
</tr>
<tr align="center" bgcolor="skyblue">

	    <th><br><h3>Username</h3></th>
		<th><br><h3>Product Image</h3></th>
        <th><br><h3>Product Name</h3></th>
	    <th><br><h3>Your Last Bid For This Product</h3></th>
        <th><br><h3>The Current Highest Bid For This Product</h3></th>
	    <th><br><h3>Your Bid Status</h3></th>
        <th><br><h3>Bid Expiry Date/Time</h3></th>
	         	         
</tr>
<?php
if(isset($_GET['productid']))
{
    $p=$_GET['productid'];
    $get_bids="select * from bids where userid = '$userid' and productid = '$p' and bidamount = (select max(bidamount)from bids where userid = '$userid' and productid = '$p')";
    $run_bids=mysqli_query($conn,$get_bids);
    $count_bids=mysqli_num_rows($run_bids);
    $row_latest=mysqli_fetch_array($run_bids);
    $latest_status=$row_latest['status'];
    $latest_bidamount=$row_latest['bidamount'];
    $latestprod=$row_latest['productid'];
    $get_prod="select * from products where productid = $latestprod";
    $run_prod=mysqli_query($conn,$get_prod);
    $prod=mysqli_fetch_array($run_prod);
    $productname=$prod['productname'];
    $productimage=$prod['productimage'];
    $bidendtime=$prod['bidendtime'];
    $get_highest=$conn->query("select MAX(bidamount) as highest from bids where productid ='$p'");
    while($row=mysqli_fetch_array($get_highest, MYSQLI_ASSOC))
    {
        $highest=$row['highest']; //assigning the highest bid amount to a variable called highest
    }


}

?>
<tr align="center">
	
	<td><br><?php echo "<h3>$user_name</h3>";?></td>
    <td><br> <img src="<?php echo 'admin/uploads/'.$productimage ?>" width='200' height='200'> </td>
	<td><br><?php echo "<h3>$productname</h3>";?></td>
	<td><br><?php echo "<h3>$latest_bidamount</h3>";?></td>
    <td><br><?php echo "<h3>$highest</h3>";?></td>
    
	<td><br>
    <?php
    if($latest_status==0)
    {
        echo "<h3>Pending</h3>";
    }
    else if($latest_status==1)
    {
        echo "<h3>Successful</h3>";
    }
    else
    {
        echo "<h3>Unsuccesful</h3>";
    }
    ?></td>
    <td><br><?php echo "<h3>$bidendtime</h3>";?></td>
</tr>
   </table>
    </body>
</html>
