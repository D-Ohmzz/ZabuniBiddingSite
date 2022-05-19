<?php
         // establishing a database connection
$conn=mysqli_connect("localhost","root","","biddingsystem");
      // or die('Error ocurred while connecting')Incase of an error while trying to connect to the database;

if(mysqli_connect_errno())
{
	echo "Failed to connect to server :" .mysqli_connect_error();

}

?>

