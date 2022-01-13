<?php
    session_start();
    include '../validation/connectSQL.php';
    include 'userHeader.php';

    //declare variable
    $orderID = array();
    $index = 0;
    $subtotal = $total = 0;
    $isFound = FALSE;

    if (!empty($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM order_details WHERE userID = '$userID'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                $isFound = TRUE;
            } else {
                $isFound = FALSE;
            }
        } else {
            $isFound = FALSE;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Order History</title>
        <style>
            .title {
                padding: 10px 0;
            }

            .title h2 {
                text-align: center;
            }

            .order {
                display: flex;
                justify-content: center;
                padding-bottom: 20px;
            }

            .order table {
                width: 80%;
                border-collapse: collapse;
                text-align: center;
            }

            .order td, .order th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            .order tr:nth-child(odd) {
                background-color: #fff;
            }

            .order tr:hover {
                background-color: #ddd;
            }

            .order th {
                padding-top: 12px;
                padding-bottom: 12px;
                background-color: #110971;
                color: white;
            }

            .order .details {
                text-align: center;
                cursor: pointer;
            }

            .order .details:hover {
                color: #CE0101;
            }

            .order .received {
                width: 150px;
            }

            .order .received:hover {
                cursor: pointer;
                opacity: 0.7;
            }

            .order .received:hover p {
                background-color: green;
            }

            .order .received p {
                background-color: #2b323d;
                padding: 10px;
                border-radius: 50px;
                color: #fff;
            }

            .order tr #done p {
                background-color: #F0F0F0;
                border: none !important;
                color: gray;
            }

            .order tr #done:hover, .order tr #done p:hover {
                opacity: 1;
                cursor: default;
            }

            .order tr #done:hover p, .order tr:hover #done p, .order tr:nth-child(odd) #done:hover p, .order tr:nth-child(odd):hover #done p {
                opacity: 1 !important;
                background-color: #ddd;
            }

            .order tr:nth-child(odd) #done p {
                background-color: #fff;
                border: none !important;
                color: gray;
            }

            #orderListView a {
                font-family: 'Balsamiq Sans', cursive;
                font-size: larger;
                cursor: pointer;
                margin: 20px 0 10px 0;
                background-color: #3F3F3F;
                color: #fff;
                padding: 10px 20px;
            }

            #orderListView a:hover {
                opacity: 0.7;
            }

            #orderListView, #mask-container {
                display: flex;
                justify-content: center;
                align-items: center;
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                visibility: hidden;
            }

            #orderListView #orderListView-container {
                display: flex;
                flex-direction: column;
                background-color: #fff;
                justify-content: center;
                align-items: center;
                width: 60%;
                height: min-content;
                padding: 30px 0;
                border-radius: 5px;
                box-shadow: 10px 10px 20px 5px #0000003F;
            }

            #orderListView table {
                width: 80%;
                border-collapse: collapse;
                text-align: center;
                display: none;
            }

            #orderListView td, #orderListView th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #orderListView tr:nth-child(odd) {
                background-color: #ddd;
            }

            #orderListView tr:nth-child(even) {
                background-color: #fff;
            }

            #orderListView th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: center;
                background-color: #110971;
                color: white;
            }

            #orderListView-container h3 {
                margin-bottom: 20px;
            }

            #mask-container {
                background-color: #fff;
                opacity: 0.9;
            }
        </style>
    </head>

    <body>
        <main>
            <div class="title">
                <h2 class="pacifico_L">Order History</h2>
            </div>
            <div class="order">
                <table id='orderHistory'>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Address</th>
                            <th>Payment Method</th>
                            <th>Payment Timestamp</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <?php
                        if ($isFound === TRUE) {
                            while ($orderDetails = mysqli_fetch_assoc($result)) {
                                array_push($orderID, $orderDetails['orderID']);
                                $paymentMethod = $orderDetails['PaymentMethod'];
                                if ($paymentMethod == 'COD') {
                                    $paymentMethod = 'Cash On Delivery';
                                } else if ($paymentMethod == 'CC') {
                                    $paymentMethod = 'Credit Card';
                                } else {
                                    $paymentMethod = 'Payment Failed';
                                }
                                if ($orderDetails['Status'] == 'To Ship') {
                                    $updateStatus = 'Return/Refund';
                                } else if ($orderDetails['Status'] == 'To Receive') {
                                    $updateStatus = 'Order Received';
                                } else if ($orderDetails['Status'] == 'Received') {
                                    $updateStatus = 'Completed';
                                } else {
                                    $updateStatus = 'Cancelled';
                                }
                                echo "<tr>
                                        <td>$orderDetails[orderID]</td>
                                        <td>$orderDetails[Address]</td>
                                        <td>$paymentMethod</td>
                                        <td>$orderDetails[PaymentDate]</td>
                                        <td id='status-$orderDetails[orderID]'>$orderDetails[Status]</td>";
                                        if ($updateStatus == 'Return/Refund' || $updateStatus == 'Order Received') {
                                            echo "<td class='received' onclick='status(\"$orderID[$index]\", \"$updateStatus\")'><p>$updateStatus</p></td>";
                                        } else {
                                            echo "<td class='received' id='done'><p>$updateStatus</p></td>";
                                        }
                                        echo "<td class='details' onclick='expand(\"$orderID[$index]\")'>More Details >></td>
                                    </tr>";
                                $index++;
                            }
                        } else {
                            echo "<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>You haven't order anything before this!<br>Order now before it is too late!</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>";
                        }
                    ?>
                    <div id="mask-container"></div>
                </table>
            </div>
            <div id="orderListView">
                <div id="orderListView-container">
                    <?php
                        if ($isFound === TRUE) {
                            echo "<h3 id='orderID'></h3>";

                            for ($i = 0; $i < count($orderID); $i++) {
                                $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_order');
                                $sql = "SELECT * FROM $orderID[$i]";
                                $orderResult = mysqli_query($conn, $sql);
                                echo "<table id='$orderID[$i]' class='orderList'>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                        </tr>";
                                while ($orderDetails = mysqli_fetch_assoc($orderResult)) {
                                    $price = number_format($orderDetails['Price'], 2, '.', '');
                                    $subtotal = $price * $orderDetails['Quantity'];
                                    $total = $total + $subtotal;
                                    $subtotal = number_format($subtotal, 2, '.', '');
                                    $total = number_format($total, 2, '.', '');

                                    echo "<tr>
                                            <td>$orderDetails[ProductID]</td>
                                            <td>$orderDetails[ProductName]</td>
                                            <td>RM $price</td>
                                            <td>$orderDetails[Quantity]</td>
                                            <td>RM $subtotal</td>
                                        </tr>";
                                }
                                echo "<tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>RM$total</td>
                                </tr>
                                </table>";
                                $subtotal = $total = 0;
                            }
                        }
                    ?>
                    <a onclick='expand("empty")'>Close Table</a>
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
    <script>
        function expand(orderID) {
            var x = document.getElementById("orderListView");
            if (orderID != "empty") {
                var y = document.getElementById(orderID);
            }
            var z = document.getElementById('mask-container');
            
            if (x.style.visibility == "visible") {
                if (orderID != "empty") {
                    y.style.display = "none";
                } else {
                    document.querySelectorAll(".orderList").forEach(a => a.style.display = "none");
                }
                x.style.visibility = 'hidden';
                z.style.visibility = 'hidden';
            } else {
                if (orderID != "empty") {
                    y.style.display = "table";
                }
                document.getElementById("orderID").innerHTML = "Order ID: " + orderID;
                x.style.visibility = 'visible';
                z.style.visibility = 'visible';
            }

            document.getElementById("orderID").style.width = tableWidth + 'px';
        }

        function status(orderID, status) {
            if (status == 'Order Received' || status == 'Return/Refund') {
                if (confirm("You are not allow to make any changes after this. Are you sure?")) {
                    const xmlhttp = new XMLHttpRequest();
                    var x = document.getElementById("status-" + orderID);
                    xmlhttp.onload = function() {
                        x.innerHTML = this.responseText;
                        location.reload();
                    }
                    xmlhttp.open("GET", "updateStatus.php?id=" + orderID);
                    xmlhttp.send();
                }   
            }     
        }
    </script>
</html>
