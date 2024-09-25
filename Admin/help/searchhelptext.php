<?php

require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_GET['help_topic_id'])){
    $search = $_GET['help_topic_id'];
    $stmt = $conn->prepare("SELECT * FROM tbl_help WHERE topic LIKE '%$search%' ");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_help");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <div>
            <a href="help/helpreport.php?help_topic_id=<?= $row['help_id']?>" target="_blank" class="btn-link" id="<?= $row['help_id']?>"><?= $row['topic']?></a>
            <p><?= $row['context']?></p>
        </div>
        <?php
    }
} else {
    ?>
        <td colspan="5">No Records Found</td>
    <?php 
}
?>