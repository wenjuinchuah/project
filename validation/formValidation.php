<?php
    ob_start();
    //Hide Undefine Message
    //error_reporting(0);

    //Hide Error Message and Success View by Default
    $showError = $successVisibility = 'hidden';

    //Declaring Variables
    if ($_POST['register']) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $tnc = $_POST['t&c'];
        $submit = $_POST['register'];
        $state = $_POST['state'];
        $gender = $_POST['gender'];
        if (isset($_POST['role'])) {
            $userType = $_POST['role'];
        } else {
            $userType = 'user';
        }
    }  

    //Function declaration  
    function errorHandle($idName, $state) {
        if (isset($state)) {
            if (isset($idName)) {
                return 'visible';
            }
            return 'visible';
        } else {
            return 'hidden';
        }
    }

    //First Name Input Validation
    if (empty($fname)) {
        $fnameError = 'First Name cannot be blank!';
        $showError = errorHandle('$fname', $submit);
    } else {
        $fname = trim($fname);
        $firstChar_fName = $fname[0];
        
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
            $fnameError = 'Only Letters are allowed!';
            $showError = errorHandle('$fname', $submit);
        } else {
            if (!preg_match("/^[A-Z]+/", $firstChar_fName)) {
                $fnameError = 'First Character must be in Capital!';
                $showError = errorHandle('$fname', $submit);
            } else {
                $fnameError = '';
            }
        }
    };

    //Last Name Input Validation
    if (empty($lname)) {
        $lnameError = 'Last Name cannot be blank!';
        $showError = errorHandle('$lname', $submit);
    } else {
        $lname = trim($lname);

        if (!preg_match("/^[a-zA-Z' \/]*$/",$lname)) {
            $lnameError = 'Only Letters and / are allowed!';
            $showError = errorHandle('$lname', $submit);
        } else {
            $name = explode(' ', $lname);

            for ($i = 0; $i < count($name); $i++) {
                $firstChar_lname = str_split($name[$i]);

                if (!preg_match("/^[A-Z]+/", $firstChar_lname[0])) {
                    $lnameError = 'First Character of each word must be in Capital Letter!';
                    $showError = errorHandle('$lname', $submit);
                    break;
                } else {
                    $lnameError = '';
                }

                /*if ($i > 0) {
                    $lname .= $name[$i].' ';
                }*/
            }

            //$lname = trim($lname);
        }
    };

    //Email Input Validation
    $regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
    if (empty($email)) {
        $emailError = 'Email cannot be blank!';
        $showError = errorHandle('$email', $submit);
    } else {
        if (!preg_match($regex, $email)) {
            $emailError = 'Please enter a valid email!';
            $showError = errorHandle('$email', $submit);
        } else {
            include '../validation/connectSQL.php';
            $sql = "SELECT * FROM user WHERE Email = '$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            if ($row !== 0) {
                $emailError = 'Email exists, Please try another email!';
                $showError = errorHandle('$email', $submit);
            } else {
                $emailError = '';
            }
        }
    };

    //Mobile Input Validatiom
    if (empty($mobile)) {
        $mobileError = 'Mobile number cannot be blank!';
        $showError = errorHandle('$mobile', $submit);
    } else {
        $mobile = trim($mobile);
            //remove first char if it's 0
            if($mobile[0] == "0"){
                $mobile = substr($mobile,1);
            }
            if (strlen($mobile) < 9 || strlen($mobile) > 10 || !is_numeric($mobile)) {
                $mobileError = 'Please enter a valid mobile number!';
                $showError = errorHandle('$mobile', $submit);
            } else {
                $mobileError = '';
            }
    };

    //Password Input Validation
    if (empty($password1)) {
        $password1Error = 'Password cannot be blank!';
        $showError = errorHandle('$password1', $submit);
    } else {
        if (strlen($password1) < 6) {
            $password1Error = 'Password should have a minimum length of 6!';
            $showError = errorHandle('$password1', $submit);
        } else if (!preg_match('#[0-9]+#', $password1)) {
            $password1Error = 'Password Must Contain At Least 1 Number!';
            $showError = errorHandle('$password1', $submit);
        } else if (!preg_match("#[A-Z]+#", $password1)) {
            $password1Error = 'Password Must Contain At Least 1 Capital Letter!';
            $showError = errorHandle('$password1', $submit);
        } else if (!preg_match("#[a-z]+#", $password1)) {
            $password1Error = 'Password Must Contain At Least 1 Lowercase Letter!';
            $showError = errorHandle('$password1', $submit);
        } else if(!preg_match('/[\'`^£!$%&*()}{@#~?><>,|=_+¬-]/', $password1)) {
            $password1Error = 'Password Must Contain At Least 1 Special Character!';
            $showError = errorHandle('$password1', $submit);
        } else {
            $password1Error = '';
        }
    };

    //Confirm Password Input Validation
    if (empty($password2)) {
        $password2Error = 'Confirm Password cannot be blank!';
        $showError = errorHandle('$password2', $submit);
    } else {
        if ($password2 != $password1) {
            $password2Error = 'Password does not match!';
            $showError = errorHandle('$password2', $submit);
        } else {
            $password2Error = '';
        }
    };

    //T&C Checkedbox Validation (when checkbox checked, the value is set to 'value1')
    //Hence, we check for the string $tnc == $_POST['value1']
    if (!empty($tnc)) {
        if ($tnc != 'value1') {
            $tncError = 'Please read the Terms and Conditions!';
            $showError = errorHandle('$tnc', $submit);
        } else {
            $tnc = 'checked';
            $tncError = '';
        }
    }

    //Change id=success visiblity to visible
    if (empty($fnameError) && empty($lnameError) && empty($emailError) && empty($mobileError) && empty($password1Error) && empty($password2Error) && empty($tncError)) {
        include 'connectSQL.php';

        //Check database
        $dbCheck = "SELECT EMAIL FROM user WHERE EMAIL = '$email'";
        $result = mysqli_query($conn, $dbCheck);
        
        $count = mysqli_num_rows($result);
        //If not found
        if ($count == 0) {
            //Hash Password
            $password1 = password_hash($password1, PASSWORD_DEFAULT);
            //insert data into mySQL
            $sql = "INSERT INTO user(FirstName, LastName, Email, Mobile, State, Gender, Password, UserType)
                VALUES ('$fname', '$lname', '$email', '60$mobile', '$state', '$gender', '$password1', '$userType')";

            if ($conn->query($sql) === TRUE) {
                $successVisibility = 'visible';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Username exists!";
        }
        
        //header('Location: ../index.php');
        ob_end_flush();
    };

    include '../user/userHeader.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="../src/style.css">
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/windows/32/000000/edit-user-male--v1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* View Container */
        #view-container {
            max-width: 100%;
        }

        .van {
            background-image: url("../src/van.jpeg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 20px;
        }

        /* Form */
        #regform {
            width: 340px;
            margin: 100px auto;
            padding: 10px;
            background-color: #fff;
            border-radius: 10px;
        }
        /* Title */
        #regform h2 {
            text-align: center;
            padding: 10px;
        }

        #regform div {
            margin: 15px 10px;
            padding-bottom: 10px;
        }

        #regform label {
            padding: 10px 0;
        }

        #regform small {
            font-size: 12px;
            padding-left: 5px;
            color: red;
            position: absolute;
            visibility: visible;
        }

        #regform input, #regform select {
            display: block;
            width: 93%;
            height: 30px;
            padding: 0 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid lightgray;
        }

        /* Mobile */
        #regform .mobile-container {
            margin: 0;
            padding: 0;
        }

        #regform .mobile-container label {
            display: block;
        }

        #regform #code {
            display: inline-block;
            width: 25px;
            pointer-events: none;
        }

        #regform #mobile {
            display: inline-block;
            width: 246px;
        }

        #regform #mobileError {
            display: block;
        }

        /* Password */
        #regform .password-container {
            padding: 0;
            margin: 0;
            margin-bottom: 10px;
        }

        #regform #i-password1, #regform #i-password2, #regform #i-password1-slash, #regform #i-password2-slash {
            position: relative;
            top: 34px;
            color: gray;
        }

        #regform #i-password1 {
            left: 220px;
        }

        #regform #i-password1-slash {
            left: 200px;
        } 

        #regform #i-password2 {
            left: 158px;
        } 
        
        #regform #i-password2-slash {
            left: 138px;
        }

        #regform #i-password1:hover, #regform #i-password2:hover, #regform #i-password1-slash:hover, #regform #i-password2-slash:hover {
            cursor: pointer;
            color: #000;
        }

        #regform #i-password1-slash, #regform #i-password2-slash{
            visibility: hidden;
        }

        /* Gender */
        #regform .gender-container {
            margin: 0;
            padding: 0;
        }

        #regform .gender-container input {
            display: inline-block;
            width: 15px;
        }

        #regform .gender-container label, .checkbox-container label {
            position: relative;
            bottom: 9px;
            margin-right: 10px;
        }

        /* State */
        #regform select {
            width: 100%;
            height: 32px;

            /* Removes the default <select> styling */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

            /* Positions background arrow image */
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAh0lEQVQ4T93TMQrCUAzG8V9x8QziiYSuXdzFC7h4AcELOPQAdXYovZCHEATlgQV5GFTe1ozJlz/kS1IpjKqw3wQBVyy++JI0y1GTe7DCBbMAckeNIQKk/BanALBB+16LtnDELoMcsM/BESDlz2heDR3WePwKSLo5eoxz3z6NNcFD+vu3ij14Aqz/DxGbKB7CAAAAAElFTkSuQmCC');
            background-repeat: no-repeat;
            background-position: 295px center;
        }

        /* t&c */
        #regform .checkbox-container {
           margin-top: 0;
        }

        #regform .checkbox-container input{
            display: inline-block;
            width: 15px;
        }

        #regform .checkbox-container label {
            font-size: 15px;
        }

        #regform .checkbox-container u {
            cursor: pointer;
            color: purple;
        }

        #regform .checkbox-container small {
            display: block;
        }

        /* Button*/
        #regform .button {
            margin: 15px 10px;
        }

        #regform .button input {
            display: inline-block;
            height: 32px;
        }

        #regform #reset {
            width: 20%;
        }

        #regform #reset:hover {
            background-color: rgb(255, 194, 194);
            cursor: pointer;
        }

        #regform #register {
            width: 78.6%;
            background-color: #2b323d;
            color: #fff;
            font-weight: bold;
        }

        #regform #register:hover {
            opacity: 70%;
            cursor: pointer;
        }

        /* Registration Successful */
        #success {
            background-color: #d3d3d3a0;
            margin: 0;
            padding: 0;
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            visibility: <?=$successVisibility?>;
        }

        .success-container {
            background-color: #fff;
            margin: 200px auto;
            height: 300px;
            max-width: 400px;
            min-width: 400px;
            border-radius: 10px;
        }

        .success-container h2 {
            text-align: center;
            padding: 20px 0;
        }

        #i-success {
            color: green;
            text-align: center;
            position: relative;
            left: 160px;
            top: 30px;
        }

        .success-container .btn {
            text-align: center;
            position: relative;
            top: 90px;
        }

        .success-container input {
            border: none;
            border-radius: 5px;
            background-color: #2b323d;
            color: #fff;
            font-weight: bold;
            font-size: large;
            text-align: center;
            margin: auto;
            padding: 5px 0;
            width: 95%;
        }

        .success-container input:hover {
            cursor: pointer;
            opacity: 70%;
        }

        .success-container a {
            color: #fff;
            text-decoration: none;
        }
    </style>
    <script src="formValidation.js"></script>
</head>
<body>
<div id="view-container">
        <div class="van">
            <div id="registerForm">
                <form class="form" id="regform" action="" method="POST">
                    <h2>User Account Registration</h2>
                    <div>
                        <label>First Name</label>
                        <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo $fname ?>"/>
                        <?php if (isset($fnameError)) {?>
                            <small id="fnameError"><?php echo $fnameError ?></small>
                        <?php } ?>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lname ?>"/>
                        <?php if (isset($lnameError)) {?>
                            <small id="lnameError"><?php echo $lnameError ?></small>
                        <?php } ?>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" id="email" name="email" placeholder="Email Address" value="<?php echo $email ?>"/>
                        <?php if (isset($emailError)) {?>
                            <small id="emailError"><?php echo $emailError ?></small>
                        <?php } ?>
                    </div>
                    <div>
                        <label >Mobile</label>
                        <div class="mobile-container">
                            <input type="text" id="code" name="code" value="+60" disabled/>  
                            <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number" value="<?php echo $mobile ?>"/>
                            <?php if (isset($mobileError)) {?>
                            <small id="mobileError"><?php echo $mobileError ?></small>
                        <?php } ?>
                        </div>
                    </div>
                    <div>
                        <label>Password</label>
                        <i id="i-password1" class="fa fa-eye" aria-hidden="true" onclick="isVisible('password1', 'i-password1', 'i-password1-slash')"></i>
                        <i id="i-password1-slash" class="fa fa-eye-slash" aria-hidden="true" onclick="isVisible('password1', 'i-password1', 'i-password1-slash')"></i>
                        <div class="password-container">
                            <input type="password" id="password1" name="password1" placeholder="Password" value="<?php echo $password1 ?>"/>
                            <?php if (isset($password1Error)) {?>
                            <small id="password1Error"><?php echo $password1Error ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div>
                        <label>Confirm Password</label>
                        <i id="i-password2" class="fa fa-eye" aria-hidden="true" onclick="isVisible('password2', 'i-password2', 'i-password2-slash')"></i>
                        <i id="i-password2-slash" class="fa fa-eye-slash" aria-hidden="true" onclick="isVisible('password2', 'i-password2', 'i-password2-slash')"></i>
                        <input type="password" id="password2" name="password2" placeholder="Confirm Password" value="<?php echo $password2 ?>"/>
                        <?php if (isset($password2Error)) {?>
                            <small id="password2Error"><?php echo $password2Error ?></small>
                        <?php } ?>        
                    </div>
                    <div>
                        <label>Gender</label>
                        <div class="gender-container">
                            <input type="radio" id="male" name="gender" value="Male" <?php echo $gender == 'Male' ? 'checked': ''?>/>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="Female" <?php echo $gender == 'Female' ? 'checked': ''?>/>
                            <label for="female">Female</label>
                        </div>
                    </div>
                    <div>
                        <label>State</label>
                        <select name="state" id="state">
                            <option disabled>- Select Your State-</option>
                            <option <?php echo $state == 'Johor' ? 'selected': ''?>>Johor</option>
                            <option <?php echo $state == 'Kedah' ? 'selected': ''?>>Kedah</option>
                            <option <?php echo $state == 'Kelantan' ? 'selected': ''?>>Kelantan</option>
                            <option <?php echo $state == 'Melaka' ? 'selected': ''?>>Melaka</option>
                            <option <?php echo $state == 'Negeri Sembilan' ? 'selected': ''?>>Negeri Sembilan</option>
                            <option <?php echo $state == 'Pahang' ? 'selected': ''?>>Pahang</option>
                            <option <?php echo $state == 'Perak' ? 'selected': ''?>>Perak</option>
                            <option <?php echo $state == 'Perlis' ? 'selected': ''?>>Perlis</option>
                            <option <?php echo $state == 'Pulau Pinang' ? 'selected': ''?>>Pulau Pinang</option>
                            <option <?php echo $state == 'Sabah' ? 'selected': ''?>>Sabah</option>
                            <option <?php echo $state == 'Sarawak' ? 'selected': ''?>>Sarawak</option>
                            <option <?php echo $state == 'Selangor' ? 'selected': ''?>>Selangor</option>
                            <option <?php echo $state == 'Terrengganu' ? 'selected': ''?>>Terengganu</option>
                            <option disabled>-Federal Territories-</option>
                            <option <?php echo $state == 'Kuala Lumpur' ? 'selected': ''?>>Kuala Lumpur</option>
                            <option <?php echo $state == 'Labuan' ? 'selected': ''?>>Labuan</option>
                            <option <?php echo $state == 'Putrajaya' ? 'selected': ''?>>Putrajaya</option>
                        </select>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="t&c" name="t&c" value="value1" <?=$tnc?>/>
                        <label for="t&c">I accept the above <u>Terms and Conditions</u></label>
                        <?php if (isset($fnameError)) {?>
                            <small id="fnameError"><?php echo $tncError ?></small>
                        <?php } ?>        </div>
                    <div class="button">
                        <input type="reset" id="reset" value="Clear"></input>
                        <input type="submit" id="register" name="register" value="Register"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="icon" id="contactus">
                <h3 class="pacifico_normal">Contact Us</h3>
                <div>
                    <i class="fa fa-map-marker"></i>
                    <p>Lot 3, Jalan Pelabur 23/1, 40300 Shah Alam, Selangor Darul Ehsan Malaysia</p>
                </div>
                <div>
                    <i class="fa fa-envelope"></i>
                    <p>customer_service@gardenia.com.my</p>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p>03-55423228</p>
                </div>
            </div>
            <div class="subscribe">
                <h3 class="pacifico_normal">Subscribe</h3>
                <form>
                    <input type="email" id="semail" name="semail" placeholder="Enter your Email ">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="bottom">
            <div class="social-media">
                <div class="social-media-container">
                    <a href="https://www.facebook.com/GardeniaKL" title="Facebook" target=_blank><img src="../src/fb.png"
                            alt="Facebook"></a>
                    <a href="https://www.instagram.com/gardenia_kl/" title="Instagram" target=_blank><img
                            src="../src/ig.png" alt="Instagram"></a>
                    <a href="https://twitter.com/gardenia_kl" title="Twitter" target=_blank><img src="../src/tw.png"
                            alt="Twitter"></a>
                    <a href="https://www.youtube.com/user/GardeniaKL" title="Youtube" target=_blank><img
                            src="../src/yt.png" alt="Youtube"></a>
                </div>
            </div>
            <p>Copyright &copy (2004-2018) Gardenia Bakeries (KL) Sdn. Bhd (139386X) All Rights Reserved. | <a
                    href="#">PRIVACY</a></p>
        </div>
    </footer>
    
    <div id="success">
        <div class="success-container">
            <h2>Registration Successful!</h2>
            <i id="i-success" class="fa fa-check fa-5x" aria-hidden="true"></i>
            <div class="btn">
                <a href="../index.php"><input type="submit" id="successBtn" name="successBtn" value="OK"></input></a>
            </div>
        </div>
    </div>
</body>
</html>

