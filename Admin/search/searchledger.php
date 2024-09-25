<?php
session_start();
require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $fiscal_id = $_SESSION['fiscal_id'];
    $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id WHERE account_name LIKE '%$search%' AND tbl_general_ledger.fiscal_id = :fiscal_id ORDER BY ledger_date DESC");
    $stmt->bindParam(':fiscal_id', $fiscal_id);
} else if (isset($_POST['fromFilter'])){
    $filter = $_POST['fromFilter'];
    $fiscal_id = $_SESSION['fiscal_id'];
    $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id WHERE account_name = :filters AND tbl_general_ledger.fiscal_id = :fiscal_id ORDER BY ledger_date DESC");
    $stmt->bindParam(":filters", $filter);
    $stmt->bindParam(":fiscal_id", $fiscal_id);
} else if (isset($_POST['fromDate3']) && isset($_POST['toDate3']) && !empty($_POST['fromDate3']) && !empty($_POST['toDate3'])){
    $fromDate = $_POST['fromDate3'];
    $toDate = $_POST['toDate3'];
    $fiscal_id = $_SESSION['fiscal_id'];
    $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id WHERE ledger_date BETWEEN :fromDate AND :toDate AND tbl_general_ledger.fiscal_id = :fiscal_id ORDER BY ledger_date DESC");
    $stmt->bindParam(":fromDate", $fromDate);
    $stmt->bindParam(":toDate", $toDate);
    $stmt->bindParam(":fiscal_id", $fiscal_id);
} else if (isset($_POST['fromDate3']) && isset($_POST['toDate3']) && !empty($_POST['fromDate3']) && !empty($_POST['toDate3']) && isset($_POST['fromFilter'])){
    $filter = $_POST['fromFilter'];
    $fromDate = $_POST['fromDate3'];
    $toDate = $_POST['toDate3'];
    $fiscal_id = $_SESSION['fiscal_id'];
    $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id WHERE ledger_date BETWEEN :fromDate AND :toDate AND account_name = :filters AND tbl_general_ledger.fiscal_id = :fiscal_id ORDER BY ledger_date DESC");
    $stmt->bindParam(":fromDate", $fromDate);
    $stmt->bindParam(":toDate", $toDate);
    $stmt->bindParam(":filters", $filter);
    $stmt->bindParam(":fiscal_id", $fiscal_id);
} else {
    $fiscal_id = $_SESSION['fiscal_id'];
    $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger WHERE fiscal_id = :fiscal_id");
    $stmt->bindParam(":fiscal_id", $fiscal_id);
    
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <tr>
            <td><?=$row['ledger_date']?></td>
            <td><?=$row['description']?></td>
            <td><?=$row['journal_voucher_no']?></td>
            <td><?=$row['debit']?></td>
            <td><?=$row['credit']?></td>
        </tr>
        <?php
    }
} else {
    ?>
        <td colspan="5">No Records Found</td>
    <?php 
}
?>