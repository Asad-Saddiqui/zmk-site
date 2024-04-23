<?php
session_start();
require("./config/config.php");

if (!isset($_SESSION['adminEmail'])) {
    header("location:index.php");
    exit(); // Ensure script stops execution after redirect
}

$error = "";
$msg = "";
$uid = $_SESSION['adminID'];
if (isset($_POST['reg'])) {
    // Validate and sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_EMAIL);
    $duration = filter_input(INPUT_POST, 'duration', FILTER_UNSAFE_RAW);

    $allowedImageTypes = ['image/png', 'image/jpg', 'image/jpeg'];
    $aimageType = $_FILES['a_img']['type'];
    $fileExtension = pathinfo($_FILES['a_img']['name'], PATHINFO_EXTENSION);
    if (!$name) {
        $error = "<p class='alert alert-warning'>Please Enter Card  Name</p>";
    } else if (!$price) {
        $error = "<p class='alert alert-warning'>Please Enter  Price</p>";
    } else if (!$duration) {
        $error = "<p class='alert alert-warning'>Please Select  Duration</p>";
    } else if (!in_array($aimageType, $allowedImageTypes)) {
        $error = "<p class='alert alert-warning'>Please select a valid image type (png, jpg, jpeg)</p>";
    } else {
        $uimage = time() . "card" . "." . $fileExtension;
        $temp_name  = $_FILES['a_img']['tmp_name'];
        move_uploaded_file($temp_name, "./card/$uimage");
        $query = "SELECT COUNT(*) AS count FROM `card` WHERE price = '$price' AND name = '$name' AND duration = '$duration';";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $count = (int)$row['count'];


        if ($count == 1) {
            $error = "<p class='alert alert-warning'>Card Already Exist</p>";
        } else {
            if (!empty($name) && !empty($price) && !empty($duration)  && !empty($uimage)) {
                // Use prepared statements to prevent SQL injection
                $query = "INSERT INTO `card` (`id`, `price`, `name`, `image`, `duration`, `uid`) VALUES (NULL, '$price', '$name', '$uimage', '$duration', '$uid');";
                $res = mysqli_query($con, $query);

                if ($res) {
                    $msg = '<script>alert("Added Successfully!")</script>';
                    $name = "";
                    $price = "";
                    $duration = "";
                } else {
                    $error = "<p class='alert alert-warning'>Card Registration Failed</p>";
                    return;
                }
            } else {
                $error = "<p class='alert alert-warning'>Please fill all the fields</p>";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>New-Admin</title>
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
</head>
<style>
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        color: #7a7a7a;
    }

    * {
        scrollbar-width: auto;
        scrollbar-color: #EB1616 #191C24;
    }

    /* Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 16px;
    }

    *::-webkit-scrollbar-track {
        background: #191C24;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #EB1616;
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

        <!-- sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- sidebar end -->
        <!-- Content Start -->
        <div class="content "style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>








            <div class="container-fluid position-relative d-flex p-0">
                <!-- Spinner Start -->

                <!-- Spinner End -->


                <!-- Sign Up Start -->
                <div class="container-fluid ">
                    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-5">

                            <div class=" rounded p-4 p-sm-5 my-2 bg-white ">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="index.html" class="">
                                        <h5 class="text-light"><i class="fa fa-card me-2"></i>Card
                                            Penal
                                        </h5>
                                        <?php echo $error;
                                        ?><?php echo $msg; ?>
                                    </a>
                                </div>

                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" maxlength="30" type="text" style="background-color: #191C24;height:50px; color: red; font-family: sans-serif;" placeholder="Name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" type="number" maxlength="30" style="background-color: #191C24;height:50px; color: red; font-family: sans-serif;" placeholder="Price" name="price">
                                    </div>

                                    <div class="form-group">
                                        <!-- <input class="form-control my-2" type="text" style="background-color: #191C24;height:50px; color: red; font-family: sans-serif;" placeholder="Phone" name="phone" maxlength="10"> -->
                                        <select class="form-control bg-white my-2" name="duration" style="background-color: #191C24;height:50px;  font-family: sans-serif;">
                                            <option value="">Select Duration</option>
                                            <option value="7">7 Days</option>
                                            <option value="15">15 Days</option>
                                            <option value="30">1 Month</option>
                                            <option value="60">2 Month</option>
                                            <option value="90">3 Month</option>
                                            <option value="180">6 Month</option>
                                            <option value="365">1 Year</option>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <input class="form-control my-2" type="file" name="a_img">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input class="btn w-100 mb-2" style="background-color:green; color: white; border: 2px solid black; font-family: sans-serif;" type="submit" name="reg" Value="Register">
                                    </div>
                                </form>

                                <!-- <p class="text-center mb-0">Already have an Account? <a href="/RealEstate-PHP/admin2/index.php">Sign In</a></p> -->

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Sign Up End -->
            </div>
            <!-- Recent Sales End -->





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
</body>

</html>