<?php
include("./config/config.php");
$pid = $_REQUEST['id'];
$url = $_REQUEST['url'];
$sql = "DELETE FROM news WHERE id = {$pid}";
$result = mysqli_query($con, $sql);
if ($result == true) {
    unlink("./common/user/$url");
    header("Location:news_list.php");
} else {
    header("Location:news_list.php");
}
mysqli_close($con);
