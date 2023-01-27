<?php
session_start();
// echo "Hello";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopi";

if ($conn = new mysqli($servername, $username, $password, $dbname)) {
} else {
    echo mysqli_error($conn);
}
