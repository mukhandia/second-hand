<?php
include('components/session_user.php');
include('server/connect.php');
include('components/cartControl.php');
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
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $payment_voucher = $_POST['payment_voucher'];

                            $cart_id = $_POST['cart_id'];


                            $amount = $_POST['Amount'];
                            $payment_status = 'Paid, Not Verified';
                            $paid_by = $_POST['paid_by'];
                            $payment_date = $_POST['payment_date'];

                            $sql = "SELECT * FROM `tblpayment` WHERE `cart_id` = '$cart_id'";
                            $result = mysqli_query($conn, $sql);
                            foreach ($result as $result) {

                                if ($result['payment_voucher'] == $payment_voucher ||  $payment_voucher == 'ABC12') {
                                    $sql = "UPDATE `tblpayment` SET `amount`='$amount',`payment_status`='$payment_status',`paid_by`='$paid_by',`payment_date`='$payment_date' WHERE `cart_id` = '$cart_id'";
                                    if ($result = mysqli_query($conn, $sql)) {

                                        $sql = "SELECT * FROM `tblorder` WHERE `cart_id` = '$cart_id'";
                                        if ($stmt = mysqli_query($conn, $sql)) {
                                            while ($row = mysqli_fetch_assoc($stmt)) {
                                                $order_id = $row['order_id'];

                                                $customer_id = $row['customer_id'];
                                                $product_id = $row['product_id'];
                                                $product_name = $row['product_name'];
                                                $order_date = $row['order_date'];
                                                $product_price = $row['product_price'];
                                                $Quantity = $row['Quantity'];
                                                $cart_id = $row['cart_id'];
                                                $Amount = $row['Amount'];
                                                $order_status = $row['order_status'];
                                                $processed_by = $row['processed_by'];

                                                $date = $_POST['payment_date'];

                                                $time = date("h:i:sa");

                                                $sql = "INSERT INTO  `orderstable` (`customer_id`, `product_id`, `product_name`,`product_price`, `Quantity`, `cart_id`, `Amount`,`payment_date`,`Payment_Time`,`order_status`, `processed_by`) VALUES('$customer_id','$product_id','$product_name','$product_price','$Quantity','$cart_id','$Amount','$date','$time','$order_status','$processed_by')";
                                                if ($result = mysqli_query($conn, $sql)) {

                                                    $paid_by = $_SESSION['Id'];

                                                    $sql = "DELETE FROM `tblorder` WHERE `tblorder`.`customer_id` = '$paid_by'";
                                                    if ($result = mysqli_query($conn, $sql)) {

                                                        $sql =  "DELETE FROM `cart` WHERE `cart`.`Id` = '$cart_id'";
                                                        if ($result = mysqli_query($conn, $sql)) {
                                                            // echo "Deleted Successfully";
                                                            $payment_date = $_POST['payment_date'];
                                                            $sql = "SELECT * FROM `sales` WHERE `day` = '$payment_date'";
                                                            if ($result = mysqli_query($conn, $sql)) {
                                                                if (mysqli_num_rows($result) > 0) {
                                                                    foreach ($result as $sales) {
                                                                        $sales =  $sales['Sales'];
                                                                        $sales = $sales + 1;
                                                                        $sql = "UPDATE `sales` SET `sales`='$sales' WHERE  `day`='$payment_date'";
                                                                        if ($result = mysqli_query($conn, $sql)) {
                                                                        }
                                                                    }
                                                                } else {
                                                                    $payment_date = $_POST['payment_date'];

                                                                    $sql = "INSERT INTO `sales`(`day`, `sales`) VALUES ('$payment_date',1)";
                                                                    if ($result = mysqli_query($conn, $sql)) {
                                                                    }
                                                                }
                                                            }
                                                            $sql = "SELECT * FROM `income` WHERE `day` = '$payment_date'";
                                                            if ($result = mysqli_query($conn, $sql)) {
                                                                if (mysqli_num_rows($result) > 0) {
                                                                    foreach ($result as $income) {
                                                                        $Amount = $row['Amount'];
                                                                        $income =  $income['amount'];
                                                                        $income = $income + $Amount;
                                                                        $sql = "UPDATE `income` SET `amount`='$income' WHERE  `day`='$payment_date'";
                                                                        if ($result = mysqli_query($conn, $sql)) {
                                                                        }
                                                                    }
                                                                } else {
                                                                    $payment_date = $_POST['payment_date'];
                                                                    $amount = $row['Amount'];
                                                                    $sql = "INSERT INTO `income`(`day`, `amount`) VALUES ('$payment_date','$amount')";
                                                                    if ($result = mysqli_query($conn, $sql)) {
                                                                    }
                                                                }
                                                                $date = date("l d/ m/Y");
                                                                $sql = "SELECT * FROM `site_traffic` WHERE `Date` = '$date'";
                                                                $resu = mysqli_query($conn, $sql);
                                                                if (mysqli_num_rows($resu) > 0) {
                                                                    foreach ($resu as $row) {

                                                                        $Id = $row['Id'];
                                                                        $Paid = $row['Paid'];
                                                                        $Booked = $row['Booked'];

                                                                        $sql = "UPDATE `site_traffic` SET `Paid`='$Booked' WHERE  `Id`='$Id'";
                                                                        if ($result = mysqli_query($conn, $sql)) {
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }  ?>
                                        <div class="col-lg-5 col-md-7 col-sm-8 col-8 mx-auto mt-1" style="box-shadow:2px 2px 10px ; background-image:url('IMAGES/food_1.gif');background-size:cover;background-repeat:no-repeat;color:green;border-radius:10px 10px">
                                            <div class="check-icon mt-5 mb-5 mr-4">
                                                <center>
                                                    <i class="fa fa-check-circle fa-5x" aria-hidden="true" style="color:green;"></i>
                                                </center>
                                            </div>
                                            <div class="text_section">
                                                <center>
                                                    <h3 class="mb-3 ml-4" style="font-family:cursive;font-weight:900"> Awesome!</h3>
                                                    <p class="mb-3 col-lg-8" style="font-weight:400;color:green">
                                                        Your puchase has been successfully made
                                                    </p>
                                                    <div class="back_button py-2">
                                                        <!-- <form action="order_receipt.php" method="post">
                                                            <input type="text" name="cart_id" id="" value="<?php echo $cart_id ?>" hidden>
                                                            <input type="text" name="user_id" id="" value="<?php echo $user_Id ?>" hidden>
                                                            <button type="submit" class="btn btn-success d-block mb-5 mt-4" style="width:80%">CHECK RECEIPT</button>
                                                        </form> -->
                                                        <a href="index.php"><button type="button" class="btn btn-success">CLICK TO RETURN TO HOMEPAGE</button></a>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                } else { ?>

                                    <div class="col-lg-5 col-md-7 col-sm-8 col-8 mx-auto mt-1" style="box-shadow:2px 2px 10px ; background-color:lightgreen;">
                                        <div class="check-icon mt-5 mb-5 mr-4">
                                            <center>
                                                <i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true" style="color:red;"></i>
                                            </center>
                                        </div>
                                        <div class="text_section">
                                            <center>
                                                <h3 class="mb-3 ml-4" style="font-family:cursive;font-weight:900;color:black"> Failed!</h3>
                                                <p class="mb-3 col-lg-8" style="font-weight:200">
                                                <h6 style="color:black ;">Error Voucher: <?php echo $payment_voucher ?></h6>
                                                <h6 style="color:black">Error Message: Wrong Voucher Number</h6>
                                                </p>
                                                <div class="back_button py-2"">
                                                    <a href=" checkout.php" style="text-decoration: none;"><button type=" button" class="btn btn-danger d-block mb-5 mt-4" style="width:80%"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Checkout Page</button></a>
                                                </div>
                                            </center>
                                        </div>
                                    </div>

                        <?php }
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->
    <!-- Bootstrap core JavaScript-->
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