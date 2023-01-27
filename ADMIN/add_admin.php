<?php

// include("components/session.php");
include("server/connect.php");
$message = "";
$name = "";
$username = "";
$pass = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['Username'];
    $pass = $_POST['Pass'];
    $email = $_POST['Email'];

    $filename = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $folder = "IMAGES/users/" . $filename;

    $sql = "SELECT * FROM `admin` WHERE  `username` = '$username'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($username == $row['username']) {
                    $message = '<div class="alert alert-danger my-1" role="alert">
                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> USERNAME ALREADY USED </strong>
                    </div>';
                }
            }
        } else {

            $sql = "INSERT INTO `admin`(`full_name`,  `username`, `email_address`, `password`, `profile_image`         
            ) VALUES ('$name','$username','$email','$pass','$filename')";
            if ($result = mysqli_query($conn, $sql)) {
                $message = '<div class="alert alert-success my-1" role="alert">
                    <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>ADMINISTRATOR REGISTRATION SUCCESSFUL</strong>
                    </div>';
                if (move_uploaded_file($tmp_name, $folder)) {
                } else {
                    $msg = "FAILED TO UPLOAD IMAGE";
                }
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
    <title>add admin</title>
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
                            <div class="col-lg-11 mx-auto mt-3 py-2" style="background-color:whitesmoke;border:1px solid orange;box-shadow:2px 2px 10px ;">
                                <h6 style="text-align: center; font-weight:900">Add Administrator</h6>
                                <center>
                                    <img src="logo2.jpg" alt="" style="width:40%;height:30vh;">
                                </center>
                                <?php echo $message ?>
                                <form id="myform" action="" method="post" enctype="multipart/form-data">
                                    <div class="row mx-2">
                                        <div class="col form-group">
                                            <label for="" style="font-weight:700;">Enter Administrator Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId" autocomplete="off" value="<?php echo $name ?>" required>

                                        </div>
                                        <div class="col form-group">
                                            <label for="" style="font-weight:700;">Username</label>
                                            <input type="text" name="Username" id="username" class="form-control" placeholder="" aria-describedby="helpId" autocomplete="off" value="<?php echo $username ?>" required>

                                        </div>
                                    </div>
                                    <div class="row mx-2">
                                        <div class="col form-group mt-3 mb-3">
                                            <label for="" style="font-weight:700;">Password</label>
                                            <input type="password" name="Pass" id="password" autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" value="<?php echo $pass ?>" required>

                                        </div>
                                        <div class="col form-group mt-3 mb-3">
                                            <label for="" style="font-weight:700;"> Confirm Password</label>
                                            <input type="password" id="conpassword" autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" value="<?php echo $pass ?>" required>

                                        </div>
                                    </div>
                                    <div class="row ml-2">
                                        <div class="col form-group mt-3 mb-3">
                                            <label for="" style="font-weight:700;"> Enter Email</label>
                                            <input type="email" name="Email" autocomplete="off" id="Email" class="form-control" value="<?php echo $email ?>" placeholder="" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="row ml-2">
                                        <div class="col form-group mt-3 mb-3">
                                            <label for="" style="font-weight:700;"> Enter Position</label>
                                            <input type="email" name="text" autocomplete="off" id="Email" class="form-control" value="<?php echo $email ?>" placeholder="" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="ml-3 form-group">
                                        <label for="" style="font-weight:700;">Upload Your Photo (Optional)</label>
                                        <input type="file" class="form-control" name="file" id="" placeholder="" value="<?php echo $filename ?> aria-describedby=" fileHelpId" style="padding-bottom: 2px;">
                                    </div>
                                    <center><button type="submit" class="btn btn-success" style="width: 30%;">Register</button>
                                    </center>
                                </form>
                                <p>If you have not registered <a href="login.php"> click here</a></p>
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
    <!-- <script src="js/demo/datatables-demo.js"></script> -->
</body>

</html>