<?php
    include '../validation/connectSQL.php';
    date_default_timezone_set('Asia/Kuala_Lumpur');
    ob_start();

    $orderID = $_SESSION['orderID'];
    $userID = $_SESSION['userID'];
    $address = $_SESSION['address'];
    $paymentMethod = $_SESSION['paymentMethod'];

    //if not login or not user
    if (!isset($_SESSION['role']) || isset($_SESSION['role']) != 'user') {
        header('../index.php');
        ob_end_flush();
    } else {
        //search for the table
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'order_details'";
        if ($result = mysqli_query($conn, $sql)) {
            
            $row = mysqli_num_rows($result);
            if ($row == 0) { //if no table, create table
                $sql = "CREATE TABLE order_details (
                    orderID VARCHAR(50) NOT NULL,
                    userID VARCHAR(50) NOT NULL,
                    Address VARCHAR(250) NOT NULL,
                    PaymentMethod VARCHAR(10) NOT NULL,
                    PaymentDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    Status VARCHAR(50) NOT NULL DEFAULT 'To Ship'
                )";
                $result = mysqli_query($conn, $sql);
            }
            //then, insert the order detail into the table
            $sql = "INSERT INTO order_Details (orderID, userID, Address, PaymentMethod)
                    VALUES ('order_$orderID', '$userID', '$address', '$paymentMethod')";
            $result = mysqli_query($conn, $sql);
        } else {
            die (mysqli_error($conn));
        }
    }
?>