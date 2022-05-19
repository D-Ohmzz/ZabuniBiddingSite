<?php

if(!isset($_SESSION['adminid']))
{

echo "<script> window.open('login.php?not_admin=You are not a admin !','_self') </script>";

}

?>
<table width="1078"  align="center" border="2px"  bgcolor="bisque">
	<tr align="center">
		<td colspan="12"><h2>View Messages From Users Here</h2></td>
	</tr>
	<tr align="center" bgcolor="skyblue">
		<th><br>No.</th>
	    <th><br>Username</th>
	    <th><br>Email</th>
	    <th><br>Message</th>       	         
	</tr>

	<?php
	include("includes/db.php");
	//Getting messages form the database
	$get_messages="select * from contact";
	$run_messages=mysqli_query($conn,$get_messages);
	$i=0;
	$j=0;
	while($row_message=mysqli_fetch_array($run_messages))
	{
  	$userid=$row_message['userid'];
  	$message=$row_message['message'];	

  	//Getting user details
  	$get_user = "select * from users where userid= $userid";
  	$run_user = mysqli_query($conn,$get_user);
  	while($row_user=mysqli_fetch_array($run_user))
  	{
	  $username=$row_user['username'];
      $email=$row_user['email'];
	  $j++;
  	}
  	$i++;
	?>
	<tr align="center">	
    	<td><br><?php echo $i;  ?></td>
		<td><br><?php echo $username?></td>
		<td><br><?php echo $email?></td>
		<td><br><?php echo $message?></td>
	</tr>
	<?php } ?>

</table>