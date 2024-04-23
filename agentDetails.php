<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("./admin/config/config.php");
            include("./expire.php");
            expire($con);
$id = isset($_GET['id']) ? (is_numeric($_GET['id']) ? $_GET['id'] : header('location:agent.php')) : header('location:agent.php');


?>
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
    <link rel="shortcut icon" href="images/favicon.ico">

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


    <title>ZMK-Agents</title>
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
                            <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Property Detail</b>
                            </h2>
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
                    <div class="row">

                        <?php

                        $query = mysqli_query($con, "SELECT user.*, profile.*, COALESCE(property_count.property_count, 0) AS property_count
                                            FROM user
                                            JOIN profile ON profile.uid = user.id
                                            LEFT JOIN (
                                                SELECT uid, COUNT(*) as property_count
                                                FROM property
                                                WHERE status = 1
                                                GROUP BY uid
                                            ) AS property_count ON property_count.uid = user.id
                                            WHERE user.role = 'agent' AND user.varified = 1 and user.id=$id ");

                        $row = mysqli_fetch_assoc($query);
                        ?>

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="single-property"
                                        style="width:1200px; height:700px; margin:30px auto 50px;">


                                        <div class="ls-slide"
                                            data-ls="duration:7500; transition2d:5; kenburnszoom:in; kenburnsscale:1.2;">
                                            <img width="1920" height="1080"
                                                src="./admin/common/user/<?php echo $row['img']; ?>" class="ls-bg"
                                                alt="" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="bg-success d-table px-3 py-2 rounded text-white text-capitalize">
                                        <?php echo $row['name']; ?></div>
                                    <span class="mb-sm-20 d-block text-capitalize"><i
                                            class="fas fa-map-marker-alt text-success font-12"></i>
                                        &nbsp;<?php echo $row['compaddress']; ?></span>
                                    <span class="mb-sm-20 d-block text-capitalize"><i
                                            class="fas fa-envelope text-success font-12"></i>
                                        &nbsp;<?php echo $row['email']; ?></span>

                                </div>

                            </div>
                            <div class="property-details">

                                <h4 class="text-secondary my-4">Description</h4>
                                <p><?php echo $row['about']; ?></p>





                                <h5 class="mt-5 mb-4 text-secondary double-down-line-left position-relative">Contact
                                    Agent</h5>
                                <div class="agent-contact pt-60">
                                    <div class="row">
                                        <div class="col-sm-4 col-lg-3"> <img
                                                src="admin/common/user/<?php echo $row['logo']; ?>" alt="" height="200"
                                                width="170"> </div>
                                        <div class="col-sm-8 col-lg-9">
                                            <div class="agent-data text-ordinary mt-sm-20">
                                                <h6 class="text-success text-capitalize"><?php echo $row['comname']; ?>
                                                </h6>
                                                <ul class="mb-3">
                                                    <li>Contact : <?php echo $row['cphone']; ?></li>
                                                    <li>Landline : <?php echo $row['clandline']; ?></li>
                                                    <li>Email : <?php echo $row['compyemail']; ?></li>
                                                    <li>Platform : <?php echo "ZMK Marketing"; ?></li>
                                                    <!-- <li>Name : <?php echo $row['name']; ?></li> -->
                                                </ul>

                                                <div class="mt-3 text-secondary hover-text-success">
                                                    <ul>
                                                        <style>
                                                        /* Example CSS for styling the icon */
                                                        .youtube-icon {
                                                            font-size: 24px;
                                                            /* Adjust the font size as needed */
                                                            color: red;
                                                            /* Adjust the color as needed */
                                                        }
                                                        </style>
                                                        <li class="float-left mr-3"><a
                                                                href="<?php echo $row['fburl']; ?>"><i
                                                                    class="fab fa-facebook-f"></i></a></li>
                                                        <li class="float-left mr-3"><a
                                                                href="<?php echo $row['instaurl']; ?>"><i
                                                                    class="fab fa-instagram"></i></a></li>
                                                        <a href="<?php echo $row['youtuburl']; ?>"><i
                                                                class="bi bi-youtube youtube-icon">Youtube</i></a>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php ?>


                    </div>
                </div>
            </div>

            <!--	Footer   start-->
            <?php include("include/footer.php"); ?>
            <!--	Footer   start-->


            <!-- Scroll to top -->
            <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i
                    class="fas fa-angle-up"></i></a>
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