<?php

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

    $sql = "SELECT * FROM `users` WHERE `Customer Username` = '$username'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($username == $row['Customer Username']) {
                    $message = '<div class="alert alert-danger" role="alert">
                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> USERNAME ALREADY USED </strong>
                    </div>';
                }
            }
        } else {

            $sql = "INSERT INTO `users`(`Customer Name`, `Customer Username`, `Email`, `Password`, `File`) VALUES ('$name','$username','$email','$pass','$filename')";
            if ($result = mysqli_query($conn, $sql)) {
                $message = '<div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>  REGISTRATION SUCCESSFUL</strong>
                    </div>';
                    header("location:login.php");
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
    </div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <?php include('components/links.php') ?>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>REGISTRATION PAGE</title>
    <link rel="icon" href="IMAGES/comp/favicon.ico" type="image/x-icon" />
</head>

<body style="background-color:whitesmoke;">
    <div class="col-lg-6 mx-auto mt-5 py-2" style="background-color:lightgreen;border:3px solid gray;box-shadow:2px 2px 10px ;">
        <h6 style="text-align: center; font-weight:900">REGISTRATION FORM</h6>
        <center>
            <img src="logo2.jpg" alt="" style="width:45%;height:30vh;">
        </center>
        <?php echo $message ?>
        <form id="myform" action="" method="post" enctype="multipart/form-data">
            <div class="row mx-2">
                <div class="col form-group">
                    <label for="" style="font-weight:700;">Enter your Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId" autocomplete="off" value="<?php echo $name ?>" required>
                    <p id="namecheck" class="error-msg mt-2  pt-1 pb-1 " style="color: red; background-color:#fee;width:auto;border-radius:2px"></p>
                </div>
                <div class="col form-group">
                    <label for="" style="font-weight:700;">Username</label>
                    <input type="text" name="Username" id="username" class="form-control" placeholder="" aria-describedby="helpId" autocomplete="off" value="<?php echo $username ?>" required>
                    <p id="usernamecheck" class="error-msg mt-2  pt-1 pb-1 " style="color: red; background-color:#fee;width:auto;border-radius:2px"></p>
                </div>
            </div>
            <div class="row mx-2">
                <div class="col form-group mt-3 mb-3">
                    <label for="" style="font-weight:700;">Password</label>
                    <input type="password" name="Pass" id="password" autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" value="<?php echo $pass ?>" required>
                    <p id="passcheck" style="color: red;">
                        **Please Fill the password
                    </p>
                </div>
                <div class="col form-group mt-3 mb-3">
                    <label for="" style="font-weight:700;"> Confirm Password</label>
                    <input type="password" id="conpassword" autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" value="<?php echo $pass ?>" required>
                    <p id="conpasscheck">
                        **Password didn't match
                    </p>
                </div>
            </div>
            <div class="row ml-2">
                <div class="col form-group mt-3 mb-3">
                    <label for="" style="font-weight:700;"> Enter Your Email</label>
                    <input type="email" name="Email" autocomplete="off" id="Email" class="form-control" value="<?php echo $email ?>" placeholder="" aria-describedby="helpId">
                    <p id="emailcheck" style="color:red">
                        **Invalid Email
                    </p>
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
    <script>
        $(document).ready(function() {
            $(".alert").hide(slow);
        });
    </script>
    <script src="js/register.js"></script>
</body>

</html>