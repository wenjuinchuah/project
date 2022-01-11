<?php
    require '../pdf/fpdf.php';
    include '../validation/connectSQL.php';
    date_default_timezone_set("Asia/Kuala_Lumpur"); //set time zone

    session_start();
    $category = $_SESSION['category'];

    class PDF extends FPDF {
        // Page header
        function Header() {
            // Logo
            $this->Image('../src/gardenia.png', 10, 10, 50);
            // Arial bold 15
            $this->SetFont('Arial', 'B', 15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(115, 15, 'Transaction Summary', 0, 0, 'C');
            // Line break
            $this->Ln(20);
        }

        // Page footer
        function Footer() {
            $currentdatetime = date("Y/m/d H:i:s");
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Generated on '. $currentdatetime, 0, 0, 'L');
            $this->Cell(0, 10, 'Page '. $this->PageNo(), 0, 0, 'R');
        }
    }

    //Main Content
    $sql = "SELECT * FROM transaction";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        //create a pdf
        $pdf = new PDF('L');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 11);
        if ($category == 'daily') {
            //daily
            $currentdate = date("Y/m/d");

            $pdf->Cell(0, 10, 'Daily Record for ' . $currentdate, 0, 1, 'R');
            $pdf->SetTitle('Transaction Record ' . $currentdate);
        } else if ($category == 'weekly') {
            //weekly
            $FirstDay = date("Y/m/d", strtotime('sunday last week'));  
            $LastDay = date("Y/m/d", strtotime('sunday this week'));

            $pdf->Cell(0, 10, 'Weekly Record From ' . $FirstDay . ' - ' . $LastDay, 0, 1, 'R');
            $pdf->SetTitle('Transaction Record ' . $FirstDay . ' - ' . $LastDay);
        } else if ($category == 'monthly') {
            //monthly
            $currentdate = date("F Y");

            $pdf->Cell(0, 10, 'Monthly Record for ' . $currentdate, 0, 1, 'R');
            $pdf->SetTitle('Transaction Record ' . $currentdate);
        } else {
            //all time
            $pdf->Cell(0, 10, 'All Record', 0, 1, 'R');
            $pdf->SetTitle('All Transaction Record');
        }

        $pdf->Cell(50, 10, 'Transaction ID', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Order ID', 1, 0, 'C');
        $pdf->Cell(80, 10, 'Transaction Timestamp', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Payment Method', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Total (RM)', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 11);
        if ($category == 'daily') {
            //daily
            while ($transaction = mysqli_fetch_assoc($result)) {
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
                if($transactiondate == $currentdate) {
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
                    $pdf->Cell(50, 10, $transactionID, 1, 0, 'C');
                    $pdf->Cell(50, 10, $transaction['OrderID'], 1, 0, 'C');
                    $pdf->Cell(80, 10, $transaction['TransactionDate'], 1, 0, 'C');
                    $pdf->Cell(50, 10, $paymentMethod, 1, 0, 'C');
                    $pdf->Cell(50, 10, $total, 1, 1, 'C');
                }
            }
        } else if ($category == 'weekly') {
            //weekly
            while ($transaction = mysqli_fetch_assoc($result)) {
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
                if($transactiondate > $FirstDay && $transactiondate <= $LastDay) {
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
                    $pdf->Cell(50, 10, $transactionID, 1, 0, 'C');
                    $pdf->Cell(50, 10, $transaction['OrderID'], 1, 0, 'C');
                    $pdf->Cell(80, 10, $transaction['TransactionDate'], 1, 0, 'C');
                    $pdf->Cell(50, 10, $paymentMethod, 1, 0, 'C');
                    $pdf->Cell(50, 10, $total, 1, 1, 'C');
                }
            }
        } else if ($category == 'monthly') {
            //monthly
            while ($transaction = mysqli_fetch_assoc($result)) {
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
                if($transactiondate == $currentdate) {
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
                    $pdf->Cell(50, 10, $transactionID, 1, 0, 'C');
                    $pdf->Cell(50, 10, $transaction['OrderID'], 1, 0, 'C');
                    $pdf->Cell(80, 10, $transaction['TransactionDate'], 1, 0, 'C');
                    $pdf->Cell(50, 10, $paymentMethod, 1, 0, 'C');
                    $pdf->Cell(50, 10, $total, 1, 1, 'C');
                }
            }
        } else {
            //all time
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
                
                $total = number_format($transaction['Total'], 2, '.', '');
                $transactionID = str_pad($transaction['TransactionID'], 4, 0, STR_PAD_LEFT);
                if ($transaction['PaymentMethod'] == 'COD') {
                    $paymentMethod = 'Cash On Delivery';
                } else {
                    $paymentMethod = 'Credit Card';
                }
                $pdf->Cell(50, 10, $transactionID, 1, 0, 'C');
                $pdf->Cell(50, 10, $transaction['OrderID'], 1, 0, 'C');
                $pdf->Cell(80, 10, $transaction['TransactionDate'], 1, 0, 'C');
                $pdf->Cell(50, 10, $paymentMethod, 1, 0, 'C');
                $pdf->Cell(50, 10, $total, 1, 1, 'C');
            }
        }

        $pdf->SetFont('Arial', 'B', 11);
        $grandTotal = $_SESSION['grandTotal'];
        $grandTotal = number_format($grandTotal, 2, '.', '');
        $count = $_SESSION['transactionCount'];

        $pdf->Cell(50, 10, '', 1, 0, 'C');
        $pdf->Cell(50, 10, '', 1, 0, 'C');
        $pdf->Cell(80, 10, '', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Grand Total', 1, 0, 'C');
        $pdf->Cell(50, 10, $grandTotal, 1, 1, 'C');

        $pdf->Cell(0, 10, 'Total Transaction Count: '.$count, 0, 1, 'L');

        $pdf->Output('I', 'transaction.pdf');
    } else {
        echo "Sorry, No Transaction Record is found!";
    }
?>