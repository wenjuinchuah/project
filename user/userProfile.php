<!DOCTYPE html>
<html>
    <head>
        <title>Gardenia Bakeries (KL) Sdn Bhd</title>
        <link rel="stylesheet" href="src/style.css">
        <link rel="icon" href="src/icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            .profile{
                background-color: rgba(109, 109, 109, 0.6); 
                width: 70%;
                margin: 50px auto; 
                border-radius: 12px; 
                position: relative; 
                text-align: center;
                padding: 30px;
                /* left: 50%;
                transform: translateX(-50%) */
            }

            .profile img, button{
                position: relative; 
                /* left: 50%; 
                transform: translateX(-50%); */
            }

            table{
                position: relative; 
                /* left: 50%; 
                transform: translateX(-50%); */
                border: solid black;
                border-collapse: collapse;
            }

            td, th{
                padding: 10px;
                border-bottom: solid black;
                border-collapse: collapse;
            }

            table {
                width: 100%;
            }

            i:hover, a:hover {
                cursor: pointer;
                color: #CE0101;
            }
        </style>
    </head>

    <?php include 'userHeader.php'; ?>

    <body>
        <div class="profile">
            <img src="../src/icon.png" style="border: 5px solid black; border-radius: 50%; height: 300px; width: 300px; "/>
            <br><br>
            <button>Change Profile Picture</button>
        </div>
        
        <div class="profile">
            <?php include '../validation/connectSQL.php';
                $sql = "SELECT * FROM user WHERE Email = '$loginUsername'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
            
                echo "<table>";
                echo "<tr>";
                echo "<th> Name </th>";
                echo "<td><p id='name'>$row[1]</p>";
                echo "<form id='hidden1' action='editProfile.php' name='name' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br>First name: <input name='firstname' type='text' />  Last name: <input name='lastname' type= 'text' />";
                echo "<br><div id='error1' style='color:darkred;' ></div><br>";
                echo "<button name='button' type='submit' value='name' >Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><a onclick=showHidden(1)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> Email </th>";
                echo "<td><p id='email'> $row[2]</p>";
                echo "<form id='hidden2' action='editProfile.php' name='email' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br>Email: <input name='email' type='text' />";
                echo "<br><div id='error2' style='color:darkred;' ></div><br>";
                echo "<button name='button' type='submit' >Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><a onclick=showHidden(2)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> Phone Number </th>";
                echo "<td><p id='phone'> $row[3]</p>";
                echo "<form id='hidden3' action='editProfile.php' name='mobile' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br>Phone Number: +60  <input name='mobile' type='text'/>";
                echo "<br><div id='error3' style='color:darkred;' ></div><br>";
                echo "<button name='button' type='submit' value='mobile'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><a onclick=showHidden(3)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> State </th>";
                echo "<td><p id='state'> $row[4]</p>";
                echo "<form id='hidden4' action='editProfile.php' name='state' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br><label>State: </label>
                        <select name='state' id='stat'>
                            <option value='state' disabled>- Select Your State-</option>
                            <option value='Johor'>Johor</option>
                            <option value='Kedah'>Kedah</option>
                            <option value='Kelantan'>Kelantan</option>
                            <option value='Melaka'>Melaka</option>
                            <option value='Negeri Sembilan'>Negeri Sembilan</option>
                            <option value='Pahang'>Pahang</option>
                            <option value='Perak'>Perak</option>
                            <option value='Perlis'>Perlis</option>
                            <option value='Pulau Pinang'>Pulau Pinang</option>
                            <option value='Sabah'>Sabah</option>
                            <option value='Sarawak'>Sarawak</option>
                            <option value='Selangor'>Selangor</option>
                            <option value='Terengganu'>Terengganu</option>
                            <option value='federal' disabled>-Federal Territories-</option>
                            <option value='Kuala Lumpur'>Kuala Lumpur</option>
                            <option value='Labuan'>Labuan</option>
                            <option value='Putrajaya'>Putrajaya</option>
                        </select>";
                echo "<br><br>";
                echo "<button name='button' type='submit' value='state'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><a onclick=showHidden(4)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> Gender </th>";
                echo "<td><p id='gender'> $row[5]</p>";
                echo "<form id='hidden5' action='editProfile.php' name='gender' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br>Gender:  
                <input type='radio' id='male' name='gender' value='Male' checked='true' />
                <label for='male'>Male</label>
                <input type='radio' id='female' name='gender' value='Female' />
                <label for='female'>Female</label> ";
                echo "<br><br>";
                echo "<button name='button' type='submit' value='gender'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><a onclick=showHidden(5)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th> Password </th>";
                echo "<td><p id='password'> $row[6]</p>";
                echo "<form id='hidden6' name='password' method='POST' onsubmit='return formValidation(name)' style='display: none;'>";
                echo "<br>New password: <input name='password' type='password'/>";
                echo "  Reenter password: <input name='confirmpassword' type='password'/>";
                echo "<br><div id='error4' style='color:darkred;' ></div><br>";
                echo "<button name='button' type='submit' value='password'>Change</button>";
                echo "</form>";
                echo "</td>";
                echo "<td><a onclick=showHidden(6)><i class='fa fa-pencil'></i> Edit</a></td>";
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
                var x = document.getElementById("hidden"+num);
                if(x.style.display == "none"){
                    x.style.display = "block";
                }else{
                    x.style.display = "none";
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
                    var password1 = document.forms['password']['password'].value;
                    var password2 = document.forms['password']['confirmpassword'].value;

                    /* password1 */
                    if (password1 == "") {
                        displayErr(4, "Password cannot be blank!")
                        return false;
                    } else {
                        if (passwordHandle(password1)) {
                        } else {
                            displayErr(4, "Password must have Uppercase, Lowercase, Special <br> Character, Numbers and No Space!");
                            return false;
                        }
                    }
                    /* password2 */
                    if (password2 == "") {
                        displayErr(4, "Confirm password cannot be blank!")
                        return false;
                    } else {
                        if (password2 == password1) {
                        } else {
                            displayErr(4, "Password does not match!");
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