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
    <title>Admin Main Page</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.5/css/all.min.css" integrity="sha512-some-long-hash" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="./../assets/css/page.css">
    <link rel="stylesheet" href="./../assets/css/modals.css">
    <script src="./../node_modules/chart.js/dist/chart.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
                    <a href="#" class="sidebar-link">
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
                <li class="sidebar-item" >
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-list"></i>
                        <span>Accounts List <br> Management</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="accountmanagement.php" class="sidebar-link" style="font-size:12px">Account Title Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="typesmanagement.php" class="sidebar-link" style="font-size:12px">Account Type Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="categories.php" class="sidebar-link" style="font-size:12px">Journal Category Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="accountclass.php" class="sidebar-link" style="font-size:12px">Account Category Management</a>
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
                            <a href="backup.php" class="sidebar-link" style="font-size:12px">Backup and Restore</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="help.php" class="sidebar-link" style="font-size:12px">Help</a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="utilities.php" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Utilities</span>
                    </a>
                </li> -->
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>  -->
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
                        <h3 style="font-weight:bold; color:white; font-size: 25px;"><i class="lni lni-home"></i> Dashboard</h3>
                    </div>
                </div>

            <div class="card card-outline card-primary">
        
            <!-- <h3>Home </h3> -->
            <main class="card-body">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card dashboard-card" style=background-color:#0e2238;>
                                    <div class="card-body">
                                      <h5 class="card-title text-center text-light" style="font-size: 14px;"><i class="bi bi-journal-bookmark-fill me-2"></i></i>Number of Journal Entry</h4>
                                      <p class="card-text text-center h6 fw-bold text-light" id="totalJournal"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card dashboard-card" style=background-color:#0e2238;>
                                    <div class="card-body">
                                      <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-file-earmark-fill me-2"></i>Total of Account Titles</h4>
                                      <p class="card-text text-center h6 fw-bold text-light" id="totalAccounts"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card dashboard-card" style=background-color:#0e2238;>
                                    <div class="card-body">
                                      <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-person-fill text-light me-2" style="font-size: 18px;"></i>Number of Users</h4>
                                      <p class="card-text text-center h6 fw-bold text-light" id="totalUsers"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card dashboard-card" style=background-color:#0e2238;>
                                    <div class="card-body">
                                      <h5 class="card-title text-center text-light" style="font-size: 15px;"><i class="bi bi-receipt me-2"></i>JEV Transactions per Month</h4>
                                      <p class="card-text text-center h6 fw-bold text-light" id="currentJournal"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>
                                
                            </div>
                            <div class="col">
                               
                                <div>
                                    <canvas id="myChart2"></canvas>
                                </div>
                               
                            </div>
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
    <script src="./../assets/js/dashboard.js"></script>

    <?php 
         include("./modals/logoutmodal.php");
    ?>
    <!-- <script src="script.js"></script> -->
    <script>
 fetch('dashboard/accountstype.php')
        .then(response => response.json())
        .then(data => {
            // Get the context of the canvas element
            var ctx = document.getElementById('myChart').getContext('2d');
            
            // Create the chart
            var myChart = new Chart(ctx, {
                type: 'bar', // or 'line', 'pie', etc.
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Account Type Count',
                        data: data.data,
                        backgroundColor: '#0e2238;',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                    display: true,
                    text: 'Number of Account Titles per Type', // Title for the bar chart
                        font: {
                        size: 18
                        }
                    }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

  const ctx2 = document.getElementById('myChart2');
  new Chart(ctx2, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
        label: '# of Entries per Month',
        data: [13, 20, 4, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Journal Entries per Month', // Title for the bar chart
                font: {
                    size: 18
                }
            }
        },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>
</body>

</html>