<?php
include("server/connect.php");
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    // echo $order_id . "<br>";

    $sql = "SELECT * FROM `tblorder` WHERE  `tblorder`.`order_id` = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($Quantity = mysqli_fetch_assoc($result)) {
            $price = $Quantity['product_price'];
            if ($Quantity['Quantity'] > 2) {
                // $message = '<div class="alert alert-danger" role="alert">
                // <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Sorry, You can only not more than 3 bookings on this menu!!</strong>
                // </div>';
                header("Location:cart.php?ERROR=You can only make a maximum of three bookings.");
            } else {
                $order_id = $Quantity['order_id'];
                $Quantity = $Quantity['Quantity'];
                $newQuantity = $Quantity + 1;
                $Amount = $newQuantity * $price;

                echo $Amount;

                $sql = "UPDATE `tblorder` SET `Quantity`='$newQuantity',`Amount`='$Amount' WHERE `tblorder`.`order_id` = '$order_id'";
                if ($exp_result = mysqli_query($conn, $sql)) {
                    $message = '<div class="alert alert-success" role="alert">
                    <strong><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i> Successfully added another product</strong>
                    </div>';
                    header("Location:cart.php");
                } else {
                    $message = '<div class="alert alert-danger" role="alert">
                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error Adding Another Product' .  mysqli_error($conn) . '</strong>
                    </div>';
                    header("Location:cart.php");
                }
            }
        }
    }
}
echo $message;
