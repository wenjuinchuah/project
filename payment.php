<?php
    if (isset($_POST['submit'])) {
        $paymentMethod = $_POST['paymentMethod'];
        
        if (isset($paymentMethod)) {
            if ($paymentMethod == 2) {
                include 'validation/validatePayment.php';
            }
            include 'addOrder.php';
            //$orderSuccessView = 'block';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        h2 {
            text-align: center;
            background-color: #000;
            color: #fff;
            padding: 10px 0;
        }

        .paymentMethod {
            width: max-content;
            margin: 0 auto;
        }

        .paymentMethod #submitButton {
            margin: 10px 0;
            padding: 5px;
            text-align: center;
        }

    </style>
</head>
<body>
    <div>
        <h2>Please select your prefer payment method</h2>
    </div>
    <div class="paymentMethod">
        <form action="" method="POST">
            <div>
                <input type="radio" name="paymentMethod" id="cashOnDelivery" checked="true" value="1"></input>
                <label for="cashOnDelivery">Cash On Delivery</label>
            </div>
            <div>
                <input type="radio" name="paymentMethod" id="creditCard" value="2"></input>
                <label for="creditCard">Credit Card</label>
            </div>
            <div id="submitButton">
                <input type="submit" id="submit" name="submit" value="Continue"></input>
            </div>
        </form>
    </div>
</body>
</html>