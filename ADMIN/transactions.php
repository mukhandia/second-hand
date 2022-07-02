<?php
include("components/session.php");
include("server/connect.php");
$Message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Id = $_POST['Id'];
    $admin = $_POST['admin'];

    $sql = "UPDATE `tblpayment` SET `payment_status` = 'Verified', `processed_by` = '$admin' WHERE `tblpayment`.`payment_id` = '$Id'";

    if ($res = mysqli_query($conn, $sql)) {
        $Message = '<div class="alert alert-success" role="alert">
        <strong><i class="icon-ok"></i> TRANSACTION DELETED SUCCESSFULLY</strong>
        </div>';
    } else {
        $Message = '<div class="alert alert-danger" role="alert">
        <strong>ERROR DELETING TRANSACTION' . mysqli_error($conn) . '</strong>
        </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TRANSACTIONS PAGE</title>
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
                    <script>
                        $(document).ready(function() {
                            var message = <?php echo $message ?>
                            if (message == "") {

                            } else {
                                alert(message);
                            }
                        })
                    </script>
                    <div class="row">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Transaction Table</h1>
                        <p class="mb-4">This tables contains all the information that are there in the database regarding the transactions that took place on our system. It is detailed and easy to follow through. It helps the admin access the Transactions to ascertain the effectiveness of each and every data stored about them</p>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Transaction</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                $sql = "SELECT * FROM `tblpayment` ORDER BY `payment_id` DESC";
                                $result = mysqli_query($conn, $sql); ?>
                                <table class="table table-hovered table-inverse table-responsive">
                                    <thead class="thead-inverse" style="background-color: green; border-bottom:4px solid orange;color:white;">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Payment Voucher</th>
                                            <th>Cart Id</th>
                                            <th>Amount</th>
                                            <th>Payment Status</th>
                                            <th>Paid By</th>
                                            <th>Payment Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($payment = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td scope="row"><?php echo $i ?></td>
                                                <td>
                                                    <h5 style="color:orange;font-family:monospace;font-weight:900;text-align:center"><?php echo $payment['payment_voucher'] ?></h5>
                                                </td>
                                                <td><?php echo $payment['cart_id'] ?>
                                                </td>
                                                <td><?php echo $payment['amount'] ?></td>
                                                <td>
                                                    <?php
                                                    echo $payment['payment_status'];
                                                    if ($payment['payment_status'] == 'Verified') { ?>
                                                        <button type="button" class="btn btn-success px-1" style="border-radius:10px;box-shadow:2px 2px 10px orange;font-size:12px;"><i class="fa fa-check"></i></button>
                                                    <?php } else if ($payment['payment_status'] == 'Paid, Not VerifiedNot Verified') { ?>
                                                        <button type="button" class="btn btn-danger px-2 py-1" style="border-radius:10px;box-shadow:2px 2px 10px orange;font-size:12px;">Not Verified</button>
                                                    <?php } else {
                                                        echo mysqli_error($conn);
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $userId = $payment['paid_by'];
                                                    if ($payment['paid_by'] == "") {
                                                        echo "No Data";
                                                    } else {
                                                        $sql = "SELECT * FROM `users` WHERE `Id` = $userId";
                                                        $users = mysqli_query($conn, $sql);
                                                        foreach ($users as $user) {
                                                            echo $user['Customer Name'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $payment['payment_date'] ?>
                                                </td>
                                                <td>
                                                    <div class="row mr-auto d-flex justify-content-around">
                                                        <div class="col-lg-6">
                                                            <form action="" method="POST">
                                                                <input type="text" name="Id" id="" value="<?php echo $payment['payment_id'] ?>" hidden>
                                                                <?php
                                                                $admin = $_SESSION['Id'];
                                                                ?>
                                                                <input type="text" name="admin" id="" value="<?php echo $admin ?>" hidden>
                                                                <button type="submit" class="btn btn-success  px-1" style="border-radius:10px;box-shadow:2px 2px 10px orange;font-size:12px;">Verify</button>
                                                            </form>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a href="update_user.php?Id=<?php echo $payment['payment_id'] ?>">
                                                                <button type="button" class="btn btn-danger px-1" style="border-radius:10px;box-shadow:2px 2px 10px orange;font-size:12px;">Delete</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="js/register.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>