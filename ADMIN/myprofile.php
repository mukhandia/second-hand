<?php
include('components/session.php');
include('server/connect.php');

$Message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Id = $_POST['admin_Id'];
    $admin_name = $_POST['admin_name'];
    $admin_username = $_POST['admin_username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE `admin` SET `full_name`='$admin_name',`username`='$admin_username',`email_address`='$email',`Address`='$address',`contact`='$phone_number' WHERE `Id`='$Id'";

    if ($res = mysqli_query($conn, $sql)) {
        $Message = '<span class="shadow my-1 bg-success py-2 px-3 " style="font-size:14px;color:white;border-radius:10px;">USER DETAILS UPDATED SUCCESSFULLY</span>';
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
    <title>My Profile</title>
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

                        $Id = $_SESSION['admin'];

                        $sql = "SELECT * FROM `admin` WHERE `admin`.`Id` =  '$Id'";
                        $result = mysqli_query($conn, $sql);
                        while ($menu = mysqli_fetch_assoc($result)) { ?>

                            <div class="col-lg-8 mx-auto my-2 pb-3" style="box-shadow:2px 2px 10px; height:auto;">
                                <center>
                                    <img src="IMAGES/users/<?php echo $menu['profile_image'] ?>" alt="" class="mt-2 mb-1" style="width: 200px;height:200px; border-radius:50%">
                                    <div class="mt-2 mb-1 error" style="width:100%">
                                        <?php echo $Message ?>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $(".alert").fadeOut(2000);
                                        })
                                    </script>
                                    <form action="" method="POST">
                                        <div class="form-row">
                                            <input type="text" name="Id" id="" value="<?php echo $menu['Id'] ?>" hidden>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationServer01">Admin Name</label>
                                                <input type="text" class="form-control" id="validationServer01" placeholder="First name" name="admin_name" value="<?php echo $menu['full_name'] ?>" required>
                                                <div class="name valid-feedback" id="name-valid-feedback">
                                                    Correct!
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationServerUsername">Admin Username</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="validationServerUsername" placeholder="Username" aria-describedby="inputGroupPrepend3" id="validationServerUsername" value="<?php echo $menu['username'] ?>" name="admin_username" required>
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
                                                <label for="validationServer03">Address</label>
                                                <input type="text" class="form-control" name="address" id="validationServer03" value="<?php echo $menu['Address'] ?>" required>
                                                <div class="address valid-feedback">
                                                    Correct!
                                                </div>
                                                <div class="addresscheck" id="addresscheck" style="color:red">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationServer04">Phone Number</label>
                                                <input type="text" class="form-control" id="validationServer04" placeholder="Phone Number" name="phone_number" value="<?php echo $menu['contact'] ?>" required>
                                                <div class="valid-feedback">
                                                    Correct!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationServer05">Admin Email</label>
                                                <input type="text" class="form-control" name="email" id="validationServer05" placeholder="Email" value="<?php echo $menu['email_address'] ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationServer05">Admin Id</label>
                                                <input type="text" class="form-control" name="admin_Id" id="validationServer05" placeholder="Email" value="<?php echo $menu['Id'] ?>" disabled>
                                            </div>
                                            <input type="text" class="form-control" name="admin_Id" id="validationServer05" placeholder="Email" value="<?php echo $menu['Id'] ?>" hidden>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Details</button>
                                    </form>
                                </center>
                            </div>
                        <?php

                        }
                        ?>

                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
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