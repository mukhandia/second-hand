<?php
include('components/session.php');
include("server/connect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DASHBOARD</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <?php include("components/sidebar.php") ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include('components/top_bar.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <form action="report.php" method="POST">
                            <input type="text" name="Amount_Today" id="" value="<?php echo $_SESSION['Amount_Today'] ?>" hidden>
                            <input type="text" name="Sales_Today" id="" value="<?php echo $_SESSION['Sales_Today'] ?>" hidden>
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
                        </form> -->

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Today)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Ksh
                                                <?php
                                                $date = date("l d/ m/Y");
                                                //query to get data from the table
                                                $sql = sprintf("SELECT amount  FROM income WHERE day = '$date'");

                                                //execute query
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $_SESSION['Amount_Today'] = $row['amount'];
                                                        echo $_SESSION['Amount_Today'];
                                                    }
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Sales (Today)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $date = date("l d/ m/Y");
                                                //query to get data from the table
                                                $sql = sprintf("SELECT sales  FROM Sales WHERE day = '$date'");

                                                //execute query
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $_SESSION['Sales_Today'] = $row['sales'];
                                                        echo $_SESSION['Sales_Today'];
                                                    }
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-asterisk fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="users.php" style="text-decoration: none ;">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Customers
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <?php

                                                    //query to get data from the table
                                                    $sql = sprintf("SELECT * FROM users");

                                                    //execute query
                                                    $result = mysqli_query($conn, $sql);
                                                    if ($num = mysqli_num_rows($result)) {
                                                        echo $num;
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="transactions.php" style="text-decoration: none ;">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Transactions (Today)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php
                                                    $date = date("l d/ m/Y");
                                                    //query to get data from the table
                                                    $sql = sprintf("SELECT * FROM tblpayment");

                                                    //execute query
                                                    $result = mysqli_query($conn, $sql);
                                                    if ($num = mysqli_num_rows($result)) {
                                                        echo $num;
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-briefcase fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-8 mr-auto">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="sales"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 mr-auto">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Summary</h6>
                                </div>
                                <div class="card-body">
                                    <p>The sales has been on an upward trend </p>
                                    <p>Monday 23th May 2022 Reported the lowest figure</p>
                                    <p>Thursday 23th May 2022 Reported the highest figure of Ksh 16950</p>
                                </div>
                                <div class="card-footer">
                                    <label for="">Add another Comment</label>
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="form-group">

                                                <textarea class="form-control" name="" id="" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="button" class="btn btn-success my-auto">Save</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- INCOME -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-8 mr-auto">
                            <div class="card shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Sales Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:auto ;">
                                    <div class="chart-area">
                                        <canvas id="income"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 mr-auto">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Summary</h6>
                                </div>
                                <div class="card-body">
                                    <p>The sales has been on an upward trend </p>
                                    <p>Friday 3th May 2022 Reported the lowest figure of 0 sales</p>
                                    <p>Tuesday 31st May 2022 Reported the highest figure of200 sales</p>
                                </div>
                                <div class="card-footer">
                                    <label for="">Add another Comment</label>
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="form-group">

                                                <textarea class="form-control" name="" id="" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="button" class="btn btn-success my-auto">Save</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- End of Content Wrapper -->
    <!-- End of main Content -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/sales.js"></script>
    <script src="js/income.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>