<?php
require(__DIR__ . "/../../connections/connection.php");
$sqlScript = "";
foreach ($tables as $table) {
    
    // Prepare SQL script for creating table structure
    $query = "SHOW CREATE TABLE `$table`";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sqlScript .= "\n\n" . $row['Create Table'] . ";\n\n";
    
    // Prepare SQL script for dumping data for each table
    $query = "SELECT * FROM `$table`";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $columnCount = $stmt->columnCount();
    
    foreach ($rows as $row) {
        $sqlScript .= "INSERT INTO `$table` VALUES(";
        $j = 0;
        foreach ($row as $value) {
            if (is_null($value)) {
                $sqlScript .= "NULL";
            } else {
                $sqlScript .= $conn->quote($value);
            }
            
            if ($j < ($columnCount - 1)) {
                $sqlScript .= ',';
            }
            $j++;
        }
        $sqlScript .= ");\n";
    }
    
    $sqlScript .= "\n"; 
}


if(!empty($sqlScript))
{
    // Save the SQL script to a backup file
    $backup_file_name = $database_name . '_backup_' . time() . '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler); 

    // Download the SQL backup file to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);
    exec('rm ' . $backup_file_name); 
}

?>
