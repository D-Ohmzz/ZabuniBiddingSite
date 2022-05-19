<?php
    function check_login($conn) //function for making sure that only logged in users can access a certian page
    {
        if(isset($_SESSION['userid']))
        {
            $id = $_SESSION['userid'];
            $query = "select * from users where userid = '$id' limit 1";
            $result = mysqli_query($conn,$query);
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
        //redirect to login
        header("Location:login.php");
        die;
    }
    function get_categories()   //function displaying categories on the sidebar
    {
        global $conn;
        $get_categories = "select * from categories ";  /* writing a query */
        $run_categories=mysqli_query($conn, $get_categories);   /* running the query */
        while ($row_cats=mysqli_fetch_array($run_categories))  
        {
            $categoryid=$row_cats['categoryid'];
            $categoryname=$row_cats['categoryname'];
            echo "<li><a href='home.php?category=$categoryid'>$categoryname</a></li>";
        }
    }
    function get_products()         // function for displaying products on homepage
    {     
        if(!isset($_GET['categories']))
        {
           
                echo '<link rel="stylesheet" href ="auctionsite.css" media="all" />';
                global $conn;
                $get_products="select * from products";
                $run_products=mysqli_query($conn,$get_products);
                while($row_products=mysqli_fetch_array($run_products))
                {
                    $productid=$row_products['productid'];	
                    $categoryid=$row_products['categoryid'];
                    $productname=$row_products['productname'];
                    $startbid=$row_products['startbid'];
                    $regularprice=$row_products['regularprice'];
                    $bidendtime=$row_products['bidendtime'];
                    $productimage=$row_products['productimage'];
                    $datecreated=$row_products['datecreated'];                                   
                    echo "                               
                    <div id='single_product'>
                        <h3>$productname</h3>                          
                        <img src='admin/uploads/$productimage' width='200' height='200' />
                        <p> Regular price:KSH.<b>$regularprice</b></p>
                        <p> Start bid:KSH.<b>$startbid</b></p>
                        <p> Bid End Time:<b>$bidendtime</b></p>
                        <a href='viewproduct.php?product=$productid'><button style='float:center'>Bid for product</button></a>
                    </div>
                    ";
                }                         
        }
    }
    function get_categoryproducts()     // Function for displaying products based on category
    {     
        if(isset($_GET['category']))
        {
            $categoryid=$_GET['category'];    
            echo '<link rel="stylesheet" href ="auctionsite.css" media="all" />';
            global $conn;
            $get_categoryproducts="select * from products where categoryid='$categoryid'";
            $run_categoryproducts=mysqli_query($conn,$get_categoryproducts);
            $count_categories=mysqli_num_rows($run_categoryproducts);
            if($count_categories==0)
            {
                echo "<h2>Sorry No Products Available For This Category!</h2>";
                exit();
            }
            else
            {                                     
                while($row_cat_pro=mysqli_fetch_array($run_categoryproducts))
                {

                    $productid=$row_cat_pro['productid'];	
                    $productname=$row_cat_pro['productname'];
                    $startbid=$row_cat_pro['startbid'];
                    $regularprice=$row_cat_pro['regularprice'];
                    $bidendtime=$row_cat_pro['bidendtime'];
                    $productimage=$row_cat_pro['productimage'];
                    $datecreated=$row_cat_pro['datecreated'];
                    echo"
                    <div id='single_product'>
                    <h3>$productname</h3>                          
                    <img src='admin/uploads/$productimage' width='200' height='200' />
                    <p> Regular price:KSH.<b>$regularprice</b></p>
                    <p> Start bid:KSH.<b>$startbid</b></p>
                    <p> Bid End Time:<b>$bidendtime</b></p>
                    <a href='viewproduct.php?product=$productid'><button style='float:center'>Bid for product</button></a>
                    </div>
                    ";
                }                  
            }
        }
    }

    function get_bidproduct()     // Function for displaying the product selected for bidding
    {     
        if(isset($_GET['product']))
        {
            $productid=$_GET['product'];    
            echo '<link rel="stylesheet" href ="auctionsite.css" media="all" />';
            global $conn;
            $get_product="select * from products where productid='$productid'";
            $run_product=mysqli_query($conn,$get_product);
            while($row_cat_pro=mysqli_fetch_array($run_product))
                {

                    $productid=$row_cat_pro['productid'];	
                    $productname=$row_cat_pro['productname'];
                    $startbid=$row_cat_pro['startbid'];
                    $regularprice=$row_cat_pro['regularprice'];
                    $bidendtime=$row_cat_pro['bidendtime'];
                    $productimage=$row_cat_pro['productimage'];
                    $datecreated=$row_cat_pro['datecreated'];
                    echo"
                    <div id='single_product'>
                    <h3>$productname</h3>                          
                    <img src='admin/uploads/$productimage' width='200' height='200' />
                    <p> Regular price:KSH.<b>$regularprice</b></p>
                    <p> Start bid:KSH.<b>$startbid</b></p>
                    <p> Bid End Time:<b>$bidendtime</b></p>
                    </div>
                    ";             
                }                   
        }
    }

    function update_bids()  // Function for updating the bid status at the end of the bidding time for every product
    {
        date_default_timezone_set('Africa/Nairobi');
        global $conn;
        $i=0;
        $get_products="select * from products";
        $run_products=mysqli_query($conn,$get_products);
        while($row_products=mysqli_fetch_array($run_products))
        {
            $productid=$row_products['productid'];
            $bidendtime=$row_products['bidendtime'];
            $get_bids="select * from bids where productid = $productid";
            $run_bids=mysqli_query($conn,$get_bids);
            $currentdatetime = date('Y-m-d H:i:s'); 
            if($currentdatetime>=$bidendtime)
            {
                //Updating the status of a bid after the bidding time has elapsed
                $first_statusupdate="UPDATE bids SET status= '1' WHERE productid='$productid' AND bidamount = (SELECT MAX(bidamount) FROM bids where productid='$productid')";
                $second_statusupdate="UPDATE bids SET status= '2' WHERE productid='$productid' AND bidamount < (SELECT MAX(bidamount) FROM bids where productid='$productid')";
                $run_firstupdate=mysqli_query($conn,$first_statusupdate);
                $run_secondupdate=mysqli_query($conn,$second_statusupdate);
            }
            else //For the case of edited products
            {
                $third_statusupdate="UPDATE bids SET status= '0' WHERE productid='$productid'";
                $run_thirdupdate=mysqli_query($conn,$third_statusupdate);

            }
        }
        $i++;
    }

?>
