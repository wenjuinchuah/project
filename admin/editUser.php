<?php
    if (isset($_POST['editUser'])) {
        //Declaring Variables
        $userID = $_POST['userID'];
        $fname = $_POST['editfname'];
        $lname = $_POST['editlname'];
        $email = $_POST['editemail'];
        $mobile = $_POST['editmobile'];
        $state = $_POST['editstate'];
        $gender = $_POST['editgender'];
        $userType = $_POST['userType'];
        $submit = $_POST['editUser'];

        //First Name Input Validation
        if (empty($fname)) {
            $editfnameError = 'First Name cannot be blank!';
            $showError = 'visible';
        } else {
            $fname = trim($fname);
            $firstChar_fName = $fname[0];
            
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
                $editfnameError = 'Only Letters are allowed!';
                $showError = 'visible';
            } else {
                if (!preg_match("/^[A-Z]+/", $firstChar_fName)) {
                    $editfnameError = 'First Character must be in Capital!';
                    $showError = 'visible';
                } 
            }
        };

        //Last Name Input Validation
        if (empty($lname)) {
            $editlnameError = 'Last Name cannot be blank!';
            $showError = 'visible';
        } else {
            $lname = trim($lname);

            if (!preg_match("/^[a-zA-Z' \/]*$/",$lname)) {
                $editlnameError = 'Only Letters and / are allowed!';
                $showError = 'visible';
            } else {
                $name = explode(' ', $lname);

                for ($i = 0; $i < count($name); $i++) {
                    $firstChar_lname = str_split($name[$i]);

                    if (!preg_match("/^[A-Z]+/", $firstChar_lname[0])) {
                        $editlnameError = 'First Character of each word must be in Capital Letter!';
                        $showError = 'visible';
                        break;
                    } 
                }
            }
        };

        //Email Input Validation
        $regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        if (empty($email)) {
            $editemailError = 'Email cannot be blank!';
            $showError = 'visible';
        } else {
            if (!preg_match($regex, $email)) {
                $editemailError = 'Please enter a valid email!';
                $showError = 'visible';
            } 
        };

        //Mobile Input Validatiom
        if (empty($mobile)) {
            $editmobileError = 'Mobile number cannot be blank!';
            $showError = 'visible';
        } else {
            $mobile = trim($mobile);
                //remove first char if it's 0
                if($mobile[0] == "0"){
                    $mobile = substr($mobile,1);
                }
                if (strlen($mobile) < 9 || strlen($mobile) > 10 || !is_numeric($mobile)) {
                    $editmobileError = 'Please enter a valid mobile number!';
                    $showError = 'visible';
                } 
        };

        if (empty($editfnameError) && empty($editlnameError) && empty($editemailError) && empty($editmobileError)) {
    
            //Check database
            $sql = "UPDATE user SET 
                    FirstName = '$fname',
                    LastName = '$lname',
                    Email = '$email',
                    Mobile = '60$mobile',
                    State = '$state',
                    Gender = '$gender',
                    UserType = '$userType'
                    WHERE UserID = '$userID'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header('Location: user.php');
            } else {
                echo 'failed';
            }
        } else{
            $editUserView = 'block';
        }
    } else if (isset($_POST['resetPassword'])) {
        //reset password
        $userID = $_POST['userID'];
        if ($_POST['userType'] == 'user') {
            //user default password
            $password = 'Abc@123';
        } else {
            //admin default password
            $password = 'Admin@123';
        }
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET Password = '$password' WHERE UserID = '$userID'";
        $result = mysqli_query($conn, $sql);
        header('Location: user.php');
    }
    
?>