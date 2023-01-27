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
    <title>CART</title>
    <link rel="icon" href="IMAGES/comp/favicon.ico" type="image/x-icon" />
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <?php include("components/links.php") ?>
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="css/search.css">
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
                    <div class="bread_crump my-1">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="index.php">Home</a>

                            <span class="breadcrumb-item active">View Cart</span>
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
                    <div class="row-sm-12">
                        <div class="row mb-5 d-flex justify-content-center pl-2">
                            <!-- Column to Display Items in the Cart -->
                            <div class="mid col-lg-8 col-sm-12 col-md-11 col-11 mt-1 mb-2" style="box-shadow:2px 2px 10px;border-radius: 8px; background-color:whitesmoke;overflow:scroll;height:90vh;">

                                <script>
                                    var ERROR = '<?php echo $ERROR ?>';
                                    if (ERROR == '') {} else {
                                        alert(ERROR);
                                    }
                                    var Remove = '<?php echo $Remove ?>';
                                    if (Remove == '') {} else {
                                        alert(Remove);
                                    }
                                </script>
                                <?php
                                $UserId = $_SESSION['Id'];
                                $sql = "SELECT product_id FROM `tblorder` WHERE `customer_id` =  '$UserId'";
                                $cart = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($cart) > 0) { ?>
                                    <table class="table table-hover table-inverse table-responsive-lg" style="font-weight: 500;overflow-y:hidden ;">
                                        <thead class="thead-inverse mx-0 text-info">
                                            <tr>
                                                <th class=" col-lg-4 col-md-4 col-sm-6 col-4">Name</th>
                                                <th class="col-lg-2 col-md-2 col-sm-6 col-2">Price</th>
                                                <th class="col-lg-4 col-md-7 col-sm-6 col-4">Add/Subtract</th>
                                                <th class="col-lg-2 col-md-2   col-sm-6 col-2">Amount</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cart as $cart_id) {
                                                $product_id = $cart_id['product_id'];
                                                $sql = "SELECT * FROM `products` WHERE `Id` =  '$product_id'";
                                                $cart = mysqli_query($conn, $sql);
                                                $result = mysqli_query($conn, $sql); ?>
                                                <?php if (mysqli_num_rows($result) > 0) { ?>

                                                    <tr>
                                                        <?php
                                                        while ($c_details = mysqli_fetch_assoc($result)) { ?>
                                                            <td scope="row no-gutters d-inline">
                                                                <div class="media">
                                                                    <a href="single.php?name=<?php echo $c_details['Name'] ?>">
                                                                        <img src="IMAGES/furniture/<?php echo $c_details['File'] ?>" alt="" style="width:80px; height:80px;">
                                                                    </a>
                                                                    <div class="media-body ml-4">
                                                                        <h6 style="color:brown;font-family:cursive;color:green;font-weight:900"> <?php echo $c_details['Name'] ?></h6>
                                                                        <p>Description:<?php echo $c_details['Description'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="py-auto"><span>Ksh <?php echo $c_details['Price']  ?></span>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $p_id =  $c_details['Id'];
                                                                $UserId = $_SESSION['Id'];
                                                                $sql = "SELECT * FROM `tblorder` WHERE product_id =  $p_id and customer_id = $UserId";
                                                                $cart_quantity = mysqli_query($conn, $sql);
                                                                foreach ($cart_quantity as $cart_quantity) { ?>
                                                                    <div class="list-group row">
                                                                        <div class="row no-gutters">
                                                                            <div class="col mr-0">
                                                                                <form action="delete.php" method="post">
                                                                                    <?php
                                                                                    if ($cart_quantity['Quantity'] == 1) { ?>
                                                                                        <button type="submit" disabled="disabled" class="btn btn-light" style="border-radius: 0px;height:40px" name="subtract"> <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                                                        </button>
                                                                                    <?php } else { ?>
                                                                                        <input type="text" name="user_Id" class="form-control" value="<?php echo $UserId ?>" placeholder="" aria-describedby="helpId" hidden>
                                                                                        <input type="text" name="order_id" value="<?php echo $cart_quantity['order_id'] ?>" class="form-control" placeholder="" aria-describedby="helpId" hidden>
                                                                                        <button type="submit" class="btn btn-light" style="border-radius: 0px;height:40px" name="subtract"> <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                                                        </button>
                                                                                    <?php }
                                                                                    ?>
                                                                                </form>
                                                                            </div>
                                                                            <div class="col">
                                                                                <button type="button" class="btn btn-success ml-0 mr-0" style="border-radius: 0px;height:40px;width:100%;" value=""> <?php echo $cart_quantity['Quantity'] ?> </button>
                                                                            </div>
                                                                            <div class="col">
                                                                                <form action="add.php" method="post">
                                                                                    <?php
                                                                                    if ($cart_quantity['Quantity'] == 3) { ?>
                                                                                        <button type="submit" disabled="disabled" class="btn btn-light" style="border-radius: 0px;height:40px" value="" name="add"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                                                    <?php } else {
                                                                                    ?>
                                                                                        <input type="text" name="user_Id" class="form-control" value="<?php echo $UserId ?>" placeholder="" aria-describedby="helpId" hidden>
                                                                                        <input type="text" name="order_id" value="<?php echo $cart_quantity['order_id'] ?>" class="form-control" placeholder="" aria-describedby="helpId" hidden>
                                                                                        <button type="submit" class="btn btn-light" style="border-radius: 0px;height:40px" value="" name="add"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                                                    <?php }
                                                                                    ?>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                Ksh <?php echo $cart_quantity['Amount'] ?>
                                                            </td>
                                                            <td>
                                                                <form action="remove_from_cart.php" method="post">
                                                                    <?php
                                                                    $UserId = $_SESSION['Id'];
                                                                    ?>
                                                                    <input type="text" name="order_id" value="<?php echo  $product_id ?>" class="form-control" placeholder="" aria-describedby="helpId" hidden>
                                                                    <input type="text" name="user_Id" class="form-control" value="<?php echo $UserId ?>" placeholder="" aria-describedby="helpId" hidden>
                                                                    <button type="submit" class="shadow btn btn-danger px-1">Remove </button>
                                                                </form>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                    </a>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php } else {
                                    echo  '<div class="alert alert-danger mt-2" role="alert"><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>You Don\'t have any item in the Cart</strong>
                             </div>';
                                }
                                ?>
                            </div>
                            <!-- Column to Display the Transaction Details -->
                            <div class="col-lg-4 col-sm-12 col-md-12" ">
                        <div class=" card text-dark bg-light" style="width:100%; box-shadow:2px 2px 10px;">
                                <div class=" card-header">
                                    <h5 style="font-size: 14px;color:lightblue;font-weight:700;">ORDER SUMMARY</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <h6 style="font-size: 14px;">ITEMS (
                                                <?php
                                                $UserId = $_SESSION['Id'];
                                                // echo $UserId;
                                                $sql = "SELECT * FROM  `tblorder` WHERE `customer_id` = $UserId";
                                                if ($result = mysqli_query($conn, $sql)) {
                                                    $num = (mysqli_num_rows($result));
                                                    echo $num;
                                                }
                                                ?>
                                                )
                                            </h6>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <h6 style="font-size: 14px;float:right">
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
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <h6 style="font-size: 14px;">
                                                ADDITIONAL COSTS
                                            </h6>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <h6 style="font-size: 14px;float:right">                                           
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <h6 style="font-size: 14px;">
                                                TOTAL COST
                                            </h6>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <h6 style="font-size: 14px;float:right">
                                                <?php
                                                $UserId = $_SESSION['Id'];
                                                // echo $UserId;
                                                $sql = "SELECT SUM(Amount)  as Amount FROM `tblorder` WHERE `customer_id` = $UserId";
                                                $total = mysqli_query($conn, $sql);
                                                foreach ($total as $total) {
                                                    $Total = (float)$total['Amount'];
                                                    echo 'Ksh ' . $Total. '.00';
                                                    $sql = "SELECT * FROM `cart` WHERE `customer_id` = '$UserId'";
                                                    $res = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        foreach ($res as $res) {
                                                            $cart_id = $res['Id'];
                                                            // echo $cart_id;

                                                            $sql = "UPDATE `cart` SET `Amount`= '$Total' WHERE `Id`= '$cart_id'";
                                                            if ($result = mysqli_query($conn, $sql)) {
                                                                $sql = "UPDATE `tblorder` SET `cart_id`= '$cart_id' WHERE `customer_id`= '$UserId'";
                                                                if ($result = mysqli_query($conn, $sql)) {
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        $UserId = $_SESSION['Id'];
                                                        $sql = "INSERT INTO `cart`(`customer_id`, `Amount`) VALUES ('$UserId','$Total')";
                                                        if ($result = mysqli_query($conn, $sql)) {
                                                            $sql = "SELECT * FROM `cart` WHERE `customer_id` = '$UserId'";
                                                            $res = mysqli_query($conn, $sql);
                                                            if (mysqli_num_rows($res) > 0) {
                                                                foreach ($res as $res) {
                                                                    $cart_id = $res['Id'];
                                                                    // echo $cart_id;
                                                                    $sql = "UPDATE `tblorder` SET `cart_id`= '$cart_id' WHERE `customer_id`= '$UserId'";
                                                                    if ($result = mysqli_query($conn, $sql)) {
                                                                    }
                                                                    function random_strings($length_of_string)
                                                                    {
                                                                        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                                        return substr(str_shuffle($str_result), 0, $length_of_string);
                                                                    }
                                                                   
                                                                   $addednum="SHOPI";
                                                                   $voucher_num = random_strings(5);
                                                                    $voucher_number = $addednum .$voucher_num ;
                                                                    $sql = "INSERT INTO `tblpayment`(`payment_voucher`, `cart_id`) 
                                                                    VALUES ('$voucher_number','$cart_id')";
                                                                    if ($result_voucher = mysqli_query($conn, $sql)) {
                                                                        $date = date("l d/ m/Y");
                                                                        $sql = "SELECT * FROM `site_traffic` WHERE `Date` = '$date'";
                                                                        $res = mysqli_query($conn, $sql);
                                                                        if (mysqli_num_rows($res) > 0) {
                                                                            foreach ($res as $row) {
                                                                                $date = date("l d/ m/Y");
                                                                                $Booked = $row['Booked'];
                                                                                $Booked = $Booked + 1;
                                                                                $Id = $row['Id'];
                                                                                $sql = "UPDATE `site_traffic` SET `Booked`=$Booked WHERE `Id`='$Id'";
                                                                                if ($result = mysqli_query($conn, $sql)) {
                                                                                }
                                                                            }
                                                                        } else {
                                                                            $date = date("l d/ m/Y");
                                                                            $sql = "INSERT INTO `site_traffic`(`Booked`, `Date`) VALUES (1,'$date')";
                                                                            if (mysqli_query($conn, $sql)) {
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            echo '<div class="alert alert-danger" role="alert">
                                                            <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Sorry, Failed To add the cart Details' . mysqli_error($conn) . '</strong>
                                                            </div>'.mysqli_error($conn);
                                                        }
                                                    }
                                                }
                                                ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <?php
                                    $UserId = $_SESSION['Id'];
                                    ?>
                                    <a href="checkout.php" style="text-decoration:none"><button type="button" class="shadow btn btn-success d-block mt-2" style="border-radius: 0px; width:98%; border-radius:12px;">CHECKOUT</button></a>
                                </div>
                            </div>
                        </div>
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