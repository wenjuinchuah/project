<?php
    include '../validation/connectSQL.php';
    global $showError;

    if (isset($_POST['reset'])) {
        if (empty($_POST['checkEmail'])) {
            $showError = 'visible';
            $errorMessage = 'Please filled in the email address!';
        } else {
            $email = $_POST['checkEmail'];
            $sql = "SELECT * FROM user WHERE Email = '$email'";
            if ($result = mysqli_query($conn, $sql)) {
                $row = mysqli_num_rows($result);
                if ($row == 1) {
                    $showError = 'hidden';
                    $errorMessage = '';
                    $_SESSION['email'] = $email;
                    header('Location: resetPassword.php');
                    ob_end_flush();
                } else {
                    $showError = 'visible';
                    $errorMessage = 'Email address not found, Please try again!';
                }
            }
        }
    } else {
        $showError = 'hidden';
        $errorMessage = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Forgot Password</title>
    </head>
    <style>
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 100px 0;
        }
        
        .main-container h2 {
            text-align: center;
            padding: 10px 0; 
        }

        .main-container form {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            width: 400px;
            box-shadow: 0 1px 2px rgb(0 0 0 / 10%), 0 2px 4px rgb(0 0 0 / 10%);
        }

        .main-container form #form-content, .main-container form #submit-button {
            padding: 10px 0;
        }

        .main-container form #form-content small {
            padding: 0 15px;
            visibility: <?php echo $showError?>;
        }

        .main-container form label {
            display: block;
            padding: 15px;
        }

        .main-container form input {
            width: 346px;
            padding: 0 15px;
            margin: 5px 10px;
            height: 50px;
            font-size: medium;
            border-radius: 5px;
            border: 1px solid lightgray;
        }

        .main-container form #reset {
            background-color: #2b323d;
            width: 380px;
            height: 30px;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }

        .main-container form #reset:hover {
            cursor: pointer;
            opacity: 0.7;
        }
    </style>

        <?php include '../user/userHeader.php'; ?>

    <body>
        <main>
            <div class="main-container">
                <form action="" method="POST">
                    <h2>Forgot Password</h2>
                    <hr>
                    <div id="form-content">
                        <label for="checkEmail">Please enter your email address to search for your account</label>
                        <input type="text" name="checkEmail" placeholder="Email Address"/>
                        <small><?=$errorMessage?></small>
                    </div>
                    <div id="submit-button">
                        <input type="submit" id="reset" name="reset" value="Reset Password"/>
                    </div>
                </form>
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