<?php
session_start();
require("./connections/connection.php");

if(isset($_SESSION['userid'])){
    if($_SESSION['userlevel'] == 'admin' ){
        header("location: Admin/admin.php");
    } else if ($_SESSION['userlevel'] == 'cashier') {
        header("location: Cashier/cashier.php");
    } else {
        header("location: Bookkeeper/bookkeeper.php");
    }
}  
// else {
//     header("Location: index.php");
// }
if(isset($_POST['username'])){

    $uname = $_POST['username'];
    $pword =  $_POST['password'];

    // Prepare Statement
    $sql = $conn->prepare("SELECT * FROM tbl_user INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id WHERE username = :username");
    $sql2 = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_status = :f_status");
    $f_status = "Active";
    if (!$sql){
        echo "Statement not prepared";
    } else {
        // Bind Parameters
        $sql->bindParam(":username",$uname,PDO::PARAM_STR);
        $sql2->bindParam(":f_status",$f_status,PDO::PARAM_STR);

        // Execute Sql Statement
        $sql->execute();
        $sql2->execute();

        if($sql->rowCount() > 0 ){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            if(password_verify($pword, $hashed_password)){
                $userlevel = $row['userlevel'];
                $_SESSION['userid'] = $row['uid'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['fiscal_id'] = $row2['fiscal_id'];
                $_SESSION['fiscal_name'] = $row2['description'];
                if($userlevel === "Administrator"){
                    $_SESSION['userlevel'] = "admin";
                    $_SESSION['ulvl'] = $row['userlevel'];
                    $_SESSION['fname'] = $row['user_fname'];
                    echo "admin";
                } else if($userlevel === "Cashier") {
                    $_SESSION['userlevel'] = "cashier";
                    echo "cashier";
                    $_SESSION['ulvl'] = $row['userlevel'];
                    $_SESSION['fname'] = $row['user_fname'];
                }
            } else {
            echo "Incorrect Password";
            }

        } else {
        echo "No User is Found";
        }
    }
    
} else {
    echo "Invalid Request";
}

?>