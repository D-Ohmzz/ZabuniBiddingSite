<?php
if(!isset($_SESSION['adminid']))//Making sure only logged in admins can access this page
{
echo "<script> window.open('login.php?not_admin=You are not a admin !','_self') </script>";
}
else
{
?>
<form action="" method="post" style="padding: 150px; text-align: center; color: blue; background-color: white">    
<b>Add New Category:</b> &emsp;
<input type="text" name="new_category" required /> &emsp;
<input type="submit" name="add_category" value="Add Category" style="color: black; background-color: skyblue" />
</form>
<?php
include("includes/db.php");
if(isset($_POST['add_category']))
{
//Fetching the new categoryname and storing it in a variable called new_category
$new_category=$_POST['new_category'];
//Inserting the new category into the database
$insert_category="insert into categories (categoryname) values('$new_category')";
$run_category=mysqli_query($conn,$insert_category);
if($run_category)
{
 echo "<script> alert('New Category inserted Successfully..!')</script>";
 echo "<script> window.open('index.php?view_categories','_self') </script>";
}
}
?>
<?php } ?>