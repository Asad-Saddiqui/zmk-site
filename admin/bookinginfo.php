<?php
session_start();
require("./config/config.php");
////code

if (!isset($_SESSION['adminEmail'])) {
    header("location:../login.php");
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
        <div class="content "style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php include("./common/navbar.php"); ?>

            <!-- Navbar end -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">

                <div class="row">
                    <h3 style="text-align: center;" class="col-md-6"> <a href="dashboard.php" style="color: white;">Dashboard</a>&nbsp;/ <a href="bookinginfo.php" style="color: green;">Booking</a></h3>

                </div>


                <hr>
                <!-- <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-white rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <h6 class="mb-2">Total Booking</h6>

                            </div>
                        </div>
                    </div>
                
                    
                    

                </div> -->



                <div class="bg-white text-center rounded p-4">
                    <div class=" align-items-center justify-content-between mb-4">
                        <h5 class="mb-0 text-dark">Total Booking</h5>
                        <hr>
                    </div>
                    <div class="table-responsive">

                        <table id="myTable" class="table table-striped dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">#</th>
                                    <th style="text-align: left;">Email</th>
                                    <th style="text-align: left;">Phone</th>
                                    <th style="text-align: left;">Message</th>
                                    <th style="text-align: left;">Date</th>
                                    <th style="text-align: left;">Actions</th>

                                </tr>
                            </thead>


                            <tbody>
                                <?php


                                $count = 1;
                                $query = mysqli_query($con, "SELECT booking.*, profile.* FROM booking JOIN profile ON profile.uid = booking.uid;");
                                while ($row = mysqli_fetch_assoc($query)) {

                                ?>
                                    <tr>
                                        <td style="text-align: left; color: #EB1616;">
                                            <?php echo $count ?>
                                        </td>
                                        <td style="text-align: left;">
                                            <?php echo $row['email']; ?>
                                        </td>
                                        <td style="text-align: left;">
                                            <?php echo $row['cphone']; ?>
                                        </td>
                                        <td style="text-align: left;">
                                            <?php echo $row['message']; ?>
                                        </td>
                                        <td style="text-align: left;">
                                            <?php echo $row['date']; ?>
                                        </td>

                                        <td style="text-align: left;">
                                            <a href="bookingdelete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
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