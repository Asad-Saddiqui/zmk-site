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
            $query23 = "INSERT INTO `booking` (`id`, `uid`, `email`, `message`, `date`, `pid`,`projid`) 
            VALUES (NULL, '$uiid', '$email', '$comment', current_timestamp(),'', '$id');";
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

$query = mysqli_query($con, "SELECT projects.*, user.name, user.email, user.img, profile.comid, profile.cphone, profile.logo, profile.fburl, profile.youtuburl, profile.instaurl, profile.compyemail, profile.comname, profile.clandline FROM projects JOIN user ON user.id = 1 JOIN profile ON profile.uid = 1 WHERE projects.project_id = $id AND user.id = 1;");
$row = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <!-- FOR MORE PROJECTS visit: codeastro.com -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Real Estate PHP">
    <meta name="keywords" content="">
    <meta name="author" content="Unicoder">
    <link rel="shortcut icon" href="./zmkImages/LOGO FINAL-01.png">

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
  
   
   <title><?php echo $row['project_name'];?></title>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        .montserrat,div,a,p,span,i,h1,h2,h3,h4,h5,h6 {
                    font-family: "Montserrat", sans-serif;
                    font-optical-sizing: auto;
                    font-style: normal;
                    }
        </style>
</head>

<body>

    <!-- <div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
        <div class="d-flex justify-content-center y-middle position-relative">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div> -->

    <div id="page-wrapper">
        <div class="row">

          
            <?php include("include/header.php"); ?>
            <div class="full-row">
                <div class="">
                    <div class="row col-xl-12 col-sm-12 col-lg-12 col-md-12">
                        <div class="col-lg-12 col-xl-12">
                            <h2 class="text-center">
                                <?php echo $row['project_name'];?></h2>
                            <div class=" col-xl-12 col-md-12 col-sm-12 col-lg-12">
                                <div id="imgsection" >
                                    <img style="width:100%;height:100%" src="./admin/uploads/<?php echo $row['project_image'];?>"  alt="" />
                                </div>
                            </div>
                            <div class="row mb-4 mt-4">
                                <div class="col-md-6   mx-4">
                                    <div class="d-table px-3 py-2 rounded text-white text-capitalize"
                                        style="background-color:#f36c22">
                                        <?php echo $row['city']; ?></div>
                                    <span class="mb-sm-20 d-block text-capitalize"><i
                                            class="fas fa-map-marker-alt   font12" style="color:#f36c22"></i>
                                        &nbsp;<?php echo $row['address']; ?></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="text-secondary">Overview</h4>
                                <p class=""><?php echo $row['features']; ?></p>
                            </div>
                             <style>
                                        .NOC{
                                            width: 100%;
                                            margin-top:1px;
                                        }
                                        </style>
                            <div style="margin: 20px 0px;">
                                <div class="row col-md-12 col-sm-12  col-lg-12 col-xl-12">
                                <h4 class="text-secondary col-md-12 col-sm-12  col-lg-12 col-xl-12">Owner & Developer Info</h4>

                                    <div class="col-md-7 col-sm-12 col-lg-7 col-xl-7  ">
                                        <p class=""><?php echo $row['description']; ?></p>
                                    </div>
                                    <div class="col-md-5  col-sm-12 col-lg-5 col-xl-5" style="height:auto">
                                     
                                            <img class="NOC" src="./admin/uploads/<?php echo $row['ownerimge']; ?>"
                                                alt="no image">
                                      
                                        <!-- <embed id="pdf-viewer"
                                            src="./admin/uploads/<?php echo $row['PricingDocument']; ?>"
                                            type="application/pdf" width="100%" height="100%"> -->
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade bd-example-modal-lg mt-5" tabindex="-3" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Book Now</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="w-100" action="#" method="post">
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <input type="text" name="name" value="<?php if (isset($_SESSION['userEmail'])) {
                                                                                                            echo $_SESSION['userName'];
                                                                                                        } ?>"
                                                                    class="form-control" placeholder="Your Name*">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <input type="text" value="<?php if (isset($_SESSION['userEmail'])) {
                                                                                                echo $_SESSION['userEmail'];
                                                                                            } ?>" name="email"
                                                                    class="form-control" placeholder="Email Address*">
                                                            </div>
                                                            <div class="form-group col-lg-12">
                                                                <input type="number" name="phone" class="form-control"
                                                                    placeholder="Phone" maxlength="10">
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <textarea name="message" class="form-control"
                                                                        rows="3" placeholder="Type Comments..."
                                                                        style="height: 100px;"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <?php
                                                        if (isset($_SESSION['userEmail'])) {
                                                        ?>
                                                <button type="submit" value="Book Now" name="booking"
                                                    class="btn btn-success">Book Now</button>
                                                <?php
                                                        } else {
                                                        ?>
                                                <button type="submit" value="Book Now"
                                                    class="btn btn-success">Book Now</button>
                                                <?php
                                                        }
                                                        ?>
                                            </div>
                                            <form>
                                    </div>
                                </div>
                            </div>
                           
                            <div style="margin: 30px 0px;">
                                <div class="row col-md-12 col-sm-12 col-lg-12 col-xl-12 ">
                                        <h4 class="text-dark col-md-12 col-sm-12 col-lg-12 col-xl-12 ">Noc Related Info:</h4>

                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 ">
                                        <img class="NOC" src="./admin/uploads/<?php echo $row['Noc Related Image :']; ?>"
                                            alt="no image">
                                    </div>
                                    <div class="font-14 pb-2 col-md-6 col-sm-12 col-lg-6 col-xl-6  ">
                                        <?php echo $row['AboutNOC']; ?>
                                    </div>
                                </div>
                            </div>

                            <div style="margin: 30px 0px;">
                                <h4 class="text-dark col-md-12 col-sm-12 col-lg-12 col-xl-12 ">Facilities and Amenities:</h4>
                                <div class="row col-md-12 col-sm-12 col-lg-12 col-xl-12 ">
                                <?php echo htmlspecialchars_decode($row['FacilitiesandAmenties']); ?>

                                  
                                </div>
                            </div>
                            


                          
                            <?php
                            
                            $query_= mysqli_query($con, "SELECT * FROM `projectsextends` where porEid=$id");
                            $row_ = mysqli_fetch_assoc($query_);
                            ?>
                            <div style="margin: 30px 0px;">
                                <div class="row col-md-12 col-sm-12 col-lg-12 col-xl-12 ">
                                    <div class=" table-striped font-14 pb-2 col-md-12 col-sm-12 col-lg-12 col-xl-12  ">
                                        <?php  if($row_['floorplan']){
                                            ?>
                                     <h4 class="">Floor Plan</h4>

                                         <embed src="./admin/uploads/<?php  echo $row_['floorplan'];?>" type="application/pdf" width="100%" height="600px" />

                                            <?php
                                            
                                        }?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="margin: 30px 0px;">
                                <div class="row col-md-12 col-sm-12 col-lg-12 col-xl-12 ">
                                    <h4 class="text-dark col-md-12 col-sm-12 col-lg-12 col-xl-12">Nearest Locations</h4>
                                    
                                    
                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 ">
                                        <img class="NOC" src="./admin/uploads/<?php echo $row['maplocationimg']; ?>"
                                            alt="no image">
                                    </div>
                                    <div class=" table-striped font-14 pb-2 col-md-6 col-sm-12 col-lg-6 col-xl-6  ">
                                        <?php echo $row_['maplocationtext']; ?>
                                    </div>
                                </div>
                            </div>
                                                                <?php 
                                     if($row['PricingDocument']){
?>
        
                            <div style="margin: 20px 0px;">
                                <div class="row col-md-12 col-sm-12  col-lg-12 col-xl-12">
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 " >
                              <h4 class="">Payment Plan</h4>

 <div class="pdf_">
                                          <embed id="pdf-viewer"
                                            src="./admin/uploads/<?php echo $row['PricingDocument']; ?>"
                                            type="application/pdf" width="100%" style="height:100%">
                                    </div>

                                    
                                        
                                    </div>
                                </div>
                            </div>
                            <?php
                                     }
                                     ?>
                            <style>
                                /* Button Styles */
                                .pdfdownload {
                                    display: flex;
                                    justify-content: center;
                                    border: 3px sold black;
                                }
                                .download-button {}
                            </style>
                            <br>
                            <br>
                            <h4 class="text-center"> <?php echo $row['project_name'] ?> Gallery</h4>
                            <hr>
                            
                            <style>
                                /* .projectimg{
                                    height:450px;
                                    width:100%;

                                }
                                .projectimg img{
                                    height: 100%;
                                    width:100%
                                } */

                                </style>

                          <div class="container">
                              <div class="swiper col-lg-12 col-xl-12 col-md-12 col-sm-12 mySwiper   m-4 pr-4 ">
                                <div class="swiper-wrapper">
                                    <?php
                                        $images = $row['RequireDocuments'];
                                        $array = json_decode($images);
                                        for ($i=0; $i <count($array) ; $i++) { 
                                    ?>
                                    <div class="swiper-slide projectimg">
                                        <img src="./admin/uploads/<?php echo $array[$i] ?>" alt="no image">
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div>
                            <div class="d-flex  ml-3
                             justify-content-center">
                                <a href="./admin/uploads/<?php echo $row['RequireDocuments']; ?>" download="filename.pdf" class="download-button">
                                    <button type="button" class="btn mx-2 btn-sm btn-secondary">
                                        Download Plans
                                    </button>
                                </a>
                                <a href="<?php echo $row['map_url']; ?>" target="_blank">
                                    <button type="button" class="btn mx-2 btn-sm btn-success">
                                        Map Location
                                    </button>
                                </a>
                                <button type="button" class="btn mx-2 btn-sm " style="background-color:#f36c21" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    Book Now
                                </button>
                            </div>
                            <ul class="property_list_widget">
                                <div class="sidebar-widget ">
                                    <ul class="property_list_widget">
                                        
                                        <?php
                                            $query = mysqli_query($con, "SELECT * FROM `property` where Projectid='$id' and status='1'");
                                        $rows=mysqli_num_rows($query);
                                        if($rows>0){
                                            ?>
                                            <h4 class=" text-secondary mt-3 position-relative pb-4 mb-4">
                                            Associated Properties</h4>
                                            <?php
                                           
                                        }
                                            while ($rowR = mysqli_fetch_array($query)) {
                                                ?>
                                        <li>
                                            <?php
                                            $pid_=$rowR['id'];
                                            $query1 = mysqli_query($con, "SELECT * FROM `propertyimages` where pid='$pid_' LIMIT 1");
                                            $rowR1 = mysqli_fetch_array($query1)
                                            ?>

                                             <img src="admin/uploads/<?php echo $rowR1['name'];  ?>" alt="pimage">
                                            <h6 class="text-secondary hover-text-success text-capitalize"><a href="propertydetail.php?pid=<?php echo $pid_ ?>"><?php echo $rowR['title']; ?></a>
                                            </h6>
                                            <span class="font-14"><i class="fas fa-map-marker-alt icon-success icon-small"></i>
                                                <?php echo $rowR['city']; ?></span>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </ul>
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
