<?php 
    include 'adminHeader.php'; 
    
    $sql = "SELECT * FROM order_details";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            #editOrderStatusView textarea {
                resize: none;
                width: 100%;
                border-radius: 5px;
                border: 1px solid lightgray;
                background-color: #f1f1f1;
                padding: 0 10px;
            }

            #editOrderStatusView label {
                padding: 0;
            }

            #editOrderStatusView input {
                margin: 0;
            }

            #editOrderStatusView select {
                width: 100%;
            }

            #editOrderStatusView #update {
                margin-bottom: 20px;
            }

            #editOrderStatusView table {
                width: 100%;
            }

            #editOrderStatusView td {
                text-align: end;
                padding-right: 5px;
            }
        </style>
    </head>
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
                    <th>Update</th>
                </tr>
                <?php $i = 1; 
                    while ($orderDetails = mysqli_fetch_assoc($result)) { ?>
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
                            <td id='orderID_$i'>$orderDetails[orderID]</td>
                            <td id='userID_$i'>$orderDetails[userID]</td>
                            <td id='address$i'>$orderDetails[Address]</td>
                            <td id='paymentMethod_$i'>$paymentMethod</td>
                            <td>$orderDetails[PaymentDate]</td>
                            <td id='status_$i'>$orderDetails[Status]</td>
                            <td>
                                <button type='button' class='openEdit' name='openEdit' onclick=\"updateOrderStatus('$orderDetails[orderID]', '$orderDetails[userID]', '$orderDetails[Address]', '$paymentMethod')\">
                                <i class='fas fa-edit'></i></button>
                            </td>
                        </tr>";
                        $i++;
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

    <!--Edit Order Status View -->
    <div id="editOrderStatusView">
        <div class="userView-container">
            <form class="regform" action="updateOrderStatus.php" method="POST" enctype="multipart/form-data">
                <i class="fa fa-times w3-right w3-xlarge" onclick="turnOffOrderStatusUpdate()"></i>
                <h2>Update Order Status</h2>
                <table>
                    <tr>
                        <td><label>Order ID</label></td>
                        <td><input type="text" id="orderID" name="orderID" disabled/></td>
                    </tr>
                    <tr style="background-color: #fff">
                        <td><label>UserID</label></td>
                        <td><input type="text" id="userID" name="userID" disabled/></td>
                    </tr>
                    <tr>
                        <td><label>Address</label></td>
                        <td><textarea id="address" name="address" disabled></textarea></td>
                    </tr>
                    <tr style="background-color: #fff">
                        <td><label>Payment Method</label></td>
                        <td><input type="text" id="paymentMethod" name="paymentMethod" disabled/></td>
                    </tr>
                    <tr>
                        <td><label>Order Status</label></td>
                        <td><select name="status">
                                <option value="1">Waiting for Dispatch</option>
                                <option value="2">Shipped</option>
                        </select></td>
                    </tr>
                </table>
                <div>
                    <input type="submit" class="edit" name="update" value="Confirm"></input>
                </div>
            </form>
        </div>
    </div>

    <script src="dashboardScript.js"></script>
    <script>
        //editOrderStatus View
        function turnOffOrderStatusUpdate() {
            document.getElementById("editOrderStatusView").style.display = "none";
        }

        //updateOrderStatus
        function updateOrderStatus(orderID, userID, address, paymentMethod) {
            document.getElementById("editOrderStatusView").style.display = "block";
            document.getElementById("orderID").value = orderID;
            document.getElementById("userID").value = userID;
            document.getElementById("address").value = address;
            document.getElementById("paymentMethod").value = paymentMethod;
            createCookie("orderID", orderID, "0.1");
        }

        // Function to create the cookie
        function createCookie(name, value, days) {
                var expires;
                
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                }
                else {
                    expires = "";
                }
                
                document.cookie = escape(name) + "=" + 
                    escape(value) + expires + "; path=/";
            }
    </script>
    </body>
</html>
