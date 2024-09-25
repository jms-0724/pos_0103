<?php
 
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['add_group'])) {

   
    $add_group = $_POST['add_group'];
    $add_description = $_POST['add_description'];
    $add_types = $_POST['add_types'];
    $sql1 = $conn->prepare("SELECT * FROM tbl_account_class WHERE class_name = :add_group_name");
    $sql1->bindParam(":add_group_name", $add_group);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Category Already Existing";
    } else {
        $sql2 = $conn->prepare("INSERT INTO tbl_account_class (class_name, description, type_code) VALUES (:a_name, :a_description, :a_type)");
        $sql2->bindParam("a_name", $add_group);
        $sql2->bindParam(":a_description", $add_description);
        $sql2->bindParam(":a_type", $add_types);

        if (!$sql2){
            echo "No Statement Prepared";
        } else {
            if ($sql2->execute()) {
                echo "Success";
            } else {
                echo "Failed in Inserting Accounts";
            }
                
        }
    }

}

?>