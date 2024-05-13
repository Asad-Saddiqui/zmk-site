<?php
session_start();
require("../admin/config/config.php");
include('./check_status.php');

// UPDATE `property` SET `size` = '1250' WHERE `property`.`id` = 1;
if (!isset($_SESSION['adminEmail'])) {
    header("location:index.php");
}

$pid = $_GET['PID'];
$uid = 1;

$query = "SELECT * FROM property WHERE id='$pid'";
$result = mysqli_query($con, $query);
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

if (trim($row['propertyType']) !== 'Plot') {
    header("location:-home-ammenities.php?PID=$pid");
}
$sqli = "SELECT * FROM plot where pid='$pid'";
$upRow = (int)mysqli_num_rows(mysqli_query($con, $sqli));
$updata = mysqli_fetch_assoc(mysqli_query($con, $sqli));

$sqli1 = "SELECT * FROM nearbylocation where pid='$pid'";
$upRow1 = (int)mysqli_num_rows(mysqli_query($con, $sqli1));
$updata1 = mysqli_fetch_assoc(mysqli_query($con, $sqli1));

$sqli2 = "SELECT * FROM otherfacilities where pid='$pid'";
$upRow2 = (int)mysqli_num_rows(mysqli_query($con, $sqli2));
$updata2 = mysqli_fetch_assoc(mysqli_query($con, $sqli2));

if (isset($_POST['saveData'])) {
    $nearbySchoolsValue = isset($_POST['nearbySchools']) ? $_POST['nearbySchools'] : '';
    $nearbyHospitalsValue = isset($_POST['nearbyHospitals']) ? $_POST['nearbyHospitals'] : '';
    $nearbyShoppingMallsValue = isset($_POST['nearbyShoppingMalls']) ? $_POST['nearbyShoppingMalls'] : '';
    $nearbyRestaurantsValue = isset($_POST['nearbyRestaurants']) ? $_POST['nearbyRestaurants'] : '';
    $nearbyPublicTransportServiceValue = isset($_POST['nearbyPublicTransportService']) ? $_POST['nearbyPublicTransportService'] : '';
    $distanceFromAirportValue = isset($_POST['distanceFromAirport']) ? $_POST['distanceFromAirport'] : '';
    $maintenanceStaffChecked = isset($_POST['maintenanceStaff']) ? 'Yes' : 'No';
    $securityStaffChecked = isset($_POST['securityStaff']) ? 'Yes' : 'No';


    $cornerValue = isset($_POST['corner']) ? 'Yes' : 'No';
    $disputedValue = isset($_POST['disputed']) ? 'Yes' : 'No';
    $ballotedValue = isset($_POST['balloted']) ? 'Yes' : 'No';
    $electricityValue = isset($_POST['electricity']) ? 'Yes' : 'No';
    $suiGasValue = isset($_POST['suiGas']) ? 'Yes' : 'No';

    $possessionValue = isset($_POST['possession']) ? 'Yes' : 'No';
    $parkFacingValue = isset($_POST['parkFacing']) ? 'Yes' : 'No';
    $sewerageValue = isset($_POST['sewerage']) ? 'Yes' : 'No';
    $waterSupplyValue = isset($_POST['waterSupply']) ? 'Yes' : 'No';
    $boundaryWallValue = isset($_POST['boundaryWall']) ? 'Yes' : 'No';




    if ($upRow === 1) {
        mysqli_query($con, "UPDATE `plot` 
    SET `corner` = '$cornerValue',
        `Disputed` = '$disputedValue',
        `Balloted` = '$ballotedValue',
        `Electricity` = '$electricityValue',
        `Sui Gas` = '$suiGasValue',
        `Possesion` = '$possessionValue',
        `Park Facing` = '$parkFacingValue',
        `Sewerage` = '$sewerageValue',
        `Water Supply` = '$waterSupplyValue',
        `Boundary Wall` = '$boundaryWallValue'
    WHERE `plot`.`pid` = '$pid'");
    } else {
        $sql = "INSERT INTO `plot` (`id`, `corner`, `Disputed`, `Balloted`, `Electricity`, `Sui Gas`, `Possesion`, `Park Facing`,
         `Sewerage`, `Water Supply`, `Boundary Wall`, `uid`, `pid`) 
         VALUES (NULL, '$cornerValue', '$disputedValue', '$ballotedValue', '$electricityValue', '$suiGasValue',
          '$possessionValue', '$parkFacingValue', '$sewerageValue', '$waterSupplyValue', '$boundaryWallValue', '$uid', '$pid')";
        mysqli_query($con, $sql);  // Execute the query for the 'plot' table
        propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");
    }


    if ($upRow1 === 1) {
        mysqli_query($con, "UPDATE `nearbylocation` 
    SET `Nearby Schools` = '$nearbySchoolsValue',
        `Nearby Hospitals` = '$nearbyHospitalsValue',
        `Nearby Shopping Malls` = '$nearbyShoppingMallsValue',
        `Nearby Restaurants` = '$nearbyRestaurantsValue',
        `Nearby Public Transport Service` = '$nearbyPublicTransportServiceValue',
        `Distance From Airport (kms)` = '$distanceFromAirportValue'
    WHERE `nearbylocation`.`pid` = '$pid'");
    } else {
        $sql2 = "INSERT INTO `nearbylocation` (`id`, `Nearby Schools`, `Nearby Hospitals`, `Nearby Shopping Malls`, `Nearby Restaurants`, `Nearby Public Transport Service`, `Distance From Airport (kms)`, `uid`, `pid`)
         VALUES (NULL, '$nearbySchoolsValue', '$nearbyHospitalsValue', '$nearbyShoppingMallsValue', '$nearbyRestaurantsValue', '$nearbyPublicTransportServiceValue', '$distanceFromAirportValue', '$uid', '$pid')";
        mysqli_query($con, $sql2);
        propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");
    }

    if ($upRow2 === 1) {
        // mysqli_query($con, "UPDATE `otherfacilities` SET `Maintenance Staff` = '$maintenanceStaffChecked',SET `Security Staff` = '$securityStaffChecked'WHERE `otherfacilities`.`pid` = '$pid;");
        mysqli_query($con, "UPDATE `otherfacilities` 
    SET `Maintenance Staff` = '$maintenanceStaffChecked',
        `Security Staff` = '$securityStaffChecked'
    WHERE `otherfacilities`.`pid` = '$pid'");
    } else {
        $sql3 = "INSERT INTO `otherfacilities` (`id`, `Maintenance Staff`, `Security Staff`, `uid`, `pid`) VALUES (NULL, '$maintenanceStaffChecked', '$securityStaffChecked', '$uid', '$pid')";
        mysqli_query($con, $sql3);
        propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");
    }
 $staus=(int)$row['status'];
if($staus===1){
    header("location:-view-pro.php");
}else{
    header("location:-propertyListing.php?id=$pid");
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>OB</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- datatable linl -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>
<style>
    .dataTables_wrapper .dataTables_length select {
        color: #7b7b7b;
    }
</style>
<style>
    * {
        scrollbar-width: auto;
        scrollbar-color: #EB1616 #191C24;
    }

    /* Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 16px;
    }

    *::-webkit-scrollbar-track {
        background: #191C24;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #EB1616;
        border-radius: 10px;
        border: 3px solid #191C24;
        height: 50px;
    }

    .mce-container-body {
        background: #111;
        color: #35ff00;
    }

    .mce-container {
        display: block;
        background-color: green;
    }
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content bg-dark">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>
            <div class="full-row   rounded bg-secondary" style="margin-top: 50px; margin-left: 25px; margin-right: 25px;">
                <form method="post" enctype="multipart/form-data" id="myForm">
                    <div class="d-flex justify-content-between">
                        <h2 class="mt-2 pt-2 text-center text-white">Add Ammenities</h2>
                        <h2 class="mt-2 text-center  border border-info p-3 text-info " style="border-radius: 50%;">6</h2>
                    </div>

                    <div class="container  rounded">

                        <div class="rounded-top p-4 bg-secondary m-3 border">
                            <ul class="nav nav-tabs" id="myTabs">
                                <li class="nav-item">
                                    <a class="nav-link text-info active" id="tab1" data-bs-toggle="tab" onclick="Tab1()" href="#content1">Plots Feature</a>
                                </li>




                                <li class="nav-item">
                                    <a class="nav-link text-info" id="tab6" data-bs-toggle="tab" onclick="Tab2()" href="#content6">Nearby Locations</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-info" id="tab7" data-bs-toggle="tab" onclick="Tab2()" href="#content7">Other Facilities

                                    </a>
                                </li>
                                <!-- Add more tabs as needed -->
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="content1">
                                    <div class="row col-lg-12 col-md-12 col-sm-12">

                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="corner">Corner :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?php
                                                                                                    if ($upRow === 1) {
                                                                                                        $type = (string)$updata['corner'];
                                                                                                        if (trim($type) === 'Yes') {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                    }
                                                                                                    ?> class="form-check-input  bg-success border border-light my-2 text-light" name="corner" id="corner" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="disputed">Disputed :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" maxlength="30" <?php
                                                                                                                    if ($upRow === 1) {
                                                                                                                        $type = (string)$updata['Disputed'];
                                                                                                                        if (trim($type) === 'Yes') {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="disputed" id="disputed" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="balloted">Balloted :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" maxlength="30" <?php
                                                                                                                    if ($upRow === 1) {
                                                                                                                        $type = (string)$updata['Balloted'];
                                                                                                                        if (trim($type) === 'Yes') {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="balloted" id="balloted" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="electricity">Electricity :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" maxlength="30" <?php
                                                                                                                    if ($upRow === 1) {
                                                                                                                        $type = (string)$updata['Electricity'];
                                                                                                                        if (trim($type) === 'Yes') {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="electricity" id="electricity" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="suiGas">Sui Gas :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" maxlength="30" <?php
                                                                                                                    if ($upRow === 1) {
                                                                                                                        $type = (string)$updata['Sui Gas'];
                                                                                                                        if (trim($type) === 'Yes') {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="suiGas" id="suiGas" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="possession">Possession :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?php
                                                                                                    if ($upRow === 1) {
                                                                                                        $type = (string)$updata['Possesion'];
                                                                                                        if (trim($type) === 'Yes') {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                    }
                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="possession" id="possession" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="parkFacing">Park Facing :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" maxlength="30" <?php
                                                                                                                    if ($upRow === 1) {
                                                                                                                        $type = (string)$updata['Park Facing'];
                                                                                                                        if (trim($type) === 'Yes') {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="parkFacing" id="parkFacing" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="sewerage">Sewerage :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" maxlength="30" <?php
                                                                                                                    if ($upRow === 1) {
                                                                                                                        $type = (string)$updata['Sewerage'];
                                                                                                                        if (trim($type) === 'Yes') {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="sewerage" id="sewerage" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="waterSupply">Water Supply :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" maxlength="30" <?php
                                                                                                                    if ($upRow === 1) {
                                                                                                                        $type = (string)$updata['Water Supply'];
                                                                                                                        if (trim($type) === 'Yes') {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="waterSupply" id="waterSupply" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="boundaryWall">Boundary Wall :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" maxlength="30" <?php
                                                                                                                    if ($upRow === 1) {
                                                                                                                        $type = (string)$updata['Boundary Wall'];
                                                                                                                        if (trim($type) === 'Yes') {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?> class="form-check-input bg-success border border-light my-2 text-light" name="boundaryWall" id="boundaryWall" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="tab-pane fade" id="content6">

                                    <div class="row col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbySchools">Nearby Schools :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="text" maxlength="40" value="<?php
                                                                                                if ($upRow1 === 1) {
                                                                                                    $type = (string)$updata1['Nearby Schools'];
                                                                                                    if (strlen(trim($type)) > 0) {
                                                                                                        echo $type;
                                                                                                    }
                                                                                                }
                                                                                                ?>" class="form-control my-2 <?php  ?>bg-secondary text-white" name="nearbySchools" id="nearbySchools" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbyHospitals">Nearby Hospitals :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="text" maxlength="40" value="<?php
                                                                                                if ($upRow1 === 1) {
                                                                                                    $type = (string)$updata1['Nearby Hospitals'];
                                                                                                    if (strlen(trim($type)) > 0) {
                                                                                                        echo $type;
                                                                                                    }
                                                                                                }
                                                                                                ?>" class="form-control my-2 <?php  ?>bg-secondary text-white" name="nearbyHospitals" id="nearbyHospitals" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbyShoppingMalls">Nearby Shopping Malls :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="text" maxlength="40" value="<?php
                                                                                                if ($upRow1 === 1) {
                                                                                                    $type = (string)$updata1['Nearby Shopping Malls'];
                                                                                                    if (strlen(trim($type)) > 0) {
                                                                                                        echo $type;
                                                                                                    }
                                                                                                }
                                                                                                ?>" class="form-control my-2 <?php  ?>bg-secondary text-white" name="nearbyShoppingMalls" id="nearbyShoppingMalls" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbyRestaurants">Nearby Restaurants :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="text" maxlength="40" value="<?php
                                                                                                if ($upRow1 === 1) {
                                                                                                    $type = (string)$updata1['Nearby Restaurants'];
                                                                                                    if (strlen(trim($type)) > 0) {
                                                                                                        echo $type;
                                                                                                    }
                                                                                                }
                                                                                                ?>" class="form-control my-2 <?php  ?> bg-secondary text-white" name="nearbyRestaurants" id="nearbyRestaurants" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbyPublicTransportService">Nearby Public Transport Service :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="text" maxlength="40" value="<?php
                                                                                                if ($upRow1 === 1) {
                                                                                                    $type = (string)$updata1['Nearby Public Transport Service'];
                                                                                                    if (strlen(trim($type)) > 0) {
                                                                                                        echo $type;
                                                                                                    }
                                                                                                }
                                                                                                ?>" class="form-control my-2 <?php  ?> bg-secondary text-white" name="nearbyPublicTransportService" id="nearbyPublicTransportService" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="distanceFromAirport">Distance From Airport (kms) :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="text" maxlength="40" value="<?php
                                                                                                if ($upRow1 === 1) {
                                                                                                    $type = (string)$updata1['Distance From Airport (kms)'];
                                                                                                    if (strlen(trim($type)) > 0) {
                                                                                                        echo $type;
                                                                                                    }
                                                                                                }
                                                                                                ?>" class="form-control my-2 <?php  ?> bg-secondary text-white" name="distanceFromAirport" id="distanceFromAirport" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="content7">
                                    <div class="row col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="maintenanceStaff">Maintenance Staff :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?php
                                                                                                    if ($upRow2 === 1) {
                                                                                                        $type = (string)$updata2['Maintenance Staff'];
                                                                                                        if (trim($type) === 'Yes') {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                    }
                                                                                                    ?> class="form-check-input bg-success border border-light my-2 <?php  ?> text-light" name="maintenanceStaff" id="maintenanceStaff" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="securityStaff">Security Staff :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?php
                                                                                                    if ($upRow2 === 1) {
                                                                                                        $type = (string)$updata2['Security Staff'];
                                                                                                        if (trim($type) === 'Yes') {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                    }
                                                                                                    ?> class="form-check-input bg-success border border-light my-2 <?php  ?> text-light" name="securityStaff" id="securityStaff" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Button to go to the next tab -->
                            <div class="container-fluid pt-4 px-4 bg-secondary">
                                <div class="rounded-top p-4 bg-secondary">
                                    <div class="row col-md-12 col-sm-12 col-lg-12 text-center" style="color: white; font-weight: 900; font-size:20px;">
                                        <div class="col-md-4 col-sm-4 col-lg-4 text-center " style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                            <input type="submit" class="btn btn-info mt-2 text-center" id="nextButton" style="width: 150px;" value="Save and Next" name="saveData" />

                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4 text-center " style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                            <button class="btn btn-outline-danger"> <a href="thank.php">Skip</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <br>
                    <br>
                    <br>
                </form>
            </div>
            <div class="container-fluid  pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center bg-secondary text-sm-start">
                            &copy; <a href="#">Oribit Enterprises Brochure</a>, All Right Reserved.
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- /////////////////////////////////////////// -->


    <!-- JavaScript Libraries -->
    <script src="assets/plugins/tinymce/tinymce.min.js"></script>
    <script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function Tab1() {

        }
    </script>


</body>

</html>