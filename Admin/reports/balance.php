<?php
// Balance Sheet Report
session_start();
require('fpdf186/fpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');

$pdf = new FPDF();
$pdf->SetTitle('Balance Sheet');

$pdf->AliasNbPages();
$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Times', 'B', 12);

$datetoday = date('Y/m/d');

$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Balaoan, La Union', '', 1, 'C', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Detailed Balance Sheet', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'December 31, 2023', '', 1, 'C', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 10, 'ASSETS', '', 0, 'l', false);
$pdf->Cell(100, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Balance Amount', '', 1, 'l', false);

$value1 = 'Current Assets';
$sql1 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
$sql1->bindParam(':acc_type', $value1);
$sql1->execute();
$data = $sql1->fetchAll(PDO::FETCH_ASSOC); 
$sql2 = $conn->prepare("SELECT * FROM tbl_account_class");
$sql2->execute();
$data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);


$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Current Asset', '', 1, 'l', false);
// $pdf->Cell(0, 10, $data['account_type'], '', 1, 'l', false);

foreach ($data as $row2) {
    $pdf->SetFont('Times', 'I', 12);
    $pdf->Cell(15, 10, '', '', 0, 'l', false);
    $pdf->Cell(0, 10, $row2['class_name'], '', 1, 'l', false);
    // Account Titles
    $sqltitle = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
    $sqltitle->bindParam(':class_id', $row2['class_id']);
    $sqltitle->execute();
    $datatitle = $sqltitle->fetchAll(PDO::FETCH_ASSOC);

    
    foreach ($datatitle as $rowtitle){
        $pdf->SetFont('Times', '', 12);
        if ($rowtitle['account_type'] === "Contra-Asset"){
            $pdf->Cell(29, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle['account_name'], '', 1, 'l', false); 

    //         $fiscal_id = $_SESSION['fiscal_id'];
    //         $account_code = $rowtitle;
    // $sqlbalance = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
    // SUM(CASE 
    //         WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
    //         WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
    //         ELSE 0 
    //     END) AS debit_balance, 
    // SUM(CASE 
    //         WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
    //         WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
    //         ELSE 0 
    //     END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code WHERE fiscal_id = :fiscal_id AND account_code = :account_code GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
    //     $sqlbalance->bindParam(':fiscal_id', $fiscal_id);
    //     $sqlbalance->bindParam(':account_code', $account_code);
    //     $sqlbalance->execute();
    //     $databalance = $sqlbalance->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $pdf->Cell(25, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle['account_name'], '', 1, 'l', false); 
        }
        
    }
    
}

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Total Current Assets', '', 1, 'l', false);

$pdf->Cell(5, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 20, 'Non-Current Assets', '', 1, 'l', false);

$value2 = 'Non-Current Assets';
$sql3 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type2");
$sql3->bindParam(':acc_type2', $value2);
$sql3->execute();
$data3 = $sql3->fetchAll(PDO::FETCH_ASSOC); 
foreach ($data3 as $row3) {
    $pdf->SetFont('Times', 'I', 12);
    $pdf->Cell(15, 10, '', '', 0, 'l', false);
    $pdf->Cell(0, 10, $row3['class_name'], '', 1, 'l', false);

    // Account Titles
    $sqltitle2 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id2");
    $sqltitle2->bindParam(':class_id2', $row3['class_id']);
    $sqltitle2->execute();
    $datatitle2 = $sqltitle2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datatitle2 as $rowtitle2){
        $pdf->SetFont('Times', '', 12);
        if ($rowtitle2['account_type'] === "Contra-Asset"){
            $pdf->Cell(29, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle2['account_name'], '', 1, 'l', false); 
        } else {
            $pdf->Cell(25, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle2['account_name'], '', 1, 'l', false); 
        }
        
    }
}

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(30, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 20, 'Total Property, Plant and Equipment', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 20, 'Total Non-Current Assets', '', 1, 'l', false);


$pdf->Cell(0, 20, 'TOTAL ASSETS', '', 1, 'l', false);

$pdf->Cell(0, 10, 'LIABILITIES AND EQUITY', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Liabilities', '', 1, 'l', false);

$value3 = 'Liabilities';
$sql4 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type3");
$sql4->bindParam(':acc_type3', $value3);
$sql4->execute();
$data4 = $sql4->fetchAll(PDO::FETCH_ASSOC); 
foreach ($data4 as $row4) {
    $pdf->SetFont('Times', 'I', 12);
    $pdf->Cell(15, 10, '', '', 0, 'l', false);
    $pdf->Cell(0, 10, $row4['class_name'], '', 1, 'l', false);

    // Account Titles
    $sqltitle3 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id2");
    $sqltitle3->bindParam(':class_id2', $row4['class_id']);
    $sqltitle3->execute();
    $datatitle3 = $sqltitle3->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datatitle3 as $rowtitle3){
        $pdf->SetFont('Times', '', 12);
        if ($rowtitle3['account_type'] === "Contra-Asset"){
            $pdf->Cell(29, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle3['account_name'], '', 1, 'l', false); 
        } else {
            $pdf->Cell(25, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle3['account_name'], '', 1, 'l', false); 
        }
        
    }
}

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(30, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 20, 'Total', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Total Liabilities', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Equity', '', 1, 'l', false);

// Equity Titles
$equity = 'Equity';
$sqltitle3 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_type = :a_title");
$sqltitle3->bindParam(':a_title', $equity);
$sqltitle3->execute();
$datatitle3 = $sqltitle3->fetchAll(PDO::FETCH_ASSOC);

foreach ($datatitle3 as $rowtitle3){
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(25, 5, '', '', 0, 'l', false);
    $pdf->Cell(0, 5, $rowtitle3['account_name'], '', 1, 'l', false); 
    
}
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Total Equity', '', 1, 'l', false);


$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'TOTAL LIABILITIES AND EQUITY', '', 1, 'l', false);

$pdf->Output();

?>