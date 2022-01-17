<?php
    include '../validation/connectSQL.php';

    if(isset($_POST['deleteUser'])){
        $id = $_POST['deleteID'];

        $sql = "DELETE FROM user WHERE UserID = '$id'";
        if (mysqli_query($conn, $sql) == TRUE) {
            //remove cart
            $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
            $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'user_$id'";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                $row = mysqli_num_rows($result);
                if ($row != 0) {
                    $sql = "DROP TABLE user_$id";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        header('Location: user.php');
                    }
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>