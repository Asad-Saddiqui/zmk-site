<?php
session_start();
require("config.php");
////code

if (!isset($_SESSION['uname'])) {
    header("location:index.php");
}
$msg1= "";
$msg= "";
$list_type="";
$duration_type="";
$error1 = "";
$error = "";
$vaid11="";
$vaid="";
$isert="";
$idp__= $_GET['idp'];
if (isset($_POST['submit_prop'])) {
     if(!empty($_POST['proplisting'])){
        $list_type=$_POST['proplisting'];
        $vaid="is-valid";
        $msg="Successfully !";
        $error = "valid-feedback";

     }else{
        $vaid="is-invalid";
        $msg="Please select value";
        $error = "invalid-feedback";
        
     }

     
     if(!empty($_POST['propduration'])){
        $duration_type=$_POST['propduration'];
        $vaid1="is-valid";
        $msg1="Successfully !";
        $error1 = "valid-feedback";

     }else{
        $vaid1="is-invalid";
        $msg1="Please select value";
        $error1 = "invalid-feedback";
        
     }
     if (!empty($list_type) & !empty($duration_type)) {
        $sql = "UPDATE `property` SET `status` = 'active', `duration` = '$duration_type', `listing_type` = '$list_type' WHERE `property`.`pid` = $idp__;";
        $result=mysqli_query($con,$sql);
        if ($result) {
            $isert ="Data Inserted Successfuly !";
            header("location:viewproperty.php");
        }else{
            $isert ="Data not insert";
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
                <h3 style="text-align: center;"> <a href="dashboard.php" style="color: white;">Dashboard</a>&nbsp;/ <a href="viewproperty.php" style="color: green;">View Property </a></h3>

                <hr>
                <hr>

                <div class="bg-secondary text-center rounded d-flex align-items-center justify-content-center p-4">

                    <div class="d-flex align-items-center justify-content-center col-md-6 mb-4 ">

                        <form action=""  method="POST"class="row g-3 col-sm-12">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Publish Property</h6>
                                <br>
                                <label><?php echo $isert;?></label>
                            </div>

                            <div class="col-md-10">
                                <label for="validationServer04" class="form-label w-100" style="text-align:left;">Select Listing Type</label>
                                <select class="form-select <?php echo $vaid ?>" name="proplisting"  id="validationServer04" aria-describedby="validationServer05Feedback" >
                                    <option  value="">Choose....</option>
                                    <option  value="Silver">Silver</option>
                                    <option  value="Gold">Gold</option>
                                    <option  value="Diamond">Diamond</option>
                                    <option  value="Platinum">Platinum</option>
                                  
                                </select>
                                <div id="validationServer05Feedback" class="<?php echo $error;?>  w-100" style="text-align:left;">
                                   <?php echo $msg; ?>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <label for="validationServer05" class="form-label w-100" style="text-align:left;">Select Listing Type</label>
                                <select class="form-select <?php echo $vaid1 ?>" name="propduration"  id="validationServer05" aria-describedby="validationServer04Feedback" >
                                <option  value="">Choose....</option>
                                    <option  value="7">1 Week</option>
                                    <option  value="15">15 days</option>
                                    <option  value="31">1 Month</option>
                                    <option  value="183">6 Month</option>
                                    <option  value="365">1 Year</option>
                                  
                                </select>
                                <div id="validationServer04Feedback" class="<?php echo $error1;?>  w-100" style="text-align:left;">
                                   <?php echo $msg1; ?>
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit" name="submit_prop">Submit form</button>
                            </div>
                        </form>
                    </div>

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

</body>

</html>