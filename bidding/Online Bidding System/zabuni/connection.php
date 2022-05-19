<?php
    $dbhost= 'localhost';
    $dbuser= 'root';
    $dbpass= '';
    $dbname = 'biddingsystem';

    //Database connection
    if(!$conn = new mysqli($dbhost, $dbuser, $dbpass ,$dbname))
    {
        die('Failed to connect to the database');
    }

?>