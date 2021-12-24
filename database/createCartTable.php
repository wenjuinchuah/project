<?php
    if (!empty($_SESSION['loginUser'])) {
        $loginUsername = $_SESSION['loginUser'];

        //get userID
        $sql = "SELECT * FROM user WHERE Email = '$loginUsername'";
        if ($result = mysqli_query($conn, $sql)) {
            $userDetails = mysqli_fetch_object($result);
            $userID = $userDetails->UserID;
            $userType = $userDetails->UserType;
            $_SESSION['userType'] = $userType;
            $_SESSION['userID'] = $userID;
        }
    } else {
        $userType = '';
        $_SESSION['userType'] = $userType;
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
            $isFound = false;
            $isSet = false;

            if (isset($_SESSION['anonymousID'])) {
                $isSet = true;
            }

            while (!$isFound) {
                //search for the table
                $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'anonymous_$i'";
                if ($result = mysqli_query($conn, $sql)) {
                    $row = mysqli_num_rows($result);
                    if ($row == 0 || $isSet == true) {
                        $sql = "CREATE TABLE anonymous_$i (
                            ProductID INT(11) NOT NULL,
                            ProductName VARCHAR(100) NOT NULL,
                            Price FLOAT NOT NULL,
                            Quantity INT(11) NOT NULL
                        )";
                        $result = mysqli_query($conn, $sql);
                        $isFound = true;
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