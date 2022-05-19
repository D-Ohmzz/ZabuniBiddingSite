<?php

if(!isset($_SESSION['adminid']))
{
echo "<script> window.open('login.php?not_admin=You are not a admin !','_self') </script>";
}
else
{

?>

<?php

include("includes/db.php");

if(isset($_GET['edit_category']))
{
	$categoryid=$_GET['edit_category'];

	$get_category="select * from categories where categoryid='$categoryid'";
    
    $run_category=mysqli_query($conn,$get_category);

    $row_category=mysqli_fetch_array($run_category);

    $categoryid=$row_category['categoryid'];
    $categoryname=$row_category['categoryname'];
}

?>

<form action="" method="post" style="padding: 150px; text-align: center; color: red; background-color: bisque">   
<b>Edit Category:</b> &emsp;
<input type="text" name="new_category" value="<?php echo $categoryname; ?>" /> &emsp;
<input type="submit" name="update_category" value="Update Category" style="color: black; background-color: skyblue" />
</form>
<?php
include("includes/db.php");
if(isset($_POST['update_category']))
{
$updateid=$categoryid;
//Getting the new categoryname from the form	
$new_category=$_POST['new_category'];
//Updating the category
$update_category="update categories set categoryname='$new_category' where categoryid='$updateid'";
$run_category=mysqli_query($conn,$update_category);
if($run_category)
{

 
 echo "<script> alert('Category updated Successfully...!')</script>";
 echo "<script> window.open('index.php?view_categories','_self') </script>";
}

}
?>

<?php } ?>