<?php
include("./config/config.php");
$pid = $_REQUEST['id'];
$sql = "DELETE FROM contact WHERE conid = {$pid}";
$result = mysqli_query($con, $sql);
if ($result == true) {
    header("Location:contact.php");
} else {
    header("Location:contact.php");
}
mysqli_close($con);
