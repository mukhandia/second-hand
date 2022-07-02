<?php
session_start();
if ($_SESSION['Id'] == "") {
    header("Location:login.php");
}
