<?php
    include 'validation/loginValidation.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gardenia Bakeries (KL) Sdn Bhd</title>
        <link rel="stylesheet" href="src/style.css">
        <link rel="icon" href="src/icon.png"> <!--a random pic as favicon for now, can change later-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
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
        <main>
            <div class="aboutus">
                <div class="bakerman">
                    <img src="src/bakerman.png" style="float: left;" alt="Bakerman">
                </div>  
                <div class="container">
                    <h2 class="centered pacifico_L">About Us</h2>
                    <p class="centered">Gardenia Foods (S) Pte Ltd. (also known as Gardenia Bakeries or Gardenia) is a Singaporean baked-goods company with presence in Singapore, Indonesia, Malaysia and the Philippines. It is listed on the Singapore Exchange (SGX) via its parent company, QAF Limited, which also owns Bonjour Bakery, and are headquartered at the Chinatown Complex in South Bridge Road.</p>
                </div>
            </div>
            
            <hr class="history_hr">

            <div class="history">

                <div class="title">
                    <h1 class="pacifico_L"> Brief History</h1>
                </div>
                <div class="desc2">
                    <p>Gardenia Bakeries (KL) Sdn Bhd rolled the first loaf of bread off its line in 1986. Within four short years, it became the bread market leader with an astounding 99 percent brand recall rate and 80 percent top-of-mind recall.</p>
                </div>
                <hr>
                <div class="history-container">
                    <div class="year1">
                        <h2>1969</h2>
                        <div class="circle1">
                            <div class="dot dot1"></div>
                        </div>
                        <div class="arrow">
                            <img class="arrow arrow1" src="src/arrow_down.png" alt="arrow_down">
                        </div>
                    </div>

                    <div class="year2">
                        <div class="arrow">
                            <img class="arrow2" src="src/arrow_up.png" alt="arrow_up">
                        </div>
                        <div class="circle2">
                            <div class="dot dot2"></div>
                        </div>
                        <h2>1986</h2>
                    </div>

                    <div class="year3">
                        <h2>Today</h2>
                        <div class="circle3">
                            <div class="dot dot2"></div>
                        </div>
                        <div class="arrow">
                            <img class="arrow3" src="src/arrow_down.png" alt="arrow_down">
                        </div>
                    </div>
                </div>
                <div class="description">
                    <div class=" desc1">
                        <p>In 1969, an American named Horatio Sye Slocumm was sent by International Executive Service Corporation (IESC) to East Malaysia to start a bakery. Mr. Slocumm brought with him 35 years of baking experience with one of America's leading chain of bakeries. Gardenia was born.</p>
                    </div>
                    <div class="desc3">
                        <p>Gardenia's range of products grew and evolved through the years, becoming better and better with each step. Leveraging on its brand strength, Gardenia now produces a variety of baked products to satisfy consumers' demands.</p>
                    </div>
                </div>
            </div>

            <hr class="history_hr">
            
            <div class="Achievement">
                <h1 class="pacifico_L" style="text-align: center; padding: 30px 0px 30px 0px; text-shadow: 3px 3px 5px rgb(122, 122, 122);">Achievements</h1>
                <div class="box">
                    <div class="sub">
                        <h class="year">2001</h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Best Supplier 2001 (Category: Bread), Dairy Farm Giant Retail</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2002</h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Quality Management Systems ISO 9001,<br>SIRIM QAS International Sdn Bhd</li>
                            <li>Superbrands Awards for 3 consecutive terms, Superbrands Malaysia</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2003</h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Superbrands Awards for 3 consecutive terms, Superbrands Malaysia</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2004</h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Superbrands Awards for 3 consecutive terms, Superbrands Malaysia</li>
                            <li>National Award for Creativity and Innovation, Malaysian Design Technology Centre</li>
                        </ul>
                    </div>
                </div>
                    

                <div class="box">
                    <div class="sub">
                        <h class="year">2005</h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Superbrands Awards for 3 consecutive terms, Superbrands Malaysia</li>
                            <li>MS 1480:1999 – Food Safety according to Hazard Analysis and Critical Control Point (HACCP)
                                System, SIRIM QAS International<br>Sdn Bhd</li>
                            <li>Universal Integrated System – ISI 2020, Research Institute of Standards in Islam</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2006</h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Superbrands Consumers' Choice Award, Superbrands Malaysia</li>
                            <li>Low Glycaemic Diabetic-Friendly, Diet-Friendly Seal, Glycemic Research Institute, Washington
                                D.C.</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2007 </h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Low Glycaemic Diabetic-Friendly, Diet-Friendly Seal, Glycemic Research Institute, Washington
                                D.C.</li>
                            <li>Highly Commended Product Award, Malaysian Institute of Food Technology (MIFT)</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2008 </h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Malaysia's Choice Award 2008, Superbrands Malaysia</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2009 </h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Malaysia's Top Ten Brands 2009 - Gardenia Malaysia (7th Place), The Nielson Company, Superbrands
                                survey</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2010 </h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Putra Brand Awards - GARDENIA Malaysia (Gold award), Association of Accredited Advertising
                                Agents (endorsed by Malaysia External Trade Development Corporation)
                                Consumers' survey on the Most Preferred<br>Brand (Foodstuff category)</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2011 </h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Malaysia's Top Ten Brands 2011 - Gardenia Malaysia (3rd Place), The Nielson Company, Superbrands
                                survey</li>
                            <li>Putra Brand Awards - GARDENIA Malaysia (Gold award), Association of Accredited Advertising
                                Agents (endorsed by Malaysia External Trade Development Corporation)
                                Consumers' survey on the Most Preferred<br>Brand (Foodstuff category)</li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="sub">
                        <h class="year">2012 </h>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Putra Brand Awards - GARDENIA Malaysia (Gold award), Association of Accredited Advertising
                                Agents (endorsed by Malaysia External Trade Development Corporation)
                                Consumers' survey on the Most Preferred<br>Brand (Foodstuff category)</li>
                        </ul>
                    </div>
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