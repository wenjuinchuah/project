<?php
    require '../pdf/fpdf.php';
    include '../validation/connectSQL.php';

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
            $this->Cell(100, 15, 'Transaction Record', 0, 0, 'C');
            // Line break
            $this->Ln(20);
        }

        // Page footer
        function Footer() {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '. $this->PageNo(), 0, 0, 'C');
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
        $pdf->SetTitle('Transaction Record');
        $pdf->Cell(50, 10, 'Transaction ID', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Order ID', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Total (RM)', 1, 0, 'C');
        $pdf->Cell(80, 10, 'Transaction Timestamp', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Payment Method', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 11);
        while ($transaction = mysqli_fetch_assoc($result)) {
            $total = number_format($transaction['Total'], 2, '.', '');
            $transactionID = str_pad($transaction['TransactionID'], 4, 0, STR_PAD_LEFT);
            if ($transaction['PaymentMethod'] == 'COD') {
                $paymentMethod = 'Cash On Delivery';
            } else {
                $paymentMethod = 'Credit Card';
            }
            $pdf->Cell(50, 10, $transactionID, 1, 0, 'C');
            $pdf->Cell(50, 10, $transaction['OrderID'], 1, 0, 'C');
            $pdf->Cell(50, 10, $total, 1, 0, 'C');
            $pdf->Cell(80, 10, $transaction['TransactionDate'], 1, 0, 'C');
            $pdf->Cell(50, 10, $paymentMethod, 1, 1, 'C');
        }

        $pdf->Output('I', 'transaction.pdf');
    } else {
        echo "Sorry, No Transaction Record is found!";
    }
?>