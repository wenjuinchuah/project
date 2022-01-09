<?php
    include '../validation/connectSQL.php';

    $sql = "SELECT * FROM order_details WHERE orderID = 'order_$orderID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $orderDetails = mysqli_fetch_assoc($result);
    }

    $orderID = str_pad($orderID, 4, 0, STR_PAD_LEFT);
    if ($orderDetails['PaymentMethod'] == 'COD') {
        $paymentMethod = 'Cash On Delivery';
    } else {
        $paymentMethod = 'Credit Card';
    }

    $sender = 'Gardenia Malaysia';
    $recipient = $email;

    $subject = "Your Order From Gardenia Has Been Confirmed!";
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

            #main-container #order-table {
                border: 1px solid #000;
                width: 100%;
                border-collapse: collapse;
            }

            #main-container #order-table td {
                padding: 5px;
                width: 50%;
            }

            #main-container #order-table #status {
                background-color: lightgray;
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
                <td>
                    <table>
                        <tr>
                            <td><h2>Thank you for your order.</h2></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Hi $name,</p>
                                <p>Thank you for shopping with Gardenia Malaysia. We have received your Order <b>#$orderID</b>. We're excited for you to receive your order!
                                We hope you had a pleasant experience. Stay safe!</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><h3>Your order details follows:</h3></td>
            </tr>
            <tr>
                <td>
                    <table id='order-table'>
                        <tr>
                            <td>Order ID</td>
                            <td>#$orderID</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>$orderDetails[Address]</td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td>$paymentMethod</td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td>$orderDetails[PaymentDate]</td>
                        </tr>
                        <tr id='status'>
                            <td><b>Status</b></td>
                            <td><b>$orderDetails[Status]</b></td>
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