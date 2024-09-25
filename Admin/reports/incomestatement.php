<?php
// Income Statement Report
session_start();
require('fpdf186/fpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');
class PDF extends FPDF
{
    // Page footer
    function Footer()
    {
        // Implement footer if needed
    }
}
$pdf = new PDF();
$pdf->SetTitle('Income Statement');

$pdf->AliasNbPages();
$pdf->AddPage('P', 'Legal');

if (isset($_GET['date_to'])){

$getValue = $_GET['date_to'];
$date = DateTime::createFromFormat('Y-m-d', $getValue);
$valueDate = $date->format('F, d, Y');


} else {
    $valueDate = date('F, d, Y');
}
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Balaoan, La Union', '', 1, 'C', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Detailed Balance Sheet', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Period Ended:' . $valueDate, '', 1, 'C', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Income', '', 1, 'L', false);

// Expenses Titles
$income = 'Income';
$sqltitle = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_type = :a_title");
$sqltitle->bindParam(':a_title', $income);
$sqltitle->execute();
$datatitle = $sqltitle->fetchAll(PDO::FETCH_ASSOC);

foreach ($datatitle as $rowtitle){
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(25, 5, '', '', 0, 'l', false);
    $pdf->Cell(0, 5, $rowtitle['account_name'], '', 1, 'l', false); 
    
}

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(25, 6, '', '', 0, 'L', false);
$pdf->Cell(0, 6, 'Total Income', '', 1, 'L', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Less:Expenses', '', 1, 'L', false);


$value1 = 'Personnel Services';
$sql1 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
$sql1->bindParam(':acc_type', $value1);
$sql1->execute();
$data = $sql1->fetchAll(PDO::FETCH_ASSOC);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Personnel Services', '', 1, 'l', false);

foreach ($data as $row2) {
    $pdf->SetFont('Times', 'I', 12);
    $pdf->Cell(15, 10, '', '', 0, 'l', false);
    $pdf->Cell(0, 10, $row2['class_name'], '', 1, 'l', false);

    $sqltitle = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
    $sqltitle->bindParam(':class_id', $row2['class_id']);
    $sqltitle->execute();
    $datatitle = $sqltitle->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datatitle as $rowtitle){
        $pdf->SetFont('Times', '', 12);
        if ($rowtitle['account_type'] === "Contra-Asset"){
            $pdf->Cell(29, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle['account_name'], '', 1, 'l', false); 
        } else {
            $pdf->Cell(25, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle['account_name'], '', 1, 'l', false); 
        }
    }

    
} //End of Loop

    $pdf->Cell(10, 6, '', '', 0, 'L', false);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 6, 'Total Personnel Services', '', 1, 'L', false);

// SQL for Maintenance and Other Operating Expenses

$value2 = 'Maintenance and Other Operating Expenses';
$sql2 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
$sql2->bindParam(':acc_type', $value2);
$sql2->execute();
$data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

foreach ($data2 as $row3) {
    $pdf->SetFont('Times', 'I', 12);
    $pdf->Cell(15, 10, '', '', 0, 'l', false);
    $pdf->Cell(0, 10, $row3['class_name'], '', 1, 'l', false);

    $sqltitle2 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
    $sqltitle2->bindParam(':class_id', $row3['class_id']);
    $sqltitle2->execute();
    $datatitle2 = $sqltitle2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datatitle2 as $rowtitle2){
        $pdf->SetFont('Times', '', 12);
        if ($rowtitle['account_type'] === "Contra-Asset"){
            $pdf->Cell(29, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle2['account_name'], '', 1, 'l', false); 
        } else {
            $pdf->Cell(25, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 5, $rowtitle2['account_name'], '', 1, 'l', false); 
        }
    }
}

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Non Cash Expenses', '', 1, 'L', false);

$value3 = 'Non Cash Expense';
$sql3 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
$sql3->bindParam(':acc_type', $value3);
$sql3->execute();
$data3 = $sql3->fetchAll(PDO::FETCH_ASSOC);

foreach ($data3 as $row4) {
    $pdf->SetFont('Times', 'I', 12);
    $pdf->Cell(15, 10, '', '', 0, 'l', false);
    $pdf->Cell(0, 10, $row4['class_name'], '', 1, 'l', false);

    $sqltitle3 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
    $sqltitle3->bindParam(':class_id', $row4['class_id']);
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

$pdf->Cell(10, 6, '', '', 0, 'L', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Total Maintenance and Other Operating Expense', '', 1, 'L', false);

$pdf->Cell(10, 6, '', '', 0, 'L', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Financial Expense', '', 1, 'L', false);

// Equity Titles
$f_expense = 'Financial Expense';
$sqltitle4 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_type = :a_title");
$sqltitle4 ->bindParam(':a_title', $f_expense);
$sqltitle4->execute();
$datatitle4 = $sqltitle4->fetchAll(PDO::FETCH_ASSOC);

foreach ($datatitle4 as $rowtitle4){
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(25, 5, '', '', 0, 'l', false);
    $pdf->Cell(0, 5, $rowtitle4['account_name'], '', 1, 'l', false); 
    
}

$pdf->Cell(10, 6, '', '', 0, 'L', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Total Financial Expense', '', 1, 'L', false);




$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 10, 'Total Expenses', '', 1, 'L', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 10, 'Net Income', '', 1, 'L', false);

$pdf->Output()
?>