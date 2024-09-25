<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location: ../index.php");
    }

    if(isset($_SESSION['userid']) && $_SESSION['userlevel'] === "cashier"){
        header("location: ../Cashier/accountant.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup and Restore</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.5/css/all.min.css" integrity="sha512-some-long-hash" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="./../assets/css/page.css">
    <link rel="stylesheet" href="./../assets/css/modals.css">

</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="expand">
            <!-- logo and title -->
            <div class="justify-content-center" style="text-align:center; ">
                    <br><img src="./../assets/img/bwd_logo2.png" alt="" class="img-fluid" width="65" height="65">
                    <h2 style="color:white; text-align:center; font-size: 20px; margin-bottom:20px; font-weight:bold;">Balaoan Water <br>District</h2>
                </div>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="admin.php" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="usermanagement.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="journal.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Journal Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="generalledger.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>General Ledger</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="trialbalance.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Trial Balance</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-list"></i>
                        <span>Accounts List <br> Management</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="accountmanagement.php" class="sidebar-link">Title Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="typesmanagement.php" class="sidebar-link">Type Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="categories.php" class="sidebar-link">Category Management</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth2" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-cog"></i>
                        <span>Utilities</span>
                    </a>
                    <ul id="auth2" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="utilities.php" class="sidebar-link" style="font-size:12px">Fiscal Year Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" style="font-size:12px">Backup and Restore</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="help.php" class="sidebar-link" style="font-size:12px">Help</a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Utitlies</span>
                    </a>
                </li> -->
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li> -->
            </ul>
            <div class="sidebar-footer">
                <a  data-bs-toggle="modal" data-bs-target="#Logout" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- title part -->
        <div class="main p-3">
        <h5 style="font-weight:bold; font-size:25px; text-align: center;">Journal Entry Voucher Management System</h5>
            <div class="row bg-tertiary border" style="background-color:white; color:black; border-radius:20px; margin-bottom:10px;">
                <div class="col-6">
                    <h5 style="font-size:15px; margin-top:5px;">
                    Fiscal Period: <span><?= $_SESSION['fiscal_name']?></span>
                    </h5>
                </div> 
                <div class="col-6 d-flex justify-content-end">
                    <h5 style="font-size:15px; margin-top:5px;">
                        <i class="lni lni-user"></i> Welcome Back <span><?= $_SESSION['ulvl'] . " " . $_SESSION['fname']?></span>
                    </h5>
                </div>
            </div>

            <!-- card header -->
            <div class="card">
                <div class="card-header" style="background-color:#0e2238;">
                    <div class="d-flex mt-1 p-2">
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-cog"></i> Backup and Restore</h3>
                    </div>
                </div>

            <div class="card card-outline card-primary">
        
            <!-- <h3>Home </h3> -->
            <main class="card-body">
                <div class="container-fluid">
                    <div class="mb-3">
                    <div class="row">
                            <div>
                            <h3>Backup Database </h3>
                            <button id="saveAsButton" class="btn text-white" style="background-color:#0e2238; margin-right: 5px;">Backup Datadase</button>
                            </div>
                            
                        
                            
                        </div>
                        <div class="row">
                            <h3>Restore Database</h3>
                            <form action="" id="sqlRestoreForm" enctype="multipart/form-data">
                                <input type="file" name="file" id="sqlFile" class="form-control" accept=".sql" ><br>
                                <!-- <a href="utility/restoredb.php" class="btn text-white" style="background-color:#0e2238; margin-right: 5px;">Restore Database</a> -->
                                <button id="restoreBtn" class=" btn text-white" style="background-color:#0e2238;">Restore DB</button>
                                <div id="restoreStatus"></div>
                            </form>
                            
                        </div>
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </main>
            </div>
        </div>
        
    </div>
    <script src="./../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" ></script>
    <script src="./../assets/js/jquery-3.7.1.min.js"></script>
    <script src="system/confirmlogout.js"></script>


    <script src="./../assets/js/backup.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const restoreForm = document.getElementById('sqlRestoreForm');
    const fileInput = document.getElementById('sqlFile');
    const restoreBtn = document.getElementById('restoreBtn');
    const restoreStatus = document.getElementById('restoreStatus'); // Assuming you have an element to show status

    // Trigger modal on form submission
    restoreForm.addEventListener('submit', function(e) {
        e.preventDefault();
        $("#confirmUtil3").modal('show');
    });

    // Proceed with restore after confirming
    document.getElementById("proceedRestore").addEventListener("click", () => {
        if (!fileInput.files.length) {
            $("#noFile").modal('show');  // Show no file selected modal
            return;
        }

        var formData = new FormData();
        formData.append('sql_file', fileInput.files[0]);
        formData.append('restore', true);

        // Disable the button and show loading status
        restoreBtn.disabled = true;
        restoreStatus.innerHTML = "<p>Restoring database, please wait...</p>";

        // Send the request using Fetch API
        fetch('utility/restoredb.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            restoreBtn.disabled = false; // Enable the button after response

            // Check if the response is OK (status 200)
            if (response.ok) {
                return response.text(); // Get response as text
            } else {
                throw new Error('Error occurred while restoring the database.');
            }
        })
        .then(data => {
            if (data === "Success") {
                restoreStatus.innerHTML = "<p>Database restored successfully!</p>";
                $("#successModal").modal('show');  // Show success modal (make sure to have this)
                restoreForm.reset();  // Reset the form after success
            } else if (data === "Failed") {
                restoreStatus.innerHTML = "<p>Database restore failed. Please check the logs for details.</p>";
                $("#errorModal").modal('show');  // Show error modal
            } else {
                restoreStatus.innerHTML = `<p>${data}</p>`; // Handle unexpected response
            }
        })
        .catch(error => {
            restoreStatus.innerHTML = "<p>Error in network or server.</p>";
            $("#errorModal").modal('show');  // Show error modal
            console.error('Error:', error);
        });
    });
});

    </script>

    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/utilitiesmodal.php");
         include("./modals/confirmutilities.php")
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>
