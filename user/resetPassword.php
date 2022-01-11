<?php
    session_start();
    include 'userHeader.php';
    include '../validation/connectSQL.php';
    $email = $_SESSION['email'];

    $randomPassword = random_password(8);

    //Generate random password
    function random_password($length) {
        //A list of characters that can be used in our random password.
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols = '@`!-.[]?()';
        $numbers = '0123456789';
        //Create a blank string.
        $password = '';
        //Get the index of the last character in our $characters string.
        $characterListLength = mb_strlen($characters, '8bit') - 1;
        $uppercaseListLength = mb_strlen($uppercase, '8bit') - 1;
        $symbolListLength = mb_strlen($symbols, '8bit') - 1;
        $numbersListLength = mb_strlen($numbers, '8bit') - 1;
        //Loop from 1 to the $length that was specified.
        foreach (range(1, $length/4) as $i) {
            $password .= $characters[random_int(0, $characterListLength)];
            $password .= $uppercase[random_int(0, $uppercaseListLength)];
            $password .= $symbols[random_int(0, $symbolListLength)];
            $password .= $numbers[random_int(0, $numbersListLength)];
        }
        return $password;
    }

    $sql = "SELECT * FROM user WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $user = mysqli_fetch_assoc($result);
    }

    $sender = 'Gardenia Malaysia';
    $recipient = $email;

    $subject = 'Reset Password';
    $headers = 'From:' . $sender . "\r\n";
    $headers .= "Content-type: text/html";

    $message = "
    <!DOCTYPE html>
    <html>
        <head> 
            <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
            <style>
                * {
                    font-family: 'Arial', 'Sans-Serif';
                }

                table {border-collapse:separate;}
                a, a:link, a:visited {text-decoration: none; color: #00788a;}
                a:hover {text-decoration: underline;}
                h2,h2 a,h2 a:visited,h3,h3 a,h3 a:visited,h4,h5,h6,.t_cht {color:#000 !important;}
                .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {line-height: 100%;}
                .ExternalClass {width: 100%;}

                html {
                    padding: 20px 50px;
                    background-image: url('https://venngage-wordpress.s3.amazonaws.com/uploads/2018/09/Colorful-Geometric-Simple-Background-Image.jpg');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-blend-mode: lighten;
                }


                body {
                    margin: 0 auto;
                    border-radius: 5px;
                    background-color: #fff;
                    max-width: 900px;
                }

                body hr {
                    border: 1px solid #000;
                    width: 95%;
                }


                #header-container {
                    margin: 15px auto;
                    text-align: center;
                    width: 100%;
                }

                #header-container img {
                    margin: 15px 0;
                }

                #header-container a {
                    text-decoration: none;
                    color: #000;
                    font-weight: bold;
                    font-size: large;
                }

                #header-container a:hover {
                    text-decoration: underline;
                    color: #CE0101;
                }

                #header-container .vl {
                    display: inline-block;
                    border-left: 3px solid #000;
                    height: 15px;
                    margin: auto 25px auto 30px;
                }


                #main-container {
                    padding: 0 50px;
                    width: 100%;
                }

                #main-container #order-table {
                    border: 1px solid #000;
                    width: 100%;
                    border-collapse: collapse;
                }

                #main-container #order-table td {
                    padding: 5px;
                    width: 50%;
                    text-align: center;
                }

                #main-container #order-table #status {
                    background-color: lightgray;
                }


                #footer-container {
                    padding: 15px 50px;
                }

                #footer-container #icon a {
                    color: #000;
                }

                #footer-container #icon img {
                    margin-right: 20px;
                }

                #footer-container #notice {
                    margin: 20px 0;
                }

                #footer-container #notice p {
                    font-size: small;
                }

                @media screen and (-webkit-min-device-pixel-ratio:0) {
                    @media only screen and (max-width: 600px) {
                        html {
                        padding: 20px 0;
                        }

                        #header-container a {
                            font-size: small;
                        }
                    }
                    
                }
            </style> 
        </head>
        <body>
            <table id='header-container'>
                <tr>
                    <td><img width='250px' src='http://aiyoyo.ddns.net/project/src/logo.png' alt='failed'/></td>
                </tr>
                <tr>
                    <td>
                        <a href='http://aiyoyo.ddns.net/project/index.php' >HOME PAGE</a><span class='vl'></span>
                        <a href='http://aiyoyo.ddns.net/project/aboutus.php' >ABOUT US</a><span class='vl'></span>
                        <a href='http://aiyoyo.ddns.net/project/products.php' >PRODUCTS</a>
                    </td>
                </tr>
            </table>
            <hr>
            <table id='main-container'>
                <tr>
                    <td><h2>You request for reset your account password.</h2></td>
                </tr>
                <tr>
                    <td>
                        <p>Hi $user[FirstName] $user[LastName],</p>
                        <p>Your password has been reset for your account! It is recommended that you change your password as soon as possible to ensure the security of your account!</p>
                    </td>
                </tr>
                <tr>
                    <td><h3>Your new password is:</h3></td>
                </tr>
                <tr>
                    <td>
                        <table id='order-table'>
                            <tr id='status'>
                                <td><h2>$randomPassword</h2></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Yours sincerely,</p>
                        <p>Gardenia Malaysia.</p>
                    </td>
                </tr>
            </table>        
            <hr>                
            <table id='footer-container'>
                <tr id='icon'>
                    <td>
                        <a href='https://www.facebook.com/GardeniaKL' title='Facebook' target=_blank><img width='25px' src='http://aiyoyo.ddns.net/project/src/facebook-square.png'/></a>
                        <a href='https://www.instagram.com/gardenia_kl/' title='Instagram' target=_blank><img width='25px' src='http://aiyoyo.ddns.net/project/src/instagram-square.png'/></a>
                        <a href='https://twitter.com/gardenia_kl' title='Twitter' target=_blank><img width='25px' src='http://aiyoyo.ddns.net/project/src/twitter-square.png'/></a>
                        <a href='https://www.youtube.com/user/GardeniaKL' title='Youtube' target=_blank><img width='25px' src='http://aiyoyo.ddns.net/project/src/youtube-square.png'/></a>
                    </td>
                </tr>
                <tr id='notice'>
                    <td>
                        <p>Lot 3, Jalan Pelabur 23/1, 40300 Shah Alam, Selangor Darul Ehsan Malaysia</p>
                        <small>This is an automatically generated email from our subscription list. Please do not reply to this email.</small>
                        <small>If you have any enquires, Please email to customer_service@gardenia.com.my or call 03-55423228.</small>
                    </td>
                </tr>
            </table>
        </body>
    </html>
    ";

    if (!mail($recipient, $subject, $message, $headers)) {
        $sendEmail = 'Fail';
    } else {
        $sendEmail = 'Success';
        //update password
        $password = password_hash($randomPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET Password = '$password' WHERE Email = '$email'";
        $result = mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Forgot Password</title>
    </head>
    <style>
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 100px 0;
        }

        .main-container {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            width: 400px;
            box-shadow: 0 1px 2px rgb(0 0 0 / 10%), 0 2px 4px rgb(0 0 0 / 10%);
        }
        
        .main-container h2 {
            text-align: center;
            padding: 10px 0; 
        }

        .main-container div {
            text-align: center;
            margin: 10px auto;
        }

        .main-container div a {
            text-decoration: none;
            color: #fff;
            margin: 10px auto;
            padding: 5px 120px;
            border-radius: 5px;
            background-color: #2b323d;
        }

        .main-container div a:hover {
            cursor: pointer;
            opacity: 0.7;
        }
        
    </style>
    <body>
        <main>
            <div class="main-container">
                <h2>Reset Password</h2>
                <hr>
                <div>
                    <?php 
                        if ($sendEmail == 'Success') {
                            echo "<i class='fas fa-check fa-9x' style='color: darkgreen'></i>
                            <p>Your password has been reset! <br>Please check your email to get the new password.</p>";
                        } else {
                            echo "<i class='fas fa-times fa-9x' style='color: red'></i>
                            <p>Password reset failed! <br>System is currently down, please try again later.</p>";
                        }
                    ?>
                </div>
                <div style="margin: 20px auto">
                    <a href="../index.php">Back to Home Page</a>
                </div>
            </div>
        </main>
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
    </body>
</html>