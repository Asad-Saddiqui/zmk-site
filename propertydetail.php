<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("./admin/config/config.php");
            include("./expire.php");
            expire($con);
$id = isset($_GET['pid']) ? (is_numeric($_GET['pid']) ? $_GET['pid'] : header('location:selling.php')) : header('location:selling.php');
function test_input1($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_SESSION['userEmail'])) {
    if (isset($_POST['booking'])) {

        $email = $_SESSION['userEmail'];
        $uiid = $_SESSION['userID'];
        $comment = $_POST['message'];

        $comment = test_input1($comment);
        if (!empty($comment)) {
            $query23 = "INSERT INTO `booking` (`id`, `uid`, `email`, `message`, `date`, `pid`) 
    VALUES (NULL, '$uiid', '$email', '$comment', current_timestamp(), '$id');";
            $resuluser23 = mysqli_query($con, $query23);
            if ($resuluser23) {

                echo '<script>alert("Booking Send successfully!")</script>';
                $comment = "";
            } else {
                echo '<script>alert("' . $stmt->error . '")</script>';
            }
        } else {
            echo '<script>alert("Please Fill Comments")</script>';
        }
    }
}
if (isset($_SESSION['userID'])) {
    $uid = $_SESSION['userID'];
    $quey56 = "SELECT * FROM propviews WHERE uid=$uid and pid=$id";
    $result56 = mysqli_query($con, $quey56);
    $row_num_56 = mysqli_num_rows($result56);
    if ($row_num_56 !== 1) {
        $quey8 = "INSERT INTO `propviews` (`id`, `uid`, `pid`) VALUES (NULL, '$uid', '$id')";
        $result8 = mysqli_query($con, $quey8);
    }
}
$query = mysqli_query($con, "SELECT property.*, user.name, user.email, user.img,profile.comid,profile.cphone,profile.logo,profile.fburl,profile.youtuburl,profile.instaurl,profile.compyemail,profile.comname,profile.clandline FROM property JOIN user ON property.uid = user.id JOIN profile ON profile.uid = property.uid WHERE property.id = $id and status=1;");
$rowApp = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags --><!-- FOR MORE PROJECTS visit: codeastro.com -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Real Estate PHP">
    <meta name="keywords" content="">
    <meta name="author" content="Unicoder">
     <link rel="shortcut icon" href="./zmkImages/LOGO FINAL-02.png">


    <!--	Fonts
	========================================================-->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!--	Css Link
	========================================================-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/layerslider.css">
    <link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--	Title
	=========================================================-->
    <title>ZMK <?php echo $rowApp['title']; ?></title>
</head>

<body>

    <div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
        <div class="d-flex justify-content-center y-middle position-relative">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>



    <div id="page-wrapper">
        <div class="row">
            <!--	Header start  -->
            <?php include("include/header.php"); ?>
            <!--	Header end  -->

            <!--	Banner   --->
            <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Property Detail</b></h2>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="float-left float-md-right">
                                <ol class="breadcrumb bg-transparent m-0 p-0">
                                    <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Property Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--	Banner   --->


            <div class="full-row">
                <div class="container">
                    <div class="row col-sm-12 col-md-12 col-lg-12">

                        <?php

                        $query = mysqli_query($con, "SELECT property.*, user.name, user.email, user.img,profile.comid,profile.cphone,profile.logo,profile.fburl,profile.youtuburl,profile.instaurl,profile.compyemail,profile.comname,profile.clandline FROM property JOIN user ON property.uid = user.id JOIN profile ON profile.uid = property.uid WHERE property.id = $id and status=1;");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>

                            <div class="col-lg-8">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="single-property" style="width:1200px; height:700px; margin:30px auto 50px;">
                                            <?php
                                            $id = $row['id'];
                                            $mysqli = mysqli_query($con, "SELECT * FROM `propertyimages` where propertyimages.pid=$id");
                                            while ($res = mysqli_fetch_assoc($mysqli)) {

                                            ?>
                                                <div class="ls-slide" data-ls="duration:7500; transition2d:5; kenburnszoom:in; kenburnsscale:1.2;"> <img width="1920" height="1080" src="./admin/uploads/<?php echo $res['name'] ?>" class="ls-bg" alt="" /> </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="bg-success d-table px-3 py-2 rounded text-white text-capitalize">For <?php echo $row['purpose']; ?></div>
                                        <h5 class="mt-2 text-secondary text-capitalize">
                                             <?php 
                                             $projid=$row['Projectid'];
                                             
                                               $mysqli_ = mysqli_query($con, "SELECT * FROM `projects` where project_id=$projid");
                                            $project_row = mysqli_num_rows($mysqli_);
                                            $res__ = mysqli_fetch_assoc($mysqli_);
                                             if($project_row===1){
                                                echo $res__['project_name']." :";
                                             }else{
                                                  echo "Marketplace  :";
                                             }
                                             ?> 
                                            
                                            <?php echo $row['propertySubtype']; ?> 
                                        
                                        </h5>
                                        <span class="mb-sm-20 d-block text-capitalize"><i class="fas fa-map-marker-alt text-success font-12"></i> &nbsp;<?php echo $row['city']; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-success text-left h5 my-2 text-md-right">Rs : <?php echo $row['price']; ?></div>
                                        <div class="text-left text-md-right">Price</div>
                                    </div>
                                </div>
                                <div class="property-details">
                                    <div class="bg-gray property-quantity px-4 pt-4 w-100">
                                        <ul>
                                            <li><span class="text-secondary"><?php echo $row['size']; ?></span> <?php echo $row['size_in']; ?></li>
                                            <?php
                                            $purpose = (string)trim($row['propertyType']);
                                            if ($purpose !== 'Plot') {
                                                $id = $row['id'];
                                                $rooms = mysqli_query($con, "SELECT * FROM `rooms` where pid=$id");
                                                $rooms_num = mysqli_num_rows($rooms);
                                                $rooms_row = mysqli_fetch_assoc($rooms);
                                                if ($rooms_num > 0) {

                                            ?>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Bedrooms']; ?></span> Bedroom</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Bathrooms']; ?></span> Bathroom</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Store Rooms']; ?></span> Store Rooms</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Kitchens']; ?></span> Kitchens</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Drawing Room']; ?></span> Drawing Room</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Study Room']; ?></span> Study Room</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Laundry Room']; ?></span> Laundry Room</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Dining Room']; ?></span> Dining Room</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Gym']; ?></span> Gym</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Prayer Room']; ?></span> Prayer Room</li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><span class="text-secondary"><?php echo 0; ?></span> Bedroom</li>
                                                    <li><span class="text-secondary"><?php echo 0; ?></span> Bathroom</li>
                                                    <li><span class="text-secondary"><?php echo 0; ?></span> Store Rooms</li>
                                                    <li><span class="text-secondary"><?php echo 0; ?></span> Kitchens</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Drawing Room']; ?></span> Drawing Room</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Study Room']; ?></span> Study Room</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Laundry Room']; ?></span> Laundry Room</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Dining Room']; ?></span> Dining Room</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Gym']; ?></span> Gym</li>
                                                    <li><span class="text-secondary"><?php echo $rooms_row['Prayer Room']; ?></span> Prayer Room</li>
                                                <?php
                                                }
                                            } else {
                                                $id = $row['id'];
                                                $plot = mysqli_query($con, "SELECT * FROM `plot` where pid=$id");
                                                $plot_num = mysqli_num_rows($plot);
                                                $plot_row = mysqli_fetch_assoc($plot);
                                                if ($plot_num > 0) {

                                                ?>
                                                    <li><span class="text-secondary"><?php echo $plot_row['corner']; ?></span> Corner</li>
                                                    <li><span class="text-secondary"><?php echo $plot_row['Disputed']; ?></span> Disputed</li>
                                                    <li><span class="text-secondary"><?php echo $plot_row['Balloted']; ?></span> Balloted</li>
                                                    <li><span class="text-secondary"><?php echo $plot_row['Electricity']; ?></span> Electricity</li>
                                                    <li><span class="text-secondary"><?php echo $plot_row['Boundary Wall']; ?></span> Boundary Wall</li>

                                            <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                            $id = $row['id'];
                                            $otherfacilities = mysqli_query($con, "SELECT * FROM `otherfacilities` where pid=$id");
                                            $otherfacilities_ = mysqli_fetch_assoc($otherfacilities);
                                            ?>
                                            <li><span class="text-secondary"><?php echo $otherfacilities_['Maintenance Staff']; ?></span> Maintenance Staff</li>
                                            <li><span class="text-secondary"><?php echo $otherfacilities_['Security Staff']; ?></span> Security Staff</li>
                                            <?php ?>
                                        </ul>
                                    </div>
                                    <h4 class="text-secondary my-4">Description</h4>
                                    <p><?php echo $row['description']; ?></p>
                                    <?php


                                    $purpose = (string)trim($row['propertyType']);
                                    if ($purpose === 'Plot') {

                                        $id = $row['id'];
                                        $plot = mysqli_query($con, "SELECT * FROM `plot` where pid=$id");
                                        $plot_num = mysqli_num_rows($plot);
                                        $plot_row = mysqli_fetch_assoc($plot);
                                        if ($plot_num > 0) {

                                    ?>

                                            <h5 class="mt-5 mb-4 text-secondary">Property Summary</h5>
                                            <div class="table-responsive"><!-- FOR MORE PROJECTS visit: codeastro.com -->
                                                <table class="table table-striped font-14 pb-2 col-md-12 col-lg-12 col-sm-12 ">
                                                    <tbody>
                                                        <tr>
                                                            <td>Sewerage :</td>
                                                            <td class="text-capitalize"><?php echo $plot_row['corner']; ?></td>
                                                            <td>Property Type :</td>
                                                            <td class="text-capitalize"><?php echo $row['propertyType']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sui Gas :</td>
                                                            <td class="text-capitalize"><?php echo $plot_row['Sui Gas']; ?></td>
                                                            <td>Possession :</td>
                                                            <td class="text-capitalize"><?php echo $plot_row['Possesion']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Parking space :</td>
                                                            <td class="text-capitalize"><?php echo $plot_row['Park Facing']; ?></td>
                                                            <td>Water Supply :</td>
                                                            <td class="text-capitalize"><?php echo $plot_row['Water Supply']; ?></td>
                                                        </tr>
                                                        <?php
                                                        $purpose = (string)$row['purpose'];
                                                        $ins_available = (string)$row['ins_avalable'];
                                                        if ($purpose === 'Sale' && $ins_available === 'Yes') {
                                                        ?>
                                                            <tr>
                                                                <td>Installment :</td>
                                                                <td class="text-capitalize">Available</td>
                                                                <td>No of Payment :</td>
                                                                <td class="text-capitalize"><?php echo $row['no_ins']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Advance Amount :</td>
                                                                <td class="text-capitalize"><?php echo $row['advance']; ?></td>
                                                                <td>Monthly Amount :</td>
                                                                <td class="text-capitalize"><?php
                                                                                            $adv = (int)$row['advance'];
                                                                                            $no = (int)$row['no_ins'];
                                                                                            $price = (int)$row['price'];
                                                                                            $left = $price - $adv;
                                                                                            echo $monthly = $left / $no;
                                                                                            ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        <?php
                                        }
                                    } else {

                                        $id = $row['id'];
                                        $main_features = mysqli_query($con, "SELECT * FROM `main_features` where pid=$id");
                                        $main_features_num = mysqli_num_rows($main_features);
                                        $main_features_row = mysqli_fetch_assoc($main_features);
                                        if ($main_features_num > 0) {

                                        ?>

                                            <h5 class="mt-5 mb-4 text-secondary">Property Summary</h5>
                                            <div class="table-striped font-14 pb-2">
                                                <table class="w-100"><!-- FOR MORE PROJECTS visit: codeastro.com -->
                                                    <tbody>
                                                        <tr>
                                                            <td>Flooring :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Flooring']; ?></td>
                                                            <td>Electricity Backup :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Electricity Backup']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Built in year :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Built in year']; ?></td>
                                                            <td>Floors :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Floors']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Parking space :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Parking space']; ?></td>
                                                            <td>Central Air Conditioning :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Central Air Conditioning']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Waste Disposal :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Waste Disposal']; ?></td>
                                                            <td>Double Glazed Windows :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Double Glazed Windows']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Central Heating :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Parking spaceCentral Heating']; ?></td>
                                                            <td>Furnished :</td>
                                                            <td class="text-capitalize"><?php echo $main_features_row['Furnished']; ?></td>
                                                        </tr>

                                                        <?php
                                                        $purpose = (string)$row['purpose'];
                                                        $ins_avalable = (string)$row['ins_avalable'];
                                                        if ($purpose === 'Sale' && $ins_avalable === 'Yes') {

                                                        ?>
                                                            <tr>
                                                                <td>Installment :</td>
                                                                <td class="text-capitalize">Avalaible</td>
                                                                <td>No of Payment :</td>
                                                                <td class="text-capitalize"><?php echo $row['no_ins']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Advance Amount :</td>
                                                                <td class="text-capitalize"><?php echo $row['advance']; ?></td>
                                                                <td>Monthly Amount :</td>
                                                                <td class="text-capitalize"><?php
                                                                                            $adv = (int)$row['advance'];
                                                                                            $no = (int)$row['no_ins'];
                                                                                            $price = (int)$row['price'];
                                                                                            $left = $price - $adv;
                                                                                            echo $monthly = $left / $no;
                                                                                            ?></td>
                                                            </tr>
                                                        <?php
                                                        }

                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    <?php
                                        }
                                    }



                                    ?>

                                    <?php
                                    $propertyType = (string)trim($row['propertyType']);
                                    if ($propertyType !== 'Plot') {
                                        $bussiness = mysqli_query($con, "SELECT * FROM `business` where pid=$id");
                                        $bussiness_ = mysqli_fetch_assoc($bussiness);
                                        $communityf = mysqli_query($con, "SELECT * FROM `communityf` where pid=$id");
                                        $communityf_ = mysqli_fetch_assoc($communityf);
                                        $healthcare = mysqli_query($con, "SELECT * FROM `healthcare` where pid=$id");
                                        $healthcare_ = mysqli_fetch_assoc($healthcare);
                                    ?>
                                        <h5 class="mt-5 mb-4 text-secondary">Features</h5>
                                        <div class="row col-md-12 col-lg-12 col-sm-12">
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$bussiness_['Satellite or Cable TV Ready'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Satellite or Cable TV Ready";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$bussiness_['Intercom'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Intercom";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$bussiness_['Broadband Internet Access'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Broadband Internet Access";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['Community Swimming Pool'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Community Swimming Pool";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['First Aid or Medical Centre'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "First Aid or Medical Centre";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['Kids Play Area'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Kids Play Area";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['First Aid or Medical Centre'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "First Aid or Medical Centre";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['Mosque'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Mosque";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['Community Gym'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Community Gym";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['Community Lawn or Garden'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Community Lawn or Garden";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['Community Centre'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Community Centre";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$communityf_['Barbeque Area'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Barbeque Area";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$healthcare_['Swimming'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Swimming";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$healthcare_['Lawn or Garden'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Lawn or Garden";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$healthcare_['Jacuzzi'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Jacuzzi";
                                                                                                                        }

                                                                                                                        ?></span>
                                            <span class="badge badge-pill m-2  badge-light" style="font-size: 15px;"><?php
                                                                                                                        $a = (string)$healthcare_['Sauna'];
                                                                                                                        if ($a === 'Yes') {
                                                                                                                            echo "Sauna";
                                                                                                                        }

                                                                                                                        ?></span>

                                        </div>
                                    <?php
                                    }

                                    ?>




                                    <!-- FOR MORE PROJECTS visit: codeastro.com -->
                                    <h5 class="mt-5 mb-4 text-secondary">Related Information</h5>
                                    <div class="accordion col-md-12 col-lg-12 col-sm-12" id="accordionExample">
                                        <button class="bg-gray hover-bg-success hover-text-white text-ordinary py-3 px-4 mb-1 w-100 text-left rounded position-relative" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Video </button>
                                        <div id="collapseOne" class="collapse show p-4" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <?php
                                            $video = mysqli_query($con, "SELECT * FROM `url` where pid=$id");
                                            $video = mysqli_fetch_assoc($video);
                                            if ($video) {
                                            ?>
                                                <div class="col-md-12 col-lg-12 col-sm-12 border-info" style="overflow-x: none;">
                                                    <?php
                                                    echo $video['url'];
                                                    ?>
                                                </div>


                                                <?php

                                                ?>


                                            <?php
                                            }

                                            ?>
                                        </div>
                                        <button class="bg-gray hover-bg-success hover-text-white text-ordinary py-3 px-4 mb-1 w-100 text-left rounded position-relative collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Map</button>
                                        <div id="collapseTwo" class="collapse p-4" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <iframe src="<?php echo $row['location']; ?>" width="100%" height="400"></iframe>
                                        </div>

                                    </div>

                                    
                                </div>
                            </div>

                        <?php } ?>

                        <div class="col-lg-4">

                            <h4 class="double-down-line-left text-secondary position-relative pb-4 my-4">Instalment Calculator</h4>
                            <form class="d-inline-block w-100" action="calc.php" method="post">
                                <label class="sr-only">Property Amount</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" name="amount" placeholder="Property Price">
                                </div>
                                <label class="sr-only">Month</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="text" class="form-control" name="month" placeholder="Duration Year">
                                </div>
                                <label class="sr-only">Interest Rate</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                    <input type="text" class="form-control" name="interest" placeholder="Interest Rate">
                                </div>
                                <button type="submit" value="submit" name="calc" class="btn btn-danger mt-4">Calclute Instalment</button>
                            </form>
                            <ul class="property_list_widget">
                                <div class="sidebar-widget mt-5">
                                    <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Recently Added Property</h4>
                                    <ul class="property_list_widget">

                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM `property` ORDER BY listingDate DESC LIMIT 7");

                                        while ($rowR = mysqli_fetch_array($query)) {
                                            $pid_ = $rowR['id'];
                                            $query_ = mysqli_query($con, "SELECT * FROM `propertyimages` where pid=$pid_  LIMIT 1");
                                            $row_ = mysqli_fetch_array($query_)
                                        ?>
                                            <li> <img src="admin/uploads/<?php echo $row_['name']; ?>" alt="pimage">
                                                <h6 class="text-secondary hover-text-success text-capitalize"><a href="propertydetail.php?pid=<?php echo $rowR['id']; ?>"><?php echo $rowR['title']; ?></a></h6>
                                                <span class="font-14"><i class="fas fa-map-marker-alt icon-success icon-small"></i> <?php echo $rowR['city']; ?></span>

                                            </li>
                                        <?php } ?>

                                    </ul>
                                </div>
                            </ul>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="text-secondary double-down-line-left  mb-5">Booking Now</h2>

                                    </div>
                                </div><!-- FOR MORE PROJECTS visit: codeastro.com -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="w-100" action="#" method="post">
                                            <div class="row">
                                                <div class="row mb-4">
                                                    <div class="form-group col-lg-6">
                                                        <input type="text" name="name" value="<?php if (isset($_SESSION['userEmail'])) {
                                                                                                    echo $_SESSION['userName'];
                                                                                                } ?>
														" class="form-control" placeholder="Your Name*">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <input type="text" value="<?php if (isset($_SESSION['userEmail'])) {
                                                                                        echo $_SESSION['userEmail'];
                                                                                    } ?>" name="email" class="form-control" placeholder="Email Address*">
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <input type="number" name="phone" class="form-control" placeholder="Phone" maxlength="10">
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <textarea name="message" class="form-control" rows="5" placeholder="Type Comments..." style="height: 400px;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if (isset($_SESSION['userEmail'])) {
                                                ?>
                                                    <button type="submit" value="Booking Now" name="booking" class="btn btn-success">Booking Now</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button type="submit" value="Booking Now" class="btn btn-success">Booking Now</button>


                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="text-secondary double-down-line-left mt-5  mb-5">Nearby Locations</h2>

                                    </div>
                                </div><!-- FOR MORE PROJECTS visit: codeastro.com -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="w-100" action="#" method="post">
                                            <div class="row">
                                                <div class=" mb-4">
                                                    <style>
                                                        .lis {
                                                            list-style: decimal;
                                                        }
                                                    </style>
                                                    <?php
                                                    $stmt = mysqli_prepare($con, "SELECT * FROM `nearbylocation` WHERE pid = ?");
                                                    if ($stmt) {
                                                        // Bind the parameter
                                                        mysqli_stmt_bind_param($stmt, "i", $id); // Assuming $id is an integer, if not use "s" for string

                                                        // Execute the statement
                                                        mysqli_stmt_execute($stmt);

                                                        // Get the result
                                                        $links = mysqli_stmt_get_result($stmt);

                                                        // Fetch the rows
                                                        while ($row = mysqli_fetch_assoc($links)) {

                                                    ?>

                                                            <?php
                                                            if (strlen($row['Nearby Schools']) > 5) {
                                                            ?>
                                                                <li class="lis"><a href="<?php echo $row['Nearby Schools']; ?>">Nearby School</a></li>
                                                            <?php
                                                            }

                                                            ?>
                                                            <?php
                                                            if (strlen($row['Nearby Hospitals']) > 5) {
                                                            ?>
                                                                <li class="lis"><a href="<?php echo $row['Nearby Hospitals']; ?>">Nearby Hospital</a></li>
                                                            <?php
                                                            }

                                                            ?>
                                                            <?php
                                                            if (strlen($row['Nearby Shopping Malls']) > 5) {
                                                            ?>
                                                                <li class="lis"><a href="<?php echo $row['Nearby Shopping Malls']; ?>">Nearby Shopping Malls</a></li>
                                                            <?php
                                                            }

                                                            ?>
                                                            <?php
                                                            if (strlen($row['Nearby Restaurants']) > 5) {
                                                            ?>
                                                                <li class="lis"><a href="<?php echo $row['Nearby Restaurants']; ?>">Nearby Restaurants</a></li>
                                                            <?php
                                                            }

                                                            ?>
                                                            <?php
                                                            if (strlen($row['Nearby Restaurants']) > 5) {
                                                            ?>
                                                                <li class="lis"><a href="<?php echo $row['Nearby Restaurants']; ?>">Nearby Restaurants</a></li>
                                                            <?php
                                                            }

                                                            ?>
                                                            <?php
                                                            if (strlen($row['Nearby Public Transport Service']) > 5) {
                                                            ?>
                                                                <li class="lis"><a href="<?php echo $row['Nearby Public Transport Service']; ?>">Nearby Public Transport Service</a></li>
                                                            <?php
                                                            }

                                                            ?>
                                                            <?php
                                                            if (strlen($row['Distance From Airport (kms)']) > 5) {
                                                            ?>
                                                                <li class="lis"><a href="<?php echo $row['Distance From Airport (kms)']; ?>">Distance From Airport</a></li>
                                                            <?php
                                                            }

                                                            ?>


                                                    <?php
                                                        }




                                                        // Free the result
                                                        mysqli_free_result($links);

                                                        // Close the statement
                                                        // mysqli_stmt_close($stmt);
                                                    } else {
                                                        // Handle the error
                                                        echo "Error: " . mysqli_error($con);
                                                    }

                                                    ?>

                                                </div>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <!--	Footer   start-->
            <?php include("include/footer.php"); ?>
            <!--	Footer   start-->


            <!-- Scroll to top -->
            <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>
            <!-- End Scroll To top -->
        </div>
    </div>
    <!-- Wrapper End -->

    <!--	Js Link
============================================================-->
    <script src="js/jquery.min.js"></script>
    <!--jQuery Layer Slider -->
    <script src="js/greensock.js"></script>
    <script src="js/layerslider.transitions.js"></script>
    <script src="js/layerslider.kreaturamedia.jquery.js"></script>
    <!--jQuery Layer Slider -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/tmpl.js"></script>
    <script src="js/jquery.dependClass-0.1.js"></script>
    <script src="js/draggable-0.1.js"></script>
    <script src="js/jquery.slider.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>