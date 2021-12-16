<?php
    include '../validation/connectSQL.php';
    session_start();

    $productName = $_SESSION['productName'];
    $productPrice = $_SESSION['productPrice'];
    $productStock = $_SESSION['productStock'];

    $sql = "INSERT INTO products (Name, Price, Stock) VALUES ('$productName', '$productPrice','$productStock')";

    if (mysqli_query($conn, $sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>