<?php
    if (!empty($_SESSION['loginUser'])) {
        $loginUsername = $_SESSION['loginUser'];

        //get userID
        $userType = $_SESSION['role'];
        $userID = $_SESSION['userID'];

    } else {
        $userType = '';
        $_SESSION['role'] = $userType;
    }

    //try connecting gardenia_shoppingcart database
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');

    if ($conn) {  
        //if userType == user
        if ($userType == 'user') {
            $sql = "CREATE TABLE user_$userID (
                ProductID INT(11) NOT NULL,
                ProductName VARCHAR(100) NOT NULL,
                Price FLOAT NOT NULL,
                Quantity INT(11) NOT NULL
            )";
            $result = mysqli_query($conn, $sql);
        } else if ($userType == '') {
            $i = 1;
            if (isset($_COOKIE['anonymousID'])) {
                $anonymousID = $_COOKIE['anonymousID'];
                $sql = "SELECT * FROM anonymous_$anonymousID";
                if ($result = mysqli_query($conn, $sql)) {
                    $isFound = true;
                } else {
                    $isFound = false;
                }
            } else {
                $isFound = false;
            }

            while (!$isFound) {
                //search for the table
                $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'anonymous_$i'";
                if ($result = mysqli_query($conn, $sql)) {
                    $row = mysqli_num_rows($result);
                    if ($row == 0) {
                        $sql = "CREATE TABLE anonymous_$i (
                            ProductID INT(11) NOT NULL,
                            ProductName VARCHAR(100) NOT NULL,
                            Price FLOAT NOT NULL,
                            Quantity INT(11) NOT NULL,
                            CartTimestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                        )";
                        $result = mysqli_query($conn, $sql);
                        $isFound = true;
                        setcookie("anonymousID", $i);
                        $_SESSION['anonymousID'] = $i;
                    } else {
                        $i++;
                    }
                }
            }
        }       
    } else {
        include 'createCartDb.php';
    }
?>