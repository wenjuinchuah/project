<?php
    include 'validation/loginValidation.php';
    include 'validation/connectSQL.php';

    $action = $_REQUEST["action"];
    $id = $_REQUEST["id"];

    //Select UserID from user
    $loginUsername = $_SESSION['loginUser'];
    $userID = $_SESSION['userID'];

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'shoppingcart');

    if ($conn) {
        if($action == 'add'){
            $sql = "UPDATE user_$userID SET Quantity=Quantity+1 WHERE ProductID=$id";
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM user_$userID WHERE ProductID=$id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            echo "$row[3]";
        }else if($action == 'minus'){
            $sql = "UPDATE user_$userID SET Quantity=Quantity-1 WHERE ProductID=$id";
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM user_$userID WHERE ProductID=$id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            if($row[3] == 0){
                $sql = "DELETE FROM user_$userID WHERE ProductID=$id";
                $result = mysqli_query($conn, $sql);
            }
            echo "$row[3]";
        }else if($action == 'remove'){
            $sql = "DELETE FROM user_$userID WHERE ProductID=$id";
            $result = mysqli_query($conn, $sql);
        }
    }

?>