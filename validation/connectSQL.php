<?php
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "userinfo";

    // Create connection
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>