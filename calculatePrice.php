<?php
    session_start();
    include 'validation/connectSQL.php';

    //Select UserID from user
    $loginUsername = $_SESSION['loginUser'];
    $userID = $_SESSION['userID'];

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'shoppingcart');

    if ($conn) {
        $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
        $result = mysqli_query($conn, $sql);
        $index = 1;
        $total = 0;
        while($row = mysqli_fetch_row($result)){
            $price = number_format($row[2], 2, '.', '');
            $subtotal = $row[3]*$price;
            $subtotal = number_format($subtotal, 2, '.');
            echo "<p style='text-align: left;'>$index) RM $price X $row[3] = RM $subtotal</p>";
            $total += $subtotal;
            $index++;
        }
        $total = number_format($total, 2, '.');
        echo "<br><p style='text-align: left; font-weight: bold;'>TOTAL: RM $total</p>";
        echo "<div style='background: none; width: 100%; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);'>";
        echo "<button type='button'><a href='addOrder.php'>Order Now</a></button>";
        echo "</div>";
    }

?>