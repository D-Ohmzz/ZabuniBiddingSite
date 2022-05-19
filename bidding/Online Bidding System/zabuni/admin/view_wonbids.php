<?php

if(!isset($_SESSION['adminid']))
{
echo "<script> window.open('login.php?not_admin=You are not a admin !','_self') </script>";
}
else
{
?>

<table width="1078"  align="center" border="2px" bgcolor="bisque">
    <tr align="center">
	    <td colspan="6"> <h2>Won Bids</h2></td>
    </tr>
    <tr align="center" bgcolor="skyblue">
	    <th><br>No.</th>
        <th><br>Product Name</th>
	    <th><br>Winner</th>
	    <th><br>Bidamount</th>
	    <th><br>Status</th>
    </tr>

    <?php
    include("includes/db.php");
    //Getting bid details of won bids
    $get_bids="select * from bids where status= '1' ";
    $run_bids=mysqli_query($conn,$get_bids);

    $i=0;
    $j=0;
    $k=0;
    while($row_bids=mysqli_fetch_array($run_bids))
    {
    $userid=$row_bids['userid']; 	
    $productid=$row_bids['productid'];
    $bidamount=$row_bids['bidamount'];
    $status=$row_bids['status'];
    //Getting product details
    $get_product = "select * from products where productid = $productid";
    $run_product = mysqli_query($conn,$get_product);
    $row_product=mysqli_fetch_array($run_product);
    $productname=$row_product['productname'];
    //Geting user details
    $get_user = "select * from users where userid = $userid";
    $run_user = mysqli_query($conn,$get_user);
    $row_user=mysqli_fetch_array($run_user);
    $username=$row_user['username'];


    $i++;

    ?>
    <tr align="center">
        <td><br><?php echo $i;?></td>
        <td><br><?php echo $productname;?></td>
	    <td><br><?php echo $username;?></td>
	    <td><br><?php echo $bidamount;?></td>
	    <td><br><?php
        if($status==0)
        {
            echo "Pending";
        }
        else if($status==1)
        {
            echo "Successful";
        }
        else
        {
            echo "Unsuccesful";
        }
        ?></td>

    </tr>
    <?php } ?>
</table>
<?php } ?>