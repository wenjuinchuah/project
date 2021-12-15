<?php
    include '../validation/connectSQL.php';
    session_start();

    $productName = $_SESSION['productName'];
    $productPrice = $_SESSION['productPrice'];

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia');
    $sql = "INSERT INTO products (Name, Price) VALUES ('$productName', '$productPrice')";

    if (mysqli_query($conn, $sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>