<?php
    ob_start();
    session_start();
    include '../validation/connectSQL.php';

    //Remove Session Created
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
    $anonymousID = $_SESSION['anonymousID'];
    $sql = "DROP TABLE anonymous_$anonymousID";
    $result = mysqli_query($conn, $sql);

    header("location: ../index.php");
    session_reset();
    session_destroy();
    ob_end_flush();
?>