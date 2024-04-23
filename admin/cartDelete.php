<?php
include("./config/config.php");
$pid = $_REQUEST['id'];

$sql = "SELECT * FROM oder where  id ={$pid}";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$qty = (int)$row['Quantity'];
$vfy = (int)$row['varify'];


if ($vfy === 0 && $qty === 0) {
    $cart = $row['purchaseID'];
    $sql1 = "DELETE FROM oder WHERE id = {$pid}";
    $result2 = mysqli_query($con, $sql1);
    header("Location:membership.php");
} else {
    header("Location:membership.php");
}
mysqli_close($con);
