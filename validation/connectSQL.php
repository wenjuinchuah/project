<?php
    $servername = "localhost";
    $dbUsername = "admin";
    $dbPassword = "w_2L!ynO8_X/jcob";
    $dbName = "gardenia";

    // Create connection
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>