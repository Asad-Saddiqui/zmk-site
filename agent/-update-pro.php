<?php
session_start();
require("../admin/config/config.php");

include('./validateUser.php');

if (!isset($_SESSION['agentEmail'])) {
    header("location:../login.php");
}
$validate = validate($_SESSION['agentEmail'], $_SESSION['agentID'], $con);
if ($validate !== true) {
    header("location:../login.php");
}
$pid = $_GET['PID'];
$uid = $_SESSION['agentID'];
if (!$pid || !is_numeric($pid)) {
    header("location:-view-pro.php");
}
$query = "SELECT * FROM property WHERE id='$pid' and uid='$uid'";
$result = mysqli_query($con, $query);
$num_row = mysqli_num_rows($result);
if ($num_row < 1) {
    header("location:./-view-pro.php");
}
$row = mysqli_fetch_assoc($result);

function test_input1($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// 
$part1Error = '';

$next1 = true;
$next2 = false;
$installment = true;
$purpose = filter_input(INPUT_POST, 'purpose', FILTER_UNSAFE_RAW);
$purpose = test_input1($purpose);
$propertyType = filter_input(INPUT_POST, 'propertyType', FILTER_UNSAFE_RAW);
$propertyType = test_input1($propertyType);
$propertySubtype = filter_input(INPUT_POST, 'propertySubtype', FILTER_UNSAFE_RAW);
$propertySubtype = test_input1($propertySubtype);
$city = filter_input(INPUT_POST, 'city', FILTER_UNSAFE_RAW);
$city = test_input1($city);
$location = filter_input(INPUT_POST, 'location', FILTER_UNSAFE_RAW);

$pattern = '/<iframe[^>]+src="([^"]+)"/';


// Perform the regular expression match
if ((string)$location === (string)$row['location']) {
    $location;
} else {
    if (preg_match($pattern, $location, $matches)) {
        $location = $matches[1];
    } else {
        $part1Error = "Invalid Location";
        $location = "";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_SESSION['agentID'];
    if ($propertyType === 'Plot') {
        if (
            $propertySubtype === 'Residitional Plot' || $propertySubtype === 'Agricultare Land'
            || $propertySubtype === 'Commercial Plot' || $propertySubtype === 'Plot File' || $propertySubtype === 'Plot Form' || $propertySubtype === 'Residitional Plot'
        ) {
            $propertySubtype = $propertySubtype;
        } else {
            $propertySubtype = "";
        }
    }
    if ($propertyType === 'Commercial') {
        if (
            $propertySubtype === 'Office' || $propertySubtype === 'Shop'
            || $propertySubtype === 'Wherehouse' || $propertySubtype === 'Factory' || $propertySubtype === 'Building' || $propertySubtype === '...Other'
        ) {
            $propertySubtype = $propertySubtype;
        } else {
            $propertySubtype = "";
        }
    }
    if ($propertyType === 'Home') {
        if (
            $propertySubtype === 'House'
            || $propertySubtype === 'Upper Portion'
            || $propertySubtype === 'Penthouse'
            || $propertySubtype === 'Lower Portion' || $propertySubtype === 'Flat' || $propertySubtype === 'Farm House' || $propertySubtype === 'Room'
        ) {
            $propertySubtype = $propertySubtype;
        } else {
            $propertySubtype = "";
        }
    }





    if (empty($purpose) || empty($propertyType) || empty($propertySubtype) || empty($city) || empty($location)) {
        $part1Error = '<div class="alert alert-primary d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
  <div>
    Fill All Data
  </div>
</div>';
    } else {
        // $part1Error = "all dats" . $purpose . $propertyType . $propertySubtype;
        $sql = "UPDATE `property` SET `purpose` = '$purpose',`propertyType` = '$propertyType',
        `propertySubtype` = '$propertySubtype',`city` = '$city',`location` = '$location' WHERE `property`.`id` = $pid;";
        if ($con->query($sql) === TRUE) {

            if ($purpose === 'Rent') {
                header("location:-add-pro-Area-price-rent.php?PID=$pid");
            } else {
                header("location:-add-pro-Area-price-sale.php?PID=$pid");
            }
        }
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Orbit Enterprises</title>
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
        /* scrollbar-color: #EB1616 #191C24; */
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

<style>
    #nav:hover {
        background-color: #d1d1d1;
        ;
    }

    #item:hover {
        background-color: #d1d1d1;
        ;

    }


    #installment1 {
        display: none;
    }

    .btn-check:checked+.btnsecondary {
        color: white;
        ;
        border-color: #000000;
        border-bottom: 2px solid green;
        /* cursor: pointer; */
    }

    .btn-check1:checked+.btnsecondary1 {
        background-color: #e8e8e8;
        color: #00ae00;
        border: 2px solid #00ae00;
        border-radius: 15px;
        padding: 3px;
        cursor: pointer;
    }

    .border1 {
        border: 1px solid black;
        border-radius: 15px;
        padding: 3px;
    }

    .btn-check3:checked+.btnsecondary3 {
        background-color: #e8e8e8;
        color: #00ae00;

        border: 1px solid #00ae00;
        border-radius: 15px;
        padding: 3px;
    }

    .btn-check4:checked+.btnsecondary4 {
        background-color: #e8e8e8;
        color: #00ae00;

        border: 1px solid #00ae00;
        border-radius: 15px;

    }

    .btn-check5:checked+.btnsecondary5 {
        background-color: #e8e8e8;
        color: #00ae00;

        border: 1px solid #00ae00;
        border-radius: 15px;

    }

    .btn-amenities:checked+.amenities {
        background-color: #e8e8e8;
        color: #00ae00;

        border-bottom: 1px solid #00ae00;

    }


    .fade:not(.show) {
        opacity: 1;
    }

    .form-check-input {
        background-color: white;

        width: 24px;
        height: 24px;
    }

    .form-check-input:checked {
        background-color: #178017;
        width: 24px;
        height: 24px;
    }

    .modal-content {
        background-color: #191c24;
    }

    .text-dark {
        color: white;
    }

    input {
        background-color: #191C24;
    }
</style>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content bg-light">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>

            <div class="full-row rounded  ">
                <form method="post" enctype="multipart/form-data">
                    <?php echo $part1Error; ?>
                    <div class="container    rounded">

                        <div class="container-fluid  pt-4 px-4">

                            <?php
                            include("./-update-pro1.php");
                            ?>
                            <div class="container-fluid bg-white pt-4 px-4 ">
                                <div class="container-fluid ">
                                    <div class=" rounded-top p-4 bg-white">
                                        <div class="row col-md-12 col-sm-12 col-lg-12 bg-white ">

                                            <div class="col-md-6 col-sm-6 col-lg-6 text-center " style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                                <input type="submit" class="btn btn-info mt-2 text-center" onclick="customButtonClick()" name="next" style="width: 150px;" value="Update">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                </form>
                <!-- Footer -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-white rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                &copy; <a href="#">Oribit Enterprises Brochure</a>, All Right Reserved.
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-end">
                                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                                Designed By <a href="#">Asad Tariq Saddiqui</a>
                                <br />Contact:
                                <a href="#" target="_blank">+92 348 9979762</a>
                            </div>
                        </div>
                    </div>
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

    <script src="js/jquery.min.js"></script>
    <script src="js/tinymce/tinymce.min.js"></script>
    <script src="js/tinymce/init-tinymce.min.js"></script>
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
    <!-- <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->

    <script>
        var forrent = document.getElementById("forrent");
        var forsell = document.getElementById("forsell");

        function for_sell() {
            if (forsell.style.display === "none") {
                forrent.style.display = "none";
                forsell.style.display = "block";
            }

        }

        function for_rent() {
            if (forrent.style.display === "none") {
                forsell.style.display = "none";
                forrent.style.display = "block";
            }
        }
        var hide_bed_bath = document.getElementById("hide_bed_bath");
        var plotmodels = document.getElementById("plotmodels");
        var homemodel = document.getElementById("homemodel");
        var commericals = document.getElementById("commericals");

        function myFunction() {
            var x = document.getElementById("home");
            var y = document.getElementById("plot");
            var z = document.getElementById("comercial");


            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
                z.style.display = "none";


            } else {
                x.style.display = "block";
                y.style.display = "none";
                z.style.display = "none";


            }
        }

        function myFunction2() {
            var x = document.getElementById("home");
            var y = document.getElementById("plot");
            var z = document.getElementById("comercial");
            if (y.style.display === "none") {
                x.style.display = "none";
                y.style.display = "block";
                z.style.display = "none";


            } else {
                x.style.display = "none";
                y.style.display = "block";
                z.style.display = "none";

            }
        }

        function myFunction3() {
            var x = document.getElementById("home");
            var y = document.getElementById("plot");
            var z = document.getElementById("comercial");
            if (z.style.display === "none") {
                x.style.display = "none";
                y.style.display = "none";
                z.style.display = "block";




            } else {
                x.style.display = "none";
                y.style.display = "none";
                z.style.display = "block";

            }
        }


        var mainfeature = document.getElementById("mainfeature");
        var room = document.getElementById("room");
        var communication = document.getElementById("commuincation1");
        var nearby_Locations = document.getElementById("nearby_Locations1");
        var community_Features = document.getElementById("community_Features1");
        var healthcare_Recreational = document.getElementById("healthcare_Recreational1");
        var otherfeatures = document.getElementById("otherfeatures");
        var plotmodel = document.getElementById("plotmodel");
    </script>

</body>

</html>