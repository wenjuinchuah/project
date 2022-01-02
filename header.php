<?php
    include 'validation/loginValidation.php';
    include 'validation/connectSQL.php';
    include 'database/createCartDb.php';
    include 'database/createOrderDb.php';
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
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        small {
            font-size: 12px;
            color: red;
            visibility: <?=$showError?>;
        }

        .dropdown-signIn {
            visibility: <?=$dropdownLoginView?>;
        }

        .dropdown-userInfo {
            visibility: <?=$dropdownUserInfoView?>;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <div class="logo-container">
                <a href="index.php"><img src="src/gardenia.png" alt="Logo"></a>
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
                <?php if (isset($_SESSION['isLogin'])) { ?>
                <?php if ($_SESSION['isLogin'] === FALSE) { ?>
                <?php echo "<li class='product'><a href='user/viewCart.php'>Shopping Cart</a></li>"; ?>
                <?php } ?>
                <?php } ?>
                <div class="dropdown">
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
                <div class="signIn" id="signIn">
                    <button class="dropbtn">
                        <?php if ($isLogin == true) { ?>
                        <p>Hi, <?php echo $loginUsername?></p>
                        <?php } else { ?><p>Sign In</p><?php } ?>
                    </button>
                    <div class="dropdown-signIn" id="dropdown-signIn">
                        <form id="loginValidation" action="" method="POST">
                            <div>
                                <label>Email:</label>
                                <input type="text" id="username" name="username" autocomplete="username"
                                    placeholder="Email Address" value="<?php echo $username ?>" />
                                <?php if (isset($nameError)) {?>
                                <small id="nameError"><?php echo $nameError ?></small>
                                <?php } ?>
                            </div>
                            <div>
                                <label>Password:</label>
                                <input type="password" name="password" autocomplete="current-password"
                                    placeholder="Password" value="<?php echo $password ?>" />
                                <?php if (isset($passwordError)) {?>
                                <small id="passwordError"><?php echo $passwordError ?></small>
                                <?php } ?>
                            </div>
                            <input type="submit" name="submit" id="signInButton" value="Login" />
                            <div style="font-family: Arial, Helvetica, sans-serif; font-size: smaller;">
                                <p>Don't have an account? <a href="registration.php">Sign Up</a> now!</p>
                            </div>
                        </form>
                    </div>
                    <div class="dropdown-userInfo">
                        <a href="user/userProfile.php"><i class="fa fa-user"></i> Profile</a>
                        <a href="user/viewCart.php"><i class="fa fa-shopping-cart"></i> Shopping Cart</a>
                        <a href="user/orderHistory.php"><i class="fa fa-history"></i></i> Order History</a>
                        <a href="validation/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>
                </div>
            </ul>
            <div class="language">
                <button class="dropbtn"><img src="src/globe.png" alt="Globe"></button>
                <div class="dropdown-language">
                    <a href="#">English</a>
                    <a href="#">B. Melayu</a>
                    <a href="#">中文</a>
                </div>
            </div>
        </nav>
    </header>
</body>
<script>
    var isClicked = false;

    document.getElementById("signIn").addEventListener("mouseover", function () {
        document.getElementById("dropdown-signIn").style.display = "block";
    });

    document.getElementById("signIn").addEventListener("mouseout", function () {
        if (isClicked) {
            document.getElementById("dropdown-signIn").style.display = "block";
            isClicked = false;
        } else {
            document.getElementById("dropdown-signIn").style.display = "none";
        }
    });

    document.getElementById("username").addEventListener("click", function () {
        isClicked = true;
    });
</script>

</html>