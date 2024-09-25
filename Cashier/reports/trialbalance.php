<?php
// Trial Balance Report
session_start();
require(__DIR__ . '/fpdf186/fpdf.php');
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

$pdf->AliasNbPages();
$pdf->AddPage('P', 'Letter');
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'L', false);
$pdf->Cell(0, 6, 'Trial Balance', '', 1, 'L', false);
$pdf->Cell(0, 6, 'As of December 31 2023', '', 1, 'L', false);

$pdf->Cell(0, 6, '', '', 1, 'L', false);
$pdf->Cell(125, 6, '', '', 0, 'L', false);
$pdf->Cell(40, 6, 'DR', '', 0, 'L', false);
$pdf->Cell(40, 6, 'CR', '', 0, 'L', false);
$pdf->Cell(0, 6, '', '', 1, 'L', false);

$sql2 = $conn->prepare ("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
    SUM(CASE 
            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
            ELSE 0 
        END) AS debit_balance, 
    SUM(CASE 
            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
            ELSE 0 
        END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");

$sql2->execute();
$data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

$total_debit = 0;
$total_credit = 0;
$pdf->SetFont('Arial', '', 12);
foreach($data2 as $row2){
    $pdf->Cell(125, 7, $row2['account_name'], '', 0, 'L', false);
    if ($row2['debit_balance']> $row2['credit_balance']){
        $pdf->Cell(40, 7, $row2['debit_balance'], '', 1, 'L', false);
        $total_debit += $row2['debit_balance'];
    } else {
        $pdf->Cell(40, 7, '', '', 0, 'L', false);
        $pdf->Cell(40, 7, $row2['credit_balance'], '', 1, 'L', false);
        $total_credit += $row2['credit_balance'];
    }

}
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, '', '', 1, 'L', false);
$pdf->Cell(125, 6, 'Total', '', 0, 'L', false);
$pdf->Cell(40, 6, number_format("$total_debit",2), '', 0, 'L', false);
$pdf->Cell(40, 6, number_format("$total_credit",2), '', 1, 'L', false);

     
$pdf->Output();
?>