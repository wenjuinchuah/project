<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Registration</title>

    <style>
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
            visibility: hidden;
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
            top: 36px;
            color: gray;
        }

        #regform #i-password1 {
            left: 220px;
        }

        #regform #i-password1-slash {
            left: 196.5px;
        } 

        #regform #i-password2 {
            left: 159px;
        } 
        
        #regform #i-password2-slash {
            left: 135.5px;
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

        #regform #submit {
            width: 78.6%;
            background-color: #2b323d;
            color: #fff;
            font-weight: bold;
        }

        #regform #submit:hover {
            opacity: 70%;
            cursor: pointer;
        }

        /* The message box is shown when the user clicks on the password field */
        #regform #message {
            background: #f1f1f1;
            color: #000;
            border-radius: 10px;
            margin: 10px 0 0 0;
            padding: 10px 0 0 10px;
            display: none;
        }

        #regform #message p {
            padding: 5px 35px;
            font-size: 13px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        #regform .valid {
            color: green;
        }

        #regform .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        #regform .invalid {
            color: red;
        }

        #regform .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
        }
    </style>
</head>

<body>
    <div id="view-container">
        <div class="van">
            <div id="registerForm">
                <form class="form" id="regform" action="validation/formValidation.php" method="POST" onsubmit="return formValidation()">
                    <h2>User Account Registration</h2>
                    <div>
                        <label>First Name</label>
                        <input type="text" id="fname" name="fname" placeholder="First Name"/>
                        <small id="fnameError">Error message</small>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" id="lname" name="lname" placeholder="Last Name"/>
                        <small id="lnameError">Error message</small>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" id="email" name="email" placeholder="Email Address"/>
                        <small id="emailError">Error message</small>
                    </div>
                    <div>
                        <label >Mobile</label>
                        <div class="mobile-container">
                            <input type="text" id="code" name="code" value="+60" disabled/>  
                            <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number"/>
                            <small id="mobileError">Error message</small>
                        </div>
                    </div>
                    <div>
                        <label>Password</label>
                        <i id="i-password1" class="fa fa-eye" aria-hidden="true" onclick="isVisible('password1', 'i-password1', 'i-password1-slash')"></i>
                        <i id="i-password1-slash" class="fa fa-eye-slash" aria-hidden="true" onclick="isVisible('password1', 'i-password1', 'i-password1-slash')"></i>
                        <div class="password-container">
                            <input type="password" id="password1" name="password1" placeholder="Password"/>
                            <small id="password1Error"></small>
                            <div id="message">
                                <h5>Password must contain the following:</h5>
                                <p id="capital" class="invalid">At least one <b>Uppercase [A-Z]</b></p>
                                <p id="letter" class="invalid">At least one <b>Lowercase [a-z]</b></p>
                                <p id="number" class="invalid">At least one <b>Number [0-9]</b></p>
                                <p id="specialChar" class="invalid">At least one <b>Special Character</b></p>
                                <p id="length" class="invalid">Minimum <b>Length of 6</b></p>
                                <p id="space" class="valid">No <b>space</b></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label>Confirm Password</label>
                        <i id="i-password2" class="fa fa-eye" aria-hidden="true" onclick="isVisible('password2', 'i-password2', 'i-password2-slash')"></i>
                        <i id="i-password2-slash" class="fa fa-eye-slash" aria-hidden="true" onclick="isVisible('password2', 'i-password2', 'i-password2-slash')"></i>
                        <input type="password" id="password2" name="password2" placeholder="Confirm Password"/>
                        <small id="password2Error">Error message</small>
                    </div>
                    <div>
                        <label>Gender</label>
                        <div class="gender-container">
                            <input type="radio" id="male" name="gender" value="Male" checked="true"/>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="Female"/>
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
                    <div class="checkbox-container">
                        <input type="checkbox" id="t&c" name="t&c" value="value1"/>
                        <label for="t&c">I accept the above <u>Terms and Conditions</u></label>
                        <small id="t&cError">Error message</small>
                    </div>
                    <div class="button">
                        <input type="reset" id="reset" value="Clear"></input>
                        <input type="submit" id="submit" name="submit" value="Register" onclick="return  confirm('Do you want to register?')"></input>
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