<?php
session_start();
include("../admin/config/config.php");
include('./validateUser.php');
include('./propertyDeleteCommon.php');

if (!isset($_SESSION['agentEmail'])) {
    header("location:../login.php");
}
$validate = validate($_SESSION['agentEmail'], $_SESSION['agentID'], $con);
if ($validate !== true) {
    header("location:../login.php");
}

$pid = $_REQUEST['id'];
$check = DeleteProperty($pid, $con);
if ($CHECK == true) {
    header("Location:-view-pro.php");
} else {
    header("Location:-view-pro.php");
}
mysqli_close($con);