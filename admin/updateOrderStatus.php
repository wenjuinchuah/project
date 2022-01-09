<?php
    session_start();
    include '../validation/connectSQL.php';
    
    if (isset($_POST['update'])) {
        $status = $_POST['status'];
        $orderID = $_COOKIE['orderID'];

        $sql = "SELECT Status FROM order_details WHERE orderID = '$orderID'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $order_details = mysqli_fetch_assoc($result);

            //set orderStatus
            if ($order_details['Status'] == 'To Ship') {
                $currentStatus = 1;
            } else if ($order_details['Status'] == 'To Receive') {
                $currentStatus = 2;
            }

            //check orderStatus
            if ($status != $currentStatus) {
                if ($status == 1) {
                    $sql = "UPDATE order_details SET Status = 'To Ship' WHERE orderID = '$orderID'";
                    $result = mysqli_query($conn, $sql);
                } else if ($status == 2) {
                    $sql = "UPDATE order_details SET Status = 'To Receive' WHERE orderID = '$orderID'";
                    $result = mysqli_query($conn, $sql);
                }
            }
        }
    }
    header('Location: order.php');
?>