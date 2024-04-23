<?php
include("./config/config.php");
$pid = $_REQUEST['id'];
$sql = "DELETE FROM feedback WHERE id = {$pid}";
$result = mysqli_query($con, $sql);
if ($result == true) {
    header("Location:feedback.php");
} else {
    header("Location:feedback.php");
}
mysqli_close($con);
