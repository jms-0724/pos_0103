<?php
// Connection to the database
require_once(__DIR__ . "/../../../connections/connection.php");

if(isset($_GET['term'])){
    $search = $_GET['term'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code WHERE account_name LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$formattedOptions = [];
foreach ($result as $row) {
    $formattedOptions[]= [
        'id' => $row['account_code'],
        'text' => $row['account_name'],
        'account_code' => $row['account_code'],
        'account_type' => $row['account_type'],
        'normal_balance' => $row['normal_balance'],
    ];
}
echo json_encode($formattedOptions);
?>