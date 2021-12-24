<?php
    ob_start();
    //Select UserID from user
    include 'validation/loginValidation.php';
    include 'validation/connectSQL.php';
    include 'database/createCartTable.php';

    $userType = $_SESSION['userType'];
    $anonymousID = $_SESSION['anonymousID'];
    
    ob_end_flush();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="../src/style.css">
        <link rel="icon" href="../src/icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            body{
                background: linear-gradient( to top , rgb(241, 241, 241)90%, rgb(196, 196, 196));
            }

            main {
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
            }

            i:hover {
                cursor: pointer;
                color: #CE0101;
            }
        </style>

    </head>

    <?php include 'header.php' ?>

    <body>
        <h2 style="text-align: center; margin-top: 30px">Shopping Cart</h2>
        <main>
            <div class= "product-div">
                <div>
                    <p style="width: 10%">ID</p><p style="width: 50%">Product</p><p style="width: 20%">Quantity</p><p style="width: 20%">Price per item</p>
                </div>
                <?php
                    if ($userType == "user") {
                        $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
                        $result = mysqli_query($conn, $sql);
                    } else if ($userType == '') {
                        $sql = "SELECT * FROM anonymous_$anonymousID ORDER BY ProductID";
                        $result = mysqli_query($conn, $sql);
                    }
                    
                    $count = mysqli_num_rows($result);

                    if ($count == 0) {
                        echo "<div>
                                <p>Oops, Your Shopping Cart is Empty<br>Browse our awesome products now!</p><br><br>
                                <button type='button'><a href='products.php'>Go Shopping Now<a></button>
                            </div>";
                    } else {
                        while($row = mysqli_fetch_row($result)){
                            $price = number_format($row[2], 2, '.', '');
                            echo "<div id='item$row[0]'>";
                            echo "<i class='fa fa-trash-o fa-lg' onclick='removeItem($row[0])'></i>"; //suppose to be delete button, i use a random pic first
                            echo "<p style='width: 7%'>$row[0]</p>";
                            echo "<p style='width: 50%'>$row[1]</p>";
                            echo "<div style='width: 20%; padding: 0; margin: 0;'>";
                            echo "<button onclick='minusAmount($row[0])' style='width: 35%'>-</button>";
                            echo "<p id='test$row[0]' style='width: 30%'>$row[3]</p>";
                            echo "<button onclick='addAmount($row[0])' style='width: 35%'>+</button>";
                            echo "</div>";
                            echo "<p style='width: 20%'>RM $price</p>"; 
                            echo "</div>";
                        }
                    }
                    
                ?>
            </div>
            <div class="amount-div">
                <h2 style="text-decoration: underline;">Amount </h2>
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
                            echo "<p style='text-align: left;'>$index) RM $price X $row[3] = RM $subtotal</p>";
                            $total += $subtotal;
                            $index++;
                        }
                        $total = number_format($total, 2, '.');
                        echo "<br><p style='text-align: left; font-weight: bold;'>TOTAL: RM $total</p>";
                        $_SESSION['total'] = $total;
                        mysqli_close($conn);
                        
                        if ($userType == "user") {
                            echo "<div style='background: none; width: 100%; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);'>
                                    <button type='button'><a href='user/payment.html'>Order Now</a></button>
                                </div>";
                        } else if ($userType == '') {
                            echo "<div style='background: none; width: 100%; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);'>
                                    <p>You haven't sign in as user.<br><a href='registration.php'>Register Now</a> and proceed to the payment</p>
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
                        <a href="https://www.facebook.com/GardeniaKL" title="Facebook" target=_blank><img src="src/fb.png" alt="Facebook"></a>
                        <a href="https://www.instagram.com/gardenia_kl/" title="Instagram" target=_blank><img src="src/ig.png" alt="Instagram"></a>
                        <a href="https://twitter.com/gardenia_kl" title="Twitter" target=_blank><img src="src/tw.png" alt="Twitter"></a>
                        <a href="https://www.youtube.com/user/GardeniaKL" title="Youtube" target=_blank><img src="src/yt.png" alt="Youtube"></a>
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
                xmlhttp.onload = function(){
                    x.innerHTML = this.responseText;
                    
                }
                xmlhttp.open("GET", "editCart.php?action=add&id=" + id);
                xmlhttp.send();
            }

            function minusAmount(id){ 
                const xmlhttp = new XMLHttpRequest();
                var x = document.getElementById("test"+id);
                xmlhttp.onload = function(){
                    x.innerHTML = this.responseText;
                    if(x.innerHTML == 0){
                        document.getElementById("item"+id).remove();
                    }
                }
                xmlhttp.open("GET", "editCart.php?action=minus&id=" + id);
                xmlhttp.send();
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
                };
            }
        </script>
    </body>
</html>