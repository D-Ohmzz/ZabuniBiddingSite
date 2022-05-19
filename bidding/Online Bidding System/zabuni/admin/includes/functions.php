<?php
function checkadmin($conn)
{
    if(isset($_SESSION['adminid']))
    {
        $adminid = $_SESSION['adminid'];
        $query = "select * from admin where adminid = '$adminid' limit 1";
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
?>