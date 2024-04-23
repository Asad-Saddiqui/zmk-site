<?php
session_start();
require("config.php");
////code

if (!isset($_SESSION['uname'])) {
    header("location:index.php");
}
if (!isset($_GET['b_id']) && !isset($_GET['uid'])) {
    header("location:bookinginfo.php");

}
if (isset($_POST['response'])) {

    $b_id = $_GET['b_id'];
    $uid = $_GET['uid'];
    $uaid = $_SESSION['uaid'];
   
    function test_input__($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
   
    $res = test_input__($_POST['res']);
    $sql = "INSERT INTO `response` (`res_id`, `response`, `uid`, `uaid`, `b_id` ) VALUES (NULL, '$res', '$uid', '$uaid', '$b_id');";
    $result = mysqli_query($con, $sql);
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

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
        <?php include("sidebar.php"); ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include("navbar.php"); ?>

            <!-- Navbar end -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <h3 style="text-align: center;"> <a href="dashboard.php" style="color: white;">Dashboard</a>&nbsp;/ <a
                        href="bookinginfo.php" style="color: green;">Booking </a></h3>

                <hr>
                <!-- <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <h6 class="mb-2">Total Booking</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <h6 class="mb-2">Pending</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <h6 class="mb-2">Approved</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <h6 class="mb-2">Reject</h6>

                            </div>
                        </div>
                    </div>

                </div> -->



                <div class="bg-dark text-center rounded p-4">
                    <div class=" align-items-center justify-content-between mb-4">
                        <h5 class="mb-0">Booking Response</h5>
                        <hr>
                    </div>
                    <form method="post">
                        <div class="row">
                        <?php
                                     $uid = $_GET['uid'];
                                     $b_id = $_GET['b_id'];
                                     $sql = "select * from booking where b_id='$b_id'";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_row($result);

                                       ?>
                            <div class="col-xl-12 my-2">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">User Id </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="id" readonly value="<?php echo $uid;?> "
                                            class="form-control text-light bg-secondary">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 my-2">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Booking info</label>
                                    <div class="col-lg-9">
                                        <input type="text"  readonly name="name" value="<?php echo $row['9'];
                                        echo " Booked by :"; echo $row['1'] ?>"
                                            class="form-control text-light bg-secondary">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 my-2">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Description</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control bg-secondary text-light" name="res"
                                            rows="10" cols="30"
                                            placeholder="Enter some message for client" minlength="70"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Submit </label>

                                            <div class="col-lg-2">
                                                <input type="submit" class="form-control my-2  " style="background-color: blue; color: white;"
                                                    name="response" required  />
                                            </div>
                                            <div class="col-lg-3">
                                                 <a href="viewres.php?b_id=<?php echo $b_id?>&uid=<?php echo $uid ?>" class="my-2 btn" style="background-color: green; color: white;" > View Response </a>
                                            </div>
                                        </div>
                        </div>
                    </form>

                </div>
                <!-- nknl -->
            </div>
            <!-- Recent Sales End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
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
    <script>$(document).ready(function () {
            $('#myTable').DataTable();
        });</script>
    <!-- <script src="js/main.js"></script> -->
</body>

</html>