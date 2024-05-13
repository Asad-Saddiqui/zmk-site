<?php
session_start();
require("../admin/config/config.php");
include('./check_status.php');

include('./validateUser.php');

if (!isset($_SESSION['agentEmail'])) {
    header("location:../login.php");
}
$validate = validate($_SESSION['agentEmail'], $_SESSION['agentID'], $con);
if ($validate !== true) {
    header("location:../login.php");
}

$uid = $_SESSION['agentID'];
$pid = $_GET['PID'];
$query = "SELECT * FROM property WHERE id='$pid'";
$result = mysqli_query($con, $query);
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if (trim($row['propertyType']) === 'Plot') {
    header("location:-plot-ammenities.php?PID=$pid");
}


$sql1 = "SELECT * FROM `main_features` WHERE `main_features`.`pid` = $pid and uid='$uid'";
$numRow = (int) mysqli_num_rows(mysqli_query($con, $sql1));
$data = mysqli_fetch_assoc(mysqli_query($con, $sql1));

$sql1_ = "SELECT * FROM `rooms` WHERE `rooms`.`pid` = $pid and uid='$uid'";
$numRow1 = mysqli_num_rows(mysqli_query($con, $sql1_));
$data1 = mysqli_fetch_assoc(mysqli_query($con, $sql1_));

$sql2 = "SELECT * FROM `business` WHERE `business`.`pid` = $pid and uid='$uid'";
$numRow2 = mysqli_num_rows(mysqli_query($con, $sql2));
$data2 = mysqli_fetch_assoc(mysqli_query($con, $sql2));

$sql3 = "SELECT * FROM `communityf` WHERE `communityf`.`pid` = $pid and uid='$uid'";
$numRow3 = mysqli_num_rows(mysqli_query($con, $sql3));
$data3 = mysqli_fetch_assoc(mysqli_query($con, $sql3));

$sql4 = "SELECT * FROM `healthcare` WHERE `healthcare`.`pid` = $pid and uid='$uid'";
$numRow4 = mysqli_num_rows(mysqli_query($con, $sql4));
$data4 = mysqli_fetch_assoc(mysqli_query($con, $sql4));
$sql5 = "SELECT * FROM `nearbylocation` WHERE `nearbylocation`.`pid` = $pid and uid='$uid'";
$numRow5 = mysqli_num_rows(mysqli_query($con, $sql5));
$data5 = mysqli_fetch_assoc(mysqli_query($con, $sql5));

$sql6 = "SELECT * FROM `otherfacilities` WHERE `otherfacilities`.`pid` = $pid and uid='$uid'";
$numRow6 = mysqli_num_rows(mysqli_query($con, $sql6));
$data6 = mysqli_fetch_assoc(mysqli_query($con, $sql6));

if (isset($_POST['saveData'])) {
    $flooring = $_POST['flooring'] ?? '';
    $electricityBackup = $_POST['ElectricityBackup'] ?? '';
    $builtInYear = $_POST['builtInYear'] ?? '';
    $floors = $_POST['floors'] ?? '';
    $parkingSpace = $_POST['parkingSpace'] ?? '';

    $centralAirConditioning = isset($_POST['centralAirConditioning']) ? 'Yes' : 'No';
    $wasteDisposal = isset($_POST['wasteDisposal']) ? 'Yes' : 'No';
    $doubleGlazedWindows = isset($_POST['doubleGlazedWindows']) ? 'Yes' : 'No';
    $centralHeating = isset($_POST['centralHeating']) ? 'Yes' : 'No';
    $furnished = isset($_POST['furnished']) ? 'Yes' : 'No';




    if ($numRow === 1) {
        $id = $data['id'];
        mysqli_query($con, "UPDATE `main_features`
        SET 
            `Flooring` = '$flooring',
            `Electricity Backup` = '$electricityBackup',
            `Built in year` = '$builtInYear',
            `Floors` = '$floors',
            `Parking space` = '$parkingSpace',
            `Central Air Conditioning` = '$centralAirConditioning',
            `Waste Disposal` = '$wasteDisposal',
            `Double Glazed Windows` = '$doubleGlazedWindows',
            `Parking spaceCentral Heating` = '$centralHeating',
            `Furnished` = '$furnished'
        WHERE
            `id` = $id");
    } else {
        $tab1 = "INSERT INTO `main_features` (`id`, `Flooring`, `Electricity Backup`,
     `Built in year`, `Floors`, `Parking space`, `Central Air Conditioning`,
      `Waste Disposal`, `Double Glazed Windows`, `Parking spaceCentral Heating`,
       `Furnished`, `pid`, `uid`) 
       VALUES (NULL, '$flooring', '$electricityBackup', '$builtInYear', '$floors', 
       '$parkingSpace', '$centralAirConditioning', '$centralAirConditioning',
        '$doubleGlazedWindows', '$centralHeating', '$furnished', '$pid', '$uid');";
        mysqli_query($con, $tab1);
    }


    // propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");

    // Variables related to content2
    $bathrooms = $_POST['bathrooms'] ?? '';
    $bedrooms = $_POST['bedrooms'] ?? '';
    $kitchens = $_POST['kitchens'] ?? '';
    $storeRooms = $_POST['storeRooms'] ?? '';

    // Checkboxes in content2
    //tab2
    $drawingRoom = isset($_POST['drawingRoom']) ? 'Yes' : 'No';
    $studyRoom = isset($_POST['studyRoom']) ? 'Yes' : 'No';
    $laundryRoom = isset($_POST['laundryRoom']) ? 'Yes' : 'No';
    $diningRoom = isset($_POST['diningRoom']) ? 'Yes' : 'No';
    $gym = isset($_POST['gym']) ? 'Yes' : 'No';
    $prayerRoom = isset($_POST['prayerRoom']) ? 'Yes' : 'No';


    if ($numRow1 === 1) {
        $tab3 = "UPDATE `rooms` SET 
            `Bathrooms` = '$bathrooms',
            `Bedrooms` = '$bedrooms',
            `Kitchens` = '$kitchens',
            `Store Rooms` = '$storeRooms',
            `Drawing Room` = '$drawingRoom',
            `Study Room` = '$studyRoom',
            `Laundry Room` = '$laundryRoom',
            `Dining Room` = '$diningRoom',
            `Gym` = '$gym',
            `Prayer Room` = '$prayerRoom'
         WHERE 
           `pid` = '$pid';";
        mysqli_query($con, $tab3);
    } else {
        $tab3 = "INSERT INTO `rooms` (`id`, `Bathrooms`, `Bedrooms`, `Kitchens`,
     `Store Rooms`, `Drawing Room`, `Study Room`, `Laundry Room`,
      `Dining Room`, `Gym`, `Prayer Room`, `uid`, `pid`)
       VALUES (NULL, '$bathrooms', '$bedrooms', '$kitchens', '$storeRooms',
        '$drawingRoom', '$studyRoom', '$laundryRoom', '$diningRoom', 
        '$gym', '$prayerRoom', '$uid', '$pid');";
        mysqli_query($con, $tab3);
    }



    // propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");


    $satelliteCableTVReady = isset($_POST['satelliteCableTVReady']) ? "Yes" : "No";
    $intercom = isset($_POST['intercom']) ? "Yes" : "No";
    $broadbandInternetAccess = isset($_POST['broadbandInternetAccess']) ? "Yes" : 'No';


    if ($numRow2 === 1) {
        $tab2 = "UPDATE `business` SET 
            `Satellite or Cable TV Ready` = '$satelliteCableTVReady',
            `Intercom` = '$intercom',
            `Broadband Internet Access` = '$broadbandInternetAccess'
         WHERE 
            `pid` = '$pid';";
        mysqli_query($con, $tab2);
    } else {
        $tab2 = "INSERT INTO `business` (`id`, `Satellite or Cable TV Ready`,
     `Intercom`, `Broadband Internet Access`, `uid`, `pid`) 
     VALUES (NULL, '$satelliteCableTVReady', '$intercom', '$broadbandInternetAccess', '$uid', '$pid');";
        mysqli_query($con, $tab2);
    }

    // propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");

    // tab 4
    $communitySwimmingPool = isset($_POST['communitySwimmingPool']) ? "Yes" : '';
    $medicalCentre = isset($_POST['medicalCentre']) ? "Yes" : '';
    $kidsPlayArea = isset($_POST['kidsPlayArea']) ? "Yes" : '';
    $mosque = isset($_POST['mosque']) ? "Yes" : '';
    $communityGym = isset($_POST['communityGym']) ? "Yes" : '';
    $communityLawnOrGarden = isset($_POST['communityLawnOrGarden']) ? "Yes" : '';
    $communityCentre = isset($_POST['communityCentre']) ? "Yes" : '';
    $barbequeArea = isset($_POST['barbequeArea']) ? "Yes" : '';



    if ($numRow3 === 1) {
        $tab4 = "UPDATE `communityf` SET 
            `Community Swimming Pool` = '$communitySwimmingPool',
            `First Aid or Medical Centre` = '$medicalCentre',
            `Kids Play Area` = '$kidsPlayArea',
            `Mosque` = '$mosque',
            `Community Gym` = '$communityGym',
            `Community Lawn or Garden` = '$communityLawnOrGarden',
            `Community Centre` = '$communityCentre',
            `Barbeque Area` = '$barbequeArea'
         WHERE 
            `pid` = '$pid';";
        mysqli_query($con, $tab4);
    } else {
        $tab4 = "INSERT INTO `communityf` (`id`, `Community Swimming Pool`,
     `First Aid or Medical Centre`, `Kids Play Area`, `Mosque`,
      `Community Gym`, `Community Lawn or Garden`, `Community Centre`,
       `Barbeque Area`, `uid`, `pid`) 
       VALUES (NULL, '$communitySwimmingPool', '$medicalCentre', '$kidsPlayArea', '$mosque', 
       '$communityGym', '$communityLawnOrGarden', '$communityCentre', '$barbequeArea', '$uid', '$pid');";
        mysqli_query($con, $tab4);
    }


    // propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");

    // tab5
    $swimmingPoolChecked = isset($_POST['swimmingPool']) ? "Yes" : "No";
    $jacuzziChecked = isset($_POST['jacuzzi']) ? "Yes" : "No";
    $lawnOrGardenChecked = isset($_POST['lawnOrGarden']) ? "Yes" : "No";
    $saunaChecked = isset($_POST['sauna']) ? "Yes" : "No";



    if ($numRow4 === 1) {
        $tab5 = "UPDATE `healthcare` SET 
            `Swimming` = '$swimmingPoolChecked',
            `Lawn or Garden` = '$lawnOrGardenChecked',
            `Jacuzzi` = '$jacuzziChecked',
            `Sauna` = '$saunaChecked'
         WHERE 
            `pid` = '$pid';";
        mysqli_query($con, $tab5);
    } else {
        $tab5 = "INSERT INTO `healthcare` (`id`, `Swimming`, `Lawn or Garden`,
     `Jacuzzi`, `Sauna`, `uid`, `pid`) 
     VALUES (NULL, '$swimmingPoolChecked', '$jacuzziChecked', '$lawnOrGardenChecked', '$saunaChecked',
      '$uid', '$pid');";
        mysqli_query($con, $tab5);
    }





    // propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");


    //tab 6
    $nearbySchoolsValue = isset($_POST['nearbySchools']) ? $_POST['nearbySchools'] : '';
    $nearbyHospitalsValue = isset($_POST['nearbyHospitals']) ? $_POST['nearbyHospitals'] : '';
    $nearbyShoppingMallsValue = isset($_POST['nearbyShoppingMalls']) ? $_POST['nearbyShoppingMalls'] : '';
    $nearbyRestaurantsValue = isset($_POST['nearbyRestaurants']) ? $_POST['nearbyRestaurants'] : '';
    $nearbyPublicTransportServiceValue = isset($_POST['nearbyPublicTransportService']) ? $_POST['nearbyPublicTransportService'] : '';
    $distanceFromAirportValue = isset($_POST['distanceFromAirport']) ? $_POST['distanceFromAirport'] : '';


    if ($numRow5 === 1) {
        $tab6 = "UPDATE `nearbylocation` SET 
            `Nearby Schools` = '$nearbySchoolsValue',
            `Nearby Hospitals` = '$nearbyHospitalsValue',
            `Nearby Shopping Malls` = '$nearbyShoppingMallsValue',
            `Nearby Restaurants` = '$nearbyRestaurantsValue',
            `Nearby Public Transport Service` = '$nearbyPublicTransportServiceValue',
            `Distance From Airport (kms)` = '$distanceFromAirportValue'
         WHERE 
            `uid` = '$uid' AND `pid` = '$pid';";
        mysqli_query($con, $tab6);
    } else {

        $tab6 = "INSERT INTO `nearbylocation` (`id`, `Nearby Schools`, `Nearby Hospitals`, `Nearby Shopping Malls`, `Nearby Restaurants`, `Nearby Public Transport Service`, `Distance From Airport (kms)`, `uid`, `pid`) VALUES (NULL, '$nearbySchoolsValue', '$nearbyHospitalsValue', '$nearbyShoppingMallsValue', '$nearbyRestaurantsValue', '$nearbyPublicTransportServiceValue', '$distanceFromAirportValue', '$uid', '$pid')";
        mysqli_query($con, $tab6);
    }


    // propertyStatus($con, $pid, "UPDATE `complete` SET `6` = '1' WHERE  `pid`=$pid ;");

    // tab 7

    $maintenanceStaffChecked = isset($_POST['maintenanceStaff']) ? 'Yes' : 'No';
    $securityStaffChecked = isset($_POST['securityStaff']) ? 'Yes' : 'No';


    if ($numRow6 === 1) {
        $tab7 = "UPDATE `otherfacilities` SET 
            `Maintenance Staff` = '$maintenanceStaffChecked',
            `Security Staff` = '$securityStaffChecked'
         WHERE 
            `uid` = '$uid' AND `pid` = '$pid';";
        mysqli_query($con, $tab7);
    } else {

        $tab7 = "INSERT INTO `otherfacilities` (`id`, `Maintenance Staff`, `Security Staff`, `uid`, `pid`) VALUES (NULL, '$maintenanceStaffChecked', '$securityStaffChecked', '$uid', '$pid')";
        mysqli_query($con, $tab7);
    }

    propertyStatus($con, $uid, $pid, "UPDATE `complete` SET `6` = '1' WHERE `complete`.`uid` = $uid AND `pid`=$pid ;");
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
        <div class="content bg-light">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>
            <div class="full-row   rounded bg-white" style="margin-top: 50px; margin-left: 25px; margin-right: 25px;">
                <form method="post" enctype="multipart/form-data">
                    <div class="d-flex justify-content-between">
                        <h2 class="mt-2 pt-2 text-center text-dark">Add Ammenities</h2>
                        <h2 class="mt-2 text-center  border border-info p-3 text-info " style="border-radius: 50%;">6</h2>
                    </div>
                    <!-- <?php echo $part1Error; ?> -->
                    <div class="container  rounded">

                        <div class="rounded-top p-4 bg-white m-3 border">
                            <ul class="nav nav-tabs" id="myTabs">
                                <li class="nav-item">
                                    <a class="nav-link text-info  active" id="tab1" data-bs-toggle="tab" onclick="Tab1()" href="#content1">Main Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-info" id="tab2" data-bs-toggle="tab" onclick="Tab2()" href="#content2">Rooms</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-info" id="tab3" data-bs-toggle="tab" onclick="Tab2()" href="#content3">Business and Communication
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-info" id="tab4" data-bs-toggle="tab" onclick="Tab2()" href="#content4">Community Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-info" id="tab5" data-bs-toggle="tab" onclick="Tab2()" href="#content5">Healthcare Recreational
                                    </a>
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
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Flooring:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <select name="flooring" class="form-control my-2 bg-white text-dark">
                                                        <option value="">Select Options</option>
                                                        <option value="Tiles" <?= $numRow === 1 && (string)trim($data['Flooring']) === 'Tiles' ? "selected" : "" ?>>Tiles</option>
                                                        <option value="Marble" <?= $numRow === 1 && (string)trim($data['Flooring']) === 'Marble' ? "selected" : "" ?>>Marble</option>
                                                        <option value="Wooden" <?= $numRow === 1 && (string)trim($data['Flooring']) === 'Wooden' ? "selected" : "" ?>>Wooden</option>
                                                        <option value="Chip" <?= $numRow === 1 && (string)trim($data['Flooring']) === 'Chip' ? "selected" : "" ?>>Chip</option>
                                                        <option value="Cement" <?= $numRow === 1 && (string)trim($data['Flooring']) === 'Cement' ? "selected" : "" ?>>Cement</option>
                                                        <option value="Other" <?= $numRow === 1 && (string)trim($data['Flooring']) === 'Other' ? "selected" : "" ?>>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Electricity Backup:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <select name="ElectricityBackup" class="form-control my-2 bg-white text-dark">
                                                        <option value="">Select Options</option>
                                                        <option value="None" <?= $numRow === 1 && (string)trim($data['Electricity Backup']) === 'None' ? "selected" : "" ?>>None</option>
                                                        <option value="Generator" <?= $numRow === 1 && (string)trim($data['Electricity Backup']) === 'Generator' ? "selected" : "" ?>>Generator</option>
                                                        <option value="Ups" <?= $numRow === 1 && (string)trim($data['Electricity Backup']) === 'Ups' ? "selected" : "" ?>>Ups</option>
                                                        <option value="Solar" <?= $numRow === 1 && (string)trim($data['Electricity Backup']) === 'Solar' ? "selected" : "" ?>>Solar</option>
                                                        <option value="Other" <?= $numRow === 1 && (string)trim($data['Electricity Backup']) === 'Other' ? "selected" : "" ?>>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Built in year:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="date" value="<?= $numRow === 1 && (string)trim($data['Built in year']) ?  $data['Built in year'] : "" ?>" class="form-control bg-white text-dark my-2 <?php ?>" name="builtInYear" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Floors:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="number" maxlength="40" value="<?= $numRow === 1 && (string)trim($data['Floors']) ?  $data['Floors'] : "" ?>" class="form-control bg-white text-dark my-2 <?php ?>" name="floors" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Parking space:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="text" maxlength="40" class="form-control bg-white text-dark my-2 <?php ?>" value="<?= $numRow === 1 && (string)trim($data['Parking space']) ?  $data['Parking space'] : "" ?>" name="parkingSpace" id="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Central Air Conditioning:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow === 1 && (string)trim($data['Central Air Conditioning']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" class="form-check-input bg-success border border-light my-2 <?php ?>" name="centralAirConditioning" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Waste Disposal:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow === 1 && (string)trim($data['Waste Disposal']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="wasteDisposal" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Double Glazed Windows:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow === 1 && (string)trim($data['Double Glazed Windows']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="doubleGlazedWindows" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Central Heating:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow === 1 &&  (string)trim($data['Parking spaceCentral Heating']) === 'Yes' ? "checked" : "" ?> maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="centralHeating" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Furnished:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow === 1 &&  (string)trim($data['Furnished']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="furnished" id="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="content2">
                                    <div class="row col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Bathrooms:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="number" value="<?= $numRow1 === 1 && (string)trim($data1['Bathrooms']) ? $data1['Bathrooms'] : "" ?>" maxlength="40" class="form-control bg-white text-dark my-2 <?php ?>" name="bathrooms" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Bedrooms:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="number" maxlength="40" value="<?= $numRow1 === 1 && (string)trim($data1['Bedrooms']) ? $data1['Bedrooms'] : "" ?>" class="form-control bg-white text-dark my-2 <?php ?>" name="bedrooms" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Kitchens:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="number" value="<?= $numRow1 === 1 && (string)trim($data1['Kitchens']) ? $data1['Kitchens'] : "" ?>" maxlength="40" class="form-control bg-white text-dark my-2 <?php ?>" name="kitchens" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>Store Rooms:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="number" value="<?= $numRow1 === 1 && (string)trim($data1['Store Rooms']) ? $data1['Store Rooms'] : "" ?>" maxlength="40" class="form-control bg-white text-dark my-2 <?php ?>" name="storeRooms" id="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Drawing Room:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow1 === 1 && (string)trim($data1['Drawing Room']) === "Yes" ? "checked" : "" ?> style="font-size:25px" class="form-check-input bg-success border border-light my-2 <?php ?>" name="drawingRoom" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Study Room:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow1 === 1 && (string)trim($data1['Study Room']) === 'Yes' ? "checked" : "" ?> maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="studyRoom" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Laundry Room:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow1 === 1 && (string)trim($data1['Laundry Room']) === 'Yes' ? "checked" : "" ?> maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="laundryRoom" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Dining Room:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow1 === 1 && (string)trim($data1['Dining Room']) === 'Yes' ? "checked" : "" ?> maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="diningRoom" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Gym:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow1 === 1 && (string)trim($data1['Gym']) === 'Yes' ? "checked" : "" ?> maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="gym" id="" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Prayer Room:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow1 === 1 && (string)trim($data1['Prayer Room']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="prayerRoom" id="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="content3">
                                    <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <div class="col-lg-6 col-md-6 col-sm-8">
                                            <label>Satellite or Cable TV Ready:</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-4">
                                            <input type="checkbox" style="font-size:25px" <?= $numRow2 === 1 && (string)trim($data2['Satellite or Cable TV Ready']) === 'Yes' ? "checked" : "" ?> class="form-check-input bg-success border border-light my-2 <?php ?>" name="satelliteCableTVReady" id="" maxlength="40" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-8">
                                            <label>Intercom:</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-4">
                                            <input type="checkbox" style="font-size:25px" <?= $numRow2 === 1 && (string)trim($data2['Intercom']) === 'Yes' ? "checked" : "" ?> class="form-check-input bg-success border border-light my-2 <?php ?>" name="intercom" id="" maxlength="40" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-8">
                                            <label>Broadband Internet Access:</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-4">
                                            <input type="checkbox" style="font-size:25px" <?= $numRow2 === 1 && (string)trim($data2['Broadband Internet Access']) === 'Yes' ? "checked" : "" ?> class="form-check-input bg-success border border-light my-2 <?php ?>" name="broadbandInternetAccess" id="" maxlength="40" />
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="content4">
                                    <div class="row col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Community Swimming Pool:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow3 === 1 && (string)trim($data3['Community Swimming Pool']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" class="form-check-input bg-success border border-light my-2 <?php ?>" name="communitySwimmingPool" id="communitySwimmingPool" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>First Aid or Medical Centre:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow3 === 1 && (string)trim($data3['First Aid or Medical Centre']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="medicalCentre" id="medicalCentre" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Kids Play Area:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow3 === 1 && (string)trim($data3['Kids Play Area']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="kidsPlayArea" id="kidsPlayArea" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Mosque:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow3 === 1 && (string)trim($data3['Mosque']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="mosque" id="mosque" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Community Gym:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow3 === 1 && (string)trim($data3['Community Gym']) === 'Yes' ? "checked" : "" ?> class="form-check-input bg-success border border-light my-2 <?php ?>" name="communityGym" id="communityGym" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Community Lawn or Garden:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow3 === 1 && (string)trim($data3['Community Lawn or Garden']) === 'Yes' ? "checked" : "" ?> maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="communityLawnOrGarden" id="communityLawnOrGarden" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Community Centre:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow3 === 1 && (string)trim($data3['Community Centre']) === 'Yes' ? "checked" : "" ?> maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="communityCentre" id="communityCentre" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Barbeque Area:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow3 === 1 && (string)trim($data3['Barbeque Area']) === 'Yes' ? "checked" : "" ?> maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="barbequeArea" id="barbequeArea" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="content5">
                                    <div class="row col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Swimming Pool:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow4 === 1 && (string)trim($data4['Swimming']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" class="form-check-input bg-success border border-light my-2 <?php ?>" name="swimmingPool" id="swimmingPool" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Jacuzzi:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow4 === 1 && (string)trim($data4['Jacuzzi']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="jacuzzi" id="jacuzzi" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Lawn or Garden:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" style="font-size:25px" <?= $numRow4 === 1 && (string)trim($data4['Lawn or Garden']) === 'Yes' ? "checked" : "" ?> class="form-check-input bg-success border border-light my-2 <?php ?>" name="lawnOrGarden" id="lawnOrGarden" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label>Sauna:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow4 === 1 && (string)trim($data4['Sauna']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" maxlength="40" class="form-check-input bg-success border border-light my-2 <?php ?>" name="sauna" id="sauna" />
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
                                                    <input type="url" value="<?= $numRow5 === 1 && (string)trim($data5['Nearby Schools']) ?  $data5['Nearby Schools'] : "" ?>" maxlength="450" class="form-control my-2 <?php  ?> bg-white text-dark" name="nearbySchools" id="nearbySchools" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbyHospitals">Nearby Hospitals :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="url" value="<?= $numRow5 === 1 && (string)trim($data5['Nearby Hospitals']) ?  $data5['Nearby Hospitals'] : "" ?>" maxlength="450" class="form-control my-2 <?php  ?> bg-white text-dark" name="nearbyHospitals" id="nearbyHospitals" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbyShoppingMalls">Nearby Shopping Malls :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="url" value="<?= $numRow5 === 1 && (string)trim($data5['Nearby Shopping Malls']) ?  $data5['Nearby Shopping Malls'] : "" ?>" maxlength="450" class="form-control my-2 <?php  ?> bg-white text-dark" name="nearbyShoppingMalls" id="nearbyShoppingMalls" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbyRestaurants">Nearby Restaurants :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="url" maxlength="450" value="<?= $numRow5 === 1 && (string)trim($data5['Nearby Restaurants']) ?  $data5['Nearby Restaurants'] : "" ?>" class="form-control my-2 <?php  ?> bg-white text-dark" name="nearbyRestaurants" id="nearbyRestaurants" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="nearbyPublicTransportService">Nearby Public Transport Service :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="url" value="<?= $numRow5 === 1 && (string)trim($data5['Nearby Public Transport Service']) ?  $data5['Nearby Public Transport Service'] : "" ?>" maxlength="450" class="form-control my-2 <?php  ?> bg-white text-dark" name="nearbyPublicTransportService" id="nearbyPublicTransportService" style="background-color:white;" />
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label for="distanceFromAirport">Distance From Airport (kms) :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <input type="url" value="<?= $numRow5 === 1 && (string)trim($data5['Distance From Airport (kms)']) ?  $data5['Distance From Airport (kms)'] : "" ?>" maxlength="450" class="form-control my-2 <?php  ?> bg-white text-dark" name="distanceFromAirport" id="distanceFromAirport" style="background-color:white;" />
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
                                                    <input type="checkbox" <?= $numRow6 === 1 && (string)trim($data6['Maintenance Staff']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" class="form-check-input bg-success border border-light my-2 <?php  ?> text-dark" name="maintenanceStaff" id="maintenanceStaff" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="row col-lg-12 col-md-12 col-sm-12 mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-8">
                                                    <label for="securityStaff">Security Staff :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-4">
                                                    <input type="checkbox" <?= $numRow6 === 1 && (string)trim($data6['Security Staff']) === 'Yes' ? "checked" : "" ?> style="font-size:25px" class="form-check-input bg-success border border-light my-2 <?php  ?> text-dark" name="securityStaff" id="securityStaff" style="background-color:white;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Button to go to the next tab -->
                            <div class="container-fluid pt-4 px-4 bg-white">
                                <div class="rounded-top p-4 bg-white">
                                    <div class="row col-md-12 col-sm-12 col-lg-12 bg-white">
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


                    </div>
                    <br>
                    <br>
                    <br>
                </form>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Oribit Enterprises Brochure</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                        
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