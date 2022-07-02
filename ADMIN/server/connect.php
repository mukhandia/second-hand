<?php
// echo "Hello";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "second_hand";

if ($conn = new mysqli($servername, $username, $password, $dbname)) {
} else {
    echo mysqli_error($conn);
}
