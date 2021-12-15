<?php
    include '../validation/connectSQL.php';
    session_start();

    //Get user amount
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result) - 1;

    //Prevent normal user to visit admin dashboard
    if ($_SESSION['role'] != 'admin') {
        header('Location: ../index.php');
    }

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia');
    $productsql = "SELECT * FROM products ORDER BY ID";
    $products = mysqli_query($conn, $productsql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="src/dashboardStyle.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="w3-light-grey">

    <!-- Top container -->
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4; display: flex; height: 60px; padding-top: 5px;">
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
                <h3>0</h3>
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
                </tr>
                <?php while ($column = mysqli_fetch_array($products)) { ?>
                    <?php 
                        $price = number_format($column[2], 2, '.', '');
                        echo "<tr>";
                        echo "<td>$column[0]</td>";
                        echo "<td>$column[1]</td>";
                        echo "<td>RM $price</td>";
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

    <script src="dashboardScript.js"></script>
    </body>
</html>
