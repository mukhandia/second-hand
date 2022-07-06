<?php
include("../server/connect.php");
$message = "";
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_Id = $_POST['user_id'];
    $product_Id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $sql = "SELECT * FROM `tblorder` WHERE `customer_id` = '$user_Id' AND `product_id` = '$product_Id'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $sql = "SELECT * FROM `tblorder` WHERE `customer_id` = '$user_Id'";
            if ($result = mysqli_query($conn, $sql)) {
                $num = mysqli_num_rows($result);
                $Message = "Product Already Added!!";

            }
        } else {
            $sql = "INSERT INTO `tblorder` (`customer_id`,`product_id`,`product_name`,`Quantity`,`order_status`,`product_price`,`Amount`) VALUES('$user_Id','$product_Id','$product_name',1,'Received', '$product_price', '$product_price')";
            if ($result = mysqli_query($conn, $sql)) {
                $message = '<div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i> ORDER ADDED TO CART</strong>
                    </div>';
                $sql = "SELECT * FROM `tblorder` WHERE `customer_id` = '$user_Id'";
                if ($result = mysqli_query($conn, $sql)) {
                    $num = mysqli_num_rows($result);
                    $Message = "Product Added Successfully";
                }
            } else {
                $Message = '<div class="alert alert-danger" role="alert">
                <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> UKNOWN ERROR ADDING PRODUCT TO CART ' . mysqli_error($conn) . '</strong>
                </div>';
            }
        }
    } else {
        echo "CONNECTION NOT SUCCESSFUL" . mysqli_error($conn);
    }
}
echo json_encode(["Number" => $num, "Message" => $Message]);
