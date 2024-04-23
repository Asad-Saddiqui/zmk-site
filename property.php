<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("./admin/config/config.php");
include("./expire.php");
expire($con);
if (isset($_REQUEST['filter'])) {
    $type = $_REQUEST['type'];
    $stype = $_REQUEST['stype'];
    $city = $_REQUEST['city'];
    $area = $_REQUEST['range1'];
    $areaType = $_REQUEST['Atype'];
    $price = $_REQUEST['range2'];
    header("location:propertygrid.php?page=1&type=$type&stype=$stype&city=$city&area=$area&areaType=$areaType&price=$price");
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$page = (int)$page;
$page = $page === 0 ? 1 : $page;
$records_per_page = 6; // Number of records per page
$pageRecordCount = 6 * $page;
$offset = ($page - 1) * $records_per_page;
$sql = "SELECT property.*,(SELECT name FROM propertyimages WHERE pid = property.id LIMIT 1) AS homeImage, 
                                            user.name, 
                                            user.role, 
                                            user.img,
                                            card.name AS cardName
                                        FROM 
                                            property 
                                        JOIN 
                                            user 
                                        ON 
                                            property.uid = user.id 
                                        LEFT JOIN 
                                            card 
                                        ON 
                                            property.cid = card.id
                                        WHERE 
                                            property.status = '1' 
                                           
                                        ORDER BY 
                                            property.listingDate DESC 
                                        LIMIT $offset,$records_per_page";
$sql2 = "SELECT property.*,(SELECT name FROM propertyimages WHERE pid = property.id LIMIT 1) AS homeImage, 
                                            user.name, 
                                            user.role, 
                                            user.img,
                                            card.name AS cardName
                                        FROM 
                                            property 
                                        JOIN 
                                            user 
                                        ON 
                                            property.uid = user.id 
                                        LEFT JOIN 
                                            card 
                                        ON 
                                            property.cid = card.id
                                        WHERE 
                                            property.status = '1' 
                                           
                                        ORDER BY 
                                            property.listingDate DESC";




$result = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql2);
$countprop1 = (int)mysqli_num_rows($result);
$countprop = (int)mysqli_num_rows($result2);
$total_pages = ceil($countprop / $records_per_page);
if (isset($_POST['like'])) {
    $pid = $_POST['Lpid'];

    // Check if the user is logged in
    if (isset($_SESSION['userEmail'])) {
        if (!empty($pid)) {
            $uid = $_SESSION['userID'];

            // Check if the user has already liked the post
            $check = mysqli_query($con, "SELECT * FROM likecount WHERE Lpid=$pid AND Luid=$uid");
            $row_num = mysqli_num_rows($check);
            $row = mysqli_fetch_assoc($check);

            if ((int)$row_num === 1) {
                // If the user has already liked the post, toggle the liked status
                $liked = (int)$row['liked'];
                $newLikedStatus = $liked ? 0 : 1;
                $like = "UPDATE likecount SET liked = $newLikedStatus WHERE Lpid = $pid AND Luid = $uid";
            } else {
                // If the user has not liked the post, insert a new like record
                $like = "INSERT INTO `likecount` (`likeid`, `Lpid`, `Luid`, `liked`, `date`) VALUES (NULL, '$pid', '$uid', '1', current_timestamp())";
            }

            // Execute the query
            if (mysqli_query($con, $like)) {
                // Redirect to the same page to avoid form resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit(); // Stop execution after redirection
            }
        } else {
            echo "<script>alert('Login Required')</script>";
            header('Location: login.php'); // Redirect to the login page
            exit(); // Stop execution after redirection
        }
    }
}
?><!-- FOR MORE PROJECTS visit: codeastro.com -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
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
    <title>ZMK Property</title>
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
                            <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Filter Property</b></h2>
                        </div><!-- FOR MORE PROJECTS visit: codeastro.com -->
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="float-left float-md-right">
                                <ol class="breadcrumb bg-transparent m-0 p-0">
                                    <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Filter Property</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--	Banner   --->
<div class=" w-100  mt-3 bg-white position-relative" data-stellar-background-ratio="0.5">

                <div class="container h-100 item-first">
                    <div class="row h-100 align-items-center">
                        <div class="col-lg-12">
                            <div class="text-white">

                                <form method="post" action="">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control" name="type">
                                                    <option value="">Select Type</option>
                                                    <?php
                                                    $mysqliproperty = mysqli_query($con, "SELECT DISTINCT propertyType FROM property where status='1' ");
                                                    $proptype_num = mysqli_num_rows($mysqliproperty);

                                                    while ($proptype_row = mysqli_fetch_assoc($mysqliproperty)) {
                                                        # code...

                                                    ?>
                                                        <option value="<?php echo $proptype_row['propertyType']; ?>"><?php echo $proptype_row['propertyType']; ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control" name="stype">
                                                    <option value="">Select Status</option>
                                                    <option value="rent">Rent</option>
                                                    <option value="sale">Sale</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control" name="Atype">
                                                    <option value="">Choose area type</option>
                                                    <option value="Marla">Marla</option>
                                                    <option value="Sq.Ft.">Sq.Ft.</option>
                                                    <option value="Sq.M.">Sq.M.</option>
                                                    <option value="Sq.Yd.">Sq.Yd.</option>
                                                    <option value="Kanal">Kanal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <input type="text" require class="form-control" name="city" placeholder="Enter City" required>
                                            </div>
                                        </div>
                                        <style>
                                            .slidecontainer {
                                                width: 100%;
                                            }

                                            .slider {
                                                -webkit-appearance: none;
                                                width: 100%;
                                                height: 25px;
                                                background: #d3d3d3;
                                                outline: none;
                                                
                                                opacity: 0.7;
                                                -webkit-transition: .2s;
                                                transition: opacity .2s;
                                            }

                                            .slider:hover {
                                                opacity: 1;
                                            }

                                            .slider::-webkit-slider-thumb {
                                                -webkit-appearance: none;
                                                appearance: none;
                                                width: 25px;
                                                height: 25px;

                                                background: #f36c21;
                                                cursor: pointer;
                                            }

                                            .slider::-moz-range-thumb {
                                                width: 25px;
                                                height: 25px;
                                                background: #f36c21;
                                                cursor: pointer;
                                            }
                                        </style>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="slidecontainer text-dark">
                                                Area Size :
                                                <span class="text-dark" id="rangevalue">10000</span>
                                                <br>
                                                <input type="range" min="0" max="300" step="5" value="140" name="range1" class="slider" id="myRange">


                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 text-dark">
                                            <div class="slidecontainer">
                                                Price :<span class="text-dark" id="AreaSize">1000</span><br>
                                                <input type="range" min="0" name="range2" value="40000" step="5000" max="100000000" class="slider" id="myRange2">

                                            </div>
                                        </div>
                                        <script>
                                            // Get the range input and span element
                                            var rangeInput = document.getElementById("myRange");
                                            var rangeInput2 = document.getElementById("myRange2");
                                            var rangeValueSpan = document.getElementById("rangevalue");
                                            var AreaSize = document.getElementById("AreaSize");

                                            // Update the span element with the initial value of the range input
                                            rangeValueSpan.textContent = rangeInput.value;
                                            AreaSize.textContent = rangeInput2.value;

                                            // Add an event listener to the range input for the "input" event
                                            rangeInput.addEventListener("input", function() {
                                                // Update the span element with the current value of the range input
                                                rangeValueSpan.textContent = rangeInput.value;
                                            });
                                            rangeInput2.addEventListener("input", function() {
                                                // Update the span element with the current value of the range input
                                                AreaSize.textContent = rangeInput2.value;
                                            });
                                        </script>


                                        <div class="col-md-4 col-lg-4 mt-2">
                                            <div class="form-group">
                                                <button type="submit" name="filter" class="btn  w-100" style="background-color:#f36c21">Search Property</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--	Property Grid
		===============================================================-->
            <div class="full-row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <!-- FOR MORE PROJECTS visit: codeastro.com -->
                                <?php


                                if ($countprop1 > 0) {

                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="featured-thumb hover-zoomer mb-4">
                                                <a href="propertydetail.php?pid=<?php echo $row['id']; ?>">
                                                <div class="overlay-black overflow-hidden position-relative"> <img src="./admin/uploads/<?php echo $row['homeImage']; ?>" alt="pimage" style="height: 200px;width:100%">
                                                    <div class="featured" style="<?php 
                                                    $cardName=(string)$row['cardName'];
                                                    if(strtolower(trim($cardName))==="platinum"){
                                                    echo 'background-color: rgb(189 22 73 / 73%);color:white;';
                                                    }elseif(strtolower(trim($cardName))==="golden"){
                                                        echo "background-color: rgb(219 209 1);color: black;";
                                                    }elseif(strtolower(trim($cardName))==="sliver"){
                                                        echo "background-color: rgb(204 202 202);color: black";
                                                    }else{
                                                        echo "background-color: #28a745;color: white;";
                                                    }
                                                    ?>"><?php echo $row['cardName']; ?></div>
                                                    <div class="sale text-capitalize" style="<?php 
                                                    $cardName=(string)$row['cardName'];
                                                    if(strtolower(trim($cardName))==="platinum"){
                                                    echo 'background-color: rgb(189 22 73 / 73%);color:white;';
                                                    }elseif(strtolower(trim($cardName))==="golden"){
                                                        echo "background-color: rgb(219 209 1);color: black;";
                                                    }elseif(strtolower(trim($cardName))==="sliver"){
                                                        echo "background-color: rgb(204 202 202);color: black";
                                                    }else{
                                                        echo "background-color: #28a745;color: white;";
                                                    }
                                                    ?>">For <?php echo $row['purpose']; ?></div>
                                                    <div class="price " style="color:#f36c21"><b>Rs : <?php echo $row['price']; ?> </b><span class="text-white"><?php echo $row['size']; ?> <?php echo $row['size_in']; ?> | <?php echo $row['propertyType']; ?></span></div>
                                                </div> </a>
                                                <div class="featured-thumb-data shadow-one">
                                                    <style>
                                                        #changeColor {
                                                            color: lightgrey;
                                                        }

                                                        #changeColor:hover {
                                                            color: red;
                                                        }
                                                    </style>
                                                    <div class="p-3">
                                                        <h5 class="text-secondary hover-text-success mb-2 text-capitalize d-flex justify-content-between"><a href="propertydetail.php?pid=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                                                            <div class=" d-flex justify-content-between">
                                                                <p class="mx-2">
                                                                <form method="post">
                                                                    <input type="text" hidden name="Lpid" value="<?php echo $row['id']; ?>">
                                                                    <i class="d-none" id="valueID" style="cursor: pointer;"><?php echo $row['id'] ?></i>
                                                                    <button type="submit" name="like" class="bg-white">
                                                                        <?php

                                                                        ?>

                                                                        <i class="fas fa-heart" id="changeColor" style="cursor: pointer;
                                                                        <?php
                                                                        if (isset($_SESSION['userEmail'])) {
                                                                            $lpid = $row['id'];
                                                                            $luid = $_SESSION['userID'];
                                                                            $check = mysqli_query($con, "select * from likecount where Lpid=$lpid and Luid=$luid");
                                                                            $row_num_user = mysqli_num_rows($check);
                                                                            $row_user = mysqli_fetch_assoc($check);
                                                                            if ((int)$row_user['liked'] === 0) {
                                                                                echo "color:lightgray";
                                                                            } else {
                                                                                echo "color:red";
                                                                            }
                                                                        }


                                                                        ?>
                                                                        "></i>
                                                                        <sub class="text-black">
                                                                            <?php

                                                                            $lpid = $row['id'];
                                                                            $check = mysqli_query($con, "select * from likecount where Lpid=$lpid and liked=1");
                                                                            $row__user = mysqli_num_rows($check);
                                                                            $row_user = mysqli_fetch_assoc($check);
                                                                            if ((int)$row__user > 0) {
                                                                                echo $row__user;
                                                                            } else {
                                                                                echo 0;
                                                                            }



                                                                            ?>
                                                                        </sub>
                                                                    </button>

                                                                </form>
                                                                </p>
                                                                <p class="mx-2">
                                                
                                                                <a href="peoperty-comment.php?pid=<?php echo $row['id'] ?>">
                                                                    <button class="bg-white" style="color:#f36c21" >
                                                                        <i class="fas fa-comment" style="cursor: pointer"></i>
                                                                        <sub class="text-black">
                                                                            <?php
                                                                            $id_ = $row['id'];
                                                                            $counts = mysqli_query($con, "SELECT COUNT(*) AS comment_count FROM comments where pid=$id_");
                                                                            $counts_ = mysqli_fetch_assoc($counts);
                                                                            echo $counts_ ?  $counts_['comment_count'] :  0;
                                                                            ?>
                                                                        </sub>
                                                                    </button>
                                                                    </a>
                                                                </p>
                                                                <p class="mx-2">
                                                                    <button class="bg-white " style="color:#f36c21">
                                                                        <i class="fas fa-eye " style="cursor: pointer"></i>
                                                                        <sub class="text-black">
                                                                            <?php
                                                                            $pid = $row['id'];
                                                                            // $uid = $row['userID'];
                                                                            $quey56 = "SELECT * FROM propviews WHERE pid=$pid";
                                                                            $result56 = mysqli_query($con, $quey56);
                                                                            $row_num_56 = mysqli_num_rows($result56);
                                                                            echo $row_num_56;


                                                                            ?>
                                                                        </sub>
                                                                    </button>
                                                                </p>


                                                            </div>
                                                        </h5>
                                                        <span class="location text-capitalize"><i class="fas fa-map-marker-alt " style="color:#f36c21"></i> <?php echo $row['city']; ?></span>
                                                    </div>
                                                    <a href="propertydetail.php?pid=<?php echo $row['id']; ?>"><div class="bg-gray quantity px-4 pt-4">

                                                        <ul>
                                                            <?php
                                                            $propertyType = ucwords(trim($row['propertyType']));
                                                            $id = $row['id'];
                                                            if ($propertyType === 'Plot') {
                                                                $myplot = "SELECT * FROM `plot`where plot.pid=$id";
                                                                $plot = mysqli_query($con, $myplot);
                                                                $rowPlot = mysqli_fetch_assoc($plot);
                                                                $rowNum = mysqli_num_rows($plot);
                                                                if ($rowNum > 0) {

                                                            ?>
                                                                    <li>Corner <span><?php echo $rowPlot['corner']; ?></span> </li>
                                                                    <li>Electricity <span><?php echo $rowPlot['Electricity']; ?></span> </li>
                                                                    <li>Sui Gas <span><?php echo $rowPlot['Sui Gas']; ?></span> </li>
                                                                    <li>Sewerage <span><?php echo $rowPlot['Sewerage']; ?></span> </li>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <li> Corner <span><?php echo "No"; ?></span></li>
                                                                    <li> Electricity <span><?php echo "No"; ?></span></li>
                                                                    <li> Sui Gas <span><?php echo "No"; ?></span></li>
                                                                    <li> Sewerage <span><?php echo "No"; ?></span></li>
                                                                <?php
                                                                }
                                                            } else {
                                                                $myroom = "SELECT * FROM `rooms`where rooms.pid=$id";
                                                                $room = mysqli_query($con, $myroom);
                                                                $rowroom = mysqli_fetch_assoc($room);
                                                                $rowNum_ = mysqli_num_rows($room);
                                                                if ($rowNum_ > 0) {

                                                                ?>
                                                                    <li>Bedroom<span><?php if(strlen(trim($rowroom['Bedrooms']))>0){
                                                                    echo $rowroom['Bedrooms'];
                                                                    }else{
                                                                        echo 0;
                                                                    }?></span> </li>
                                                                    <li>Bath <span><?php 
                                                                    if(strlen(trim($rowroom['Bathrooms']))>0){
                                                                    echo $rowroom['Bathrooms'];
                                                                    }else{
                                                                        echo 0;
                                                                    }?></span> </li>
                                                                    <li>Kitchen <span><?php 
                                                                     if(strlen(trim($rowroom['Kitchens']))>0){
                                                                    echo $rowroom['Kitchens'];
                                                                    }else{
                                                                        echo 0;
                                                                    }
                                                                     ?></span> </li>
                                                                    <li>Store Room<span><?php 
                                                                    
                                                                     if(strlen(trim($rowroom['Store Rooms']))>0){
                                                                    echo $rowroom['Store Rooms'];
                                                                    }else{
                                                                        echo 0;
                                                                    }
                                                                     ?></span> </li>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <li> Bedroom <span><?php echo "0"; ?></span></li>
                                                                    <li> Bath<span><?php echo "0"; ?></span></li>
                                                                    <li> Kitchen <span><?php echo "0"; ?></span></li>
                                                                    <li> Store Room<span><?php echo "0"; ?></span></li>
                                                            <?php
                                                                }
                                                            }
                                                            ?>


                                                        </ul>

                                                    </div></a>
                                                    <div class="p-4 d-inline-block w-100">
                                                        <div class="float-left text-capitalize"><i class="fas fa-user mr-1"style="color:#f36c21"></i>By : <?php echo $row['name']; ?></div>
                                                        <div class="float-right"><i class="far fa-calendar-alt mr-1"style="color:#f36c21"></i> <?php echo date('d-m-Y', strtotime($row['listingDate'])); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {

                                    echo "<h1 class='mb-5'><center>No Property Available</center></h1>";
                                }

                                ?>
                                <style>
                                    @media only screen and (max-width: 992px) {
                                        #mydiv {
                                            display: none;
                                        }
                                    }
                                </style>


                                <?php
                                if ($countprop1 > 0) {
                                ?>

                                    <div class="col-md-12">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-center mt-4 row col-md-12 col-lg-12 col-sm-12 ">
                                                <li class="page-item  my-2 <?php if ($page === 1) {
                                                                            ?> disabled <?php
                                                                                    } ?> pointer"> <a class="page-link" href="property.php?page=<?php
                                                                                                                                                $pages = $page;
                                                                                                                                                if ($pages === 1) {
                                                                                                                                                    echo $pages = 1;
                                                                                                                                                } else {
                                                                                                                                                    echo $pages = $pages - 1;
                                                                                                                                                }
                                                                                                                                                ?>">Previous</a></li>
                                                <?php
                                                for ($i = 1; $i <= $total_pages; $i++) {
                                                ?>
                                                    <li class="page-item <?php
                                                                            if ($page === $i) {
                                                                                echo "active";
                                                                            }

                                                                            ?>  col-md-1 col-sm-2  my-2 " id="mydiv" aria-current="page"> <a class="page-link" style="background-color:#f36c21" href="property.php?page=<?php
                                                                                                                                                                                        echo $pages = $i;
                                                                                                                                                                                        ?>"><?php echo $i; ?></a> </span> </li>
                                                <?php
                                                }


                                                ?>


                                                <li class="page-item   my-2 <?php if ((int)$page === (int)$total_pages) {
                                                                            ?> disabled <?php
                                                                                    } ?>"> <a class="page-link" href="property.php?page=<?php
                                                                                                                                        $pages = $page;
                                                                                                                                        if ($page === $total_pages) {
                                                                                                                                            echo $pages = $total_pages;
                                                                                                                                        } else {
                                                                                                                                            echo $pages = $pages + 1;
                                                                                                                                        }
                                                                                                                                        ?>">Next</a> </li>
                                            </ul>
                                        </nav>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div><!-- FOR MORE PROJECTS visit: codeastro.com -->

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