<?php

if(!isset($_SESSION['adminid']))
{

echo "<script> window.open('login.php?not_admin=You are not admin !','_self') </script>";

}

else
{
?>
<?php 
include("includes/db.php");   
if(isset($_GET['delete_category']))
{
  //Getting the category id 
  $deleteid=$_GET['delete_category'];
  //deleting the category from the database
  $delete_category="delete from categories where categoryid='$deleteid'";
  $run_delete=mysqli_query($conn,$delete_category) or die("Query not working");
  if($run_delete)
  {
    echo "<script>alert('Category has been deleted..!')</script>";
    echo "<script>window.open('index.php?view_categories','_self')</script>";
  }
}
?>
<?php } ?>