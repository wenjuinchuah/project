<?php
    include 'connectSQL.php';

    if(!isset($_SESSION)) { 
        session_start(); 
    }
     
    //Hide Error Message by Default
    $showError = 'hidden';
    $dropdownLoginView = 'visible';
    $dropdownUserInfoView = 'hidden';

    if (empty($_SESSION['isLogin'])) {
        $_SESSION['isLogin'] = false;
    }

    $isLogin = $_SESSION['isLogin'];

    if ($isLogin == true) {
        $loginUsername = $_SESSION['loginUser'];
        $_SESSION['loginUser'] = $loginUsername;
        $username = $password = '';
        $dropdownLoginView = 'hidden';
        $dropdownUserInfoView = 'visible';
    } else {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            //filter username before check with database
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT Email FROM user WHERE Email = '$username'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_num_rows($result);
    
                if ($row == 0) {
                    $nameError = "Email does not exist";
                    $showError = "visible";
                } 
    
                $sql = "SELECT * FROM user WHERE Email = '$username'";
                $getpdResult = mysqli_query($conn,$sql);
                $userDetails = mysqli_fetch_assoc($getpdResult);
    
                if (isset($userDetails['Password'])) {
                    if (!password_verify($password, $userDetails['Password'])) {
                        $passwordError = "Invalid password!";
                        $showError = "visible";
                    }
                }
            } else {
                if (empty($username)) {
                    $nameError = "Email cannot be blank!";
                    $showError = 'visible';
                } else {
                    $nameError = "Invalid email address!";
                    $showError = 'visible';
                }
            }
            
            
            if (empty($password)) {
                $passwordError = "Password cannot be blank!";
                $showError = 'visible';
            }
            if (empty($nameError) && empty($passwordError)) {
                include 'login.php';

                $username = $password = '';
                //If found, $count == 1
                if ($count == 1) {
                    $loginUsername = $_SESSION['loginUser'];
                    $_SESSION['loginUser'] = $loginUsername;
                    $isLogin = $_SESSION['isLogin'] = true;
                    $dropdownLoginView = 'hidden';
                    $dropdownUserInfoView = 'visible';                   
                } 
            } 
        } else {
            $username = $password = '';
            if (isset($_SESSION['loginUser'])) {
                $loginUsername = $_SESSION['loginUser'];
                $_SESSION['loginUser'] = $loginUsername;
                $isLogin = $_SESSION['isLogin'] = true;
                $dropdownLoginView = 'hidden';
                $dropdownUserInfoView = 'visible';
            }
        }
    }
?>