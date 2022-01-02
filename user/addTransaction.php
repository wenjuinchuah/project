<?php
    include '../database/createTransactionDb.php';
    
    $orderID = $_SESSION['orderID'];
    $total = $_SESSION['total'];
    $paymentMethod = $_SESSION['paymentMethod'];

    $sql = "INSERT INTO transaction (OrderID, Total, PaymentMethod)
            VALUES ('$orderID', '$total', '$paymentMethod')";
    $result = mysqli_query($conn, $sql);
?>