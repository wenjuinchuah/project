<?php
    include '../validation/connectSQL.php';
    session_start();

    //Get order amount
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_order');
    $sql = "SELECT COUNT(*) AS orderCount FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'gardenia_order'";
    $result = mysqli_query($conn, $sql);
    $assocResult = mysqli_fetch_assoc($result);
    $orderCount = $assocResult['orderCount'];
    $_SESSION['orderCount'] = $orderCount;

    //Get user amount
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia');
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    $userCount = mysqli_num_rows($result) - 1;
    $_SESSION['userCount'] = $userCount;

    //Prevent normal user to visit admin dashboard
    if ($_SESSION['role'] != 'admin') {
        header('Location: ../index.php');
    }

    //Get products database
    $productsql = "SELECT * FROM products ORDER BY ID";
    $productList = mysqli_query($conn, $productsql);
    $productCount = mysqli_num_rows($productList);
    $_SESSION['productCount'] = $productCount;

    if (isset($_POST['submit'])) {
        $product = mysqli_fetch_assoc($productList);

        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productStock = $_POST['productStock'];

        if (empty($_POST['productName'])) {
            $productNameError = "Product Name cannot be blank!";
            $showError = 'visible';
        }
        if (empty($_POST['productPrice'])) {
            $productPriceError = "Price cannot be blank!";
            $showError = 'visible';
        }
        if (empty($_POST['productPrice'])){
            $productStockError = "Stock cannot be blank!";
            $showError = 'visible';
        }
        if (empty($productNameError) && empty($productPriceError) && empty($productStockError)) {
            if ($product['Name'] != $_POST['productName']) {
                $_SESSION['productName'] = $_POST['productName'];
                $_SESSION['productPrice'] = $_POST['productPrice'];
                $_SESSION['productStock'] = $_POST['productStock'];
                header("Location: addProduct.php");
            }
        } else {
            $productView = "block";
            $productList = mysqli_query($conn, $productsql);
        }
    } else {
        $productName = $productPrice = $productStock = "";
        $productList = mysqli_query($conn, $productsql);
    }
    mysqli_free_result($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="src/dashboardStyle.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .w3-quarter:hover {
                cursor: pointer;
                opacity: 0.8;
            }

            #addProductView {
                display: <?=$productView?>
            }

            small {
                font-size: 12px;
                color: red;
                font-weight: bold;
                visibility: <?=$showError?>;
            }
        </style>
    </head>

    <body class="w3-light-grey">

    <!-- Top container -->
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4; display: flex; height: 60px; padding-top: 7px;">
        <div class="w3-container w3-row" style="flex: 1; align-content: center;">
            <div class="w3-col s4" style="width: 100%">
                <img src="src/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
                <span>Welcome, <?php echo $_SESSION['loginUser'] ?></span>
            </div>
        </div>
        <span class="w3-bar-item w3-right"><a href="../validation/logout.php">Logout<a></span>
    </div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-top:43px;">

        <!-- Header -->
        <header class="w3-container" style="padding-top:22px">
            <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
        </header>

        <div class="w3-row-padding w3-margin-bottom">
            <div class="w3-quarter" onclick="window.location.href='dashboard.php'">
            <div class="w3-container w3-red w3-padding-16">
                <div class="w3-left"><i class="fa fa-list w3-xxxlarge"></i></div>
                <div class="w3-right">
                <h3><?php echo $_SESSION['productCount'] ?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Products</h4>
            </div>
            </div>
            <div class="w3-quarter" onclick="window.location.href='order.php'">
            <div class="w3-container w3-blue w3-padding-16">
                <div class="w3-left"><i class="fa fa-shopping-bag w3-xxxlarge"></i></div>
                <div class="w3-right">
                <h3><?php echo $_SESSION['orderCount'] ?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Orders</h4>
            </div>
            </div>
            <div class="w3-quarter">
            <div class="w3-container w3-teal w3-padding-16">
                <div class="w3-left"><i class="fa fa-credit-card w3-xxxlarge"></i></div>
                <div class="w3-right">
                <h3><?php //echo $transactionCount ?>0</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Transaction</h4>
            </div>
            </div>
            <div class="w3-quarter" onclick="window.location.href='user.php'">
            <div class="w3-container w3-orange w3-text-white w3-padding-16">
                <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                <div class="w3-right">
                <h3><?php echo $_SESSION['userCount'] ?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Users</h4>
            </div>
            </div>
        </div>
    </div>
    
    </body>
</html>