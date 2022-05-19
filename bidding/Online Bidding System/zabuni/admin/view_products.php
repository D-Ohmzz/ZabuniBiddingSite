<?php

if(!isset($_SESSION['adminid']))
{

echo "<script> window.open('login.php?not_admin=You are not a admin !','_self') </script>";

}

?>
<table width="1078"  align="center" border="2px"  bgcolor="bisque">
	<tr align="center">
		<td colspan="12"><h2>View All Products Here</h2></td>
	</tr>
	<tr align="center" bgcolor="skyblue">
		<th><br>No.</th>
	    <th><br>Product Image</th>
	    <th><br>Category</th>
	    <th><br>Product Name</th>
		<th><br>Regular Price</th>
		<th><br>Start Bid</th>
		<th><br>Bid End Date/Time</th>
		<th><br>Date Created</th>
	    <th><br>Edit</th>
	    <th><br>Delete</th>         	         
	</tr>

	<?php
	include("includes/db.php");
	//Getting product details
	$get_product="select * from products";
	$run_product=mysqli_query($conn,$get_product);
	$i=0;
	$j=0;
	while($row_product=mysqli_fetch_array($run_product))
	{
  	$productid=$row_product['productid'];
  	$categoryid=$row_product['categoryid'];	
  	$productname=$row_product['productname'];
  	$productimage=$row_product['productimage'];
  	$regularprice=$row_product['regularprice'];
  	$startbid=$row_product['startbid'];
  	$bidendtime=$row_product['bidendtime'];
  	$datecreated=$row_product['datecreated'];
  	//Getting categorydetails
  	$get_category = "select * from categories where categoryid = $categoryid";
  	$run_caterogy = mysqli_query($conn,$get_category);
  	while($row_category=mysqli_fetch_array($run_caterogy))
  	{
	  $categoryname=$row_category['categoryname'];
	  $j++;
  	}
  	$i++;
	?>
	<tr align="center">	
    	<td><br><?php echo $i;  ?></td>
		<td><br> <img src="<?php echo 'uploads/'.$productimage ?>" width='200' height='200'> </td>
		<td><br><?php echo $categoryname?></td>
		<td><br><?php echo $productname?></td>
		<td><br><?php echo $regularprice?></td>
		<td><br><?php echo $startbid?></td>
		<td><br><?php echo $bidendtime?><br></td>
		<td><br><?php echo $datecreated?></td>
		<td><br><a href="index.php?edit_product=<?php echo $productid; ?>">Edit</a></td>
		<td><br><a href="index.php?delete_product=<?php echo $productid; ?> ">Delete</a></td>
	</tr>
	<?php } ?>

</table>