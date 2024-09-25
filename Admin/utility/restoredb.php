<?php
require(__DIR__ . "/../../connections/connection.php");
// if (isset($_POST['restore'])) {
//     $file = $_FILES['sql_file']['tmp_name'];

//     // Check if file is uploaded and is a SQL file
//     if ($file && pathinfo($_FILES['sql_file']['name'], PATHINFO_EXTENSION) == 'sql') {
//         $sql_content = file_get_contents($file);

//         // Create a new connection
//         $conn = new mysqli($host, $username, $password, $dbname);

//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }

//         // Split SQL statements by semicolons to handle multiple statements
//         $queries = explode(';', $sql_content);

//         $success = true;
//         $log_file = 'restore_log.txt';  // Optional: Log the restoration process

//         // Execute each query one by one
//         foreach ($queries as $query) {
//             $query = trim($query);
//             if (!empty($query)) {
//                 if (!$conn->query($query)) {
//                     file_put_contents($log_file, "Error executing query: " . $conn->error . "\n", FILE_APPEND);
//                     $success = false;
//                 } else {
//                     file_put_contents($log_file, "Query executed successfully.\n", FILE_APPEND);
//                 }
//             }
//         }

//         $conn->close();

//         // Provide feedback to the user
//         if ($success) {
//             echo "Success";
//         } else {
//             echo "Failed";
//         }

//     } else {
//         echo "Invalid SQL File";
//     }
// }


require(__DIR__ . "/../../connections/connection.php"); // Assuming this initializes $pdo

if (isset($_POST['restore'])) {
    $file = $_FILES['sql_file']['tmp_name'];

    // Check if file is uploaded and is a SQL file
    if ($file && pathinfo($_FILES['sql_file']['name'], PATHINFO_EXTENSION) == 'sql') {
        $sql_content = file_get_contents($file);

        // Create a new connection using PDO (assuming $pdo is defined in connection.php)
        try {
            // Disable foreign key checks to avoid issues with dependencies during restoration
            $conn->exec("SET FOREIGN_KEY_CHECKS = 0");

            // Split SQL statements by semicolons to handle multiple statements
            $queries = explode(';', $sql_content);

            $success = true;
            $log_file = 'restore_log.txt';  // Optional: Log the restoration process

            // Execute each query one by one
            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query)) {
                    try {
                        $conn->exec($query); // Execute the query using PDO
                        file_put_contents($log_file, "Query executed successfully.\n", FILE_APPEND);
                    } catch (PDOException $e) {
                        file_put_contents($log_file, "Error executing query: " . $e->getMessage() . "\n", FILE_APPEND);
                        $success = false;
                    }
                }
            }

            // Re-enable foreign key checks
            $conn->exec("SET FOREIGN_KEY_CHECKS = 1");

            // Provide feedback to the user
            if ($success) {
                echo "Success";
            } else {
                echo "Failed";
            }

        } catch (PDOException $e) {
            file_put_contents($log_file, "Connection failed: " . $e->getMessage() . "\n", FILE_APPEND);
            echo "Connection failed: " . $e->getMessage();
        }
    } else {
        echo "Invalid SQL File";
    }
}


?>