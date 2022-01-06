<?php
    include '../validation/connectSQL.php';

    if ($conn) {
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = N'transaction'";
        if ($result = mysqli_query($conn, $sql)) {
            $row = mysqli_num_rows($result);
            if ($row == 0) {
                $sql = "CREATE TABLE transaction (
                    TransactionID INT(11) AUTO_INCREMENT,
                    OrderID INT(11) NOT NULL,
                    Total FLOAT NOT NULL,
                    TransactionDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PaymentMethod VARCHAR(11) NOT NULL,
                    PRIMARY KEY (TransactionID)
                )";
                $result = mysqli_query($conn, $sql);
            }
        }    
    } else {
        header('Location: ../index.php');
        ob_end_flush();
    }
?>