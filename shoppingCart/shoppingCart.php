<?php
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword);
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, 'shoppingCart');

    if (!$db_selected) {
        // If we couldn't, then it either doesn't exist, or we can't see it.
        $sql = 'CREATE DATABASE shoppingCart';

        if (mysqli_query($conn, $sql) != true) {
            echo 'Error creating database: ' . mysqli_error($conn) . "\n";
        }
    }
    
?>