<?php
// DELETE property,comments,communityf,complete,healthcare,main_features,nearbylocation,otherfacilities,plot,propertyimages,propviews,rooms,url FROM property LEFT JOIN comments ON comments.pid = property.id LEFT JOIN communityf ON communityf.pid = property.id LEFT JOIN complete ON complete.pid = property.id LEFT JOIN healthcare ON healthcare.pid = property.id LEFT JOIN main_features ON main_features.pid = property.id LEFT JOIN nearbylocation ON nearbylocation.pid = property.id LEFT JOIN otherfacilities ON otherfacilities.pid = property.id LEFT JOIN plot ON plot.pid = property.id LEFT JOIN propertyimages ON propertyimages.pid = property.id LEFT JOIN propviews ON propviews.pid = property.id LEFT JOIN rooms ON rooms.pid = property.id LEFT JOIN url ON url.pid = property.id WHERE property.id = 89;
function DeleteProperty($pid, $con)
{
    $images = "SELECT * FROM propertyimages WHERE pid=$pid;";
    $result_ = mysqli_query($con, $images);
    $imageFolder = "./uploads/";
    if ($result_) {
        while ($row = mysqli_fetch_assoc($result_)) {
            $imageName = $row['name'];
            $imagePath = $imageFolder . $imageName;
            unlink($imagePath);
        }
    }
    $sqli = "DELETE property, comments, communityf, complete, healthcare, main_features,
        nearbylocation, otherfacilities, plot, propertyimages, propviews, rooms, url
        FROM property
        LEFT JOIN comments ON comments.pid = property.id
        LEFT JOIN communityf ON communityf.pid = property.id
        LEFT JOIN complete ON complete.pid = property.id
        LEFT JOIN healthcare ON healthcare.pid = property.id
        LEFT JOIN main_features ON main_features.pid = property.id
        LEFT JOIN nearbylocation ON nearbylocation.pid = property.id
        LEFT JOIN otherfacilities ON otherfacilities.pid = property.id
        LEFT JOIN plot ON plot.pid = property.id
        LEFT JOIN propertyimages ON propertyimages.pid = property.id
        LEFT JOIN propviews ON propviews.pid = property.id
        LEFT JOIN rooms ON rooms.pid = property.id
        LEFT JOIN url ON url.pid = property.id
        WHERE property.id = $pid;";
    $result = mysqli_query($con, $sqli);
    return true;
}
