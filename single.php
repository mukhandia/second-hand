<?php
include('components/session_user.php');
include('server/connect.php');


$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_Id = $_POST['user_id'];
    $product_Id = $_POST['Id'];
    $Name = $_POST['Name'];
    $Price = $_POST['Price'];
    $sql = "SELECT * FROM `tblorder` WHERE `customer_id` = '$user_Id' AND `product_Id` = '$product_Id'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($user_Id == $row['customer_id']) {
                    $message = '<div class="alert alert-danger" role="alert">
                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> You Have Already Made This Order</strong>
                    </div>';
                }
            }
        } else {
            $sql = "INSERT INTO `tblorder` (`customer_id`,`product_Id`,`product_name`,`Quantity`,`order_status`,`product_price`,`Amount`) VALUES('$user_Id','$product_Id','$Name',1,'Received', '$Price', '$Price')";
            if ($result = mysqli_query($conn, $sql)) {
                $message = '<div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i> ORDER ADDED TO CART</strong>
                    </div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">
                <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> UKNOWN ERROR ADDING PRODUCT TO CART ' . mysqli_error($conn) . '</strong>
                </div>';
            }
        }
    } else {
        echo "CONNECTION NOT SUCCESSFUL" . mysqli_error($conn);
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
    <link rel="stylesheet" href="css/search.css">
    <title>
        <?php
        if (isset($_GET['name'])) {
            $Name = $_GET['name'];
            echo $Name;
        }
        ?>
    </title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>
    .card-img-top:hover {
        transform: scale(1.04);
        transition: 200ms;
    }
</style>

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
                    <?php echo $message; ?>
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
                        <div class="col-lg-11 mx-auto">
                            </script>
                            <?php
                            if (isset($_GET['name'])) {
                                $Name = $_GET['name'];
                                $sql = "SELECT * FROM `products` WHERE `Name` = '$Name'";
                                $result = mysqli_query($conn, $sql);
                                while ($product = mysqli_fetch_assoc($result)) { ?>
                                    <div class="card mt-4">
                                        <center><img class="card-img-top img-fluid mt-2" src="IMAGES/furniture/<?php echo $product['File'] ?>" alt="" style="height:50vh; width:40%"></center>
                                        <div class="card-body">
                                            <h3 class="card-title"><?php echo $product['Name'] ?></h3>
                                            <h4>Price: Ksh
                                                <?php echo $product['Price'];
                                                ?></h4>
                                            <form action="" method="post" style="float:right">
                                                <input type="text" name="Id" id="" value="<?php echo $product['Id'] ?>" hidden>
                                                <input type="text" name="Name" id="" value="<?php echo $product['Name'] ?>" hidden>
                                                <input type="text" name="user_id" id="" value="<?php echo $_SESSION['Id'] ?>" hidden>
                                                <input type="text" name="Price" id="" value="<?php echo $product['Price'] ?>" hidden>
                                                <button type="submit" class="btn btn-success d-block">Purchase Product</button>
                                            </form>
                                            <p class="card-text"><b> Description: </b><?php echo $product['Description'] ?></p>
                                            <span class="text-warning mb-2">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                                            4.0 stars
                                        </div>
                                    </div>
                                    <div class="card mt-1">
                                        <div class="card-header">
                                            <h4>Similar Products</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row d-flex justify-content-start">
                                                <?php
                                                $product_type = $product['Category'];

                                                $sql = "SELECT * FROM `products` WHERE `Category` = '$product_type'";
                                                $result = mysqli_query($conn, $sql);
                                                while ($product = mysqli_fetch_assoc($result)) { ?>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                        <div class="card text-dark mb-3" style="background-color:white; height:auto">
                                                            <center> <a href="single.php?name=<?php echo $product['Name'] ?>" style="text-decoration:none">
                                                                    <img class=" shadow card-img-top mt-1" src="IMAGES/furniture/<?php echo $product['File'] ?>" alt="" style="width:90%; height:190px">
                                                                </a>
                                                            </center>
                                                            <div class="card-body">
                                                                <a href="single.php?name=<?php echo $product['Name'] ?>" style="text-decoration: none;">
                                                                    <h6 class="card-title" style="text-align:center"><?php echo $product['Name'] ?></h6>
                                                                </a>
                                                                <div class="row">
                                                                    <div class="col-lg-7 pt-2">
                                                                        PRICE: Ksh
                                                                        <?php echo $product['Price'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <form action="" method="post">
                                                                    <input type="text" name="Id" id="" value="<?php echo $product['Id'] ?>" hidden>
                                                                    <input type="text" name="Name" id="" value="<?php echo $product['Name'] ?>" hidden>
                                                                    <input type="text" name="user_id" id="" value="<?php echo $_SESSION['Id'] ?>" hidden>
                                                                    <input type="text" name="Price" id="" value="<?php echo $product['Price'] ?>" hidden>
                                                                    <button type="submit" style="size:small" class="shadow btn btn-success"> Purchase Product</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>

                            <?php
                                }
                            }

                            ?>

                        </div>

                    </div>
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
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>