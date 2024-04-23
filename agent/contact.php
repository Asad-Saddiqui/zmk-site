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
$error = '';
if (isset($_POST['deletebtn'])) {
    $id = $_POST['btnID'];
    $check = "SELECT booking.*,user.email FROM booking JOIN user ON user.id=booking.uid where booking.id='$id'";
    $res = mysqli_query($con, $check);
    $row_ = mysqli_fetch_row($res);
    $count = mysqli_num_rows($res);
    if ($count === 1) {
        if ($row_['6'] === $_SESSION['agentEmail']) {
            $del = "DELETE FROM booking WHERE `booking`.`id` = $id";
            $res = mysqli_query($con, $del);
            if ($res) {
                $error = '<div class="alert alert-success" role="alert">
                        Deleted Successfully !
                        </div>';
            } else {
                $error = '<div class="alert alert-warning" role="alert">
                        something Went Wrong
                        </div>';
            }
        } else {
            $error = '<div class="alert alert-danger" role="alert">
                        Invalid Something!
                        </div>';
        }
    } else {
        $error = '<div class="alert alert-danger" role="alert">
                        Invalid Something!
                        </div>';
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
        <!-- Sidebar Start -->
        <?php include("./common/sidebar.php"); ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content bg-light">
            <!-- Navbar Start -->
            <?php include("./common/navbar.php"); ?>

            <!-- Navbar end -->
            <!-- Recent Sales Start -->
            <div class="container-fluid  pt-4 px-4">

                <div class="row">
                    <h3 style="text-align: center;" class="col-md-6"> <a href="dashboard.php" style="color: white;">Dashboard</a>&nbsp;/ <a href="bookinginfo.php" style="color: lightgreen;">Booking</a></h3>
                    <h3 style="text-align: center;" class="col-md-6">
                        <!-- exportPropertyData.php -->
                        <!-- <form action="bookingExport.php" method="post">
                            <button type="submit" id="btnExport" name='bookingpexport' value="Export to Excel" class="btn btn-info">Export All Data to Excel</button>
                        </form> -->
                    </h3>
                </div>


                <hr>
                <!-- <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <h6 class="mb-2">Total Booking</h6>

                            </div>
                        </div>
                    </div>
                
                    
                    

                </div> -->



                <div class="bg-white text-center rounded p-4">
                    <div class=" align-items-center justify-content-between mb-4">
                        <h5 class="mb-0 text-dark">Total Booking</h5>
                        <?php echo $error; ?>
                    </div>
                    <div class="table-responsive bg-white">

                        <table id="myTable" class="table table-striped dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">#</th>
                                    <th style="text-align: left;">Email</th>
                                    <th style="text-align: left;">Message</th>
                                    <th style="text-align: left;">Date</th>
                              
                                    <th style="text-align: left;">Action</th>

                                </tr>
                            </thead>


                            <tbody>
                                <?php


                                $count = 1;
                                $uid = $_SESSION['agentID'];
                                $query = mysqli_query($con, "SELECT * FROM booking where booking.uid='$uid';");
                                while ($row = mysqli_fetch_row($query)) {

                                ?>
                                    <tr>
                                        <td style="text-align: left; color: #EB1616;">
                                            <?php echo $count ?>
                                        </td>
                                        <td style="text-align: left;">
                                            <?php echo $row['2']; ?>
                                        </td>
                                        <td style="text-align: left;">
                                            <?php echo $row['3']; ?>
                                        </td>
                                        <td style="text-align: left;">
                                            <?php echo $row['4']; ?>
                                        </td>
                                       

                                        <td style="text-align: left;">
                                            <form method="post">
                                                <input class="form-control" hidden type="number" value="<?php echo $row['0']; ?>" name="btnID">
                                                <button class="btn btn-danger" type="submit" name="deletebtn"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                    $count = $count + 1;
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- ... -->
                    </div>
                </div>
                <!-- nknl -->
            </div>
            <!-- Recent Sales End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white rounded-top p-4">
                    <div class="row ">
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
    <!-- <script src="js/main.js"></script> -->
</body>

</html>