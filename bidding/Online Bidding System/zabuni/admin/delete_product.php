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
if(isset($_GET['delete_product']))
{
  //Getting the category id 
  $deleteid=$_GET['delete_product'];
  //deleting the category from the database
  $delete_product="delete from products where productid='$deleteid'";
  $run_delete=mysqli_query($conn,$delete_product) or die("Query not working");
  if($run_delete)
  {
    echo "<script>alert('Product has been deleted..!')</script>";
    echo "<script>window.open('index.php?view_products','_self')</script>";
  }
}
?>
<?php } ?>