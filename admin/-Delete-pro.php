<?php
include("./config/config.php");
include("./propertyDeleteCommon.php");
$pid = $_REQUEST['id'];
$CHECK = DeleteProperty($pid, $con);
if ($CHECK == true) {
    header("Location:-view-pro.php");
} else {
    header("Location:-view-pro.php");
}
mysqli_close($con);
