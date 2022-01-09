<?php
    include '../validation/connectSQL.php';
    date_default_timezone_set("Asia/Kuala_Lumpur"); //set time zone
    $currentDate = date("Y/m/d h:i:s");

    $orderID = $_SESSION['orderID'];
    $userID = $_SESSION['userID'];

    $name = $_SESSION['name'];
    $address = $_SESSION['address'];
    $state = $_SESSION['state'];
    $zip = $_SESSION['zip'];
    $city = $_SESSION['city'];

    $sender = 'Gardenia Malaysia';
    $recipient = $email;

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia');
    $sql = "SELECT * FROM user WHERE UserID = '$userID'";
    $result = mysqli_query($conn, $sql);
    $userDetails = mysqli_fetch_assoc($result);
    $mobile = $userDetails['Mobile'];

    $sql = "SELECT * FROM transaction WHERE OrderID = '$orderID'";
    $result = mysqli_query($conn, $sql);
    $transaction = mysqli_fetch_assoc($result);

    $transactionID = str_pad($transaction['TransactionID'], 4, 0, STR_PAD_LEFT);
    $order = str_pad($orderID, 4, 0, STR_PAD_LEFT);
    
    $subject = 'Invoice #' . $transactionID;
    $headers = 'From:' . $sender . "\r\n";
    $headers .= "Content-type: text/html";

$message = "
<!DOCTYPE html>
<html>
    <head> 
        <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <style>
            * {
                font-family: 'Arial', 'Sans-Serif';
            }

            table {border-collapse:separate;}
            a, a:link, a:visited {text-decoration: none; color: #00788a;}
            a:hover {text-decoration: underline;}
            h2,h2 a,h2 a:visited,h3,h3 a,h3 a:visited,h4,h5,h6,.t_cht {color:#000 !important;}
            .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {line-height: 100%;}
            .ExternalClass {width: 100%;}

            html {
                padding: 20px 50px;
                background-image: url('https://venngage-wordpress.s3.amazonaws.com/uploads/2018/09/Colorful-Geometric-Simple-Background-Image.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-blend-mode: lighten;
            }


            body {
                margin: 0 auto;
                border-radius: 5px;
                background-color: #fff;
                max-width: 900px;
            }

            body hr {
                border: 1px solid #000;
                width: 95%;
            }


            #header-container {
                margin: 15px auto;
                text-align: center;
                width: 100%;
            }

            #header-container img {
                margin: 15px 0;
            }

            #header-container a {
                text-decoration: none;
                color: #000;
                font-weight: bold;
                font-size: large;
            }

            #header-container a:hover {
                text-decoration: underline;
                color: #CE0101;
            }

            #header-container .vl {
                display: inline-block;
                border-left: 3px solid #000;
                height: 15px;
                margin: auto 25px auto 30px;
            }


            #main-container {
                padding: 0 50px;
                width: 100%;
            }

            #main-container #invoice {
                border: 1px solid lightgray;
                width: 100%;
                border-collapse: collapse;
            }

            #main-container #invoice table {
                width: 100%;
                border-collapse: collapse;
            }

            #main-container #invoice td {
                padding: 5px;
            }

            #main-container #invoice .width-50 {
                width: 50%;
            }

            #main-container #invoice .width-20 {
                width: 20%;
            }

            #main-container #invoice #address p {
                margin: 0;
            }

            #main-container #invoice .order, #main-container #invoice .total {
                background-color: lightgray;
                font-weight: bold;
            }

            #main-container #invoice .total, #main-container #invoice .payment {
                text-align: right;
            }

            #footer-container {
                padding: 15px 50px;
            }

            #footer-container #icon a {
                color: #000;
            }

            #footer-container #icon img {
                margin-right: 20px;
            }

            #footer-container #notice {
                margin: 20px 0;
            }

            #footer-container #notice p {
                font-size: small;
            }

            @media screen and (-webkit-min-device-pixel-ratio:0) {
                @media only screen and (max-width: 600px) {
                    html {
                    padding: 20px 0;
                    }

                    #header-container a {
                        font-size: small;
                    }
                  }
            }
        </style> 
    </head>
    <body>
		<table id='header-container'>
        	<tr>
              	<td><img width='250px' src='http://aiyoyo.ddns.net/project/src/logo.png' alt='failed'/></td>
          	</tr>
          	<tr>
              	<td>
                    <a href='http://aiyoyo.ddns.net/project/index.php' >HOME PAGE</a><span class='vl'></span>
                    <a href='http://aiyoyo.ddns.net/project/aboutus.php' >ABOUT US</a><span class='vl'></span>
                    <a href='http://aiyoyo.ddns.net/project/products.php' >PRODUCTS</a>
              	</td>
          	</tr>
     	</table>
        <hr>
        <table id='main-container'>
            <tr>
                <td><h3>Your order #$order has been processed.</h3></td>
            </tr>
            <tr>
                <td>
                    <table id='invoice'>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td class='width-50'><img width='150px' src='http://aiyoyo.ddns.net/project/src/gardenia.png' alt='failed'></td>
                                        <td class='width-20'>
                                            <p>INVOICE NO:</p>
                                            <p>Issue Date:</p>
                                            <p>Order Date:</p>
                                        </td>
                                        <td style='text-align: right'>
                                            <p>#$transactionID</p>
                                            <p>$currentDate</p>
                                            <p>$transaction[TransactionDate]</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><h3 style='text-align: center'>INVOICE</h3></td>
                        </tr>
                        <tr>
                            <td>
                                <table id='address'>
                                    <tr style='margin: 0'>
                                        <td class='width-50'>
                                            <h4>Billing address</h4>
                                            <p>$name</p>
                                            <p>$address,</p>
                                            <p>$zip $city,</p>
                                            <p>$state</p>
                                            <p>$mobile</p>
                                            <p>$email</p>
                                        </td>
                                        <td class='width-50'>
                                            <h4>Delivery from</h4>
                                            <p>Gardenia Malaysia</p>
                                            <p>Lot 3, Jalan Pelabur 23/1,</p>
                                            <p>40300 Shah Alam,</p>
                                            <p>Selangor</p>
                                            <p>03-55423228</p>
                                            <p>customer_service@gardenia.com.my</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td class='width-50'></td>
                                        <td>Date & Time: $transaction[TransactionDate]</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style='text-align: center'>
                                    <tr class='order'>
                                        <td>Item</td>
                                        <td>Price</td>
                                        <td style='width: 1%'>Quantity</td>
                                        <td style='text-align: right'>Subtotal</td>
                                    </tr>";?>
                                    <?php 

                                    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_order');
                                    $sql = "SELECT * FROM order_$orderID";
                                    $result = mysqli_query($conn, $sql);

                                    $total = 0;
                                    while ($row = mysqli_fetch_row($result)) {
                                        $price = number_format($row[2], 2, '.', '');
                                        $subtotal = $row[3] * $price;
                                        $subtotal = number_format($subtotal, 2, '.');
                                        $total += $subtotal;
                                        $message .= "
                                        <tr>
                                            <td>$row[1]</td>
                                            <td>RM $price</td>
                                            <td>$row[3]</td>
                                            <td style='text-align: right'>RM $subtotal</td>
                                        </tr>";
                                    }
                                    $total = number_format($total, 2, '.');

                                    $message .= "
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr class='total'>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>RM $total</td>
                                    </tr>
                                    <tr class='payment'>
                                        <td></td>
                                        <td></td>
                                        <td>Received</td>";
                                        $transaction = mysqli_fetch_assoc($result);
                                        if ($transaction['PaymentMethod'] == 'CC') {
                                            $message .= "<td>RM $total</td>";
                                        } else {
                                            $message .= "<td>RM 0.00</td>";
                                        }
                                    $message .= "
                                    </tr>
                                    <tr class='payment'>
                                        <td></td>
                                        <td></td>
                                        <td>Overpaid</td>
                                        <td>RM 0.00</td>
                                    </tr>
                                    <tr class='payment'>
                                        <td></td>
                                        <td></td>
                                        <td>Amount due</td>";
                                        if ($transaction['PaymentMethod'] == 'CC') {
                                            $message .= "<td>RM 0.00</td>";
                                        } else {
                                            $message .= "<td>RM $total</td>";
                                        }
                                    $message .= "
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Yours sincerely,</p>
                    <p>Gardenia Malaysia.</p>
                </td>
            </tr>
        </table>        
        <hr>              
        <table id='footer-container'>
            <tr id='icon'>
                <td>
                    <a href='https://www.facebook.com/GardeniaKL' title='Facebook' target=_blank><img width='25px' src='http://aiyoyo.ddns.net/project/src/facebook-square.png'/></a>
                    <a href='https://www.instagram.com/gardenia_kl/' title='Instagram' target=_blank><img width='25px' src='http://aiyoyo.ddns.net/project/src/instagram-square.png'/></a>
                    <a href='https://twitter.com/gardenia_kl' title='Twitter' target=_blank><img width='25px' src='http://aiyoyo.ddns.net/project/src/twitter-square.png'/></a>
                    <a href='https://www.youtube.com/user/GardeniaKL' title='Youtube' target=_blank><img width='25px' src='http://aiyoyo.ddns.net/project/src/youtube-square.png'/></a>
                </td>
            </tr>
            <tr id='notice'>
                <td>
                    <p>Lot 3, Jalan Pelabur 23/1, 40300 Shah Alam, Selangor Darul Ehsan Malaysia</p>
                    <small>This is an automatically generated email from our subscription list. Please do not reply to this email.</small>
                    <small>If you have any enquires, Please email to customer_service@gardenia.com.my or call 03-55423228.</small>
                </td>
            </tr>
        </table>
    </body>
</html>
";

if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}
?>