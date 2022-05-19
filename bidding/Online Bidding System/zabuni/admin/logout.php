<?php
session_start();
if(isset($_SESSION['adminid']))
{
    unset($_SESSION['adminid']);
}
header("Location: login.php");
die;
?>