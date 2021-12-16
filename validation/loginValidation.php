<?php
    //Hide Error Message by Default
    $showError = 'hidden';
    $dropdownLoginView = 'visible';
    $dropdownUserInfoView = 'hidden';

    session_start();
    if (empty($_SESSION['isLogin'])) {
        $_SESSION['isLogin'] = false;
    }

    $isLogin = $_SESSION['isLogin'];

    if ($isLogin == true) {
        $loginUsername = $_SESSION['loginUser'];
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
                    $isLogin = true;
                    $dropdownLoginView = 'hidden';
                    $dropdownUserInfoView = 'visible';

                    //Create shoppingCart db
                    include 'createCartDb.php';
                }
            }
        } else {
            $username = $password = '';
            if (isset($_SESSION['loginUser'])) {
                $loginUsername = $_SESSION['loginUser'];
                $isLogin = true;
                $dropdownLoginView = 'hidden';
                $dropdownUserInfoView = 'visible';
            }
        }
    }
?>