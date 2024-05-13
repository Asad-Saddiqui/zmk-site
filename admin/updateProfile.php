<?php
session_start();
require("./config/config.php");
////code

if (!isset($_SESSION['adminEmail'])) {
    header("location:index.php");
}
$uid = $_GET['aid'];

$mysqli = "SELECT * FROM profile WHERE uid=1";
$results = mysqli_query($con, $mysqli);
$numRows = mysqli_num_rows($results);
$rows__ = mysqli_fetch_assoc($results);
$errors = "";
if (isset($_POST['contactbtn'])) {
    $companyName = mysqli_real_escape_string($con, $_POST['companyName']);
    $companyEmail = mysqli_real_escape_string($con, $_POST['companyEmail']);
    $companyMobile = mysqli_real_escape_string($con, $_POST['companyMobile']);
    $companyLandline = mysqli_real_escape_string($con, $_POST['comapnyLandline']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $fbUrl = mysqli_real_escape_string($con, $_POST['fburl']);
    $youtubeUrl = mysqli_real_escape_string($con, $_POST['youtuburl']);
    $instaUrl = mysqli_real_escape_string($con, $_POST['instaurl']);
    // Validate input
    $errors = "";
    // Validate Company Mobile
    // Validate Company Name
    if (empty($companyName)) {
        $errors = "Company Name is required";
    } elseif (strlen($companyName) > 50) {
        $errors = "Company Name should not exceed 50 characters";
    }
    $allowedImageTypes = ['image/png', 'image/jpg', 'image/jpeg'];
    $aimage = $_FILES['a_img'];
    $uimage = '';
    if ($aimage) {
        $aimageType = $_FILES['a_img']['type'];
        $fileExtension = pathinfo($_FILES['a_img']['name'], PATHINFO_EXTENSION);
        // $errors = $fileExtension;

        if (!in_array($aimageType, $allowedImageTypes)) {
            $errors = "Please select a valid image type (png, jpg, jpeg) s";
        } else {
            $uimage = time() . "logo" . "." . $fileExtension;
            $temp_name  = $_FILES['a_img']['tmp_name'];
            move_uploaded_file($temp_name, "./common/user/$uimage");
            unlink('./common/user/' . $rows__['logo']);
        }
    }

    // Validate Company Email
    if (empty($companyEmail)) {
        $errors = "Company Email is required";
    } elseif (!filter_var($companyEmail, FILTER_VALIDATE_EMAIL)) {
        $errors = "Invalid company email format";
    }
    if (empty($companyMobile)) {
        $errors = "Company Mobile is required";
    } elseif (!preg_match('/^[0-9]$/', $companyMobile) && strlen($companyMobile) > 13) {
        $errors = "Invalid company mobile format";
    }
    // Validate Company Mobile
    if (empty($companyLandline)) {
        $errors = "Company landline is required";
    } elseif (!preg_match('/^[0-9]$/', $companyLandline) && strlen($companyLandline) > 13) {
        $errors = "Invalid company number format";
    }
    if (empty($address)) {
        $errors = "Company address is required";
    } elseif (!preg_match('/^[A-Za-z 0-9]$/', $address) && strlen($address) > 140) {
        $errors = " Address Invalid only text and number format and not exceed 50 characters";
    }
    if (empty($message)) {
        $errors = "Company About is required";
    } elseif (!preg_match('/^[A-Za-z 0-9]{1000}$/', $message) && strlen($message) > 1000) {
        $errors = "About Invalid only text and number format not exceed 1000 characters";
    }


    if (empty($errors)) { // If there are no validation errors
        // Insert data into the profile table
        if ($numRows === 1) {
            $sqli_ = "UPDATE `profile`
            SET 
            `compyemail` = '$companyEmail',
            `comname` = '$companyName',
            `logo` = '$uimage',
            `cphone` = '$companyMobile',
            `clandline` = '$companyLandline',
            `youtuburl` = '$youtubeUrl',
            `instaurl` = '$instaUrl',
            `about` = '$message',
            `compaddress` = '$address',
            `fburl` = '$fbUrl'
            WHERE 
            `profile`.`uid` = 1";
            if (mysqli_query($con, $sqli_)) {
                              $error = "<script>alert('Profile Updated Successfully')</script>";

            } else {
                $errors = "Error: " . $insertQuery . "<br>" . mysqli_error($con);
            }
        }
        //  else {
        //     $insertQuery = "INSERT INTO `profile`(`comid`, `uid`, `cphone`, `clandline`, `fburl`, `youtuburl`, `instaurl`, `about`, `compaddress`, `logo`, `compyemail`,, `comname`)VALUES 
        //     (NULL, '$uid', '$companyMobile', '$companyLandline', '$fbUrl', '$youtubeUrl', '$instaUrl', '$message', '$address','$uimage','$companyEmail','$companyName')";
        //     if (mysqli_query($con, $insertQuery)) {
        //         $errors = "Record inserted successfully";
        //     } else {
        //         $errors = "Error: " . $insertQuery . "<br>" . mysqli_error($con);
        //     }
        // }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile</title>
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
    <link href="./lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="./lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
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
    scrollbar-color: #FFA500 #191C24; /* Orange warning color */
}

/* Chrome, Edge, and Safari */
*::-webkit-scrollbar {
    width: 16px;
}

*::-webkit-scrollbar-track {
    background: #191C24;
}

*::-webkit-scrollbar-thumb {
    background-color: #FFA500; /* Orange warning color */
    border-radius: 10px;
    border: 3px solid #191C24;
    height: 50px;
}


    /* *{
            overflow-x: hidden;
        } */
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content "style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php include("./common/navbar.php"); ?>


            <div class="container d-flex">
                <div class="col-sm-12 col-xl-12 bg-white container-fluid my-5 py-3">
                    <h3 class="text-dark">Profile Changes</h3>
                    <p><?php echo $errors; ?></p>
                    <form method="post" action="" enctype="multipart/form-data">

                        <div class="row">


                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <input name="companyName" value="<?php
                                                                        if ($rows__ !== NULL) {
                                                                            echo $rows__['comname'];
                                                                        }

                                                                        ?>" type="tel" class="form-control bg-white form-control-lg form-control rounded-0 border-success border-top-0 border-end-0 border-start-0" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <input type="tel" name="companyEmail" value="<?php
                                                                                    if ($rows__ !== NULL) {
                                                                                        echo $rows__['compyemail'];
                                                                                    }

                                                                                    ?>" maxlength="30" class=" bg-white form-control form-control-lg form-control rounded-0 border-success border-top-0 border-end-0 border-start-0" placeholder="Company Email">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <input type="file" name="a_img" class="form-control bg-white form-control-lg form-control bg-dark rounded-0 border-success border-top-0 border-end-0 border-start-0">

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <input name="companyMobile" value="<?php
                                                                        if ($rows__ !== NULL) {
                                                                            echo $rows__['cphone'];
                                                                        }

                                                                        ?>" type="tel" class="form-control bg-white form-control-lg form-control rounded-0 border-success border-top-0 border-end-0 border-start-0" placeholder="Mobile #">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    
                                    <input type="tel" name="comapnyLandline" value="<?php
                                                                                    if ($rows__ !== NULL) {
                                                                                        echo $rows__['clandline'];
                                                                                    }

                                                                                    ?>" maxlength="30" class="form-control bg-white form-control-lg form-control rounded-0 border-success border-top-0 border-end-0 border-start-0" placeholder="Landline">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <input type="text" name="address" value="<?php
                                                                                if ($rows__ !== NULL) {
                                                                                    echo $rows__['compaddress'];
                                                                                }

                                                                                ?>" maxlength="140" class="form-control bg-white form-control-lg rounded-0 border-success border-top-0 border-end-0 border-start-0" placeholder="Address">
                                </div>
                            </div>


                            <div class="col-md-4 my-3">
                                <div class="form-group">
                                    <input type="url" name="fburl" value="<?php
                                                                            if ($rows__ !== NULL) {
                                                                                echo $rows__['fburl'];
                                                                            }

                                                                            ?>"" maxlength=" 140" class="form-control bg-white form-control-lg rounded-0 border-success border-top-0 border-end-0 border-start-0" placeholder="Facbook Link">
                                </div>
                            </div>
                            <div class="col-md-4 my-3">
                                <div class="form-group">
                                    <input type="url" value="<?php
                                                                if ($rows__ !== NULL) {
                                                                    echo $rows__['youtuburl'];
                                                                }

                                                                ?>"" name=" youtuburl" class="form-control bg-white form-control-lg rounded-0 border-success border-top-0 border-end-0 border-start-0" placeholder="Youtub Link">
                                </div>
                            </div>
                            <div class="col-md-4 my-3">
                                <div class="form-group">
                                    <input type="url" value="<?php
                                                                if ($rows__ !== NULL) {
                                                                    echo $rows__['instaurl'];
                                                                }

                                                                ?>" name="instaurl" class="form-control bg-white form-control-lg rounded-0 border-success border-top-0 border-end-0 border-start-0" placeholder="Instagram Link">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea maxlength="1000" class="form-control bg-white rounded-0 border-success border-top-0 border-end-0 border-start-0" name="message" cols="45" rows="4"><?php
                                                                                                                                                                                        if ($rows__ !== NULL) {
                                                                                                                                                                                            echo trim($rows__['about']);
                                                                                                                                                                                        }
                                                                                                                                                                                        ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3 text-center">
                                <button type="submit" name="contactbtn" class=" text-white btn btn-success">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Start -->
            
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- /////////////////////////////////////////// -->


    <!-- JavaScript Libraries -->
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
    </script>
</body>

</html>