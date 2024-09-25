<?php
// Balance Sheet Report
session_start();
require('fpdf186/fpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');

$pdf = new FPDF();

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
$pdf->Cell(0, 10, 'ASSETS', '', 1, 'l', false);

$value1 = 'Current Assets';
$sql1 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
$sql1->bindParam(':acc_type', $value1);
$sql1->execute();
$data = $sql1->fetch(PDO::FETCH_ASSOC);
$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, $data['account_type'], '', 1, 'l', false); 




$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Total Current Assets', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 20, 'Non-Current Assets', '', 1, 'l', false);

$pdf->Cell(30, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 20, 'Total Property, Plant and Equipment', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 20, 'Total Non-Current Assets', '', 1, 'l', false);


$pdf->Cell(0, 20, 'TOTAL ASSETS', '', 1, 'l', false);

$pdf->Cell(0, 10, 'LIABILITIES AND EQUITY', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Liabilities', '', 1, 'l', false);

$pdf->Cell(30, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 20, 'Total', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Total Liabilities', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Equity', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'Total Equity', '', 1, 'l', false);

$pdf->Cell(10, 10, '', '', 0, 'l', false);
$pdf->Cell(0, 10, 'TOTAL LIABILITIES AND EQUITY', '', 1, 'l', false);

$pdf->Output();

?>