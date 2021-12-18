<?php
    include 'validation/connectSQL.php';

    session_start();
    //Select UserID from user
    $loginUsername = $_SESSION['loginUser'];
    $sql = "SELECT * FROM user WHERE Email = '$loginUsername'";

    if ($result = mysqli_query($conn, $sql)) {
        $userDetails = mysqli_fetch_object($result);
        $UserID = $userDetails->UserID;
    }
    
    $productID = $_COOKIE['productID'];
    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];

        $sql = "SELECT * FROM products WHERE ID = '$productID'";
        if ($result = mysqli_query($conn, $sql)) {
            $row = mysqli_fetch_row($result); 
            $productName = $row[1];
            $productPrice = $row[2];
            $productStock = $row[3];
        }

        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'shoppingCart');

        if ($conn) {
            $sql = "SELECT Quantity FROM user_$UserID WHERE ProductID = '$productID'";

            if ($result = mysqli_query($conn, $sql)) {
                $row = mysqli_num_rows($result);
                if ($row == 0) {
                    $sql = "INSERT INTO user_$UserID (ProductID, ProductName, Price, Quantity)
                            VALUES ('$productID', '$productName', '$productPrice', '$quantity')";
                } else {
                    $cartDetails = mysqli_fetch_object($result);
                    if (($quantity + $cartDetails->Quantity) <= $productStock) {
                        $quantity += $cartDetails->Quantity;
                        $sql = "UPDATE user_$UserID SET Quantity = '$quantity' WHERE ProductID = '$productID'";
                    } else {
                        echo 'Add Failed! Reached max stock of current product';
                    }
                }
                $result = mysqli_query($conn, $sql);                
            }
        } else {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    header("location: products.php");
?>

