<?php
    $orderID = $_REQUEST['id'];
    include '../validation/connectSQL.php';

    if ($conn) {
        $sql = "SELECT * FROM order_details WHERE orderID = '$orderID'";
        if ($result = mysqli_query($conn, $sql)) {
            $orderDetails = mysqli_fetch_assoc($result);
            if ($orderDetails['Status'] == 'To Receive') {
                //update status
                echo 'Received';
                $sql = "UPDATE order_details SET Status = 'Received' WHERE orderID = '$orderID'";
                $result = mysqli_query($conn, $sql);
            } else if ($orderDetails['Status'] == 'To Ship') {
                //update status
                echo 'Cancelled';
                $sql = "UPDATE order_details SET Status = 'Cancelled' WHERE orderID = '$orderID'";
                $result = mysqli_query($conn, $sql);
            } //else do nothing
        }
    }
?>