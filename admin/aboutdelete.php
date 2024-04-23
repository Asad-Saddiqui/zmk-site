<?php
include("config.php");
$aid = $_REQUEST['id'];
$sql = "DELETE FROM about WHERE ab_id = {$aid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	$msg="<p class='alert alert-success'>about Deleted</p>";
	header("Location:aboutview.php?msg=$msg");
}
else{
	$msg="<p class='alert alert-warning'>about Not Deleted</p>";
	header("Location:aboutview.php?msg=$msg");
}
mysqli_close($con);
?>
