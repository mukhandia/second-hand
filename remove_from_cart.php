<?php
include("server/connect.php");
include("components/links.php");
include('server/connect.php');
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['order_id'];
    // echo $menu_id;
    $user_Id = $_POST['user_Id'];
    // echo $user_Id;
    $sql = "SELECT * FROM `tblorder` WHERE product_id = '$product_id' and customer_id = '$user_Id'";
    if ($results = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($results)) {
            $order_id = $row['order_id'];
            $sql = "DELETE FROM `tblorder` WHERE `order_id` = '$order_id'";
            if ($result = mysqli_query($conn, $sql)) {
                $message = '<div class="alert alert-success" role="alert">
            <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i> Successfully Removed the product</strong>
            </div>';
                header("Location:cart.php");
            } else {
                $message = '<div class="alert alert-danger" role="alert">
                <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Sorry, You cannot make the request at this time' . mysqli_error($conn) . '</strong>
                </div>';
                header("Location:cart.php");
            }
        }
    } else {
        $message = '<div class="alert alert-danger" role="alert">
           <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Sorry, You cannot make the request at this time' . mysqli_error($conn) . '</strong>
            </div>';
    }
}
echo $message;
