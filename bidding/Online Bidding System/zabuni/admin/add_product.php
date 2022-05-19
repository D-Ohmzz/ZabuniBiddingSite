<?php
include("includes/db.php");
if(!isset($_SESSION['adminid']))//Making sure only logged in admins can access this page
{

echo "<script> window.open('login.php?not_admin=You are not a admin !','_self') </script>";

}

else
{

?>
<html>
<head>
<title>Admin Panel</title>
</head>
<body>

  <form action=" " method="post" enctype="multipart/form-data">
    <table align="center" width="1077" height="622" border="2" bgcolor="bisque">
      <tr align="center">
 	      <td colspan="2" style="padding-top:10px;"><h2 >  Insert Products </h2></td>
      </tr>

      <tr>
 	      <td align="right"> Product Name: </td>
 	      <td align="left"><input type="text" name="productname" required />
      </tr>

      <tr>
 	      <td align="right"> Product Category: </td>
 	      <td align="left"> 
        <select name="categoryid">
        	<option>Select a Category</option>
          <?php
          //Query for getting category details
          $get_categories = "select * from categories ";  
			    $run_categories=mysqli_query($conn,$get_categories);  
      		while ($row_categories=mysqli_fetch_array($run_categories))  
					{

  					$categoryid=$row_categories['categoryid'];
  					$categoryname=$row_categories['categoryname'];
					  echo "<option value='$categoryid'>$categoryname</option>";
          }
          ?>
        </select>
 	      </td>
      </tr>

      <tr> 
 	      <td align="right"> Regular Price: </td>
 	      <td align="left" ><input type="number" name="regularprice"  required />
      </tr>

      <tr>
 	      <td align="right"> Starting Bid Amount: </td>
 	      <td align="left" ><input type="number" name="startbid"  required />
      </tr>

      <tr>	
 	      <td align="right"> Bid End Date/Time: </td>
 	      <td align="left" ><input type="datetime-local" name="bidendtime" required />
      </tr>

      <tr>
 	      <td align="right"> Product Image: </td>
 	      <td align="left"><input type="file" name="productimage"  />
      </tr>

      <tr align="center">
 	      <td colspan="8"><input type="submit" name="insert_post" value="Insert" />
      </tr>
    </table>
</body>
</html>
<?php
global $conn;
$pid=0;
if(isset($_POST['insert_post']))
{
  $get_products="select * from products where productid=(select max(productid) from products)";
  $run_products=mysqli_query($conn,$get_products);
  $count_products=mysqli_num_rows($run_products);
  if($count_products==0)
  {
    $pid=1;
  }
  else
  {
    $row_pro=mysqli_fetch_array($run_products);
    $maxproductid=$row_pro['productid'];
    $pid=$maxproductid;
    $pid=$pid+1;
  }

    // getting data from fields
    $productname=$_POST['productname'];
    $categoryid=$_POST['categoryid'];
    $regularprice=$_POST['regularprice'];
    $startbid=$_POST['startbid'];
    $bidendtime=$_POST['bidendtime'];  
    $ftype= explode('.',$_FILES['productimage']['name']);
		$ftype= end($ftype);
		$fname =$pid.'.'.$ftype;
		if(is_file('uploads/'. $fname))
			unlink('uploads/'. $fname);
		move_uploaded_file($_FILES['productimage']['tmp_name'],'uploads/'. $fname);
    //Saving the data to the database
    $stmt = $conn->prepare("INSERT INTO products(productname,categoryid,regularprice,startbid,bidendtime,productimage) 
    VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("siiiss",$productname,$categoryid,$regularprice,$startbid,$bidendtime,$fname);
    $execval = $stmt->execute();
    echo $execval;
    if($execval == TRUE)
    {
      echo "<script>alert('Product added successfully...!')</script>";
      echo "<script> window.open('index.php?view_products','_self') </script>";
    }
    $stmt->close();
    $conn->close();
}

?>



<?php } ?>



