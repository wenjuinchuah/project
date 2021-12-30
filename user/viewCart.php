<?php
    ob_start();
    session_start();
    //Select UserID from user
    include '../validation/loginValidation.php';
    include '../validation/connectSQL.php';
    include '../database/createCartTable.php';
    
    $userType = $_SESSION['userType'];
    if (isset($_SESSION['anonymousID'])) {
        $anonymousID = $_SESSION['anonymousID'];
    }
    
    ob_end_flush();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <style>
            body{
                background: linear-gradient( to top , rgb(241, 241, 241)90%, rgb(196, 196, 196));
            }

            .sub-title {
                text-align: center;
                margin: 30px auto;
            }

            #viewcart-container {
                display: flex;
                justify-content: center;
                gap: 40px;
            }

            #viewcart-container .product-div {
                padding-bottom: 40px;
                width: 50%;
            }

            #viewcart-container .product-div table {
                width: 100%;
                border-collapse: collapse;
            }

            #viewcart-container .product-div table button, #viewcart-container .amount-div .orderButton a {
                margin: 10px;
                padding: 5px 10px;
                border-radius: 25px;
                border: none;
                background-color: #3F3F3F;
            }

            #viewcart-container .product-div table button:hover, #viewcart-container .amount-div a:hover {
                opacity: 0.7;
            }

            #viewcart-container .product-div table button a, #viewcart-container .amount-div .orderButton a {
                text-decoration: none;
                color: #fff;
            }

            #viewcart-container .product-div table .fa.fa-minus, #viewcart-container .product-div table .fa.fa-plus {
                margin: 5px;
                padding: 5px 10px;
            }

            #viewcart-container .product-div table i:hover {
                opacity: 0.5;
            }

            #viewcart-container .product-div table p {
                display: inline;
                padding: 0 5px;
            }

            #viewcart-container .product-div table td,  #viewcart-container .product-div table th {
                border: 1px solid #ddd;
                height: 30px;
                padding: 8px;
                text-align: center;
            }

            #viewcart-container .product-div table tr:nth-child(even) {
                background-color: #fff;
            }

            #viewcart-container .product-div table tr:hover {
                background-color: #ddd;
            }

            #viewcart-container .product-div table th {
                padding-top: 12px;
                padding-bottom: 12px;
                background-color: #110971;
                color: white;
            }

            #viewcart-container #amount-div {
                width: 20%;
                height: 100%;
                background-color: #fff;
                padding: 10px;
                margin-bottom: 40px;
czzzzz            }

            #viewcart-container .amount-div #price {
                display: flex;
                height: calc(460px - 69px);
                flex-direction: column;
            }

            #viewcart-container .amount-div h2 {
                text-align: center;
                padding-bottom: 20px;
            }

            #viewcart-container .amount-div #price div {
                display: flex;
                padding: 8px 0;
            }

            #viewcart-container .amount-div #price div p {
                display: inline;
            }

            #viewcart-container .amount-div #price div p.priceList, #viewcart-container .amount-div .total {
                flex: 1;
            }

            #viewcart-container .amount-div .orderButton {
                justify-content: end;
            }

            #viewcart-container .amount-div .orderButton a {
                font-size: larger;
                font-weight: bold;
                width: 100%;
                padding: 5px 0;
                margin: 10px auto;
                border-radius: 0;
                text-align: center;
            }

            #viewcart-container .amount-div .registerButton {
                text-align: center;
            }

            #viewcart-container .amount-div .empty {
                flex: 1;
            }

            #viewcart-container .amount-div .checkout {
                flex-direction: column;
                justify-content: flex-end;
            }

            /* main {
                display: inline-block;
                width: 80%;
                height: 500px;
                margin: 20px 0% 5% 0%;
                position: relative;
                left: 50%;
                transform: translateX(-50%);
            }

            .product-div {
                background-color: gray; 
                width: 65%; 
                height: 100%;
                border-radius: 12px;
            }

            .product-div p{
                display: inline-block;
            }

            .amount-div {
                position: absolute;
                top: 0%;
                background: white;
                width: 30%;
                height: 100%;
                border: 2px solid black;
                border-radius: 12px;
                padding: 20px;
            }

            main div {
                display: inline-block;
                padding: 20px 5%;
                width: 100%;
                text-align: center;
                background-color: white;
                margin: 10px;
                border-radius: 5px;
            } */

            i:hover {
                cursor: pointer;
                color: #CE0101;
            }
        </style>

    </head>

    <?php include 'userHeader.php' ?>

    <body>
        <h2 class="sub-title">Shopping Cart</h2>
        <main id="viewcart-container">
            <div class= "product-div">
                <table id="table">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price per item</th>
                        <!-- <th>Subtotal</th> -->
                    </tr>
                    <?php
                        $total = 0;
                        $subtotal = 0;
                        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');

                        if ($userType == "user") {
                            $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
                            $result = mysqli_query($conn, $sql);
                        } else if ($userType == '') {
                            $sql = "SELECT * FROM anonymous_$anonymousID ORDER BY ProductID";
                            $result = mysqli_query($conn, $sql);
                        }
                        
                        $count = mysqli_num_rows($result);

                        if ($count == 0) {
                            echo "<tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        Oops, Your Shopping Cart is Empty<br>Browse our awesome products now!<br>
                                        <button type='button'><a href='../products.php'>Shopping Now</a></button>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <!--<td></td>-->
                                </tr>";
                        } else {
                            while($row = mysqli_fetch_row($result)){
                                $price = number_format($row[2], 2, '.', '');

                                echo "<tr id='item$row[0]'>
                                        <td><i class='fa fa-trash-o fa-lg' onclick='removeItem($row[0])'></i></td>
                                        <td>$row[0]</td>
                                        <td>$row[1]</td>
                                        <td>
                                            <i class='fa fa-minus' class='button-quantity' onclick='minusAmount($row[0])'></i>
                                                <p id='test$row[0]'>$row[3]</p>
                                            <i class='fa fa-plus' class='button-quantity' onclick='addAmount($row[0])'></i>
                                        </td>
                                        <td>RM $price</td>
                                    </tr>";

                                // echo "<div id='item$row[0]'>";                                                      
                                // echo "<i class='fa fa-trash-o fa-lg' onclick='removeItem($row[0])'></i>";           
                                // echo "<p style='width: 7%'>$row[0]</p>";                                            
                                // echo "<p style='width: 50%'>$row[1]</p>";                                           
                                // echo "<div style='width: 20%; padding: 0; margin: 0;'>";                            
                                // echo "<button onclick='minusAmount($row[0])' style='width: 35%'>-</button>";        
                                // echo "<p id='test$row[0]' style='width: 30%'>$row[3]</p>";                          
                                // echo "<button onclick='addAmount($row[0])' style='width: 35%'>+</button>";          
                                // echo "</div>";                                                                      
                                // echo "<p style='width: 20%'>RM $price</p>";                                         
                                // echo "</div>";
                            }
                        }
                    ?>
                </table>
            </div>
            <div class="amount-div" id="amount-div">
                <h2>Amount</h2>
                <div id="price">
                    <?php
                        if ($userType == "user") {
                            $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
                            $result = mysqli_query($conn, $sql);
                        } else if ($userType == '') {
                            $sql = "SELECT * FROM anonymous_$anonymousID ORDER BY ProductID";
                            $result = mysqli_query($conn, $sql);
                        }
                        $index = 1;
                        $total = 0;
                        while($row = mysqli_fetch_row($result)){
                            $price = number_format($row[2], 2, '.', '');
                            $subtotal = $row[3]*$price;
                            $subtotal = number_format($subtotal, 2, '.');
                            echo "<div>
                                    <p class='priceList'>$index) RM $price X $row[3]</p>
                                    <p class='price'>RM $subtotal</p>
                                </div>";
                            $total += $subtotal;
                            $index++;
                        }
                        $total = number_format($total, 2, '.');
                        echo "<div class='empty'></div>
                            <div class='checkout'><hr><div><p class='priceList' style='text-align: left; font-weight: bold;'>TOTAL</p><p class='price'>RM $total</p></div><hr>";
                        $_SESSION['total'] = $total;
                        mysqli_close($conn);
                        
                        if ($userType == "user") {
                            $count = mysqli_num_rows($result);
                            if ($count == 0) {
                                echo "<div class='orderButton'>
                                    <a style='pointer-events: none; opacity: 0.5;'>Order Now</a>
                                </div>";
                            } else {
                                echo "<div class='orderButton'>
                                    <a href='payment.html' >Order Now</a>
                                </div>";
                            }
                           
                        } else if ($userType == '') {
                            echo "<div class='registerButton'>
                                    <p>You haven't sign in as user.<br><a href='../registration.php'>Register Now</a> and proceed to the payment</p>
                                </div>
                                </div>";
                        }
                        
                    ?>
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
            $("button").click(function() {
                $("#price").load("calculatePrice.php");
            });

            function addAmount(id){
                const xmlhttp = new XMLHttpRequest();
                var x = document.getElementById("test"+id);
                var y = document.getElementById("priceList"+id);
                xmlhttp.onload = function(){
                    x.innerHTML = this.responseText;
                }
                xmlhttp.open("GET", "editCart.php?action=add&id=" + id);
                xmlhttp.send();
                location.reload();
            }

            function minusAmount(id){ 
                const xmlhttp = new XMLHttpRequest();
                var x = document.getElementById("test"+id);
                xmlhttp.onload = function(){
                    x.innerHTML = this.responseText;
                    if(x.innerHTML == 0){
                        document.getElementById("item"+id).deleteRow();
                    }
                }
                xmlhttp.open("GET", "editCart.php?action=minus&id=" + id);
                xmlhttp.send();
                location.reload();
            }

            function removeItem(id){
                if (confirm("Do you want to remove this product from your cart?") == true) {
                    const xmlhttp = new XMLHttpRequest();
                    var x = document.getElementById("item"+id);
                    xmlhttp.onload = function(){
                        x.remove();
                    }
                    xmlhttp.open("GET", "editCart.php?action=remove&id=" + id);
                    xmlhttp.send();
                    document.getElementById("item"+id).deleteRow();
                    location.reload();
                };
            }

            //Calculate table height
            $(document).ready(function () {
                let table = document.getElementById("table");
                let tableHeight = table.offsetHeight - 20;
                document.getElementById("amount-div").style.height = tableHeight + 'px';
                tableHeight -= 40;
                let price = document.getElementById("price").style.height;
                let priceHeight = price.offsetHeight;
                if (tableHeight > 391) {
                    document.getElementById("price").style.height = tableHeight + 'px';
                } else {
                    document.getElementById("amount-div").style.height = '421px';
                }
            });
        </script>
    </body>
</html>