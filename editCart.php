<?php
    session_start();
    //Select UserID from user
    $loginUsername = $_SESSION['loginUser'];
    $userID = $_SESSION['userID'];

    $action = $_REQUEST["action"];
    $id = $_REQUEST["id"];

    include 'validation/connectSQL.php';

    //Get the current stock
    $sql = "SELECT Stock from products WHERE ID=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $stock = $row[0];

    //Connect to shopping cart db
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');

    if ($conn) {
        if($action == 'add'){
            //Get the current quantity of product in the cart
            $sql = "SELECT Quantity from user_$userID WHERE ProductID=$id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            $quantity = $row[0];
            //if the quantity in cart is same with the stock (aka. cannot add anymore)
            if($quantity == $stock){
                echo $quantity;
                echo "<div id='error' onclick='this.remove();' style='position: absolute; z-index: 1; border: 2px black solid; right: 50%; top: 50%; transform: translate(50%, 50%); visibility: visible;'>";
                echo "<p>The quantity exceed the stock!</p>";
                echo "</div>";                
            }else{
                $sql = "UPDATE user_$userID SET Quantity=Quantity+1 WHERE ProductID=$id";
                $result = mysqli_query($conn, $sql);
                $sql = "SELECT * FROM user_$userID WHERE ProductID=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
                echo "$row[3]";
            }
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