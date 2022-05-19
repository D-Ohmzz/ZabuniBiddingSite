<?php
include("includes/db.php");
if(!isset($_SESSION['adminid']))
{
echo "<script> window.open('login.php?not_admin=You are not a admin !','_self') </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../auctionsite.css">
        <title> ZABUNI BIDDING SITE</title>
        <link rel="icon" href="images/letterz2.png"> 
        <script src="https://kit.fontawesome.com/d02a27485b.js" crossorigin="anonymous"></script>
    </head>
    <body>
	<table width="1078"  align="center" border="2px"  bgcolor="bisque">
		<tr align="center">
		   <td colspan="6"> <h2><br>View All Categories Here<br><br></h2></td>
	   	</tr>
	   	<tr align="center" bgcolor="skyblue">
			<th><br>No.</th>
			<th><br>Category ID</th>
			<th><br>Category Title</th>	   
			<th><br>Edit</th>
			<th><br>Delete</th>						 
	   	</tr> 
		<?php
	   include("includes/db.php");
	   //Getting category details from database
	   $get_category="select * from categories";
	   $run_category=mysqli_query($conn,$get_category);
	   $i=0;
	   while($row_cat=mysqli_fetch_array($run_category))
	   {
		 $categoryid=$row_cat['categoryid']; 	
		 $categoryname=$row_cat['categoryname'];
	
		 $i++;
	   
	   ?>
	   <tr align="center">
		   <td><br><?php echo $i;  ?></td>
		   <td><br><?php echo $categoryid;  ?></td>
		   <td><br><?php echo $categoryname;  ?></td>
		   <td><br><a href="index.php?edit_category=<?php echo $categoryid; ?>">Edit</a></td>
		   <td><br><a href="index.php?delete_category=<?php echo $categoryid; ?> ">Delete</a></td>
	   	</tr>
	   <?php } ?>
	</table>	  
    </body>
</html>