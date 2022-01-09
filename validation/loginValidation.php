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
            //$passwordH = password_hash($password, PASSWORD_DEFAULT);

            $sql = "SELECT Email FROM user WHERE Email = '$username'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_num_rows($result);

            if ($row == 0) {
                $nameError = "Email does not exist";
                $showError = "visible";
            } 

            //if($userDetails !== $passwordH) {
            //    $nameError = "Invalid password!";
            //   $showError = "visible";
            //} i test again ya
            //then the new user registration de? okey

            $sql = "SELECT * FROM user WHERE Email = '$username'";
            $getpdResult = mysqli_query($conn,$sql);
            $userDetails = mysqli_fetch_assoc($getpdResult);

            if (!password_verify($password, $userDetails['Password'])) {
                $nameError = "Invalid password!";
                $showError = "visible";
            }
            if (empty($username)) {
                $nameError = "Email cannot be blank!";
                $showError = 'visible';
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