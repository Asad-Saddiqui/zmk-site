<?php
session_start();
include("./config/config.php");
$aid = $_GET['id'];
$sqliquery = "SELECT * FROM user where id='$aid'";
$res2 = mysqli_query($con, $sqliquery);
$row_num2 = mysqli_num_rows($res2);
$row_ = mysqli_fetch_assoc($res2);
if ($row_num2 > 0) {
	$sql = "DELETE user, profile FROM user LEFT JOIN profile ON profile.uid = user.id WHERE `user`.`id` = '$aid'";
	$sqlup = "UPDATE `property` SET `status` = '0' WHERE `property`.`uid` = $aid;";
	$result1 = mysqli_query($con, $sqlup);
	$result = mysqli_query($con, $sql);
	unlink('./common/user/' . $row_['img']);
	header('location:adminlist.php');
}
// }
