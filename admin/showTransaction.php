<?php
include '../validation/connectSQL.php';
include '../validation/loginValidation.php';

$category = $_REQUEST['category']; //get category

date_default_timezone_set("Asia/Kuala_Lumpur"); //set time zone

//retrieve all the data first
$sql = "SELECT * FROM transaction ORDER BY TransactionID";
$result = mysqli_query($conn, $sql);

//the header for the table
echo "
        <table>
            <tr class='table-top'>
                <th>Transaction ID</th>
                <th>Order ID</th>
                <th>Total</th>
                <th>Transaction Timestamp</th>
                <th>Payment Method</th>
            </tr>";

if($category == 'daily'){
    if($conn){
        $currentdate = date("Y/m/d");
        echo  "<h3 style='text-align:center; font-weight:bold;'>Transaction Record for $currentdate</h3>";
        while($transaction = mysqli_fetch_assoc($result)){
            //create date from timestamp
            $transactiondate = date("Y/m/d", strtotime($transaction['TransactionDate']));

            //compare date
            if($transactiondate == $currentdate){
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
            }else{
                continue;
            }
        }
    }
}else if($category == 'weekly'){
    $FirstDay = date("Y/m/d", strtotime('sunday last week'));  
    $LastDay = date("Y/m/d", strtotime('sunday this week'));
    
    echo  "<h3 style='text-align:center; font-weight:bold;'>Transaction Record From $FirstDay to $LastDay</h3>";

    while($transaction = mysqli_fetch_assoc($result)){
        //create date from timestamp
        $transactiondate = date("Y/m/d", strtotime($transaction['TransactionDate']));

        //compare date
        if($transactiondate > $FirstDay && $transactiondate < $LastDay){
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
        }else{
            continue;
        }
    }

}else if($category == 'monthly'){
    if($conn){
        $currentdate = date("F Y");

        echo  "<h3 style='text-align:center; font-weight:bold;'>Transaction Record for $currentdate</h3>";
        while($transaction = mysqli_fetch_assoc($result)){
            //create date from timestamp
            $transactiondate = date("F Y", strtotime($transaction['TransactionDate']));

            //compare date
            if($transactiondate == $currentdate){
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
            }else{
                continue;
            }
        }
    }
}else if($category == 'all'){
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

}else{
    header('Location: dashboard.php');
}

echo "</table>";


?>