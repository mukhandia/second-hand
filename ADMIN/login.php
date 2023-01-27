<?php
include("server/connect.php");
$message = "";
$name = "";
$pass = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `admin` WHERE `username` = '$name'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($pass == $row['password']) {
                    $message = '<div class="alert alert-success" role="alert">
                    <strong>Login Successful</strong>
                    </div>';
                    session_start();
                    $_SESSION["admin"] = $row['Id'];
                    header("Location:dashboard.php");
                } else {
                    $message = '<div class="alert alert-danger" role="alert">
                    <strong>Wrong Password</strong>
                    </div>';
                }
            }
        } else {
            $message = '<div class="alert alert-danger" role="alert">
            <strong>Admin Does not Exist</strong>
            </div>';
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
    <title>LOGIN PAGE</title>
    <link rel="icon" href="../IMAGES/comp/favicon.ico" type="image/x-icon" />

</head>

<body style="background-color:whitesmoke;">
    <div class="col-5 mx-auto mt-5 py-2" style="background-color:lightgreen;border:3px solid gray;box-shadow:2px 2px 10px ;">
        <h6 style="text-align: center;">ADMIN LOGIN FORM</h6>
        <center>
            <img src="logo2.jpg" alt="" style="width:45%;height:30vh;">
        </center>
        <div class="message my-1">
            <?php echo $message ?>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="user" id="" value="<?php echo $name ?>" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="pass" id="" value="<?php echo $pass ?>" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <center>
                <button type="submit" class="btn btn-primary">Submit</button>
            </center>
        </form>

    </div>
    <script>
        $(document).ready(function() {
            $(".alert").hide(slow);
        });
    </script>
</body>

</html>