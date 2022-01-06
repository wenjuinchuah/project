<?php 
    include 'adminHeader.php'; 

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia');
    $sql = "SELECT * FROM transaction ORDER BY TransactionID";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <body class="w3-light-grey">

        <!--Order-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-credit-card"></i> Transaction</b></h5>
            <div class="w3-right" style="margin-right: 15px;">
            <h5 class="addFunction" onclick="showTransaction('all')" style="display:inline-block; width:100px; text-align: center;"> All</h5>
                <h5 class="addFunction" onclick="showTransaction('daily')" style="display:inline-block; width:100px; text-align: center;"> Daily</h5>
                <h5 class="addFunction" onclick="showTransaction('weekly')" style="display:inline-block; width:100px; text-align: center;"> Weekly</h5>
                <h5 class="addFunction" onclick="showTransaction('monthly')" style="display:inline-block; width:100px; text-align: center;"> Monthly</h5>
            </div>
        </div>
        <div id="transaction-div" style="padding: 0 15px" >
                <table>
                <tr class="table-top">
                    <th>Transaction ID</th>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Transaction Timestamp</th>
                    <th>Payment Method</th>
                </tr>
                <?php
                    echo  "<h3 style='text-align:center; font-weight:bold;'>All Time Transaction Record</h3>";
                    while ($transaction = mysqli_fetch_assoc($result)) { 
                        $paymentMethod = $transaction['PaymentMethod'];
                        if ($paymentMethod == 'COD') {
                            $paymentMethod = 'Cash On Delivery';
                        } else if ($paymentMethod == 'CC') {
                            $paymentMethod = 'Credit Card';
                        } else {
                            $paymentMethod = 'Payment Failed';
                        }
                        $total = number_format($transaction['Total'], 2, '.', '');
                        $transactionID = str_pad($transaction['TransactionID'], 4, 0, STR_PAD_LEFT);
                        echo "<tr>
                            <td>$transactionID</td>
                            <td>order_$transaction[OrderID]</td>
                            <td>RM $total</td>
                            <td> $transaction[TransactionDate]</td>
                            <td>$paymentMethod</td>
                        </tr>";
                    } 
                ?>
            </table>
            <div style="display:flex; justify-content: center; margin-top: 20px;">
                <button class="openEdit" style="font-size: larger; font-weight: bold;">Generate Report</button>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="w3-container w3-padding-16 w3-light-grey">
            <h4>FOOTER</h4>
            <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
        </footer>
    
    <!--End of Page-->
    </div>

    <script src="dashboardScript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        
        function showTransaction(category) {
            const xmlhttp = new XMLHttpRequest();
            var x = document.getElementById("transaction-div");
            xmlhttp.onload = function () {
                x.innerHTML = this.responseText;
            }
            xmlhttp.open("GET", "showTransaction.php?category="+category);
            xmlhttp.send();
        }
        
    </script>

    </body>
</html>
