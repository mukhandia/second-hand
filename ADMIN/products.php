<?php
// include('components/session.php');
include("server/connect.php");

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];
    $name = $_POST['P_name'];
    $Category = $_POST['Category'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];
    $Design = $_POST['Design'];


    $sql = "UPDATE `products` SET `Name`='$name',`Category`='$Category',`Description`='$Description',`Design`='$Design',`Price`='$Price' WHERE `Id`='$productId'";
    if ($result = mysqli_query($conn, $sql)) {
        $message = '<div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i> Product Added Successfuly</strong>
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
    <title>products</title>
    <link rel="icon" href="../IMAGES/comp/favicon.ico" type="image/x-icon" />

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
                        <h1 class="h3 mb-2 text-gray-800">Products Tables</h1>
                        <p class="mb-4">This tables contains all the information that are there in the database regardin the products we sell. It is detailed and easy to update ad delete products. It helps the admin access the products to ascertain the effectiveness of each and every of them</p>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 ">
                                <div class="mr-auto">
                                    <a href="insertProduct.php" style="float:right"><button type="button" class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> ADD PRODUCT</button></a>
                                </div>
                                <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                $sql = "SELECT * FROM products ORDER BY `products`.`Id` DESC";
                                $result = mysqli_query($conn, $sql); ?>
                                <div class="table-responsive">
                                    <table class="mr-5 table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>N/M</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tfoot>
                                            <?php
                                            $num =  1;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <th><?php echo $num ?></th>
                                                    <th> <img src="IMAGES/products/<?php echo $row['File'] ?>" alt="" style="width:80px; height:80px;"></th>
                                                    <th><?php echo $row['Name'] ?></th>
                                                    <th><?php echo $row['Category'] ?></th>
                                                    <th style="width:200px; height:80px;"><?php echo $row['Description'] ?></th>
                                                    <th style="width:80px; height:80px;"><?php echo $row['Price'] ?></th>
                                                    <th>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <button type="button" class="btn btn-success px-1" data-toggle="modal" data-target="#product_modal<?php echo $row['Id'] ?>">Update</button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="product_modal<?php echo $row['Id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Update Product</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <center>
                                                                                    <img src="IMAGES/products/<?php echo $row['File'] ?>" alt="" style="width:60%; height:50vh;">
                                                                                    <form id="myform" class="my-2" action="" method="post" enctype="multipart/form-data">
                                                                                        <div class="row mx-2">
                                                                                            <div class="col form-group">
                                                                                                <label for="" style="font-weight:700;">Enter the Product Name</label>
                                                                                                <input type="text" name="P_name" id="name" class="form-control" placeholder="" value="<?php echo $row['Name'] ?>" aria-describedby="helpId" autocomplete="off" required>

                                                                                            </div>
                                                                                            <div class="col form-group" <div class="form-group">
                                                                                                <label for="">Category</label>
                                                                                                <select class="form-control" name="Category" id="" value="<?php echo $row['Category'] ?>">
                                                                                                    SELECT<option value="" disabled>--SELECT--</option>
                                                                                                    <option value="Furniture">Furniture</option>
                                                                                                    <option value="Electronics">Electronics</option>
                                                                                                    <option value="Utensils">Utensils</option>
                                                                                                    <option value="Gas Cylinders">Gas Cylinders</option>
                                                                                                </select>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="row mx-2">
                                                                                            <div class="col form-group mt-3 mb-3">
                                                                                                <label for="" style="font-weight:700;">Description</label>
                                                                                                <input type="textarea" name="Description" id="password" autocomplete="off" value="<?php echo $row['Description'] ?>" class="form-control" placeholder="" aria-describedby="helpId" required>
                                                                                            </div>
                                                                                            <div class="col form-group mt-3 mb-3">
                                                                                                <label for="" style="font-weight:700;">Price</label>
                                                                                                <input type="text" id="" name="Price" value="<?php echo $row['Price'] ?>" autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" required>

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mx-2">
                                                                                            <div class="col-lg-6 form-group mt-3 mb-3">
                                                                                                <label for="" style="font-weight:700;">Design</label>
                                                                                                <input type="textarea" name="Design" id="password" autocomplete="off" value="<?php echo $row['Design'] ?>" class="form-control" placeholder="" aria-describedby="helpId" required>
                                                                                            </div>
                                                                                            <div class="col-lg-6 form-group mt-3 mb-3">
                                                                                                <label for="" style="font-weight:700;">Product Id</label>
                                                                                                <input type="textarea" name="productId" id="password" autocomplete="off" value="<?php echo $row['Id'] ?>" class="form-control" placeholder="" aria-describedby="helpId" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <center><button type="submit" class="btn btn-success mt-4" style="width: 30%;">Update Product</button>
                                                                                        </center>
                                                                                    </form>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <a href="?productId=<?php echo $row['Id'] ?> "><button type="button" class="btn btn-danger px-1 mr-1">Delete</button></a>
                                                            </div>

                                                        </div>
                                                    </th>
                                                </tr>
                                            <?php
                                                $num++;
                                            }
                                            ?>
                                        </tfoot>
                                        </tbody>
                                        <?php
                                        if (isset($_GET['productId'])) {
                                            $del_productId = $_GET['productId'];
                                            $sql = "DELETE FROM products WHERE Id = $del_productId;";
                                            $result = mysqli_query($conn, $sql);
                                            if (!$result) {
                                                $message = '<div class="alert alert-alert" role="alert">
                                                <strong><i class="fa fa-exclamation" style="color:green" aria-hidden="true"></i> Product Added Successfuly</strong>
                                                </div>';
                                            } else {
                                                $message = '<div class="alert alert-success" role="alert">
                                                <strong><i class="fa fa-check" style="color:green" aria-hidden="true"></i> Product Deleted Successfuly</strong>
                                                </div>';
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Bootstrap core JavaScript-->

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/datatables-demo.js"></script> -->

</body>

</html>