<?php
include("./config/config.php");
$pid = $_REQUEST['id'];
$sql = "DELETE FROM card WHERE id = {$pid}";
$result = mysqli_query($con, $sql);
if ($result == true) {
    header("Location:@cardList.php");
} else {
    header("Location:@cardList.php");
}
mysqli_close($con);
