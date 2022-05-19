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
		<td colspan="6"> <h2>View All Users Here</h2></td>
	</tr>
	<tr align="center" bgcolor="skyblue">
	    <th><br>No.</th>
	    <th><br>FirstName</th>
		<th><br>LastName</th>
	    <th><br>Username</th>
	    <th><br>Email</th>
	         	         
	</tr>
	<?php
	include("includes/db.php");
	//Getting users' details
	$get_user="select * from users";
	$run_user=mysqli_query($conn,$get_user);
	$i=0;
	while($row_user=mysqli_fetch_array($run_user))
	{
  	$userid=$row_user['userid']; 	
  	$firstname=$row_user['firstname'];
  	$lastname=$row_user['lastname'];
  	$username=$row_user['username'];
  	$email=$row_user['email'];
  	$i++;
	?>
	<tr align="center">
    	<td><br><?php echo $i;?></td>
		<td><br><?php echo $firstname;?></td>
		<td><br><?php echo $lastname;?></td>
		<td><br><?php echo $username;?></td>
		<td><br><?php echo $email;?></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>