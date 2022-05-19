<?php
    session_start();
    include('connection.php');
    include('functions.php');
    update_bids();
    $user_data=check_login($conn);
    $userid=$user_data['userid'];
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
                <li><a href="about us.php"><i class="fa fa-book"></i>About Us</a></li>
                <li><a href="contact.php"><i class="fa fa-phone"></i>Contact</a></li>
                
            </ul>
        </div>
        <hr>
<table width="1078"  align="center" border="2px" bgcolor="bisque">
<tr align="center">
	<td colspan="6"> <h2>Bids For <?php echo $user_data['username'];?></h2></td>
</tr>
<tr align="center" bgcolor="skyblue">

	    <th><br><h3>No.</h3></th>
	    <th><br><h3>Username</h3></th>
		<th><br><h3>Product Name</h3></th>
	    <th><br><h3>Bidamount</h3></th>
        <th><br><h3>Bid Expiry Date/Time</h3></th>
	    <th><br><h3>Status</h3></th>
        <th><br><h3>Latest Bid info</h3></th>
	         	         
</tr>
  <?php
  $user_id=$user_data['userid'];
  global $conn;
include("connection.php");

$get_bids="select * from bids where userid = $user_id";

$run_bids=mysqli_query($conn,$get_bids);

$count_bids=mysqli_num_rows($run_bids);
$i=0;
$j=0;
$k=0;
if($count_bids==0)
{
    echo "<h2>YOU CURRENTLY DON'T HAVE ANY BIDS</h2>";
    exit();
}
else
{
while($row_bids=mysqli_fetch_array($run_bids))
{ 	
  $productid=$row_bids['productid'];
  $bidamount=$row_bids['bidamount'];
  $status=$row_bids['status'];
  //Getting product details
  $get_product = "select * from products where productid = $productid";
  $run_product = mysqli_query($conn,$get_product);
  while($row_product=mysqli_fetch_array($run_product))
  {
	  $productname=$row_product['productname'];
      $bidendtime=$row_product['bidendtime'];
	  $j++;
  }
  $get_user = "select * from users where userid = $user_id";
  $run_user = mysqli_query($conn,$get_user);
  while($row_user=mysqli_fetch_array($run_user))
  {
	  $username=$row_user['username'];
	  $k++;
  }
  $i++;

?>
<tr align="center">
	
    <td><br><?php echo "<h3>$i</h3>";?></td>
	<td><br><?php echo "<h3>$username</h3>";?></td>
	<td><br><?php echo "<h3>$productname</h3>";?></td>
	<td><br><?php echo "<h3>$bidamount</h3>";?></td>
    <td><br><?php echo "<h3>$bidendtime</h3>";?></td>
	<td><br>
    <?php
    if($status==0)
    {
        echo "<h3>Pending</h3>";
    }
    else if($status==1)
    {
        echo "<h3>Successful</h3>";
    }
    else
    {
        echo "<h3>Unsuccesful</h3>";
    }
    ?></td>
    <td><br><a href="latestbids.php?productid=<?php echo $productid; ?>">LatestBidinfo</a></td>

</tr>
<?php } ?>
   </table>
    </body>
</html>
<?php }?>

