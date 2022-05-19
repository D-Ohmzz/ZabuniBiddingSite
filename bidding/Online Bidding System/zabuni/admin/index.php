<?php
    session_start();
    include('includes/db.php');
    include('includes/functions.php');
    $user_data=checkadmin($conn);   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../auctionsite.css">
        <title> ZABUNI BIDDING SITE</title>
        <link rel="icon" href="images/letterz2.png"> 
        <script src="https://kit.fontawesome.com/d02a27485b.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="head">
            <ul>
                <li> <i class="fa-solid fa-mobile" >  0712345678</i></li>
                <li> <i class="fa-solid fa-envelope" >zabuni@gmail.com</i> </li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"><a href="logout.php"></i> LOGOUT</a></li>
            </ul>
        </div>
        <hr>
        <div id="top_panel">
            <img src="../images/letterz2.png" width="90px" alt="trial">
            <div class="top_panel_container"></div>
            <h1>ZABUNI BIDDING SITE</h1> <h1>ADMIN SIDE</h1>
        </div>
        <hr>
        <div id="horizontal_nav">
            <ul>
                <li class="active"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="index.php?view_messages"><i class="fa fa-message"></i>View Messages</a></li> 
                <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Log Out</a></li>
            </ul>
        </div>
        <hr>
        <div class="content">           
			<div id="sidebar">
			    <div id="sidebar_title">
                    <h3>ADMIN PANEL</h3>
                    <ul id="cats">
                        <hr>
                    <li> <a href="index.php?view_products">View Products</a> </li>
                    <hr>
                    <li> <a href="index.php?add_product">Add Product</a> </li>
                    <hr>
                    <li><a href="index.php?view_categories">View Categories</a></li>
                    <hr>
                    <li><a href="index.php?add_category">Add Category</a></li>
                    <hr>
                    <li><a href="index.php?view_users">View Users</a></li>
                    <hr>
                    <li><a href="index.php?view_bids">View All Bids</a></li>
                    <hr> 
                    <li><a href="index.php?view_pendingbids">View Pending Bids</a></li> 
                    <hr>  
                    <li><a href="index.php?view_lostbids">View Lost Bids</a></li> 
                    <hr>
                    <li><a href="index.php?view_wonbids">View Won Bids</a></li>    
			        </ul>
                </div>
			</div>
        </div>
    </body>
</html>
<?php
if(isset($_GET['add_product']))
{
    include("add_product.php");
}

if(isset($_GET['view_products']))
{
    include("view_products.php");
}

if(isset($_GET['edit_product']))
{
    include("edit_product.php");
}

if(isset($_GET['add_category']))
{
    include("add_category.php");
}

if(isset($_GET['view_categories']))
{
    include("view_categories.php");
}

if(isset($_GET['edit_category']))
{
    include("edit_category.php");
}

if(isset($_GET['delete_category']))
{
    include("delete_category.php");
}
if(isset($_GET['delete_product']))
{
    include("delete_product.php");
}
                
if(isset($_GET['view_users']))
{
    include("view_users.php");
}

if(isset($_GET['view_bids']))
{
    include("view_bids.php");
}
if(isset($_GET['view_pendingbids']))
{
    include("view_pendingbids.php");
}
if(isset($_GET['view_lostbids']))
{
    include("view_lostbids.php");
}
if(isset($_GET['view_wonbids']))
{
    include("view_wonbids.php");
}
if(isset($_GET['view_messages']))
{
    include("messages.php");
}

?>
