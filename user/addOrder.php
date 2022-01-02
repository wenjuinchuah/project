<?php
    include '../validation/connectSQL.php';
    //connect to useroder database
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_order');

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
                    $_SESSION['orderID'] = $i;
                } else {
                    $i++;
                }
            }
        }
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
    $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
    $result = mysqli_query($conn, $sql);
    //addorder to table
    while ($row = mysqli_fetch_row($result)) {
        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_order');
        $sql = "INSERT INTO order_$i (ProductID, ProductName, Price, Quantity)
                VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]')";
        $order_result = mysqli_query($conn, $sql);

        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia');
        $sql = "SELECT * FROM products WHERE ID = '$row[0]'";
        if ($products_result = mysqli_query($conn, $sql)) {
            $assocProducts = mysqli_fetch_assoc($products_result);
            $newStock = $assocProducts['Stock'] - $row[3];
            $sql = "UPDATE products SET Stock = '$newStock' WHERE ID = '$row[0]'";
            $products_result = mysqli_query($conn, $sql);
        }
        
        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
        $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
    }

    include 'orderDetails.php';
?>