<?php
session_start();
$loginuser = $_SESSION['loginUser'];

//Get the value of the button to know which form is updating
$type = $_POST['button'];

include '../validation/connectSQL.php';

if($type == 'name'){
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];

    //First Name Input Validation
    if (empty($fname)) {
        $fnameError = 'First Name cannot be blank!';
        $_SESSION['validation_name'] = $fnameError;
        header('Location: userProfile.php');
    } else {
        $fname = trim($fname);
        $firstChar_fName = $fname[0];
        
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
            $fnameError = 'Only Letters are allowed!';
            $_SESSION['validation_name'] = $fnameError;
            header('Location: userProfile.php');
        } else {
            if (!preg_match("/^[A-Z]+/", $firstChar_fName)) {
                $fnameError = 'First Character must be in Capital!';
                $_SESSION['validation_name'] = $fnameError;
                header('Location: userProfile.php');
            }else{
                //Last Name Input Validation
                if (empty($lname)) {
                    $lnameError = 'Last Name cannot be blank!';
                    $_SESSION['validation_name'] = $lnameError;
                    header('Location: userProfile.php');
                } else {
                    $lname = trim($lname);
                    $firstChar_lName = $lname[0];
                    
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
                        $lnameError = 'Only Letters are allowed!';
                        $_SESSION['validation_name'] = $lnameError;
                        header('Location: userProfile.php');
                    } else {
                        if (!preg_match("/^[A-Z]+/", $firstChar_lName)) {
                            $lnameError = 'First Character must be in Capital!';
                            $_SESSION['validation_name'] = $lnameError;
                            header('Location: userProfile.php');
                        }else{
                            unset($_SESSION['validation_name']);
                        }
                    }
                };
            }
        }
    };

    if(!isset($_SESSION['validation_name'])){
        $sql = "UPDATE user SET FirstName='$fname' WHERE Email='$loginuser'";
        mysqli_query($conn, $sql);
        $sql = "UPDATE user SET LastName='$lname' WHERE Email='$loginuser'";
        mysqli_query($conn, $sql);
        header('Location: userProfile.php');
    }
    
}else if($type == 'email'){
    $email = $_POST['email'];

    $regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
    if (empty($email)) {
        $emailError = 'Email cannot be blank!';
        $_SESSION['validation_email'] = $emailError;
        header('Location: userProfile.php');
    } else {
        if (!preg_match($regex, $email)) {
            $emailError = 'Please enter a valid email!';
            $_SESSION['validation_email'] = $emailError;
            header('Location: userProfile.php');
        } else {
            unset($_SESSION['validation_email']);
        }
    };

    if(!isset($_SESSION['validation_email'])){
        $sql = "UPDATE user SET Email='$email' WHERE Email='$loginuser'";
        mysqli_query($conn, $sql);
        $_SESSION['loginUser'] = $email;
        header('Location: userProfile.php');
    }
}else if($type == 'mobile'){
    $mobile = $_POST['mobile'];
    $country_code = "+60";

    //Mobile Input Validatiom
    if (empty($mobile)) {
        $mobileError = 'Mobile number cannot be blank!';
        $_SESSION['validation_mobile'] = $mobileError;
        header('Location: userProfile.php');
    } else {
        $mobile = trim($mobile);
            if (strlen($mobile) < 9 || strlen($mobile) > 10) {
                $mobileError = 'Please enter a valid mobile number!';
                $_SESSION['validation_mobile'] = $mobileError;
                header('Location: userProfile.php');
            } else {
                unset($_SESSION['validation_mobile']);
            }
    };

    if(!isset($_SESSION['validation_mobile'])){
        $sql = "UPDATE user SET Mobile='$country_code$mobile' WHERE Email='$loginuser'";
        mysqli_query($conn, $sql);
        header('Location: userProfile.php');
    }
}else if($type == 'state'){
    $state = $_POST['state'];

    $sql = "UPDATE user SET State='$state' WHERE Email='$loginuser'";
    mysqli_query($conn, $sql);
    header('Location: userProfile.php');
}else if($type == 'gender'){
    $gender = $_POST['gender'];

    $sql = "UPDATE user SET Gender='$gender' WHERE Email='$loginuser'";
    mysqli_query($conn, $sql);
    header('Location: userProfile.php');
}else if($type == 'password'){
    $currentPassword = $_POST['currentPassword'];
    $password1 = $_POST['newpassword'];
    $password2 = $_POST['confirmpassword'];

    //Password Input Validation
    if (empty($currentPassword)) {
        $currentPasswordError = 'Current Password cannot be blank!';
        $_SESSION['validation_currentPassword'] = $currentPasswordError;
        header('Location: userProfile.php');
    } else if (empty($password1)) {
        $password1Error = 'Password cannot be blank!';
        $_SESSION['validation_password'] = $password1Error;
        header('Location: userProfile.php');
    } else {
        if (strlen($password1) < 6) {
            $password1Error = 'Password should have a minimum length of 6!';
            $_SESSION['validation_password'] = $password1Error;
            header('Location: userProfile.php');
        } else if (!preg_match('#[0-9]+#', $password1)) {
            $password1Error = 'Password Must Contain At Least 1 Number!';
            $_SESSION['validation_password'] = $password1Error;
            header('Location: userProfile.php');
        } else if (!preg_match("#[A-Z]+#", $password1)) {
            $password1Error = 'Password Must Contain At Least 1 Capital Letter!';
            $_SESSION['validation_password'] = $password1Error;
            header('Location: userProfile.php');
        } else if (!preg_match("#[a-z]+#", $password1)) {
            $password1Error = 'Password Must Contain At Least 1 Lowercase Letter!';
            $_SESSION['validation_password'] = $password1Error;
            header('Location: userProfile.php');
        } else if(!preg_match('/[\'`^£!$%&*()}{@#~?><>,|=_+¬-]/', $password1)) {
            $password1Error = 'Password Must Contain At Least 1 Special Character!';
            $_SESSION['validation_password'] = $password1Error;
            header('Location: userProfile.php');
        } else {
            //Confirm Password Input Validation
            if (empty($password2)) {
                $password2Error = 'Confirm Password cannot be blank!';
                $_SESSION['validation_password'] = $password2Error;
                header('Location: userProfile.php');
            } else {
                if ($password2 != $password1) {
                    $password2Error = 'Password does not match!';
                    $_SESSION['validation_password'] = $password2Error;
                    header('Location: userProfile.php');
                } else {
                    $password = password_hash($password1, PASSWORD_DEFAULT);
                    $sql = "UPDATE user SET Password='$password' WHERE Email='$loginuser'";
                    mysqli_query($conn, $sql);
                    header('Location: userProfile.php');
                }
            }
        }
    };
}
?>