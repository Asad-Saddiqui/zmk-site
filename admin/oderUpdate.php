<?php
session_start();
require("./config/config.php");

if (!isset($_SESSION['adminEmail'])) {
    header("location:index.php");
    exit(); // Ensure script stops execution after redirect
}
$id = $_GET['aid'];
$qid = $_GET['qid'];
$pqid = $_GET['pqid'];
if (
    !is_numeric($id)
    || !is_numeric($qid)
    || !is_numeric($pqid)
) {
    header("location:membership.php");
}


$error = "";
$msg = "";

if (isset($_POST['reg'])) {
    // Validate and sanitize inputs
    $Pending = $_POST['Pending'] ?? '0';
    $Quantity = $_POST['Quantity'] ?? '0';

    $sqli = "UPDATE `oder` SET `varify` = '$Quantity',`Quantity` = '$Pending' WHERE `oder`.`id` = '$id';";
    $result = mysqli_query($con, $sqli);
    header("location:membership.php");
}
?>

<!-- Your HTML content remains unchanged -->


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

</style>

<body>

    <div class="container-fluid position-relative d-flex p-0">

        <!-- sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- sidebar end -->
        <!-- Content Start -->
        <div class="content bg-white">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>








            <div class="container-fluid position-relative d-flex p-0">
                <!-- Spinner Start -->

                <!-- Spinner End -->


                <!-- Sign Up Start -->
                <div class="container-fluid " style="background-color:#e9ecef">
                    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-5">

                            <div class=" rounded p-4 p-sm-5 my-2 bg-white ">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="index.html" class="">
                                        <h5 class="text-light">Card
                                            Penal
                                        </h5>
                                        <?php echo $error;
                                        ?><?php echo $msg; ?>
                                    </a>
                                </div>

                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Quantity For Verifying</label>
                                        <input class="form-control my-2" value="<?php echo $qid ?>" min="0" type="number" style="background-color: white;height:50px; color: black; font-family: sans-serif;" placeholder="Pending.." name="Pending">
                                    </div>
                                    <div class="form-group">
                                        <label>Pending</label>

                                        <input class="form-control my-2" value="<?php echo $pqid ?>" min="0" type="number" style="background-color:white;height:50px; color: black; font-family: sans-serif;" placeholder="Quantity.." name="Quantity">
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
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Oribit Enterprises Brochure</a>, All Right Reserved.
                        </div>
                       
                    </div>
                </div>
            </div>
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