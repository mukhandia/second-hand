<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopi";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_REQUEST['term'])) {
    $sql = "SELECT * FROM `tblpayment` WHERE `payment_date` LIKE ? ";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        $param_term = $_REQUEST["term"] . '%';
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<p>" . $row['payment_date'] . "</p>";
                }
            } else {
            }
        } else {
            echo "ERROR: Could not be able to execute $sql" . mysqli_error($conn);
        }
    }
}
