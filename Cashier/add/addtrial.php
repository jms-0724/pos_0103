<?php
 
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['add_journal_title2'])) {

   
    $add_journal_title2 = $_POST['add_journal_title2'];
    $add_balance_type = $_POST['add_balance_type'];
    $add_start_balance = $_POST['add_start_balance'];
    $ledger_id = 0;
    $sql1 = $conn->prepare("SELECT * FROM tbl_trial_balance WHERE account_code = :add_journal_title");
    $sql1->bindParam(":add_journal_title", $add_journal_title2);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Category Already Existing";
    } else {
        $sql3 = $conn->prepare("INSERT INTO tbl_trial_balance (account_code, total_debit, trial_balance_date) VALUES (:a_code, :t_debit, :t_date)");
        $sql2 = $conn->prepare("INSERT INTO tbl_trial_balance (account_code, total_credit, trial_balance_date) VALUES (:a_code, :t_debit, :t_date)");
        $sql2->bindParam("a_name", $add_group);
        $sql2->bindParam(":a_description", $add_description);
        $sql2->bindParam(":a_type", $add_types);

        if (!$sql2){
            echo "No Statement Prepared";
        } else {
            if ($add_balance_type = "Debit") {
                $sql3->execute();
                echo "Success";
            
            } elseif  ($add_balance_type = "Credit"){
                $sql3->execute();
                echo "Success";
            } else {
                echo "Invalid Balance Type";
            }
                
        }
    }

}

?>