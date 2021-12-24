<?php
    session_start();
    ob_start();
    include '../validation/connectSQL.php';
    include '../database/createCartTable.php';
    
    $userType = $_SESSION['userType'];
    $anonymousID = $_SESSION['anonymousID'];

    $productID = $_COOKIE['productID'];
    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];

        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);
        $sql = "SELECT * FROM products WHERE ID = '$productID'";
        if ($result = mysqli_query($conn, $sql)) {
            $row = mysqli_fetch_row($result); 
            $productName = $row[1];
            $productPrice = $row[2];
            $productStock = $row[3];
        }

        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
        if ($userType == 'user') {
            $sql = "SELECT Quantity FROM user_$userID WHERE ProductID = '$productID'";

            if ($result = mysqli_query($conn, $sql)) {
                $row = mysqli_num_rows($result);
                if ($row == 0) {
                    $sql = "INSERT INTO user_$userID (ProductID, ProductName, Price, Quantity)
                            VALUES ('$productID', '$productName', '$productPrice', '$quantity')";
                    $result = mysqli_query($conn, $sql);
                } else {
                    $cartDetails = mysqli_fetch_object($result);
                    if (($quantity + $cartDetails->Quantity) <= $productStock) {
                        $quantity += $cartDetails->Quantity;
                        $sql = "UPDATE user_$userID SET Quantity = '$quantity' WHERE ProductID = '$productID'";
                        $result = mysqli_query($conn, $sql);                
                    } else {
                        echo 'Add Failed! Reached max stock of current product';
                    }
                }
            }
        } else if ($userType == '') {
            $sql = "SELECT Quantity FROM anonymous_$anonymousID WHERE ProductID = '$productID'";

            if ($result = mysqli_query($conn, $sql)) {
                $row = mysqli_num_rows($result);
                if ($row == 0) {
                    $sql = "INSERT INTO anonymous_$anonymousID (ProductID, ProductName, Price, Quantity)
                            VALUES ('$productID', '$productName', '$productPrice', '$quantity')";
                    $result = mysqli_query($conn, $sql);
                } else {
                    $cartDetails = mysqli_fetch_object($result);
                    if (($quantity + $cartDetails->Quantity) <= $productStock) {
                        $quantity += $cartDetails->Quantity;
                        $sql = "UPDATE anonymous_$anonymousID SET Quantity = '$quantity' WHERE ProductID = '$productID'";
                        $result = mysqli_query($conn, $sql);
                    } else {
                        echo 'Add Failed! Reached max stock of current product';
                    }
                }
            }
        }
        
    }
    header('Location: ../products.php');
    ob_end_flush();
?>

