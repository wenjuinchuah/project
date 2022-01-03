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
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th>Transaction ID</th>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                </tr>
                <?php while ($transaction = mysqli_fetch_assoc($result)) { ?>
                    <?php 
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
                            <td>$total</td>
                            <td>$paymentMethod</td>
                        </tr>";
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
