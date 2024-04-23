<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./admin/config/config.php");								
include("./expire.php");
expire($con);							
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

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<!-- Css Link -->
<!-- FOR MORE PROJECTS visit: codeastro.com -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/layerslider.css">
<link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<!-- Title -->
<title>Real Estate PHP</title>
</head>
<body>

<!--	Page Loader -->
<!-- <div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
	<div class="d-flex justify-content-center y-middle position-relative">
	  <div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	  </div>
	</div>
</div> -->
<!-- FOR MORE PROJECTS visit: codeastro.com -->
<div id="page-wrapper">
    <div class="row"> 
        <!--	Header start  -->
		<?php include("include/header.php");?>
        <!--	Header end  -->
        
        <!--	Banner   --->
        <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>About US</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">About Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
         <!--	Banner   --->
		 <!-- FOR MORE PROJECTS visit: codeastro.com -->
        <!--	About Our Company -->
        <div class="full-row">
            <div class=" mx-4">
                
                    <div class="row">
                        <div class="col-md-12 mx-4 col-lg-12">
                            <h3 class="text-secondary position-relative text-center pb-4 mb-4">ZMK Marketing</h3>
                        </div>
                    </div>
                
                    <div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="col-md-12 col-lg-6 col-sm-12 col-xl-6 ">
                            <h3>
                                Introduction
                      </h3>
                       <p>
                        Welcome to ZMK Marketing Pvt. Ltd, a distinguished
                        name in the realm of development, construction, and
                        marketing solutions. With a legacy spanning over
                        eight years, we stand as a beacon of innovation,
                        integrity, and excellence in the industry.
                        Headquartered in Top City-1, Islamabad, ZMK
                        Marketing is your trusted partner for comprehensive
                        and tailored solutions that transform landscapes and
                        enrich communities.
                        </p>
                        <br>
                        <p>
                            ZMK Marketing Pvt. Ltd is a leading
                            development, construction, and
                            marketing company based in Top
                            City-1, Islamabad. With over eight
                            years of industry experience, we have
                            earned a reputation for excellence,
                            integrity, and professionalism. Our
                            multidisciplinary team of qualied
                            professionals, including architects,
                            engineers, and marketers, is dedicated
                            to delivering innovative solutions that
                            drive value and exceed expectations.
                            Backed by robust operational and
                            nancial capabilities, as well as a vast
                            network of partners and contractors,
                            we have successfully undertaken and
                            completed projects across various
                            sectors, including residential,
                            commercial, and infrastructure.
                            </p>

                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6  mt-3 ">
                            <div class="about-img"> <img src="./zmkImages/Capture.PNG" alt="about image"> </div>
                        </div>
                    </div>
             

				
            </div>
        </div>
        <!--	About Our Company -->        
         <div class="full-row bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-secondary  text-center mb-5">OUR SERVICES</h2>
                        </div>
                    </div>
                    <div class="text-box-one">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="flaticon-rent  flat-medium" style="color:#f36c21" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">Mass Housing
Developments</h5>
                                    <p>Fulfilling the dream of
affordable, quality housing
for individuals and families</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="flaticon-rent  flat-medium" style="color:#f36c21" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">Marketing Services:</h5>
                                    <p>Crafting compelling
marketing strategies to
promote real estate projects
and services effectively.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="flaticon-rent  flat-medium" style="color:#f36c21" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">Commercial
Development</h5>
                                    <p>Creating dynamic spaces
that inspire productivity,
collaboration, and success.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="flaticon-rent  flat-medium" style="color:#f36c21" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">Land Development</h5>
                                    <p>Transforming raw land into
                                    vibrant, sustainable
                                    communities that thrive.</p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
       <!--	Footer   start-->
		<?php include("include/footer.php");?>
		<!--	Footer   start-->
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div><!-- FOR MORE PROJECTS visit: codeastro.com -->
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
<script src="js/jquery.cookie.js"></script> 
<script src="js/custom.js"></script>
</body>

</html>