<?php
    include 'connectSQL.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
        $usernameData = mysqli_real_escape_string($conn,$_POST['username']);
        $passwordData = mysqli_real_escape_string($conn,$_POST['password']); 

        //Get Hashed Password
        $sql = "SELECT Password FROM user WHERE Email = '$usernameData'";
        $result = mysqli_query($conn, $sql);
        $passwordVerified = mysqli_fetch_assoc($result);

        //Verify input password and hashed password from database
        if (password_verify($passwordData, $passwordVerified['Password'])) {
            $passwordHashed = $passwordVerified['Password'];
            $loginData = "SELECT * FROM user WHERE Email = '$usernameData' AND Password = '$passwordHashed'";
            $result = mysqli_query($conn, $loginData);

            $count = mysqli_num_rows($result);
            //If result matched, table row must be 1 row
            if ($count == 1) {
                $_SESSION['loginUser'] = $usernameData;
            }

            //Get user role
            $role = mysqli_fetch_assoc($result);
            $_SESSION['role'] = $role['UserType'];

            //If admin then goto admin dashboard
            if ($role['UserType'] == 'admin') {
                header('Location: ./admin/dashboard.php');
            }
        } else {
            $count = 0;
        }
        
    } else {
        die();
    }
?>