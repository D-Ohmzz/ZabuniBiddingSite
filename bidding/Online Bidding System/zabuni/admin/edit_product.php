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
if(isset($_GET['edit_product']))
{
  //Getting the productid
  $get_productid=$_GET['edit_product']; 
  //Getting productdetails     
  $get_product="select * from products where productid='$get_productid'";
  $run_product=mysqli_query($conn,$get_product);
  $row_product=mysqli_fetch_array($run_product);
  $productid=$row_product['productid'];
  $categoryid=$row_product['categoryid'];	
  $productname=$row_product['productname'];
  $startbid=$row_product['startbid'];
  $pregularprice=$row_product['regularprice'];
  $bidendtime=$row_product['bidendtime'];
  $productimage=$row_product['productimage'];

  //Categorydetails
  $get_category="select * from categories where categoryid='$categoryid'";
  $run_category=mysqli_query($conn,$get_category);
  $row_category=mysqli_fetch_array($run_category);
  $categoryname=$row_category['categoryname'];

}
?>
<html>
<head>
<title>Admin Panel</title>
</head>
<body>
  <form action=" " method="post">
    <table align="center" width="1077" height="622" border="2" bgcolor="bisque">
      <tr align="center"> 
        <td colspan="6"><h2>EDIT PRODUCT</h2></td>
      </tr>

      <tr>
 	      <td align="right"> Product Name: </td>
 	      <td align="left"><input type="text" name="productname" value="<?php echo $productname;?>" />
      </tr>
    
      <tr>
 	      <td align="right"> Regular Price: </td>
 	      <td align="left" ><input type="number" name="regularprice"  value="<?php echo $pregularprice;?>" />
      </tr>

      <tr>
 	      <td align="right"> Start Bidding Amount: </td>
 	      <td align="left" ><input type="number" name="startbid"  value="<?php echo $startbid;?>" 
      </tr>

      <tr>
 	      <td align="right"> Bidding End Date/Time: </td>
 	      <td align="left" ><input type="datetime-local" name="bidendtime"  value="<?php echo $bidendtime;?>" />
      </tr>
      <tr align="center">
 	      <td colspan="8"><input type="submit" name="update_product" value="Update" />
      </tr>
    </table>
          

</body>
</html>


<?php
  global $conn;
 if(isset($_POST['update_product']))
  {
    // getting data from fields
    $update_id=$productid;
    $productname=$_POST['productname'];
    $regularprice=$_POST['regularprice'];
    $startbid=$_POST['startbid'];
    $bidendtime=$_POST['bidendtime'];
    
    //Updating the product

    $update_query = "update products set productname='$productname', startbid='$startbid', regularprice='$regularprice', bidendtime='$bidendtime' where productid='$update_id' ";

    $update_product=mysqli_query($conn,$update_query) or die ("can not work!"); 

    if($update_product)
    {
    echo "<script>alert('Product has been updated..!')</script>";
    echo "<script> window.open('index.php?view_product','self')</script>"; 
    }

  }
?>

<?php  }  ?>



