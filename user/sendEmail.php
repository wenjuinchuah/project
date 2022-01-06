<?PHP
include '../validation/connectSQL.php';

$userID = $_SESSION['userID'];
$orderID = $_SESSION['orderID'];
$paymentMethod = $_SESSION['paymentMethod'];

$sender = 'aiyoyoteam@gmail.com';
$recipient = $email;
//$recipient = '74487@siswa.unimas.my';

$subject = "Your Order From Gardenia Has Been Confirmed!";
$headers = 'From:' . $sender . "\r\n";
//$headers .= 'Cc: 75590@siswa.unimas.my' . "\r\n";
//$headers .= 'Cc: 75107@siswa.unimas.my' . "\r\n";
//$headers .= 'Cc: 75162@siswa.unimas.my' . "\r\n";
//$headers .= 'Cc: 74487@siswa.unimas.my' . "\r\n";
$headers .= "Content-type: text/html";

//apparently need to use table to position stuff
//$message = "hskfljsld";

$message = "
<html>
    <head> 
        <meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <style> 
            body{
                margin: 0;
            }

            a{
                text-decoration: none;         
            }

            a:hover{
                color: red;
            }

            table{
                width: 100%;
                border-collapse: collapse;               
            }

            .center{
                text-align: center;
            }

            .right{
                text-align: right;
            }

            th, td {
                text-align: left;
                border-collapse: collapse;
            }

            .greytd{
                background-color: #D5D8DC;
                border-bottom: 2px solid #808B96;
            }

            .greyth{
                background-color: #ABB2B9;
                border-bottom: 2px solid #808B96;
            }
            
            .navs{
                background-color: #0e084d;
                color: white;
                font-size: large;
                font-weight: bold;
                border-radius: 20px;
                padding:10px;
                margin:20px;
            }

            .rb_box{
                border-radius: 10px;
                padding-top: 50px;
                padding-left: 20px;
                padding-right: 20px;
                padding-bottom: 30px;
                box-shadow: 3px 3px 10px #17202A;
                background-image: url('https://venngage-wordpress.s3.amazonaws.com/uploads/2018/09/Colorful-Geometric-Simple-Background-Image.jpg');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .white_box{
                background-color: rgb(248, 249, 249, 0.85);
                border-radius: 10px;
                padding: 20px;
                margin-top:20px;
                margin-bottom:20px;
            }

            .white_text{
                color:white;
                text-shadow: 3px 3px 5px #17202A;
            }

        </style> 
    </head>

    <body mso-line-height-rule: exactly;>
    <div class='rb_box'>
        <table>
            <tr>
            <td colspan= 3 class='center' ><img src='https://seeklogo.com/images/G/gardenia-logo-AB56A38F6F-seeklogo.com.png' alt='failed'/></td>
            </tr>

            <tr>
            <td class='center navs' >
                <a href='http://aiyoyo.ddns.net/project/index.php' >Home Page</a> 
            </td>
            <td class='center navs'>
                <a href='http://aiyoyo.ddns.net/project/aboutus.php' >About Us</a> 
            </td>
            <td class='center navs'>
                <a href='http://aiyoyo.ddns.net/project/products.php' >Products</a>
            </td>
            </tr>
            
        </table>

        <div class='white_box'>
        <table>
            <tr>
            <td colspan= 3>
                <br>
                <h4>Dear $name,</h4>
                <p>Thank you for shopping with Gardenia Malaysia.</p>
                <p>We have received your Order <b>$orderID</b>. We're excited for you to receive your order!</p>
                <p>We hope you had a pleasant experience. Stay safe!</p><br>
                <p>Yours sincerely,</p>
                <p>Gardenia Malaysia.</p>
            </td>
            </tr>
        </table>
        </div>
        <div class='white_box'>

            <table>
                <tr>
                    <td class='center'><h2>Order Detail</h2></td>
                </tr>
            </table>

            <table class='table_border'>
                <tr >
                    <th style='width: 30%;' class='greyth right'>Order ID: </th>
                    <td class='greytd'>$orderID</th>
                </tr>
                
                <tr>
                    <th style='width: 30%;' class='greyth right'>Name: </th>
                    <td class='greytd'>$name</th>
                </tr>

                <tr>
                    <th style='width: 30%;' class='greyth right'>Email: </th>
                    <td class='greytd'>$email</th>
                </tr>

                <tr>
                    <th style='width: 30%;' class='greyth right'>Address: </th>
                    <td class='greytd'>$address</td>
                </tr>

                <tr>
                    <th style='width: 30%;' class='greyth right'>Payment Method: </th>
                    <td class='greytd'>$paymentMethod</td>
                </tr>
            </table>

            <br>

            <table>
                <tr>
                    <td class='center'><h2>Receipt</h2></td>
                </tr>
            </table>

            <table class='table_border'>
                <tr>
                    <th class='greyth'> Product ID</th>
                    <th class='greyth'> Product Name</th>
                    <th class='greyth'> Price Per Item</th>
                    <th class='greyth'> Quantity</th>
                    <th class='greyth'> Subtotal</th>
                </tr>
                ";
        
            $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
            $sql = "SELECT * FROM user_$userID ORDER BY ProductID";
            $result = mysqli_query($conn, $sql);
            
            $total = 0;
            $index = 1;

            while($row = mysqli_fetch_row($result)){

                $price = number_format($row[2], 2, '.', '');
                $subtotal = $row[3] * $price;
                $subtotal = number_format($subtotal, 2, '.');
                $message.="
                <tr>
                    <td class='greytd'> $row[0]</td>
                    <td class='greytd'> $row[1]</td>
                    <td class='greytd'> RM $price</td>
                    <td class='greytd'> $row[3]</td>
                    <td class='greytd'> RM $subtotal</td>
                </tr>";
                $total += $subtotal;
                $index++;
            }

            $total = number_format($total, 2, '.');
            $message.="
                <tr class='greyth'>
                    <td colspan=3 > </td>
                    <th class='right'>TOTAL </th>
                    <td class='greytd'>RM $total</td>
                </tr><br>";

            $message.="
                    </table>
        </div>
        <footer>
        <div class='white_box'>
            <table>
                <tr>
                    <td class='center'>
                        <h2><b>Contact Us</b></h2>
                        <i class='fa fa-map-marker'></i>  
                        <p>Lot 3, Jalan Pelabur 23/1, 40300 Shah Alam, Selangor Darul Ehsan Malaysia</p>
                        <i class='fa fa-envelope'></i>
                        <p>customer_service@gardenia.com.my</p>
                        <i class='fa fa-phone'></i>
                        <p>03-55423228</p>
                    </td>
                </tr>
            </table>
        </div>

            <table>
                <tr>
                    <br><td class='center'><strong>This is an automatically generated email from our subscription list. Please do not reply to this email.</strong></td>
                </tr>
            </table>
        
        </footer>
        </div>
    </body>
</html>";


if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}
?>