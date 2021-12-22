<?php
    include '../validation/connectSQL.php';
    session_start();

    //Get order amount
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'userorder');
    $sql = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'";
    $result = mysqli_query($conn, $sql);
    $order = mysqli_num_rows($result);

    //Get user amount
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia');
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result) - 1;

    //Prevent normal user to visit admin dashboard
    if ($_SESSION['role'] != 'admin') {
        header('Location: ../index.php');
    }

    //Get products database
    $productsql = "SELECT * FROM products ORDER BY ID";
    $productList = mysqli_query($conn, $productsql);
    
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
            <div class="w3-quarter">
            <div class="w3-container w3-red w3-padding-16">
                <div class="w3-left"><i class="fa fa-shopping-bag w3-xxxlarge"></i></div>
                <div class="w3-right">
                <h3><?php echo $order ?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Orders</h4>
            </div>
            </div>
            <div class="w3-quarter">
            <div class="w3-container w3-blue w3-padding-16">
                <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
                <div class="w3-right">
                <h3 class="visits">0</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Views</h4>
            </div>
            </div>
            <div class="w3-quarter">
            <div class="w3-container w3-teal w3-padding-16">
                <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
                <div class="w3-right">
                <h3>0</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Shares</h4>
            </div>
            </div>
            <div class="w3-quarter">
            <div class="w3-container w3-orange w3-text-white w3-padding-16">
                <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                <div class="w3-right">
                <h3><?php echo $count ?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Users</h4>
            </div>
            </div>
        </div>

        <!--Products-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-list"></i> Products</b></h5>
            <div class="w3-right" style="margin-right: 15px">
                <h5 class="addProduct" onclick="addProduct()"><i class="fa fa-plus"></i> Add Product</h5>
            </div>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
                <?php while ($column = mysqli_fetch_array($productList)) { ?>
                    <?php 
                        $price = number_format($column[2], 2, '.', '');
                        echo "<tr>";
                        echo "<td>$column[0]</td>";
                        echo "<td>$column[1]</td>";
                        echo "<td>RM $price</td>";
                        echo "<td>$column[3]</td>";
                        echo "</tr>"; 
                    ?>
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

    <!--Add Product View-->
    <div id="addProductView">
        <div class="addProductView-container">
            <i class="fa fa-times w3-right w3-xlarge" onclick="turnOff()"></i>
            <form action="" method="POST">
                <h2>Add New Product</h2>
                <div>
                    <label>Product Name</label>
                    <input type="text" name="productName" placeholder="Product Name" value="<?php echo $productName ?>"/>
                    <?php if (isset($productNameError)) {?>
                        <small id="productNameError"><?php echo $productNameError ?></small>
                    <?php } ?>
                 </div>
                <div style="margin-top: 10px">
                    <label class="priceLabel">Price</label>
                    <input type="text" id="currency" name="currency" value="RM" disabled/>
                    <input type="text" id="productPrice" name="productPrice" placeholder="10" value="<?php echo $productPrice ?>"/>
                    <?php if (isset($productPriceError)) {?>
                        <small id="productPriceError"><?php echo $productPriceError ?></small>
                    <?php } ?>
                </div>
                <div style="margin-top: 10px">
                    <label class="stockLabel">Stock</label>
                    <input type="text" id="productStock" name="productStock" placeholder="1" value="<?php echo $productStock ?>"/>
                    <?php if (isset($productStockError)) {?>
                        <small id="productStockError"><?php echo $productStockError ?></small>
                    <?php } ?>
                </div>
                <div class="button">
                    <input type="submit" id="submit" name="submit" value="Add Product"></input>
                </div>
            </form>
        </div>
    </div>

    <script src="dashboardScript.js"></script>
    </body>
</html>
