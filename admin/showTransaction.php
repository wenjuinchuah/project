<?php
include '../validation/connectSQL.php';
include '../validation/loginValidation.php';

$category = $_REQUEST['category']; //get category
$_SESSION['category'] = $category;

date_default_timezone_set("Asia/Kuala_Lumpur"); //set time zone

//retrieve all the data first
$sql = "SELECT * FROM transaction ORDER BY TransactionID";
$result = mysqli_query($conn, $sql);

$count = 0;

//the header for the table
echo "
        <table>
            <tr class='table-top'>
                <th>Transaction ID</th>
                <th>Order ID</th>
                <th>Transaction Timestamp</th>
                <th>Payment Method</th>
                <th>Total</th>
            </tr>";

if($category == 'daily'){
    if($conn){
        $grandTotal = 0;
        $currentdate = date("Y/m/d");
        echo  "<h3 style='text-align:center; font-weight:bold;'>Transaction Record for $currentdate</h3>";
        while($transaction = mysqli_fetch_assoc($result)){
            //create date from timestamp
            $transactiondate = date("Y/m/d", strtotime($transaction['TransactionDate']));

            //look for any cancelled order
            $sql = "SELECT * FROM order_details WHERE orderID = 'order_$transaction[OrderID]'";
                        
            if ($orderResult = mysqli_query($conn, $sql)) {
                if ($order = mysqli_fetch_assoc($orderResult)) {
                    if ($order['Status'] == 'Cancelled') {
                        continue; //continue next searching if found cancelled order
                    }
                }
            }

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
                    <td> $transaction[TransactionDate]</td>
                    <td>$paymentMethod</td>
                    <td>RM $total</td>
                </tr>";
                $grandTotal += $total;
                $count += 1;
            }else{
                continue;
            }
        }
        $_SESSION['grandTotal'] = $grandTotal;
    }
}else if($category == 'weekly'){
    $grandTotal = 0;
    $FirstDay = date("Y/m/d", strtotime('sunday last week'));  
    $LastDay = date("Y/m/d", strtotime('sunday this week'));

    echo  "<h3 style='text-align:center; font-weight:bold;'>Transaction Record From $FirstDay to $LastDay</h3>";

    while($transaction = mysqli_fetch_assoc($result)){
        //create date from timestamp
        $transactiondate = date("Y/m/d", strtotime($transaction['TransactionDate']));

        //look for any cancelled order
        $sql = "SELECT * FROM order_details WHERE orderID = 'order_$transaction[OrderID]'";
                        
        if ($orderResult = mysqli_query($conn, $sql)) {
            if ($order = mysqli_fetch_assoc($orderResult)) {
                if ($order['Status'] == 'Cancelled') {
                    continue; //continue next searching if found cancelled order
                }
            }
        }

        //compare date
        if($transactiondate > $FirstDay && $transactiondate <= $LastDay){
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
                <td> $transaction[TransactionDate]</td>
                <td>$paymentMethod</td>
                <td>RM $total</td>
            </tr>";
            $grandTotal += $total;
            $count += 1;
        }else{
            continue;
        }
        $_SESSION['grandTotal'] = $grandTotal;
    }

}else if($category == 'monthly'){
    if($conn){
        $grandTotal = 0;
        $currentdate = date("F Y");

        echo  "<h3 style='text-align:center; font-weight:bold;'>Transaction Record for $currentdate</h3>";
        while($transaction = mysqli_fetch_assoc($result)){
            //create date from timestamp
            $transactiondate = date("F Y", strtotime($transaction['TransactionDate']));
            
            //look for any cancelled order
            $sql = "SELECT * FROM order_details WHERE orderID = 'order_$transaction[OrderID]'";
                        
            if ($orderResult = mysqli_query($conn, $sql)) {
                if ($order = mysqli_fetch_assoc($orderResult)) {
                    if ($order['Status'] == 'Cancelled') {
                        continue; //continue next searching if found cancelled order
                    }
                }
            }

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
                    <td> $transaction[TransactionDate]</td>
                    <td>$paymentMethod</td>
                    <td>RM $total</td>
                </tr>";
                $grandTotal += $total;
                $count += 1;
            }else{
                continue;
            }
            $_SESSION['grandTotal'] = $grandTotal;
        }
    }
}else if ($category == 'all') {
    $grandTotal = 0;
    echo  "<h3 style='text-align:center; font-weight:bold;'>All Time Transaction Record</h3>";
    
    while ($transaction = mysqli_fetch_assoc($result)) { 
        //look for any cancelled order
        $sql = "SELECT * FROM order_details WHERE orderID = 'order_$transaction[OrderID]'";
                        
        if ($orderResult = mysqli_query($conn, $sql)) {
            if ($order = mysqli_fetch_assoc($orderResult)) {
                if ($order['Status'] == 'Cancelled') {
                    continue; //continue next searching if found cancelled order
                }
            }
        }

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
            <td> $transaction[TransactionDate]</td>
            <td>$paymentMethod</td>
            <td>RM $total</td>
        </tr>";
        $grandTotal += $total;
        $count += 1;
    }
    $_SESSION['grandTotal'] = $grandTotal;

} else {
    header('Location: dashboard.php');
}

$grandTotal = $_SESSION['grandTotal'];
$grandTotal = number_format($grandTotal, 2, '.', '');
echo "<tr>
        <td></td>
        <td></td>
        <td></td>
        <td><b>Grand Total</b></td>
        <td><b>RM $grandTotal</b></td>
        </tr>
    </table>";
    $_SESSION['transactionCount'] = $count;
    echo "<p>Total Transaction Count: <b>$count</b></p>
    <div style='display:flex; justify-content: center; margin-top: 20px;'>
        <a class='openEdit' style='font-size: larger; font-weight: bold; text-decoration: none' target='_blank' href='generatePdf.php'>Generate Report</a>
    </div>";
?>