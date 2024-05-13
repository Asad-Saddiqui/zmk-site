<?php
session_start();
require("config.php");
////code

if (!isset($_SESSION['uname'])) {
    header("location:index.php");
}
$ag_id = $_REQUEST['id'];

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

            <div class="container d-flex">
                <div class="col-sm-12 col-xl-8 container-fluid my-5">
                    <div class="bg-secondary rounded h-200 p-4 " style="height:500px">
                        <?php
                        // $auser = $_SESSION['auser'];
                        $query = "SELECT * FROM user WHERE uid=$ag_id and  utype = 'agent'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);

                     
                            ?>
                            <h6 class="mb-4 mt-4"><?php echo $row['utype']; ?></h6>

                            <div class="owl-carousel testimonial-carousel mt-3">
                                <div class="testimonial-item text-center">
                                    <img class="img-fluid rounded-circle mx-auto mb-4"
                                        src="../companylogo/<?php echo $row['uimage']; ?> ?>" style="width: 200px; height: 200px;">
                                    <h5 class="mb-1">
                                        <?php echo $row['uname']; ?>
                                    </h5>
                                    <p><?php echo $row['uemail']; ?></p>
                                    <p class="mb-0"> Contact No : <?php echo $row['uphone']; ?></p>
                                </div>
                            </div>
                            <?php
                       
                        ?>
                    </div>
                </div>
            </div>



<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
                <h3 style="text-align: center;">Property list</h3>
                <hr>
                <hr>
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Real Estate Property</h6>
                    </div>
                    <div class="table-responsive">
                    <table id="myTable" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: left;">P ID</th>
                                                    <th style="text-align: left;">Title</th>
                                                    <th style="text-align: left;">Type</th>
                                                    <!-- <th>BHK</th> -->
                                                    <th style="text-align: left;">S/R</th>
                                                   
													<!-- <th style="text-align: left;">Area</th> -->
                                                    <th style="text-align: left;">Price</th>
                                                    <th style="text-align: left;">Location</th>
													<th style="text-align: left;">Status</th>
                                                   
                                                    
                                                    <th style="text-align: left;">Actions</th>
                                                    
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
												<?php
													
													$query=mysqli_query($con,"select * from property where agent_id='$ag_id'");
													while($row=mysqli_fetch_assoc($query))
													{
												?>
											
                                                <tr>
                                                    <td style="text-align: left;"><?php echo $row['pid']; ?></td>
                                                    <td style="text-align: left;"><?php echo $row['p__title']; ?></td>
                                                    <td style="text-align: left;"><?php echo $row['propty_purpose']; ?></td>
                                                    <!-- <td><?php echo $row['4']; ?></td> -->
                                                    <td style="text-align: left;"><?php echo $row['propty_type']; ?></td>
                                                   
                                                    <td style="text-align: left;"><?php echo $row['_price_type']; ?></td>
                                                    <td style="text-align: left;"><?php echo $row['citys']; ?></td>
                                                    <!-- <td style="text-align: left;"><?php echo $row['citys']; ?></td> -->
													
                                                   
                                                    <td style="text-align: left;"><?php echo $row['status']; ?></td>
													
													<td style="text-align: left;">
                                                    <!-- <a href="updateProperty.php?p_id=<?php echo $row['0'];?>&u_id=<?php echo $row['23'];?>&a_id=<?php echo $row['24'];?>"><button class="btn btn-info">Edit</button></a> -->
                                                    <a  href="propertydelete.php?id=<?php echo $row['0'];?>"><button class="btn btn-danger">Delete</button></a></td>
                                                </tr>
                                               <?php
												} 
												?>
                                            </tbody>
                                        </table>
                    </div>
                </div>
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
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>$(document).ready(function () {
            $('#myTable').DataTable();
        });</script>
</body>

</html>