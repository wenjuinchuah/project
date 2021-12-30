<?php 
    include 'adminHeader.php'; 
    
    $sql = "SELECT * FROM order_details ORDER BY orderID";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <body class="w3-light-grey">

        <!--Order-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-shopping-bag"></i> Orders</b></h5>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Address</th>
                    <th>Payment Method</th>
                    <th>Payment Timestamp</th>
                    <th>Status</th>
                </tr>
                <?php while ($orderDetails = mysqli_fetch_assoc($result)) { ?>
                    <?php 
                        $paymentMethod = $orderDetails['PaymentMethod'];
                        if ($paymentMethod == 'COD') {
                            $paymentMethod = 'Cash On Delivery';
                        } else if ($paymentMethod == 'CC') {
                            $paymentMethod = 'Credit Card';
                        } else {
                            $paymentMethod = 'Payment Failed';
                        }
                        echo "<tr>
                            <td>$orderDetails[orderID]</td>
                            <td>$orderDetails[userID]</td>
                            <td>$orderDetails[Address]</td>
                            <td>$paymentMethod</td>
                            <td>$orderDetails[PaymentDate]</td>
                            <td>$orderDetails[Status]</td>
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
