<?php
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

// Instantiation of inherited class
$pdf = new PDF();
$pdf->SetTitle('GENERAL LEDGER');

// Adding page and setting font
$pdf->AliasNbPages();
$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->Cell(0, 6, 'General Ledger', '', 1, 'C', false);
$pdf->Cell(0, 6, 'From August 1 2024 to August 30 2024', '', 1, 'C', false);

$pdf->Cell(0, 6, '', '', 1, 'L', false);
$pdf->Cell(50, 6, 'Transaction', '', 0, 'L', false);
$pdf->Cell(40, 6, 'Date', '', 0, 'L', false);
$pdf->Cell(45, 6, 'Posting Reference', '', 0, 'L', false);
$pdf->Cell(30, 6, 'DR', '', 0, 'L', false);
$pdf->Cell(30, 6, 'CR', '', 1, 'L', false); // Added a new line here

$sql1 = $conn->prepare("SELECT * FROM tbl_general_ledger INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id");
$sql1->execute();
$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);

foreach ($result1 as $row1) {
    $pdf->SetFont('Arial', '', 11);

    // Save the current Y position
    $yBefore = $pdf->GetY();
    
    // MultiCell for description (50 width)
    $pdf->MultiCell(50, 6, $row1['description'], 0, 'L', false);
    
    // Calculate the height of the MultiCell
    $yAfter = $pdf->GetY();
    $cellHeight = $yAfter - $yBefore;
    
    // Set X and Y back for the remaining cells in the row
    $pdf->SetXY(60, $yBefore);
    
    // Now place the other cells at the same Y position as the first one
    $pdf->Cell(40, $cellHeight, $row1['ledger_date'], 0, 0, 'L', false);
    $pdf->Cell(45, $cellHeight, $row1['journal_voucher_no'], 0, 0, 'L', false);

    if ($row1['debit'] > 0) {
        $pdf->Cell(30, $cellHeight, number_format($row1['debit'], 2), 0, 0, 'L', false);
        $pdf->Cell(30, $cellHeight, '', 0, 1, 'L', false);
    } else {
        $pdf->Cell(30, $cellHeight, '', 0, 0, 'L', false);
        $pdf->Cell(30, $cellHeight, number_format($row1['credit'], 2), 0, 1, 'L', false);
    }
}

$pdf->Output();
?>
