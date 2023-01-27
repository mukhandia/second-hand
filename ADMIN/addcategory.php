<?php
// include('components/session.php');
include("server/connect.php");
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['C_name'];
    // $Category = $_POST['Category'];
    $Description = $_POST['Description'];
    // $Price = $_POST['Price'];

    // $filename = $_FILES['File']['name'];
    // $tmp_name = $_FILES['File']['tmp_name'];
    // $folder = "IMAGES/products/" . $filename;

    $sql = "SELECT * FROM `product_categories` WHERE `categoryName` = '$name'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($name == $row['categoryName']) {
                    $message = '<div class="alert alert-danger" role="alert">
                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Category Already Added </strong>
                    </div>';
                }
            }
        } else {
            $sql = "INSERT INTO `product_categories`(`categoryName`, `categoryDescription`) VALUES ('$name','$Description')";
            if ($result = mysqli_query($conn, $sql)) {
                $message = '<div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i> Category Added Successfuly</strong>
                    </div>';
                
            }
        }
    } else {
        $message = "CONNECTION NOT SUCCESSFUL" . mysqli_error($conn);
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
    <title>add product category</title>
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
                    <div class="row">
                        <div class="col-lg-8 mx-auto my-3">
                            <h4 class="mt-2 text-dark mx-auto mb-2" style="font-weight:900 ;text-align:center;">Add Category</h4>
                            <div class="my-2">
                                <?php echo $message ?>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $(".alert").hide(2000);
                                })
                            </script>
                            <form id="myform" action="" method="post" enctype="multipart/form-data">
                                <div class="row mx-2">
                                    <div class="col form-group">
                                        <label for="" style="font-weight:700;">Enter the Category Name</label>
                                        <input type="text" name="C_name" id="name" class="form-control" placeholder=" Category Name" aria-describedby="helpId" autocomplete="off" required>

                                    </div>
                                </div>

                                <div class="row mx-2">
                                    <div class="col form-group mt-3 mb-3">
                                        <label for="" style="font-weight:700;"> Cateory Description</label>
                                        
                                        <textarea type="textarea" size="7" name="Description" id="password" autocomplete="off" class="form-control" placeholder="Category Description" aria-describedby="helpId" required></textarea>
                                    </div>
                                   
                                </div>
                                <center><button type="submit" class="btn btn-success mt-4" style="width: 30%;">Save Category</button>
                                </center>
                            </form>
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

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>