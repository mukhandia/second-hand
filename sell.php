<?php
include('components/session_user.php');
include('server/connect.php');
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['P_name'];
    $Category = $_POST['Category'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];

    $filename = $_FILES['File']['name'];
    $tmp_name = $_FILES['File']['tmp_name'];
    $folder = "ADMIN/IMAGES/products/" . $filename;

    $sql = "SELECT * FROM `products` WHERE `Name` = '$name'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($name == $row['Name']) {
                    $message = '<div class="alert alert-danger" role="alert">
                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Product Already Added </strong>
                    </div>';
                }
            }
        } else {

            $sql = "INSERT INTO `products`(`Name`,`Category`, `Description`, `Price`, `File`) VALUES ('$name','$Category','$Description','$Price','$filename')";
            if ($result = mysqli_query($conn, $sql)) {
                $message = '<div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i> Product Added Successfuly</strong>
                    </div>';
                if (move_uploaded_file($tmp_name, $folder)) {
                } else {
                    $message = "FAILED TO UPLOAD IMAGE";
                }
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
    <link rel="stylesheet" href="css/search.css">
    <title>
        Sell With Us
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

                        <div class="shadow-lg col-lg-9 mx-auto bg-light my-3">
                            <div class="intro-text my-3">
                                Do you have anything to sell Enter the details of your product on the form displayed below and we will help you to find market for your product.
                            </div>
                            <form id="myform" action="" method="post" enctype="multipart/form-data">
                                <div class="row mx-2">
                                    <div class="col form-group">
                                        <label for="" style="font-weight:700;"> Product Name</label>
                                        <input type="text" name="P_name" id="name" class="form-control" placeholder="" aria-describedby="helpId" autocomplete="off" required>

                                    </div>
                                    <div class="col form-group">
                                        <label for="" style="font-weight:700;">Category</label>
                                        <select class="form-control" name="Category" id="">
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
                                        <input type="textarea" name="Description" id="password" autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" required>
                                    </div>
                                    <div class="col form-group mt-3 mb-3">
                                        <label for="" style="font-weight:700;">Price</label>
                                        <input type="text" id="" name="Price" autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" required>

                                    </div>
                                </div>
                                <div class="ml-3 form-group mt-3">
                                    <label for="" style="font-weight:700;">Upload Product Photo</label>
                                    <input type="file" class="form-control mb-1" name="File" id="" placeholder="" aria-describedby=" fileHelpId" style="padding-bottom: 2px;">
                                </div>
                                <center><button type="submit" class="btn btn-success my-4" style="font-size:14px;">Publishs Product</button>
                                </center>
                            </form>
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
                        <span>Copyright &copy; Second Hand Commodity Enterprise 2022</span>
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