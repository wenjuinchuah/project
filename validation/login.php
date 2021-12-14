<?php
    include 'connectSQL.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
        
        $usernameData = mysqli_real_escape_string($conn,$_POST['username']);
        $passwordData = mysqli_real_escape_string($conn,$_POST['password']); 

        $loginData = "SELECT * FROM user WHERE Email = '$usernameData' AND Password = '$passwordData'";
        $result = mysqli_query($conn, $loginData);
        
        $count = mysqli_num_rows($result);
        // If result matched $myusername and $mypassword, table row must be 1 row
        if ($count == 1) {
           $_SESSION['loginUser'] = $usernameData;
        }
    } else {
        die();
    }
?>