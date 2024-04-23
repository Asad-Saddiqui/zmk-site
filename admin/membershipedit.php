<?php
session_start();
require("config.php");
////code

if (!isset($_SESSION['uname'])) {
    header("location:index.php");
}
if (!isset($_GET['active'])) {
   header("location:membership.php");
}
//// code insert
//// add code
$error = "";
$msg = "";
$caid =$_GET['active'];
if (isset($_POST['updatecart'])) {
    $qun_ = $_POST['qun'];
    $act_ = $_POST['act'];
    $pay_ = $_POST['pay'];
    $myup="UPDATE `purchase_cart` SET `cart_quantity` = $qun_, `total_pay_amount_` = $pay_, `u_status` = ' $act_' WHERE `purchase_cart`.`cart_id` =$caid;";
    $res=mysqli_query($con, $myup);
    if ($res) {
        header("location:membership.php");
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
    .dataTables_wrapper .dataTables_length select {
        color: #7b7b7b;
    }
</style>
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

    .mce-container-body {
        background: #111;
        color: #35ff00;
    }

    .mce-container {
        display: block;
        background-color: green;
    }
</style>
<!-- UPDATE `purchase_cart` SET `cart_quantity` = '3', `total_pay_amount_` = '500000', `u_status` = 'inactive' WHERE `purchase_cart`.`cart_id` = 44; -->
<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        include("sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            include("navbar.php");
            ?>

            <!-- Navbar end -->
            <!-- Recent Sales Start -->
            <div class="full-row ">

                <div class="container my-4">
                    <h3 style="text-align: center;"> <a href="dashboard.php" style="color: white;">Dashboard</a>&nbsp;/
                        <a href="addproperty.php" style="color: green;"> Edit Membership
                        </a></h3>

                    <hr>
                    <hr>
                    <div class="row p-4 bg-dark">
                        <form method="post" enctype="multipart/form-data" class="bg-secondary rounded">
                            <div class="description">
                                <h5 class="text-light my-3">Activate  Cart</h5>
                                <hr />
                                <?php echo $error; ?>
                                <?php echo $msg; ?>
                                <?php $query = mysqli_query($con, "SELECT* FROM `purchase_cart` where cart_id=$caid;
                                ");
                                $row = mysqli_fetch_row($query) ?>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Total Payment</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control my-2 bg-secondary text-light"
                                                    name="pay" required value="<?php echo $row['10'] ?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Quantity</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control my-2 bg-secondary text-light"
                                                    name="qun" required  value="<?php echo $row['2'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Status</label>
                                            <div class="col-lg-9">
                                                <select name="act" required id="" class="form-control bg-secondary text-light ">
                                                    <option value="">Please select to activate</option>
                                                    <option value="active">Active</option>
                                                </select>
                                            </div>
                                        </div>
                                      
                                      
                                       

                                    </div>
                                    
                                    <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Submit </label>

                                            <div class="col-lg-3">
                                                <input type="submit" class="form-control my-2  " style="background-color: blue; color: white;"
                                                    name="updatecart" required  />
                                            </div>
                                        </div>
    
                                </div>

                        </form>
                    </div>
                </div>
            </div>

            <!--	Submit property   -->

            <!-- Recent Sales End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
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
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- /////////////////////////////////////////// -->


    <!-- JavaScript Libraries -->
    <script src="assets/plugins/tinymce/tinymce.min.js"></script>
    <script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
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
</body>

</html>