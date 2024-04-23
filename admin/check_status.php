<?php
// require('../admin/config/config.php');

function propertyStatus($con, $pid, $qey)
{
    $sql = "SELECT * FROM `complete` WHERE pid='$pid'";
    $sqli = mysqli_query($con, $sql);
    $row_num = mysqli_num_rows($sqli);
    $row = mysqli_fetch_assoc($sqli);
    if ($row_num === 1) {
        $res = mysqli_query($con, $qey);
        $sql_ = "SELECT * FROM `complete` WHERE pid='$pid'";
        $sqli_ = mysqli_query($con, $sql_);
        $row_ = mysqli_fetch_assoc($sqli_);
        $one = (int)$row_['1'];
        $two = (int)$row_['2'];
        $three = (int)$row_['3'];
        $four = (int)$row_['4'];
        $five = (int)$row_['5'];
        $six = (int)$row_['6'];
        if ($one === 1 && $two === 1 && $three === 1 && $four === 1 && $five === 1 && $six === 1) {
            $sqli = "UPDATE `complete` SET `status1` = 'Complate' WHERE `complete`.`pid` = '$pid'";
            $res = mysqli_query($con, $sqli);
            return "Complate";
            // echo "<script>alert('hjasjdlkasjd')</script>";
        } else {
            return "Incomplate";
            // echo "<script>alert('hjasjdlkasjd')</script>";
        }
    } else {
        $sqli = mysqli_query($con, $qey);
        return "Incomplate";
    }
}
