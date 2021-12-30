<?php
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
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            if (empty($username)) {
                $nameError = "Username cannot be blank!";
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