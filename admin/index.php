<?php
session_start();
require("./config/config.php");

if (!isset($_SESSION['adminEmail'])) {
    header("location:../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard-Home</title>
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

  <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    @media (max-width: 400px) {
        #hide {
            display: none;
        }
    }

    @media (max-width: 300px) {
        #hide2 {
            display: none;
        }
    }
</style>


<body>

    <div class="container-fluid position-relative d-flex p-0 "style="background-color:#e9ecef">

        <?php include("./common/sidebar.php"); ?>
        <!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content "style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php include("./common/navbar.php"); ?>

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4 ">
                <h2 style="color: white; text-align: center">
                    Well come to ZMK
                </h2>
                <hr />
                <div class="row g-4 bg-light ">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-white  rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2"> Admin </p>
                                <h6 class="text-dark">
                                    <?php $sql = "SELECT * FROM user WHERE role = 'admin'";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows"; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-white  rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Users</p>
                                <h6 class="text-dark"><?php $sql = "SELECT * FROM user WHERE role = 'user'";
                                                    $query = $con->query($sql);
                                                    echo "$query->num_rows"; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-white  rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-success"></i>
                            <div class="ms-3">
                                <p class="mb-2">Agents</p>
                                <h6 class="text-dark">
                                    <?php $sql = "SELECT * FROM user WHERE role = 'agent'";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows"; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-white  rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">Properties</p>
                                <h6 class="text-dark">
                                                                        <?php
                                    $sql = "SELECT * FROM property";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows";
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>




                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-white  rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-quote-left fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">On Rent</p>
                                <h6 class="text-dark">
                                    <?php
                                    $sql = "SELECT * FROM property where purpose = 'Rent' and status='active'";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows";
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-white  rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-quote-right fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">On Sale</p>
                                <h6 class="text-dark">
                                    <?php
                                     $sql = "SELECT * FROM property where purpose = 'Sale'";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows";
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
          
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>
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