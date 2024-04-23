<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("./admin/config/config.php");
include("./expire.php");
expire($con);



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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!--	Title
	=========================================================-->
    <title>ZMK Marketing</title>
</head>

<body>

    <div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
        <div class="d-flex justify-content-center y-middle position-relative">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <!--	Page Loader  -->

    <div id="page-wrapper">
        <div class="row">
            <!--	Header start  -->
            <?php include("include/header.php"); ?>
            <style>
            .callNow {
                position: fixed;
                background-color: green;
                z-index: 1;
                width: 10% auto;
                height: 10%;
                color: white;
                font-size: 20px;
                background-color: green;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 5px;
                top: 20%;
                left: 90%;
                transform: translate(-10%, -90%);
            }
           .sliderImg {
                width: 100%;
                height: 420px;
            }
 @media only screen and (min-width: 992px) {
                .sliderImg {
                    height: auto; /* Allow the height to adjust automatically */
                }
                .font{
              font-size: 20px;
                }
            }
           
            @media only screen and (min-width: 1200px) {
                .sliderImg {
                    height: 700px; /* Allow the height to adjust automatically */
                }
                .font{
             font-size: 18px;
                }
            }
            @media only screen and (min-width: 1400px) {
                .sliderImg {
                    height: 738px; /* Allow the height to adjust automatically */
                }
                .font{
              font-size: 20px;
                }
            }
            @media only screen and (min-width: 1500px) {
                .sliderImg {
                    height: 868px; /* Allow the height to adjust automatically */
                }
                .font{
              font-size: 24px;
                }
            }
          .content-section{
            width:100%;
            background-color:white;
            height:100px;
            display:flex;
            justify-content:center;
            align-items:center;
          }
          .bg-color{
            background-color:#00000080;
            color:white;
          }
          .text-color{
            color:white;
          }
          .montserrat,div,a,p,span,i {
                    font-family: "Montserrat", sans-serif;
                    font-optical-sizing: auto;
                    font-style: normal;
                    }

            </style>


<div style="width: 100%; height: auto;">
    <div class="swiper ">
        <!-- mySwiper -->
        <div class="swiper-wrapper">
            <?php
            $count = 0;
            $query = mysqli_query($con, "SELECT * FROM `projects` ORDER BY `description` DESC");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="swiper-slide">
                    <img class="sliderImg" src="./admin/uploads/<?php echo $row['project_image']; ?>" class="d-block w-100" alt="...">
                    <div class="content-section">
                        <div class="carousel-caption bg-color d-md-block" style="opacity: 1;">
                            <h3 style="color: green; font-weight: bold; font-size: 35px; color: #f36c21;"><?php echo $row['project_name']; ?></h3>
                            <p class="text-color montserrat font" ><?php
                                $features = $row['features'];
                                echo substr($features, 0, 150) . "...";
                                ?></p>
                            <p><a href="projectDetails.php?pid=<?php echo $row['project_id']; ?>" style="color: white; font-size: 20px; font-weight: bold;">View More</a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>





            <div class="full-row bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-secondary  text-center mb-5">What We Do</h2>
                        </div>
                    </div>
                    <div class="text-box-one">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="flaticon-rent  flat-medium" style="color:#f36c21" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0"><a href="selling.php">Selling
                                            Service</a></h5>
                                    <!-- <p>This is a dummy text for filling out spaces. Just some random words...</p> -->
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="flaticon-for-rent  flat-medium" style="color:#f36c21"
                                        aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0"><a href="Rental.php">Rental
                                            Service</a></h5>
                                    <!-- <p>This is a dummy text for filling out spaces. Just some random words...</p> -->
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="flaticon-list  flat-medium" style="color:#f36c21" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0"><a
                                            href="property.php">Property Listing</a></h5>
                                    <!-- <p>This is a dummy text for filling out spaces. Just some random words...</p> -->
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="flaticon-diagram  flat-medium" style="color:#f36c21"
                                        aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0"><a href="Installment.php">On
                                            Installment</a></h5>
                                    <!-- <p>This is a dummy text for filling out spaces. Just some random words...</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-----  Our Services  ---->




        </div>
        <div class="full-row">
            <div class="">
                <div class="row">
                    <div class="row col-md-12 col-lg-12 col-sm-12">
                        <h2 class="col-md-12 col-lg-12 col-sm-12 text-secondary text-center mb-4">OUR PROJECTS</h2>

                    </div>

                    <div class="col-md-12">
                        <div class="tab-content mt-4" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home">
                                <div class="row">
                                    <?php 
                                    $query = mysqli_query($con, "SELECT * FROM `projects` ORDER BY `description` DESC");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>

                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="featured-thumb hover-zoomer mb-4">
                                            <a href="propertydetail.php?pid=<?php echo $row['project_id']; ?>">
                                                <div class="overlay-black overflow-hidden position-relative"> <img
                                                        src="./admin/uploads/<?php echo $row['project_image']; ?>"
                                                        alt="pimage" style="height: 400px;width:100%">

                                                </div>
                                            </a>
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
                                                    <h3 class=" mb-2 text-capitalize d-flex justify-content-center"
                                                        style="color:#f36c21"><?php echo $row['project_name']; ?>

                                                    </h3>
                                                    <div class="d-flex justify-content-center">
                                                        <p class="location text-capitalize" style="font-size: 20px;">
                                                            <?php echo $row['ListingCategory']; ?></p>
                                                        <p class="mx-3" style="font-size: 20px;"> | </p>
                                                        <p class="location text-capitalize" style="font-size: 20px;">
                                                            <?php echo $row['city']; ?></p>
                                                    </div>
                                                    <hr>
                                                    <h3 class="d-flex justify-content-center">
                                                        <a class="text-secondary"
                                                            href="projectDetails.php?pid=<?php echo $row['project_id']; ?>">View
                                                            Details</a>

                                                    </h3>
                                                    <!--<span class="location text-capitalize"><i class="fas fa-map-marker-alt text-success"></i> <?php echo $row['city']; ?></span>-->
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="full-row">

            <!--	Why Choose Us -->
            <div class="full-row living bg-one overlay-secondary-half"
                style="background-image: url('images/01.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="living-list pr-4">
                                <h3 class="pb-4 mb-3 text-white">Contents</h3>
                                <ul>
                                    <li class="mb-4 text-white d-flex">
                                        <i class="flaticon-reward flat-medium float-left d-table mr-4 "
                                            style="color:#f36c21" aria-hidden="true"></i>
                                        <div class="pl-2">
                                            <h5 class="mb-3">Mission and Vision</h5>
                                            <p>Transforming businesses with creative
                                                strategies, pioneering excellence, and
                                                fostering growth for lasting industry
                                                impact and success..</p>
                                        </div>
                                    </li>
                                    <li class="mb-4 text-white d-flex">
                                        <i class="flaticon-real-estate flat-medium float-left d-table mr-4 "
                                            style="color:#f36c21" aria-hidden="true"></i>
                                        <div class="pl-2">
                                            <h5 class="mb-3">Our Services</h5>
                                            <p>Delivering comprehensive marketing
                                                solutions including digital, social
                                                media, branding, content creation,
                                                and strategic campaigns for
                                                businesses.</p>
                                        </div>
                                    </li>
                                    <li class="mb-4 text-white d-flex">
                                        <i class="flaticon-seller flat-medium float-left d-table mr-4 "
                                            style="color:#f36c21" aria-hidden="true"></i>
                                        <div class="pl-2">
                                            <h5 class="mb-3">Company Profile</h5>
                                            <p>ZMK Marketing specializes in innovative
                                                strategies, data-driven insights, and
                                                creative solutions to propel businesses
                                                towards sustainable growth.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--	why choose us -->

            <!--	How it work -->


            <!--	How It Work -->

            <!--	Achievement
        ============================================================-->

            <!--	Popular Place -->
            <div class="full-row bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-secondary  text-center mb-5">Popular Places</h2>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-3 pb-1">
                                <div
                                    class="overflow-hidden position-relative overlay-secondary hover-zoomer mx-n13 z-index-9">
                                    <img src="images/thumbnail4/1.jpg" alt="">
                                    <div class="text-white xy-center z-index-9 position-absolute text-center w-100">
                                        <?php
                                    $query = mysqli_query($con, "SELECT count(project_id) FROM projects where city='Islamabad'");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <h4 class="hover-text-success text-capitalize"><a href="">Islamabad</a></h4>
                                        <span><?php
                                                $total = $row[0];
                                                echo $total; ?> Projects Listed</span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 pb-1">
                                <div
                                    class="overflow-hidden position-relative overlay-secondary hover-zoomer mx-n13 z-index-9">
                                    <img src="images/thumbnail4/2.jpg" alt="">
                                    <div class="text-white xy-center z-index-9 position-absolute text-center w-100">
                                        <?php
                                    $query = mysqli_query($con, "SELECT count(project_id) FROM projects where city='Topcity'");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <h4 class="hover-text-success text-capitalize"><a href="">Topcity</a></h4>
                                        <span><?php
                                                $total = $row[0];
                                                echo $total; ?> Projects Listed</span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 pb-1">
                                <div
                                    class="overflow-hidden position-relative overlay-secondary hover-zoomer mx-n13 z-index-9">
                                    <img src="images/thumbnail4/3.jpg" alt="">
                                    <div class="text-white xy-center z-index-9 position-absolute text-center w-100">
                                        <?php
                                    $query = mysqli_query($con, "SELECT count(project_id) FROM projects where city='University Town'");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <h4 class="hover-text-success text-capitalize"><a href="">University Town</a>
                                        </h4>
                                        <span><?php
                                                $total = $row[0];
                                                echo $total; ?> Projects Listed</span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 pb-1">
                                <div
                                    class="overflow-hidden position-relative overlay-secondary hover-zoomer mx-n13 z-index-9">
                                    <img src="images/thumbnail4/4.jpg" alt="">
                                    <div class="text-white xy-center z-index-9 position-absolute text-center w-100">
                                        <?php
                                    $query = mysqli_query($con, "SELECT count(project_id) FROM projects where city='Rawalpindi'");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <h4 class="hover-text-success text-capitalize"><a href="">Rawalpindi</a>
                                        </h4>
                                        <span><?php
                                                $total = $row[0];
                                                echo $total; ?> Projects Listed</span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="full-row overlay-secondary"
                style="background-image: url('images/breadcromb.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
                <div class="container">
                    <div class="fact-counter">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="count wow text-center  mb-sm-50" data-wow-duration="300ms"> <i
                                        class="flaticon-house flat-large text-white" aria-hidden="true"></i>
                                    <?php
                                $query_ = mysqli_query($con, "SELECT count(project_id) FROM projects");
                                while ($row = mysqli_fetch_array($query_)) {
                                ?>
                                    <div class="count-num my-4" style="color:#f36c21" data-speed="3000"
                                        data-stop="<?php
                                                                                                            $total = $row[0];
                                                                                                            echo $total; ?>">
                                        <?php
                                                                                                                                $total = $row[0];
                                                                                                                                echo $total; ?>
                                    </div>
                                    <?php } ?>
                                    <div class="text-white h5">Available Projects</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="count wow text-center  mb-sm-50" data-wow-duration="300ms"> <i
                                        class="flaticon-house flat-large text-white" aria-hidden="true"></i>
                                    <?php
                                $query = mysqli_query($con, "SELECT count(id) FROM property where purpose='Sale' and status=1");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="count-num my-4" style="color:#f36c21" data-speed="3000"
                                        data-stop="<?php
                                                                                                            $total = $row[0];
                                                                                                            echo $total; ?>">
                                        <?php
                                                                                                                                $total = $row[0];
                                                                                                                                echo $total; ?>
                                    </div>
                                    <?php } ?>
                                    <div class="text-white h5">Sale Property Available</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="count wow text-center  mb-sm-50" data-wow-duration="300ms"> <i
                                        class="flaticon-house flat-large text-white" aria-hidden="true"></i>
                                    <?php
                                $query = mysqli_query($con, "SELECT count(id) FROM property where purpose='Rent' and status=1");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="count-num  my-4" style="color:#f36c21" data-speed="3000"
                                        data-stop="<?php
                                                                                                            $total = $row[0];
                                                                                                            echo $total; ?>">
                                        <?php
                                                                                                                                $total = $row[0];
                                                                                                                                echo $total; ?>
                                    </div>
                                    <?php } ?>
                                    <div class="text-white h5">Rent Property Available</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="count wow text-center  mb-sm-50" data-wow-duration="300ms"> <i
                                        class="flaticon-man flat-large text-white" aria-hidden="true"></i>
                                    <?php
                                $query = mysqli_query($con, "SELECT count(id) FROM user");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="count-num  my-4" style="color:#f36c21" data-speed="3000"
                                        data-stop="<?php
                                                                                                            $total = $row[0];
                                                                                                            echo $total; ?>">
                                        <?php
                                                                                                                                $total = $row[0];
                                                                                                                                echo $total; ?>
                                    </div>
                                    <?php } ?>
                                    <div class="text-white h5">Registered Users</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!--	Popular Places -->

            <!--	Testonomial -->
            <div class="full-row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content-sidebar p-4">
                                <div class="mb-3 col-lg-12">
                                    <h4 class=" text-secondary position-relative pb-4 mb-4">Feedback</h4>
                                    <div class="recent-review owl-carousel owl-dots-gray owl-dots-hover-success">

                                        <?php

                                    $query = mysqli_query($con, "SELECT feedback.*, user.name FROM feedback INNER JOIN user ON feedback.uid = user.id WHERE feedback.status = '1'");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <div class="item">
                                            <div class="p-4   position-relative" style="background-color:#f36c21">
                                                <p class="text-white"><i
                                                        class="fas fa-quote-left mr-2 text-white"></i><?php echo $row['message']; ?>.
                                                    <i class="fas fa-quote-right mr-2 text-white"></i>
                                                </p>
                                            </div>
                                            <div class="">
                                                <span class="d-table text-capitalize"
                                                    style="color:#f36c21"><?php echo $row['name']; ?></span> </span>
                                            </div>
                                        </div>
                                        <?php }  ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--	Testonomial -->


            <!--	Footer   start-->
            <?php include("include/footer.php"); ?>
            <!--	Footer   start-->


            <!-- Scroll to top -->
            <a href="#" class="text-white hover-text-secondary" style="background-color:#f36c21" id="scroll"><i
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
    <script src="js/YouTubePopUp.jquery.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/custom.js"></script>


 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
        var swiper = new Swiper(".mySwiper", {
        autoplay: {
                delay: 5000, // Delay between transitions in milliseconds
                disableOnInteraction: false, // Continue autoplay even when user interacts with swiper
    },
    loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                // when window width is <= 768px
                768: {
                    slidesPerView: 1
                },
                // when window width is <= 992px
                992: {
                    slidesPerView: 1
                }
            }
        });
        </script>

</body>

</html>