<?php

require(__DIR__ . "/../../connections/connection.php");

if (isset($_POST['fiscal_desc'])){
    $fiscal_description = $_POST['fiscal_desc'];
    $fiscal_status = $_POST['upd_status'];
    $fiscal_inactive = 'Inactive';

    $sql1 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalstatus WHERE fiscal_id = :fiscal_description");
    $sql1->bindParam(':fiscalstatus', $fiscal_status);
    $sql1->bindParam(':fiscal_description', $fiscal_description);

    $sql2 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalinactive");
    $sql2->bindParam(':fiscalinactive', $fiscal_inactive);
    if (!$sql1) {
        echo "No Statement Prepared";
    } else {
        // $sql2->execute();
        if($sql2->execute()){            
            if ($sql1->execute()){
                echo "Success";
            } else {
                echo "Failed";
            }
        } else {
            echo "Failed";
        }
    }
} else {
    echo "No Statement Prepared"; 
}
?>