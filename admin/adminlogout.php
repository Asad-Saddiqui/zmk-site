<?php
session_start();
unset($_SESSION['adminID']);
unset($_SESSION['adminEmail']);
unset($_SESSION['adminImg']);
unset($_SESSION['adminName']);
header('location:../login.php');


?>