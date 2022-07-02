<?php
include('components/session_user.php');
include('server/connect.php');
include('components/cartControl.php');

$Message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Id = $_POST['Id'];
    $customer_name = $_POST['customer_name'];
    $customer_username = $_POST['customer_username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE `users` SET `Customer Name`='$customer_name',`Customer Username`='$customer_username',`Email`='$email',`Address`='$address',`Phone Number`='$phone_number' WHERE `Id`='$Id'";

    if ($res = mysqli_query($conn, $sql)) {
        $Message = '<div class="alert alert-success alerta" role="alert">
        <strong><i class="icon-ok"></i> USER DETAILS UPDATED SUCCESSFULLY</strong>
        </div>';
    } else {
        $Message = '<div class="alert alert-danger" role="alert">
        <strong>ERROR UPDATING USER' . mysqli_error($conn) . '</strong>
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
    <title>CHECKOUT</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/search.css">
    <?php include("components/links.php") ?>
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
                    <div class="bread_crump my-2">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <a class="breadcrumb-item" href="cart.php">View Cart</a>
                            <span class="breadcrumb-item active">Checkout</span>
                        </nav>
                    </div>
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
                        <!-- Column to Display Items in the Cart -->
                        <?php
                        $UserId = $_SESSION['Id'];
                        $sql = "SELECT * FROM `users` WHERE `Id` =  $UserId";
                        $result = mysqli_query($conn, $sql);
                        while ($personal_details = mysqli_fetch_assoc($result)) { ?>
                            <div class="col-lg-6 mt-1 mx-auto" style="box-shadow:1px 1px 7px">
                                <div class="card text-dark bg-light mt-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-10">
                                                <h3 class="text mb-3" style="font-family: monospace; font-size:20px;font-weight:600"><i class="fa fa-user" aria-hidden="true"></i> CONTACT INFO</h3>
                                                <div class="name pl-4">
                                                    <span class="text my-2" style="font-weight: 600;font-size:17px"> Name:</span> <?php echo $personal_details['Customer Name'] ?>
                                                </div>
                                                <div class="phone pl-4">
                                                    <span class="text my-2" style="font-weight: 600;font-size:17px"> Phone:</span>
                                                    <?php
                                                    $_SESSION['number'] = $personal_details['Phone Number'];
                                                    echo $_SESSION['number'];
                                                    ?>
                                                </div>
                                                <div class="phone pl-4">
                                                    <span class="text my-2" style="font-weight: 600;font-size:17px"> Email: </span><?php echo $personal_details['Email'] ?>
                                                </div>
                                                <div class="phone pl-4">
                                                    <span class="text my-2" style="font-weight: 600;font-size:17px"> Address: </span><?php echo $personal_details['Address'] ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                                <div class="edit py-4" style="cursor:pointer;">
                                                    <i class=" fa fa-edit fa-2x" aria-hidden="true" data-toggle="modal" data-target="#userdata"></i><!-- Button trigger modal -->
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="userdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update Personal Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    $Id = $_SESSION['Id'];

                                                                    $sql = "SELECT * FROM `users` WHERE `users`.`Id` =  '$Id'";
                                                                    $result = mysqli_query($conn, $sql);
                                                                    while ($menu = mysqli_fetch_assoc($result)) { ?>
                                                                        <div class="row">
                                                                            <div class="col-lg-4">
                                                                                <center>
                                                                                    <img src="IMAGES/users/<?php echo $menu['File'] ?>" alt="" class="mt-2 mb-1" style="width: 200px;height:200px; border-radius:50%">
                                                                                </center>
                                                                            </div>
                                                                            <div class="col-lg-8" style="border-right:2px sold green ;">
                                                                                <div class="mt-2 mb-1 error" style="width:100%">
                                                                                    <?php echo $Message ?>
                                                                                </div>
                                                                                <form action="" method="POST">
                                                                                    <div class="form-row">
                                                                                        <input type="text" name="Id" id="" value="<?php echo $menu['Id'] ?>" hidden>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationServer01" style="font-weight:700;">Customer Name</label>
                                                                                            <input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" name="customer_name" value="<?php echo $menu['Customer Name'] ?>" required>
                                                                                            <div class="name valid-feedback" id="name-valid-feedback">
                                                                                                Correct!
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="" style="font-weight:700;">Customer Username</label>
                                                                                            <div class="input-group">
                                                                                                <div class="input-group-prepend">
                                                                                                    <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                                                                                </div>
                                                                                                <input type="text" class="form-control is-valid" id="" placeholder="Username" aria-describedby="inputGroupPrepend3" id="" value="<?php echo $menu['Customer Username'] ?>" name="customer_username" required>
                                                                                                <div class="valid-feedback" id="valid-feeback">
                                                                                                    Looks Good!
                                                                                                </div>
                                                                                                <div class="usercheck" id="usercheck" style="color:red;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationServer04" style="font-weight:700;">Phone Number</label>
                                                                                            <input type="text" class="form-control is-valid" id="validationServer04" placeholder="Phone Number" name="phone_number" value="<?php echo $menu['Phone Number'] ?>" required>
                                                                                            <div class="valid-feedback">
                                                                                                Correct!
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationServer03" style="font-weight:700;">Address</label>
                                                                                            <input type="text" class="form-control is-valid" name="address" id="validationServer03" value="<?php echo $menu['Address'] ?>" required>
                                                                                            <div class="address valid-feedback">
                                                                                                Correct!
                                                                                            </div>
                                                                                            <div class="addresscheck" id="addresscheck" style="color:red">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-3">
                                                                                            <label for="validationServer05" style="font-weight:700;">Customer Email</label>
                                                                                            <input type="text" class="form-control is-valid " name="email" id="validationServer05" placeholder="Email" value="<?php echo $menu['Email'] ?>" required style="100%">
                                                                                            <div class="valid-feedback">
                                                                                                Looks good!
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-primary">Update Details</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        $('#exampleModal').on('show.bs.modal', event => {
                                                            var button = $(event.relatedTarget);
                                                            var modal = $(this);
                                                            // Use above variables to manipulate the DOM

                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card text-dark bg-light mt-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-10">
                                                <h3 class="text mb-3" style="font-family: monospace; font-size:20px;font-weight:600"><i class="fa fa-car" aria-hidden="true"></i> ORDERING METHOD</h3>
                                                <div class="name pl-4">
                                                    <span class="text my-2" style="font-weight: 600;font-size:17px">Type:</span> Pickup
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                                <div class="edit py-4" style="cursor:pointer;">
                                                    <i class=" fa fa-edit fa-2x" aria-hidden="true" data-toggle="modal" data-target="#transaction_method"></i>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="transaction_method" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="alert alert-warning" role="alert">
                                                                        <h4 class="alert-heading"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Pickup is the only Available Option. </h4>
                                                                        <p></p>
                                                                        <p class="mb-0"></p>
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


                            </div>
                            <div class="col-lg-5" style="box-shadow:1px 1px 7px">
                                <div class="card text-dark bg-light mt-2 mb-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-10 col-sm-10 col-10">
                                                <h3 class="text mb-3" style="font-family: monospace; font-size:20px;font-weight:600"><i class="fas fa-dollar-sign"></i> PAYMENT METHOD</h3>
                                                <div class="name pl-4">
                                                    <span class="text my-2" style="font-weight: 600;font-size:17px">Type:</span> MPESA
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-9 col-sm-9 col-9">
                                                        <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <strong>
                                                                Pay :
                                                                <?php
                                                                $UserId = $_SESSION['Id'];
                                                                // echo $UserId;
                                                                $sql = "SELECT SUM(Amount)  as Amount FROM `tblorder` WHERE `customer_id` = $UserId";
                                                                $total = mysqli_query($conn, $sql);
                                                                foreach ($total as $total) {
                                                                    $Total = (float)$total['Amount'];
                                                                    echo 'Ksh ' . $Total . '.00';
                                                                }
                                                                ?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-3 col-sm-3 col-3 py-auto" style="float:right;">
                                                        <?php
                                                        $Id = $_SESSION['Id'];

                                                        $sql = "SELECT * FROM `users` WHERE `users`.`Id` =  '$Id'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($personal_details = mysqli_fetch_assoc($result)) {
                                                            $phone =  $personal_details['Phone Number'];
                                                            // echo $UserId;
                                                            $sql = "SELECT SUM(Amount)  as Amount FROM `tblorder` WHERE `customer_id` = $UserId";
                                                            $total = mysqli_query($conn, $sql);
                                                            foreach ($total as $total) {
                                                                $Total = (float)$total['Amount']; ?>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-success text-white" style="border-bottom:2px solid orange ;">
                                                                                <h5 class="modal-title">Confirm Transaction</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true" style="color:orange;">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php
                                                                                $number =  $_SESSION['number'];
                                                                                $formatedPhone = substr($number, 1)
                                                                                ?>
                                                                                <label for="" style="font-weight:700;">Confirm Phone Number</label>
                                                                                <form action="PHP-MPESA/MpesaProcessor.php" method="GET">
                                                                                    <div class="input-group">
                                                                                        <input type="text" name="amount" id="" value="<?php echo $Total ?>" hidden>

                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text" id="inputGroupPrepend3">+254</span>
                                                                                        </div>
                                                                                        <input type="tel" class="form-control" id="" placeholder="" aria-describedby="inputGroupPrepend3" id="" value="<?php echo $formatedPhone ?>" name="number" required>
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-primary d-block mx-auto px-2 my-3">SEND REQUEST</button>
                                                                                </form>
                                                                                <hr>
                                                                                OR
                                                                                <hr>
                                                                                <div class="mpesa_div pt-3 mb-3" style="background-color: green; ">
                                                                                    <center>
                                                                                        <h5 style="background-color: white; color:green; width:60%">
                                                                                            LIPA NA MPESA
                                                                                        </h5>
                                                                                        <h5 class="mb-2 text-white">PAYBILL NUMBER</h5>
                                                                                        <div class="paybill_number " style="background-color: white; color:green; width:50%;height:auto">
                                                                                            <div class="number">
                                                                                                <span style="font-weight: 800; font-size:22px">1 7 4 3 7 9</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="paybill_footer pb-3" style="background-color: green;  width:100%;height:4px">
                                                                                        </div>
                                                                                    </center>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <p style="font-size:14px;font-weight:800 ;">For any queries call:</p>
                                                                                <p> <span>  0768754625</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-primary mt-2" style="font-size: 10px;" data-toggle="modal" data-target="#payment_modal" style="font-size:13px ;">Pay</button>

                                                        <?php }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <script>
                                                    $(".alert").alert();
                                                </script>

                                                <form action="transaction.php" method="post" class="form mb-2">
                                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            <span class="sr-only">Close</span>
                                                        </button>
                                                        <strong>Use Voucher Code: <span style="font-family:cursive; color:green;font-weight:800;">ABC12</span> To Test The System Functionality </strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">ENTER THE VOUCHER CODE RECEIVED:</label>
                                                        <input type="text" name="payment_voucher" id="" class="form-control" placeholder="" autocomplete="off" aria-describedby="helpId" required>
                                                    </div>
                                                    <input type="text" name="paid_by" id="" value="<?php echo $UserId ?>" hidden>
                                                    <input type="text" name="Amount" id="" value="<?php echo $Total ?>" hidden>
                                                    <input type="text" name="payment_date" id="" value="<?php echo date("l d/ m/Y") ?>" hidden>
                                                    <?php
                                                    $sql = "SELECT * FROM `cart` WHERE `customer_id` = '$UserId'";
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                                            <input type="text" name="cart_id" id="" value=" <?php echo $row['Id'] ?>" hidden>
                                                    <?php }
                                                    }
                                                    ?>
                                                    <center><button type="submit" class="btn btn-primary d-block">SUBMIT</button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->
    <!-- Bootstrap core JavaScript-->
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "PHP-MPESA/Mpesa/Processor.php",
                method: "GET",
                success: function(data) {
                    console.log(data);
                    // var day = [];
                    // var amount = [];


                },
                error: function(data) {
                    console.log(data);
                }
            });

        });
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/data.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>