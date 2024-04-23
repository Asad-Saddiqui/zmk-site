<?php
require("./config/config.php");

function prop($con)
{
    $query = "SELECT * FROM property";
    $result = mysqli_query($con, $query);

    if ($result) {
        $num_row = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $date1 = (string)$row['listingDate'];
            $date2 = (string)$row['expireDate'];
            $result = compareDates($date1, $date2, $id, $con);
        };
    }
}

// Function to compare dates
function compareDates($date1, $date2, $id, $con)
{
    if (strtotime($date1) > strtotime($date2)) {
        $update = "UPDATE `property` SET `status` = '0' WHERE `property`.`id` = $id";
        $result = mysqli_query($con, $update);
    }
}
