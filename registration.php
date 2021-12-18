<?php
    include 'validation/loginValidation.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gardenia Bakeries (KL) Sdn Bhd</title>
    <link rel="stylesheet" href="src/style.css">
    <link rel="icon" href="src/icon.png">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/windows/32/000000/edit-user-male--v1.png">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Login */
        small {
            font-size: 12px;
            color: red;
            visibility: <?=$showError?>;
        }

        .dropdown-signIn {
            visibility: <?=$dropdownLoginView?>
        }

        .dropdown-userInfo {
            visibility: <?=$dropdownUserInfoView?>
        }

        /* View Container */
        #view-container {
            max-width: 100%;
        }

        .van {
            background-image: url("src/van.jpeg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 20px;
        }

        /* Form */
        #registerForm {
            /*width: calc(100% - 650px);*/
            width: 100%;
        }
        
        #RegForm {
            /*font-family: Arial, Helvetica, sans-serif;*/
            width: 380px;
            margin: auto;
            padding: 20px;
            padding-bottom: 40px;
            position: relative;
            border-radius: 25px;
            background-color: #ffffffe8;
        }

        /* Title */
        #RegForm h2 {
            text-align: center;
            padding: 20px 0;
        }

        #RegForm div {
            margin-bottom: 10px;
        }

        #RegForm small {
            font-size: 12px;
            padding-left: 15px;
            color: red;
            display: none;
        }

        #RegForm input, #RegForm select {
            display: block;
            width: 93%;
            height: 30px;
            padding: 0 10px;
            border-radius: 5px;
            margin: auto;
            border: 1px solid lightgray;
        }

        #RegForm label {
            padding-left: 15px;
        }

        /* Mobile */
        .mobile-container {
            margin: auto;
            padding-left: 11px;
        }

        .mobile-container label {
            display: block;
        }

        #RegForm #code {
            display: inline-block;
            width: 50px;
            pointer-events: none;
        }

        #RegForm #mobile {
            display: inline-block;
            width: calc(95% - 50px);
        }

        #mobileError {
            display: block;
        }

        /* Password */
        .password-container {
            padding: 0;
            margin: 0;
            margin-bottom: 10px;
        }

        #i-password1,
        #i-password2,
        #i-password1-slash,
        #i-password2-slash {
            position: relative;
            top: 24px;
            color: gray;
        }

        #i-password1 {
            left: 193px;
        }

        #i-password1-slash {
            left: 173px;
        }

        #i-password2 {
            left: 134px;
        }

        #i-password2-slash {
            left: 114px;
        }

        #i-password1:hover,
        #i-password2:hover,
        #i-password1-slash:hover,
        #i-password2-slash:hover {
            cursor: pointer;
            color: #000;
        }

        #i-password1-slash,
        #i-password2-slash {
            visibility: hidden;
        }

        /* Gender */
        .gender-container {
            margin: 0;
            padding-left: 15px;
        }

        #RegForm .gender-container input {
            display: inline-block;
            width: 15px;
            padding-left: 15px;
        }

        .gender-container label, .checkbox-container label {
            position: relative;
            bottom: 9px;
            margin-right: 10px;
            padding: 0 !important;
        }

        /* State */
        #RegForm select {
            width: 93%;
            height: 32px;

            /* Removes the default <select> styling */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

            /* Positions background arrow image */
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAh0lEQVQ4T93TMQrCUAzG8V9x8QziiYSuXdzFC7h4AcELOPQAdXYovZCHEATlgQV5GFTe1ozJlz/kS1IpjKqw3wQBVyy++JI0y1GTe7DCBbMAckeNIQKk/BanALBB+16LtnDELoMcsM/BESDlz2heDR3WePwKSLo5eoxz3z6NNcFD+vu3ij14Aqz/DxGbKB7CAAAAAElFTkSuQmCC');
            background-repeat: no-repeat;
            background-position: 270px center;
        }

        /* t&c */
        .checkbox-container {
            text-align: center;
            margin: 0;
        }

        #RegForm .checkbox-container input {
            display: inline-block;
            width: 15px;
        }

        .checkbox-container label {
            font-size: 15px;
        }

        .checkbox-container u {
            cursor: pointer;
            color: purple;
        }

        .checkbox-container small {
            display: block;
        }

        /* Button*/

        #RegForm .button{
            margin:0;
            text-align: center;;
        }

        #RegForm .button input {
            display: inline-block;
            height: 32px;
        }

        #RegForm #reset {
            width: 15%;
        }

        #RegForm #reset:hover {
            background-color: rgb(255, 194, 194);
            cursor: pointer;
        }

        #RegForm #submit {
            width: 77%;
            background-color: #2b323d;
            color: #fff;
            font-weight: bold;
        }

        #RegForm #submit:hover {
            opacity: 70%;
            cursor: pointer;
        }

        /* The message box is shown when the user clicks on the password field */
        #message {
            width: 93%;
            background: #f1f1f1;
            color: #000;
            border-radius: 10px;
            margin: 10px 0 0 5px;
            padding: 10px 0 0 10px;
            display: none;
        }

        #message p {
            padding: 5px 35px;
            font-size: 13px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <div class="logo-container">
                <img src="src/gardenia.png" alt="Logo">
            </div>
            <div class="logo-container slogan">
                <img src="src/sogood.png" alt="Good">
            </div>
        </div>
        <nav>
            <ul class="nav-links">
                <li class="home"><a href="index.php">Home</a></li>
                <li class="about-us"><a href="aboutus.php">About Us</a></li>
                <li class="product"><a href="products.php">Products</a></li>
                <div class = "dropdown">
                    <button class="dropbtn">More</button>
                    <div class="dropdown-content">
                        <a href="#">Halal Matters</a>
                        <a href="#">Activities</a>
                        <a href="#">Recipe</a>
                        <a href="#">Tour</a>
                        <a href="#">Health Tips</a>
                        <a href="#">R&D/QA</a>
                        <a href="#">The Truth</a>
                        <a href="#">Career Center</a>
                        <a href="#contactus">Contact Us</a>
                    </div>
                </div>
                <div class = "signIn"> <!--testing-->
                    <button class="dropbtn">
                        <?php if ($isLogin == true) { ?>
                            <p>Hi, <?php echo $loginUsername ?></p>
                        <?php } else { ?><p>Sign In</p><?php } ?>
                    </button>
                    <div class="dropdown-signIn">
                        <form id="loginValidation" action="" method="POST">
                            <div>
                                <label>Username:</label>
                                <input type="text" name="username" placeholder="Username" value="<?php echo $username ?>"/>
                                <?php if (isset($nameError)) {?>
                                    <small id="nameError"><?php echo $nameError ?></small>
                                <?php } ?>
                            </div>
                            <div>
                                <label>Password:</label>
                                <input type="password" name="password" placeholder="Password" value="<?php echo $password ?>"/>
                                <?php if (isset($passwordError)) {?>
                                    <small id="passwordError"><?php echo $passwordError ?></small>
                                <?php } ?>
                            </div>
                            <input type="submit" name="submit" id="signInButton" value="Login"/>
                            <div style="font-family: Arial, Helvetica, sans-serif; font-size: smaller;">
                                <p>Don't have an account? <a href="registration.php">Sign Up</a> now!</p>
                            </div>
                        </form>
                    </div>
                    <div class="dropdown-userInfo">
                        <a href="viewCart.php"><i class="fa fa-shopping-cart"></i> Shopping Cart</a>
                        <a href="validation/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>
                </div>
            </ul>
            <div class = "language">
                <button class="dropbtn"><img src="src/globe.png" alt="Globe"></button>
                <div class="dropdown-language">
                    <a href="#">English</a>
                    <a href="#">B. Melayu</a>
                    <a href="#">中文</a>
                </div>
            </div>
        </nav>
    </header>

    <div id="view-container">
        <div class="van">
            

            <div id="registerForm">
                <form class="RegForm" id="RegForm" action="validation/formValidation.php" method="POST" onsubmit="return formValidation()">
                    <h2>User Account Registration</h2>
                    <div>
                        <label>First Name</label>
                        <input type="text" id="fname" name="fname" placeholder="First Name" />
                        <small id="fnameError">Error message</small>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" id="lname" name="lname" placeholder="Last Name" />
                        <small id="lnameError">Error message</small>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" id="email" name="email" placeholder="Email Address" />
                        <small id="emailError">Error message</small>
                    </div>
                    <div>
                        <label>Mobile</label>
                        <div class="mobile-container">
                            <input type="text" id="code" name="code" value="+60" disabled />
                            <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number" maxlength="10" />
                            <small id="mobileError">Error message</small>
                        </div>
                    </div>
                    <div>
                        <label>Gender</label>
                        <div class="gender-container">
                            <input type="radio" id="male" name="gender" value="Male" checked="true" />
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="Female" />
                            <label for="female">Female</label>
                        </div>
                    </div>
                    <div>
                        <label>State</label>
                        <select name="state" id="state">
                            <option value="state" disabled>- Select Your State-</option>
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="federal" disabled>-Federal Territories-</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Labuan">Labuan</option>
                            <option value="Putrajaya">Putrajaya</option>
                        </select>
                    </div>
                    <div>
                        <label>Password</label>
                        <i id="i-password1" class="fa fa-eye" aria-hidden="true"
                            onclick="isVisible('password1', 'i-password1', 'i-password1-slash')"></i>
                        <i id="i-password1-slash" class="fa fa-eye-slash" aria-hidden="true"
                            onclick="isVisible('password1', 'i-password1', 'i-password1-slash')"></i>
                        <div class="password-container">
                            <input type="password" id="password1" name="password1" placeholder="Password" />
                            <div id="message">
                                <h5>Password must contain the following:</h5>
                                <p id="capital" class="invalid">At least one <b>Uppercase [A-Z]</b></p>
                                <p id="letter" class="invalid">At least one <b>Lowercase [a-z]</b></p>
                                <p id="number" class="invalid">At least one <b>Number [0-9]</b></p>
                                <p id="specialChar" class="invalid">At least one <b>Special Character</b></p>
                                <p id="length" class="invalid">Minimum <b>Length of 6</b></p>
                                <p id="space" class="valid">No <b>space</b></p>
                            </div>
                            <small id="password1Error"></small>
                        </div>
                    </div>
                    <div>
                        <label>Confirm Password</label>
                        <i id="i-password2" class="fa fa-eye" aria-hidden="true"
                            onclick="isVisible('password2', 'i-password2', 'i-password2-slash')"></i>
                        <i id="i-password2-slash" class="fa fa-eye-slash" aria-hidden="true"
                            onclick="isVisible('password2', 'i-password2', 'i-password2-slash')"></i>
                        <input type="password" id="password2" name="password2" placeholder="Confirm Password" />
                        <small id="password2Error">Error message</small>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="t&c" name="t&c" value="value1" />
                        <label for="t&c">I accept the above <u>Terms and Conditions</u></label>
                        <small id="t&cError">Error message</small>
                    </div>
                    <div class="button">
                        <input type="reset" id="reset" value="Clear"></input>
                        <input type="submit" id="submit" name="submit" value="Register"
                            onclick="return  confirm('Do you want to register?')"></input>
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
                    <input type="email" id="email" name="email" placeholder="Enter your Email ">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="bottom">
            <div class="social-media">
                <div class="social-media-container">
                    <a href="https://www.facebook.com/GardeniaKL" title="Facebook" target=_blank><img src="src/fb.png"
                            alt="Facebook"></a>
                    <a href="https://www.instagram.com/gardenia_kl/" title="Instagram" target=_blank><img
                            src="src/ig.png" alt="Instagram"></a>
                    <a href="https://twitter.com/gardenia_kl" title="Twitter" target=_blank><img src="src/tw.png"
                            alt="Twitter"></a>
                    <a href="https://www.youtube.com/user/GardeniaKL" title="Youtube" target=_blank><img
                            src="src/yt.png" alt="Youtube"></a>
                </div>
            </div>
            <p>Copyright &copy (2004-2018) Gardenia Bakeries (KL) Sdn. Bhd (139386X) All Rights Reserved. | <a
                    href="#">PRIVACY</a></p>
        </div>
    </footer>

    <script src="validation/formValidation.js"></script>
</body>

</html>