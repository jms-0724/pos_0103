<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_entry");
} 
else if ($_POST['category_id']){
    $category = $_POST['category_id'];
    $stmt = $conn->prepare("SELECT DISTINCT description FROM tbl_journal_entry WHERE category_id = :category_id");
    $stmt->bindParam('category_id', $category);
}
else {
    $stmt = $conn->prepare("SELECT DISTINCT description FROM tbl_journal_entry");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <option value="<?=$row['description']?>"></option>

        <?php
    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>