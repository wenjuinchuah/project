<?php
    include 'validation/loginValidation.php';
?>

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
            main {
                background: linear-gradient( to top , rgb(241, 241, 241)90%, rgb(196, 196, 196));
            }

            .product-div {
                background-color: gray; 
                width: 70%; 
                position: relative; 
                left: 50%; 
                transform: translateX(-50%);
                border-radius: 12px;
            }

            main div {
                display: inline-block;
                padding: 20px 5%;
                width: 30%;
                text-align: center;
                background-color: white;
                margin: 10px;
                border-radius: 5px;
            }

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
                            <a href="validation/logout.php">Logout</a>
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

        <main>
            <div class= "product-div">
                <?php
                    include 'validation/connectSQL.php';

                    $query = "SELECT * FROM products";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_row($result)){
                        echo "<div>";
                        echo "<p>ID: $row[0]</p>";
                        echo "<p>Name: $row[1]</p>";
                        echo "<p>Price: RM $row[2]</p>";
                        echo "<p>Stock: $row[3]</p>";
                        echo "</div>";
                    }

                    mysqli_close($conn);
                ?>
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
                        <input type="email" id="email" name="email" placeholder="Enter your Email ">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="bottom">
                <div class="social-media">
                    <div class="social-media-container">
                        <a href="https://www.facebook.com/GardeniaKL" title="Facebook" target=_blank><img src="src/fb.png" alt="Facebook"></a>
                        <a href="https://www.instagram.com/gardenia_kl/" title="Instagram" target=_blank><img src="src/ig.png" alt="Instagram"></a>
                        <a href="https://twitter.com/gardenia_kl" title="Twitter" target=_blank><img src="src/tw.png" alt="Twitter"></a>
                        <a href="https://www.youtube.com/user/GardeniaKL" title="Youtube" target=_blank><img src="src/yt.png" alt="Youtube"></a>
                    </div>
                </div>
                <p>Copyright &copy (2004-2018) Gardenia Bakeries (KL) Sdn. Bhd (139386X) All Rights Reserved. | <a href="#">PRIVACY</a></p>
            </div>
        </footer>
    </body>
</html>