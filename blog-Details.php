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

    <!-- Meta Tags --><!-- FOR MORE PROJECTS visit: codeastro.com -->
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

    <!--	Title
	=========================================================-->
    <title>Real Estate PHP</title>
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
                            <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>News Detail</b></h2>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="float-left float-md-right">
                                <ol class="breadcrumb bg-transparent m-0 p-0">
                                    <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">News Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--	Banner   --->


            <div class="full-row">
                <div class="container">
                    <div class="row"><!-- FOR MORE PROJECTS visit: codeastro.com -->

                        <?php

                        $query = mysqli_query($con, "SELECT * FROM news where id=$id");

                        $row = mysqli_fetch_assoc($query);
                        ?>

                        <div class="col-lg-8">

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="single-property" style="width:1200px; height:700px; margin:30px auto 50px;">


                                        <div class="ls-slide">
                                            <img width="1920" height="1080" src="./admin/common/user/<?php echo $row['img']; ?>" class="ls-bg" alt="" />
                                        </div>

                                    </div>
                                </div>
                            </div><!-- FOR MORE PROJECTS visit: codeastro.com -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="bg-success d-table px-3 py-2 rounded text-white text-capitalize"><?php echo $row['title']; ?></div>
                                    <span class="mb-sm-20 d-block text-capitalize"><i class="fas fa-map-marker-alt text-success font-12"></i> &nbsp;<?php echo $row['status']; ?></span>
                                    <span class="mb-sm-20 d-block text-capitalize"><i class="fas fa-calendar text-success font-12"></i> &nbsp;<?php echo $row['date']; ?></span>

                                </div>

                            </div>
                            <div class="property-details">

                                <h4 class="text-secondary my-4">Description</h4>
                                <p><?php echo $row['description']; ?></p>






                            </div>
                        </div>

                        <?php ?>

                        <div class="col-lg-4">


                            <ul class="property_list_widget">
                                <div class="sidebar-widget mt-5">
                                    <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Recent Added News</h4>
                                    <ul class="property_list_widget">

                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM `news` LIMIT 10");

                                        while ($rowR = mysqli_fetch_array($query)) {

                                        ?>
                                            <li> <img src="admin/common/user/<?php echo $rowR['img']; ?>" alt="pimage">
                                                <h6 class="text-secondary hover-text-success text-capitalize"><a href="blog-Details.php?pid=<?php echo $rowR['id']; ?>"><?php echo $rowR['title']; ?></a></h6>
                                                <span class="font-14"><i class="fas fa-map-calendar-alt icon-success icon-small"></i> <?php echo $rowR['date']; ?></span>

                                            </li>
                                        <?php } ?>

                                    </ul>
                                </div>
                            </ul>



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