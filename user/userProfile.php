<?php include 'userHeader.php'; 
    //Navigation record
    if(isset($_SESSION['navigation']) && $_SESSION['role']=='user'){
        array_push($_SESSION['navigation'], array("User Profile" => date("Y-m-d H:i:s")));
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Profile</title>
        <style>
            .profile{
                background-color: rgba(39, 55, 70 , 0.6); 
                width: auto; 
                position: relative; 
                text-align: center;
                padding: 30px;
                margin-bottom: 3px;
                box-shadow: 3px 3px 10px #17202A;
                
                /*background-image: url("https://i.pinimg.com/564x/62/f5/a5/62f5a5854bb2febeeb3944b378a40781.jpg");*/
                background-image: url("../src/colorful-bg.jpg");
                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .profile img, button{
                position: relative; 
            }

            table{
                width:80%;
                margin:auto;
                position: relative; 
                border: solid black;
                border-collapse: collapse;
            }


            td, th{
                padding: 10px;
                border-bottom: solid black;
                border-collapse: collapse;
            }

            th{
                background-color: rgba(28, 40, 51, 0.85);
                color: white;
                text-align: right;
            }

            td{
                text-align: left;
                background-color: RGBA(255,255,255,0.85);
            }

            .edit {
                padding: 10px 20px !important;
                cursor: pointer;
                font-size:medium;
                text-align: center;
                text-decoration: none;
                outline: none;
                color: #fff;
                border: none;
                border-radius: 15px;
                box-shadow: 0 7px #999;
                background-color:#291ea8;
            }

            .edit2 {
                padding: 6px 20px !important;
                cursor: pointer;
                font-size:medium;
                text-align: center;
                text-decoration: none;
                outline: none;
                color: #fff;
                border: none;
                border-radius: 15px;
                box-shadow: 0 7px #999;
                background-color:#291ea8;
            }

            .change {
                padding: 10px 20px !important;
                cursor: pointer;
                font-size:medium;
                text-align: center;
                text-decoration: none;
                outline: none;
                color: #fff;
                border: none;
                border-radius: 15px;
                box-shadow: 0 7px #999;
                background-color:#27AE60;
            }

            .edit:active, .edit2:active, .edit:hover, .edit2:hover {
                background-color: #110971;
                box-shadow: 0 5px #666;
                transform: translateY(2px);
            }

            .change:active, .change:hover {
                background-color: #145A32;
                box-shadow: 0 5px #666;
                transform: translateY(2px);
            }

            .pfp_div{
                border: 5px solid black; 
                border-radius: 50%; 
                height: 300px; 
                width: 300px; 
                box-shadow: 3px 3px 10px #17202A;
                margin-left:auto;
                margin-right:auto;
            }

            .error{
                visibility: <?= $errStat ?>
            }

            form input, form select {
                border: 1px solid lightgray;
                border-radius: 3px;
                font-size: large;
                padding: 2px 5px;
            }

            form #code {
                width: 30px;
            }

        </style>
    </head>

    <body>
        <div class="profile">
        
            <?php include '../validation/connectSQL.php';

                $sql = "SELECT * FROM user WHERE Email = '$loginUsername'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);

                echo "<h2 class='pacifico_L' style='color: white; text-shadow: 3px 3px 5px #17202A; text-align: center; padding-top: 10px '>Good day, ".$row[1].' '.$row[2]."!</h2>";
                echo "<br><br>";

                //get picture path from sql
                $sql = "SELECT pic_path FROM user WHERE Email='$loginUsername'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);

                //if NULL set default
                if(empty($row[0])){
                    //$path = "../src/icon.png";
                    $path = "https://p.kindpng.com/picc/s/105-1055656_account-user-profile-avatar-avatar-user-profile-icon.png";
                }else{
                    $path = "../userpic/".$row[0];
                }
                
                //crop image nicely
                $imagecrop = "background-image: url($path);background-position: center; background-repeat: no-repeat; background-size: cover;";
                echo "<div class='pfp_div' style='$imagecrop'></div>"

            ?>
            <br><br>
            <button class='edit' onclick="showHidden(0)">Edit Profile Picture</button>
            <div id="hidden0" style="display:none;">
                <br>
                <form action="uploadpic.php" method="POST" enctype="multipart/form-data" >
                    <input class='edit2' type="file" name="fileToUpload" id="fileToUpload">
                    <input class='edit' type="submit" value="Upload Image" name="submit">
                </form>
            </div>
            <span class='error'> 
                <?php //Error message for upload picture
                    if(isset($_SESSION['pic_error'])){
                        echo "<br><br>".$_SESSION['pic_error'];
                        unset($_SESSION['pic_error']);
                    }
                ?>
            </span> 
                <br>
                <br>

            <?php
                $sql = "SELECT * FROM user WHERE Email = '$loginUsername'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
            
                echo "<table>";
                echo "<tr>";
                echo "<th> Name </th>";
                echo "<td><p id='name'>$row[1] $row[2]</p>";
                echo "<form id='hidden1' action='editProfile.php' name='name' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<div style='margin: 5px 0'><span style='margin-right: 5px'>First Name</span><input name='firstname' type='text' value='$row[1]'/></div>
                    <div><span style='margin-right: 6px'>Last Name</span><input name='lastname' type= 'text' value='$row[2]'/></div>";
                echo "<div id='error1' style='color:darkred;' ></div><br>";
                if(isset($_SESSION['validation_name'])) { echo "<br><p style='color:darkred;' > $_SESSION[validation_name]</p><br>"; }; //for php validation
                echo "<button class='change' name='button' type='submit' value='name' >Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td style='width:90px'><button class='edit' onclick=showHidden(1)><i class='fa fa-pencil'></i> Edit</button></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> Email </th>";
                echo "<td><p id='email'> $row[3]</p>";
                echo "<form id='hidden2' action='editProfile.php' name='email' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<div style='margin: 5px 0'><span style='margin-right: 5px'>Email</span><input name='email' type='text' value='$row[3]'/></div>";
                echo "<div id='error2' style='color:darkred;' ></div><br>";
                if(isset($_SESSION['validation_email'])) { echo "<br><p style='color:darkred;' > $_SESSION[validation_email]</p><br>"; }; //for php validation
                echo "<button class='change' name='button' type='submit' value='email'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><button class='edit' onclick=showHidden(2)><i class='fa fa-pencil'></i> Edit</button></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> Phone Number </th>";
                echo "<td><p id='phone'> $row[4]</p>";
                $mobile = substr($row[4], 2);
                echo "<form id='hidden3' action='editProfile.php' name='mobile' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br>Phone Number <input type='text' id='code' name='code' value='+60' disabled /><input name='mobile' type='text' value='$mobile'/>";
                echo "<br><div id='error3' style='color:darkred;' ></div><br>";
                if(isset($_SESSION['validation_mobile'])) { echo "<br><p style='color:darkred;' > $_SESSION[validation_mobile]</p><br>"; }; //for php validation
                echo "<button class='change' name='button' type='submit' value='mobile'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><button class='edit' onclick=showHidden(3)><i class='fa fa-pencil'></i> Edit</button></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> State </th>";
                echo "<td><p id='state'> $row[5]</p>";
                $state = $row[5];
                echo "<form id='hidden4' action='editProfile.php' name='state' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br><label>State: </label>
                    <select name='state'>
                        <option disabled>- Select Your State-</option>
                        <option"; echo $state == 'Johor' ? 'selected': ''; echo ">Johor</option>
                        <option"; echo $state == 'Kelantan' ? 'selected': ''; echo ">Kelantan</option>
                        <option"; echo $state == 'Kedah' ? 'selected': ''; echo ">Kedah</option>
                        <option"; echo $state == 'Melaka' ? 'selected': ''; echo ">Melaka</option>
                        <option"; echo $state == 'Negeri Sembilan' ? 'selected': ''; echo ">Negeri Sembilan</option>
                        <option"; echo $state == 'Pahang' ? 'selected': ''; echo ">Pahang</option>
                        <option"; echo $state == 'Perak' ? 'selected': ''; echo ">Perak</option>
                        <option"; echo $state == 'Perlis' ? 'selected': ''; echo ">Perlis</option>
                        <option"; echo $state == 'Pulau Pinang' ? 'selected': ''; echo ">Pulau Pinang</option>
                        <option"; echo $state == 'Sabah' ? 'selected': ''; echo ">Sabah</option>
                        <option"; echo $state == 'Sarawak' ? 'selected': ''; echo ">Sarawak</option>
                        <option"; echo $state == 'Selangor' ? 'selected': ''; echo ">Selangor</option>
                        <option"; echo $state == 'Terrengganu' ? 'selected': ''; echo ">Terengganu</option>
                        <option disabled>-Federal Territories-</option>
                        <option"; echo $state == 'Kuala Lumpur' ? 'selected': ''; echo ">Kuala Lumpur</option>
                        <option"; echo $state == 'Labuan' ? 'selected': ''; echo ">Labuan</option>
                        <option"; echo $state == 'Putrajaya' ? 'selected': ''; echo ">Putrajaya</option>
                    </select>";
                echo "<br><br>";
                echo "<button class='change' name='button' type='submit' value='state'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><button class='edit' onclick=showHidden(4)><i class='fa fa-pencil'></i> Edit</button></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> Gender </th>";
                echo "<td><p id='gender'> $row[6]</p>";
                echo "<form id='hidden5' action='editProfile.php' name='gender' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br>Gender:  
                <input type='radio' id='male' name='gender' value='Male' checked='true' />
                <label for='male'>Male</label>
                <input type='radio' id='female' name='gender' value='Female' />
                <label for='female'>Female</label> ";
                echo "<br><br>";
                echo "<button class='change' name='button' type='submit' value='gender'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><button class='edit' onclick=showHidden(5)><i class='fa fa-pencil'></i> Edit</button></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> Password </th>";
                for ($i = 0; $i < strlen($row[7]); $i++) {
                    if (empty($currentPassword)) {
                        $currentPassword = '*';
                    } else {
                        $currentPassword .= '*';
                        $_SESSION['hashPassword'] = $currentPassword;
                    }
                }
                echo "<td><p id='password'> $_SESSION[hashPassword]</p>";
                echo "<form id='hidden6' action='editProfile.php' name='password' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<div style='margin: 5px 0'><span style='margin: 0 5px'>Current Password</span><input name='currentPassword' type='password'/></div>";
                echo "<div id='error4' style='color:darkred;' ></div>";
                if(isset($_SESSION['validation_currentPassword'])) { echo "<br><p style='color:darkred;' > $_SESSION[validation_currentPassword]</p>"; };
                echo "<div style='margin: 5px 0'><span style='margin: 0 5px 0 27px'>New Password</span><input name='newpassword' type='password'/></div>";
                echo "<div style='margin: 5px 0'><span style='margin-right: 5px'>Reenter Password</span><input name='confirmpassword' type='password'/></div>";
                echo "<br><div id='error5' style='color:darkred;' ></div>";
                if(isset($_SESSION['validation_password'])) { echo "<br><p style='color:darkred;' > $_SESSION[validation_password]</p><br>"; }; //for php validation
                echo "<button class='change' name='button' type='submit' value='password'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><button class='edit' onclick=showHidden(6)><i class='fa fa-pencil'></i> Edit</button></td>";
                echo "</tr>";
                echo "</table>";
            ?>
        </div>

        <div id="result">
        </div>

    </body>

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
                        <input type="email" id="Sub-email" name="Sub-email" placeholder="Enter your Email ">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="bottom">
                <div class="social-media">
                    <div class="social-media-container">
                        <a href="https://www.facebook.com/GardeniaKL" title="Facebook" target=_blank><img src="../src/fb.png" alt="Facebook"></a>
                        <a href="https://www.instagram.com/gardenia_kl/" title="Instagram" target=_blank><img src="../src/ig.png" alt="Instagram"></a>
                        <a href="https://twitter.com/gardenia_kl" title="Twitter" target=_blank><img src="../src/tw.png" alt="Twitter"></a>
                        <a href="https://www.youtube.com/user/GardeniaKL" title="Youtube" target=_blank><img src="../src/yt.png" alt="Youtube"></a>
                    </div>
                </div>
                <p>Copyright &copy (2004-2018) Gardenia Bakeries (KL) Sdn. Bhd (139386X) All Rights Reserved. | <a href="#">PRIVACY</a></p>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            /* Edit button */
            function showHidden(num){
                switch (num) {
                    case 0:
                        toggleDisplay(num, "");
                    case 1:
                        toggleDisplay(num, "name");
                        break;
                    case 2:
                        toggleDisplay(num, "email");
                        break;
                    case 3:
                        toggleDisplay(num, "phone");
                        break;
                    case 4:
                        toggleDisplay(num, "state");
                        break;
                    case 5:
                        toggleDisplay(num, "gender");
                        break;
                    case 6:
                        toggleDisplay(num, "password");
                        break;
                }

                function toggleDisplay(num, name) {
                    var x = document.getElementById("hidden"+num);
                    if(x.style.display == "none"){
                        x.style.display = "block";
                        document.getElementById(name).style.display = "none";
                    }else{
                        x.style.display = "none";
                        document.getElementById(name).style.display = "block";
                    }
                }
            }

            /* Display error message */
            function displayErr(num, message){
                var x = document.getElementById("error"+num);
                x.innerHTML = message;
            }

            /* EmailHandle */
            function emailHandle(email) {
                return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
            }

            /* PasswordHandle */
            function passwordHandle(password) {
                var rules = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,20}$/;
                if (password.match(rules)) {
                    return true;
                } else {
                    return false;
                }
            }

            /* Form Validation */
            function formValidation(type){
                if(type == 'name'){
                    var firstname = document.forms['name']['firstname'].value;
                    var lastname = document.forms['name']['lastname'].value;
                    
                    var fnameRegex = /^[a-zA-Z-' ]+$/;
                    var lnameRegex = /^[a-zA-Z-' \/]+$/;

                    /* fname */
                    if (firstname == "") {
                        displayErr(1, "First Name cannot be blank!");
                        return false;
                    } else if (!fnameRegex.test(firstname)) {
                        displayErr(1, "First Name can have letters only!");
                        return false;
                    } else {
                        var fnarray = firstname.split(" ");
                        for (let i = 0; i < fnarray.length; i++) {
                            if (fnarray[i].charCodeAt(0) < 65 || fnarray[i].charCodeAt(0) > 90) {
                                displayErr(1, "First Character of each word must be in Capital Letter!");
                                return false;
                            }
                        }
                    }

                    /* lname */
                    if (lastname == "") {
                        displayErr(1, "Last Name cannot be blank!")
                        return false;
                    } else if (!lnameRegex.test(lastname)) {
                        displayErr(1, "Last Name can have letters and / only!");
                    } else {
                        var lnarray = lastname.split(" ");
                        for (let i = 0; i < lnarray.length; i++) {
                            if (lnarray[i].charCodeAt(0) < 65 || lnarray[i].charCodeAt(0) > 90) {
                                displayErr(1, "First Character of each word must be in Capital Letter!");
                                return false;
                            }
                        }
                    }
                }

                if(type == "email"){
                    /* email */
                    var email = document.forms['email']['email'].value;
                    if (email == "") {
                        displayErr(2, "Email cannot be blank!")
                        return false;
                    } else {
                        if (emailHandle(email)) {
                        } else {
                            displayErr(2, "Please enter a valid email!")
                            return false;
                        }
                    }
                }

                if(type == "mobile"){
                    /* mobile */
                    var mobile = document.forms['mobile']['mobile'].value;
                    if (mobile == "") {
                        displayErr(3, "Mobile number cannot be blank!")
                        return false;
                    } else if (mobile.length < 9 || mobile.length > 10){
                        displayErr(3, "Please enter a valid mobile number!")
                        return false;
                    }
                }

                if(type == "password"){
                    var currentPassword = document.forms['password']['currentPassword'].value;
                    var password1 = document.forms['password']['password'].value;
                    var password2 = document.forms['password']['confirmpassword'].value;

                    /* password1 */
                    if (currentPassword == "") {
                        displayErr(4, "Current Password cannot be blank!")
                        return false;
                    } else {
                        displayErr(4, "")
                        return false;
                    }
                    /* password1 */
                    if (password1 == "") {
                        displayErr(5, "Password cannot be blank!")
                        return false;
                    } else {
                        if (passwordHandle(password1)) {
                        } else {
                            displayErr(5, "Password must have Uppercase, Lowercase, Special <br> Character, Numbers and No Space!");
                            return false;
                        }
                    }
                    /* password2 */
                    if (password2 == "") {
                        displayErr(5, "Confirm password cannot be blank!")
                        return false;
                    } else {
                        if (password2 == password1) {
                        } else {
                            displayErr(5, "Password does not match!");
                            return false;
                        }
                    }
                }

                //leave it first
                $("form").submit(function(e) {

                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    });
                });
                return true;
            }
        
        </script>
    </body>
</html>