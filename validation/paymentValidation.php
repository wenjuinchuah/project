<?php 
    session_start();
    include 'connectSQL.php';
    $userID = $_SESSION['userID'];
    $total = $_SESSION['total'];
    $total = number_format($total, 2, '.', '');

    //Navigation record
    if(isset($_SESSION['navigation']) && $_SESSION['role']=='user'){
        array_push($_SESSION['navigation'], array("Payment Page" => date("Y-m-d H:i:s")));
    }

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
    $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
    $result = mysqli_query($conn, $sql);

    if (isset($_POST['submitPaymentMethod'])) {   
        $paymentMethod = $_POST['paymentMethod'];     
        if (isset($paymentMethod)) {
            if ($paymentMethod == 2) {
                $_SESSION['paymentMethod'] = "CC";
            } else {
                $_SESSION['paymentMethod'] = "COD";
            }
        }
    }

    if (isset ($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];

        $_SESSION['address'] = $address;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['state'] = $state;
        $_SESSION['city'] = $city;
        $_SESSION['zip'] = $zip;

        if (isset($_POST['cardnumber'])) {
            $cardno = $_POST['cardnumber'];
            if (strlen($cardno) != 20) {
                
            }
        }
        
        include '../user/addOrder.php';
        include '../user/addTransaction.php';
        include '../user/sendOrderDetails.php';
        include '../user/sendInvoice.php';
        include '../user/removeCart.php';
        header('location:../index.php');
        ob_end_flush();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Payment Validation</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <style>
            body {
                font-family: Arial;
                font-size: 17px;
                padding: 8px;
            }

            * {
                box-sizing: border-box;
            }

            h2 {
                text-align: center;
            }

            .row {
                display: -ms-flexbox; /* IE10 */
                display: flex;
                -ms-flex-wrap: wrap; /* IE10 */
                flex-wrap: wrap;
                margin: 0 -16px;
            }

            .col-25 {
                -ms-flex: 25%; /* IE10 */
                flex: 25%;
            }

            .col-50 {
                -ms-flex: 50%; /* IE10 */
                flex: 50%;
            }

            .col-75 {
                -ms-flex: 75%; /* IE10 */
                flex: 75%;
            }

            .col-25,
            .col-50,
            .col-75 {
                padding: 0 16px;
            }

            .container {
                background-color: #f2f2f2;
                padding: 5px 20px 15px 20px;
                border: 1px solid lightgrey;
                border-radius: 3px;
            }

            input[type=text], select {
                width: 100%;
                margin-bottom: 20px;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            select {
                height: 41px;
            }

            label {
                margin-bottom: 10px;
                display: block;
            }

            .icon-container {
                margin-bottom: 20px;
                padding: 7px 0;
                font-size: 24px;
            }

            .btn {
                background-color: #04AA6D;
                color: white;
                padding: 12px;
                margin: 10px 0;
                border: none;
                width: 100%;
                border-radius: 3px;
                cursor: pointer;
                font-size: 17px;
            }

            .btn:hover {
                background-color: #45a049;
            }

            a {
                color: #2196F3;
            }

            hr {
                border: 1px solid lightgrey;
            }

            span.price {
                float: right;
                color: grey;
            }

            /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
            @media (max-width: 800px) {
                .row {
                    flex-direction: column-reverse;
                }
                .col-25 {
                    margin-bottom: 20px;
                }
            }
        </style>
    </head>

    <body>
        <h2>Payment Details</h2>
        <div class="row">
            <div class="col-75">
                <div class="container">
                <form action="" method="POST">
                
                    <div class="row">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="name"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="name" name="name" placeholder="John M. Doe">
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="john@example.com">
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="Kuching">

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <select name="state" id="state">
                                        <option value="state" disabled>- Select Your State-</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Pulau Pinang">Pulau Pinang</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                        <option value="federal" disabled>-Federal Territories-</option>
                                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option value="Labuan">Labuan</option>
                                        <option value="Putrajaya">Putrajaya</option>
                                    </select>
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="10001">
                                </div>
                            </div>
                        </div>
                        <?php
                            if ($_SESSION['paymentMethod'] == 'CC') {
                                echo '<div class="col-50">
                                    <h3>Payment</h3>
                                    <label for="fname">Accepted Cards</label>
                                    <div class="icon-container">
                                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                                    </div>
                                    <label for="cname">Name on Card</label>
                                    <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                    <label for="ccnum">Credit card number</label>
                                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111 2222 3333 4444">
                                    <label for="expmonth">Exp Month</label>
                                    <select name="expmonth" id="expmonth">
                                        <option value="January">January</option>
                                        <option value="Febuary">Febuary</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="Jult">Jult</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                    <!--<input type="text" id="expmonth" name="expmonth" placeholder="September">-->
                                    <div class="row">
                                        <div class="col-50">
                                            <label for="expyear">Exp Year</label>
                                            <input type="text" id="expyear" name="expyear" placeholder="2018">
                                        </div>
                                        <div class="col-50">
                                            <label for="cvv">CVV</label>
                                            <input type="text" id="cvv" name="cvv" placeholder="352">
                                        </div>
                                    </div>
                                </div>';
                            }
                        ?>
                    </div>
                    <?php
                        if ($_SESSION['paymentMethod'] == 'CC') { 
                            echo '<label>
                            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                            </label>';
                        }
                    ?>
                    <input type="submit" id="submit" name="submit" value="Continue to checkout" class="btn">
                    <a href="../index.php">Cancel</a>
                </form>
                </div>
            </div>
            <div class="col-25">
                <div class="container">
                <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php
                    $itemCount = mysqli_num_rows($result);
                    echo $itemCount;
                ?></b></span></h4>
                <?php
                    while ($row = mysqli_fetch_row($result)) {
                        $price = $row[2] * $row[3];
                        $subtotal = number_format($price, 2, '.', '');
                        echo "<p>$row[3] x $row[1] <span class='price'>RM$subtotal</span></p>";
                    }
                ?>
                <hr>
                <p>Total <span class="price" style="color:black"><b><?php echo 'RM'.$total?></b></span></p>
                </div>
            </div>
        </div>
        <footer>
            <!-- <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p> -->
        </footer>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">     
            // enable spacing for credit card number     
            $('#ccnum').on('keyup', function(e){         
                var val = $(this).val();         
                var newval = '';         
                val = val.replace(/\s/g, ''); 
                
                // iterate to letter-spacing after every 4 digits   
                for(var i = 0; i < val.length; i++) {             
                if(i%4 == 0 && i > 0) newval = newval.concat(' ');             
                newval = newval.concat(val[i]);         
                }        

                // format in same input field 
                $(this).val(newval);     
            });   
        </script>
    </body>

</html>