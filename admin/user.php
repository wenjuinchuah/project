<?php 
    include 'adminHeader.php'; 
    
    $sql = "SELECT * FROM user ORDER BY UserID";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<head>
    <style>
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
            top: 25px;
            color: gray;
        }

        #i-password1 {
            left: 213px;
        }

        #i-password1-slash {
            left: 193px;
        }

        #i-password2 {
            left: 154px;
        }

        #i-password2-slash {
            left: 134px;
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
            background-position: 285px center;
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
<html>
    <body class="w3-light-grey">

        <!--Order-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-users"></i> Users</b></h5>
            <div class="w3-right" style="margin-right: 15px">
                <h5 class="addFunction" onclick="addUser()"><i class="fa fa-plus"></i> Add User</h5>
            </div>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>State</th>
                    <th>Gender</th>
                    <th>Password</th>
                    <th>UserType</th>
                </tr>
                <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                    <?php if ($user['UserType'] !== 'admin') { ?>
                        <?php 
                            $user['Password'] = substr($user['Password'],0,10) . "...";
                            echo "<tr>
                                <td>$user[UserID]</td>
                                <td>$user[Name]</td>
                                <td>$user[Email]</td>
                                <td>$user[Mobile]</td>
                                <td>$user[State]</td>
                                <td>$user[Gender]</td>
                                <td>$user[Password]</td>
                                <td>$user[UserType]</td>
                            </tr>";
                        ?>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
        
        <!-- Footer -->
        <footer class="w3-container w3-padding-16 w3-light-grey">
            <h4>FOOTER</h4>
            <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
        </footer>
    
    <!--End of Page-->
    </div>

    <!--Add User View-->
    <div id="addUserView">
        <div class="addUserView-container" id="registerForm">
            <i class="fa fa-times w3-right w3-xlarge" onclick="turnOffUserView()"></i>
            <form class="RegForm" id="RegForm" action="" method="POST" enctype="multipart/form-data">
                <h2>Add New User</h2>
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

    <script src="dashboardScript.js"></script>
    </body>
</html>
