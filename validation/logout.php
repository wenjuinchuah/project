<?php
    ob_start();
    session_start();
    include '../validation/connectSQL.php';

    //Remove COOKIE Created
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
    $anonymousID = $_COOKIE['anonymousID'];
    $sql = "DROP TABLE anonymous_$anonymousID";
    $result = mysqli_query($conn, $sql);
    
    if (isset($_COOKIE['anonymousID'])) {
        unset($_COOKIE['anonymousID']);
    }
    
    if (isset($_COOKIE['productID'])) {
        unset($_COOKIE['productID']);
    }

    header("location: ../index.php");
    session_reset();
    session_destroy();
    ob_end_flush();
?>