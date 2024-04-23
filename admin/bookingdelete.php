<?php
session_start();
require("./config/config.php");
////code

if (!isset($_SESSION['adminEmail'])) {
	header("location:../login.php");
}
$pid = $_GET['id'];
$sql = "DELETE FROM booking WHERE id = {$pid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	$msg="<p class='alert alert-success'>Property Deleted</p>";
	header("Location:bookinginfo.php");
}
else{
	$msg="<p class='alert alert-warning'>Property Not Deleted</p>";
	header("Location:bookinginfo.php");
}
mysqli_close($con);
?>