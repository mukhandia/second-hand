<?php
$UserId = $_SESSION['Id'];
$sql = "SELECT product_id FROM `tblorder` WHERE `customer_id` =  '$UserId'";
$cart = mysqli_query($conn, $sql);
if (mysqli_num_rows($cart) > 0) {
} else {
    header("Location:index.php?message = No Items in The Cart");
}
