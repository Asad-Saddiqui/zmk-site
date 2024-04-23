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
$uid = $_SESSION['agentID'];

$cartid = $_REQUEST['id'];
$delete = "DELETE FROM oder WHERE `oder`.`id` = $cartid AND `oder`.`uid`=$uid";
mysqli_query($con,$delete);
header("Location:Purchase_card_list.php");

mysqli_close($con);
