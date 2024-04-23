<?php


function expire($con)
{
    $expire = mysqli_query($con, "SELECT * FROM property ");
    while ($rowexpire = mysqli_fetch_assoc($expire)) {
        $id_ = $rowexpire['id'];
        $current_ = (string)date("Y-m-d H:i:s");
        $date2i = (string)$rowexpire['expireDate'];

        if (strtotime($date2i) < strtotime($current_)) {

            $updateL = "UPDATE `property` SET `status` = '0' WHERE `property`.`id` = $id_";
            $resultL = mysqli_query($con, $updateL);
            if (!$resultL) {
                echo "Error updating record: ";
            }
        }
    }
}

