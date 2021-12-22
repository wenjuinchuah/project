<?php
    session_start();
    include 'validation/connectSQL.php';

    //Select UserID from user
    $loginUsername = $_SESSION['loginUser'];
    $userID = $_SESSION['userID'];

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'shoppingcart');
    if ($conn) {
        $sql = "SELECT * FROM shoppingcart";
        $result = mysqli_query($conn, $sql);

        $sql = "TRUNCATE TABLE user_$userID";
        $result = mysqli_query($conn, $sql);
    }
?>