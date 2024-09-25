<?php
// Income Statement Report
session_start();
require('fpdf186/fpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');

$pdf = new PDF();

$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Balaoan, La Union', '', 1, 'C', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Detailed Balance Sheet', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Period Ended December 31, 2023', '', 1, 'C', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Income', '', 1, 'L', false);

$pdf->Cell(20, 6, '', '', 1, 'L', false);
$pdf->Cell(0, 6, 'Total Income', '', 1, 'L', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Less:Expenses', '', 1, 'L', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Total Personnel Services', '', 1, 'L', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Total Maintenance and Other Operating Expense', '', 1, 'L', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Total Financial Expense', '', 1, 'L', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Total Expenses', '', 1, 'L', false);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Net Income', '', 1, 'L', false);

$pdf->Output()
?>