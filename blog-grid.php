<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("./admin/config/config.php");
            include("./expire.php");
            expire($con);
$page = isset($_GET['page']) ? $_GET['page'] : 1;


$page = (int)$page;
$page = $page === 0 ? 1 : $page;
$records_per_page = 4; // Number of records per page
$pageRecordCount = 4 * $page;
$offset = ($page - 1) * $records_per_page;
$sql = "SELECT * FROM news ORDER BY date DESC  lIMIT $offset,$records_per_page";
$sql2 = "SELECT * FROM news";
$result = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql2);
$countprop1 = (int)mysqli_num_rows($result);
$countprop = (int)mysqli_num_rows($result2);
$total_pages = ceil($countprop / $records_per_page);

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

                                        <div class="col-md-6 col-lg-4"><!-- FOR MORE PROJECTS visit: codeastro.com -->
                                            <div class="featured-thumb hover-zoomer mb-4">
                                                <div class="overlay-black overflow-hidden position-relative"> <img src="./admin/common/user/<?php echo $row['img']; ?>" alt="pimage" style="height: 280px;width:100%">
                                                </div>
                                                <div class="featured-thumb-data shadow-one">
                                                    <div class="p-1">
                                                        <h5 class="text-secondary hover-text-success text-capitalize"><a href="blog-Details.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h5>
                                                    </div>

                                                    <div class="p-1 d-inline-block w-100">
                                                        <div class="float-left text-capitalize"><i class="fas fa-list text-success mr-1"></i>Status : <?php echo $row['status']; ?></div>
                                                        <div class="float-right"><i class="far fa-calendar-alt text-success mr-1"></i> <?php echo date('d-m-Y', strtotime($row['date'])); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {

                                    echo "<h1 class='mb-5'><center>No News</center></h1>";
                                }

                                ?>



                                <?php
                                if ($countprop1 > 0) {
                                ?>

                                    <div class="col-md-12">
                                        <nav aria-label="Page navigation">
                                            <style>
                                                @media only screen and (max-width: 992px) {
                                                    #mydiv {
                                                        display: none;
                                                    }
                                                }
                                            </style>
                                            <ul class="pagination justify-content-center mt-4 row col-md-12 col-lg-12 col-sm-12 ">
                                                <li class="page-item  my-2 <?php if ($page === 1) {
                                                                            ?> disabled <?php
                                                                                    } ?> pointer"> <a class="page-link" href="agent.php?page=<?php
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

                                                                            ?>  col-md-1 col-sm-2  my-2 " id="mydiv" aria-current="page"> <a class="page-link" href="agent.php?page=<?php
                                                                                                                                                                                    echo $pages = $i;
                                                                                                                                                                                    ?>"><?php echo $i; ?></a> </span> </li>
                                                <?php
                                                }


                                                ?>


                                                <li class="page-item   my-2 <?php if ((int)$page === (int)$total_pages) {
                                                                            ?> disabled <?php
                                                                                    } ?>"> <a class="page-link" href="agent.php?page=<?php
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