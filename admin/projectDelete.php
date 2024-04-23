<?php
include("./config/config.php");
$id = $_GET['id'];
$sql_ = "SELECT * FROM projects WHERE project_id = {$id}";
$result_ = mysqli_query($con, $sql_);
$num = mysqli_num_rows($result_);
$row = mysqli_fetch_assoc($result_);
if ($num === 1) {
    $sql = "DELETE FROM projects WHERE project_id = {$id}";
    $result = mysqli_query($con, $sql);
    if ($result == true) {
        $img = $row['project_image'];
        $imges = $row['RequireDocuments'];
        $Noc = $row['Noc Related Image :'];
        $PricingDocument = $row['PricingDocument'];
        $deserializedArray = json_decode($imges);
    $count = count($deserializedArray);
    for ($i=0; $i <$count ; $i++) { 
        $_img=$deserializedArray[$i];
        unlink("./uploads/$_img");
    }
        unlink("./uploads/$PricingDocument");
        unlink("./uploads/$Noc");
        unlink("./uploads/$img");
        header("Location:projectlist.php");
    } else {
        header("Location:projectlist.php");
    }
}