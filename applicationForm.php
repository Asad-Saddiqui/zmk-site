<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("./admin/config/config.php");

if (!isset($_SESSION['userEmail'])) {
    header("location:./login.php");
}
include("./expire.php");
expire($con);
$errors = "";
function test_input1($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$uid = $_SESSION['userID'];
$prof = "SELECT * FROM `profile` where uid = $uid";
$result_ = mysqli_query($con, $prof);
$num = mysqli_num_rows($result_);
$row = mysqli_fetch_assoc($result_);
if (isset($_POST['contactbtn'])) {

    $companyName = test_input1(mysqli_real_escape_string($con, $_POST['companyname']));
    $companyEmail = test_input1(mysqli_real_escape_string($con, $_POST['companyemail']));
    $companyMobile = test_input1(mysqli_real_escape_string($con, $_POST['companyMobile']));
    $companyLandline = test_input1(mysqli_real_escape_string($con, $_POST['comapnyLandline']));
    $address = test_input1(mysqli_real_escape_string($con, $_POST['address']));
    $message = test_input1(mysqli_real_escape_string($con, $_POST['message']));
    $fbUrl = mysqli_real_escape_string($con, $_POST['fburl']);
    $youtubeUrl = mysqli_real_escape_string($con, $_POST['youtuburl']);
    $instaUrl = mysqli_real_escape_string($con, $_POST['instaurl']);

    // Validate input
    $errors = array();

    // Validate Company Name
    if (empty($companyName)) {
        $errors = "Company Name is required";
    } elseif (strlen($companyName) > 50) {
        $errors = "Company Name should not exceed 50 characters";
    }

    // Validate Company Email
    if (empty($companyEmail)) {
        $errors = "Company Email is required";
    } elseif (!filter_var($companyEmail, FILTER_VALIDATE_EMAIL)) {
        $errors = "Invalid company email format";
    }

    // Validate Company Mobile
    if (empty($companyMobile)) {
        $errors = "Company Mobile is required";
    } elseif (strlen($companyMobile) > 13) {
        $errors = "Invalid company mobile format";
    }
    // Validate Company Mobile
    if (empty($companyLandline)) {
        $errors = "Company landline is required";
    } elseif (strlen($companyLandline) > 13) {
        $errors = "Invalid company number format";
    }
    if (empty($address)) {
        $errors = "Company address is required";
    } elseif (strlen($address) > 140) {
        $errors = " Address Invalid only text and number format and not exceed 50 characters";
    }
    if (empty($message)) {
        $errors = "Company About is required";
    } elseif (strlen($message) > 1000) {
        $errors = "About  not exceed 1000 characters";
    }
    $allowedImageTypes = ['image/png', 'image/jpg', 'image/jpeg'];
    $aimage = $_FILES['a_img']['name'];
    $uimage = '';

    if (!empty($aimage)) {
        $aimageType = $_FILES['a_img']['type'];
        $fileExtension = pathinfo($_FILES['a_img']['name'], PATHINFO_EXTENSION);
        // $errors = $fileExtension;

        if (!in_array($aimageType, $allowedImageTypes)) {
            $errors = "Please select a valid image type (png, jpg, jpeg)";
        } else {
            $uimage = time() . "logo" . "." . $fileExtension;
        }
    } else {
        $uimage =  !empty($row['logo']) ? $row['logo'] : '';
    }

    if (empty($errors)) { // If there are no validation errors
        // Insert data into the profile table

        if ($num === 1) {
            if (!empty($uimage)) {
                       $insertQuery = "UPDATE `profile` SET 
                                    `cphone` = '$companyMobile',
                                    `clandline` = '$companyLandline',
                                    `fburl` = '$fbUrl',
                                    `youtuburl` = '$youtubeUrl',
                                    `instaurl` = '$instaUrl',
                                    `about` = '$message',
                                    `compaddress` = '$address',
                                    `logo` = '$uimage',
                                    `compyemail` = '$companyEmail',
                                    `comname` = '$companyName'
                                WHERE 
                                    `uid` = '$uid'";
                if (mysqli_query($con, $insertQuery)) {
                    if (!empty($uimage)) {
                        if ((string)$row['logo'] === (string)$uimage) {
                            $uimage = $row['logo'];
                        } else {
                            $temp_name  = $_FILES['a_img']['tmp_name'];
                            if (move_uploaded_file($temp_name, "./admin/common/user/$uimage")) {
                                $path = './admin/common/user/' . $row['logo'];
                                if (file_exists($path)) {
                                    unlink($path);
                                }
                            }
                        }
                    }

                    $mysqli_ = "UPDATE `user` SET `active` = '2',`varified`=1 WHERE `user`.`id` = $uid";
                    mysqli_query($con, $mysqli_);
                    $message = "Save Successfully !";
                    header('location:index.php');
                } else {
                    $errors = "Error: " . $insertQuery . "<br>" . mysqli_error($con);
                }
            } else {
                $errors = "Please Select a  valid logo";
            }
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
    <title>ZMK Application Form</title>
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
                            <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Application Form</b></h2>
                        </div><!-- FOR MORE PROJECTS visit: codeastro.com -->
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="float-left float-md-right">
                                <ol class="breadcrumb bg-transparent m-0 p-0">
                                    <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Application</li>
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

                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="applicationForm.php" enctype="multipart/form-data">
                                            <h2 class="text-dark">
                                                <?php print_r($errors);

                                                $prof = "SELECT * FROM `profile` where uid = $uid";
                                                $result_ = mysqli_query($con, $prof);
                                                $rows = mysqli_fetch_assoc($result_);
                                                ?>
                                            </h2>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label>Company Name* :</label>
                                                        <input type="text" name="companyname" value="<?php if (!empty($rows['comname'])) {
                                                                                                            echo $rows['comname'];
                                                                                                        } ?>" class="form-control form-control-lg form-control-a" placeholder="Company Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                         <label>Company Email* :</label>
                                                        <input name="companyemail" value="<?php if (!empty($rows['compyemail'])) {
                                                                                                echo $rows['compyemail'];
                                                                                            } ?>" type="email" class="form-control form-control-lg form-control-a" placeholder="Company Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label>Company Phone* :</label>
                                                        <input name="companyMobile" value="<?php if (!empty($rows['cphone'])) {
                                                                                                echo $rows['cphone'];
                                                                                            } ?>" type="tel" class="form-control form-control-lg form-control-a" placeholder="Company Mobile #">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label>Company Landline* :</label>
                                                        <input type="tel" name="comapnyLandline" value="<?php if (!empty($rows['clandline'])) {
                                                                                                            echo $rows['clandline'];
                                                                                                        } ?>" maxlength="30" class="form-control form-control-lg form-control-a" placeholder="Company Landline">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label>Company Address* :</label>
                                                        <input type="text" name="address" value="<?php if (!empty($rows['compaddress'])) {
                                                                                                        echo $rows['compaddress'];
                                                                                                    } ?>" maxlength="140" class="form-control form-control-lg form-control-a" placeholder="Company Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label>Company logo* :</label>
                                                        <input type="file" name="a_img" class="form-control form-control-lg form-control-a" placeholder="Company Landline">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label>Company Facebook Link* :</label>
                                                        <input type="url" name="fburl" value="<?php if (!empty($rows['fburl'])) {
                                                                                                    echo $rows['fburl'];
                                                                                                } ?>" maxlength="140" class="form-control form-control-lg form-control-a" placeholder="Facbook Link">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label>Company Youtube Link* :</label>
                                                        <input type="url" name="youtuburl" value="<?php if (!empty($rows['youtuburl'])) {
                                                                                                        echo $rows['youtuburl'];
                                                                                                    } ?>" class="form-control form-control-lg form-control-a" placeholder="Youtub Link">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label>Company Instagram Link* :</label>
                                                        <input type="url" name="instaurl" value="<?php if (!empty($rows['instaurl'])) {
                                                                                                        echo $rows['instaurl'];
                                                                                                    } ?>" class="form-control form-control-lg form-control-a" placeholder="Instagram Link">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Company About* :</label>
                                                        <textarea maxlength="1000" class="form-control" name="message" cols="45" rows="4"> <?php if (!empty($rows['about'])) {
                                                                                                                                                echo $rows['about'];
                                                                                                                                            } ?> </textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3 text-center">
                                                    <button type="submit" name="contactbtn" class="btn bg-success">Save Profile </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>

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