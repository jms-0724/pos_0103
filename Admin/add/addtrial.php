<?php
session_start();
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['add_journal_title2'])) {

    $datetoday = $datetoday = date('Y/m/d');
    $add_journal_title2 = $_POST['add_journal_title2'];
    $add_balance_type = $_POST['add_balance_type'];
    $add_start_balance = $_POST['add_start_balance'];
    $ledger_id = 0;
    $fiscal_id = $_SESSION['fiscal_id'];
    
    
        $sql3 = $conn->prepare("INSERT INTO tbl_trial_balance (account_code, total_debit, trial_balance_date, fiscal_id) VALUES (:a_code, :t_debit, :t_date, :fiscal_id)");
        
        $sql3->bindParam("a_code",$add_journal_title2);
        $sql3->bindParam("t_date",$datetoday);
        $sql3->bindParam("t_debit",$add_start_balance);
        $sql3->bindParam("fiscal_id",$fiscal_id);



        $sql2 = $conn->prepare("INSERT INTO tbl_trial_balance (account_code, total_credit, trial_balance_date, fiscal_id) VALUES (:a_code, :t_credit :t_date, :fiscal_id2)");
        $sql2->bindParam("a_code",$add_journal_title2);
        $sql2->bindParam("t_date",$datetoday);
        $sql2->bindParam("t_credit",$add_start_balance);
        $sql3->bindParam("fiscal_id2",$fiscal_id);


        if (!$sql2){
            echo "No Statement Prepared";
        } else {
            if ($add_balance_type = "Debit") {
                $sql3->execute();
                echo "Success";
            
            } elseif  ($add_balance_type = "Credit"){
                $sql2->execute();
                echo "Success";
            } else {
                echo "Invalid Balance Type";
            }
                
        }
    

}

?>