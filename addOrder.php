<?php
    include 'validation/connectSQL.php';
    
    session_start();
    //connect to useroder database
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'userorder');

    //variable declaration
    $userID = $_SESSION['userID'];
    $isFound = false;
    $i = 1;

    //if connected to database, create table
    if ($conn) {
        while (!$isFound) {
            //search for the table
            $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'order_$i'";
            if ($result = mysqli_query($conn, $sql)) {
                $row = mysqli_num_rows($result);
                if ($row == 0) {
                    $sql = "CREATE TABLE order_$i (
                        ProductID INT(11) NOT NULL,
                        ProductName VARCHAR(100) NOT NULL,
                        Price FLOAT NOT NULL,
                        Quantity INT(11) NOT NULL
                    )";
        
                    $result = mysqli_query($conn, $sql);
                    $isFound = true;
                } else {
                    $i++;
                }
            }
        }
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'shoppingcart');
    $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
    $result = mysqli_query($conn, $sql);
    //addorder to table
    while ($row = mysqli_fetch_row($result)) {
        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'userorder');
        $sql = "INSERT INTO order_$i (ProductID, ProductName, Price, Quantity)
                VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]')";
        $order_result = mysqli_query($conn, $sql);
        
        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'shoppingcart');
        $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
    }

    include 'removeCart.php';
    header('location:index.php');
?>