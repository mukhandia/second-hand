<?php
session_start();
unset($_SESSION["Id"]);
header("Location:login.php");
