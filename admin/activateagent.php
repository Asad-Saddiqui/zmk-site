<?php
session_start();
require("config.php");
////code

if (!isset($_SESSION['uname'])) {
    header("location:index.php");
}
$ag__id = $_GET['id'];
$sql = "select * from user where uid=$ag__id";
$result = mysqli_query($con, $sql);
$row_1 = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Orbit Enterprises</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <?php
        include("sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include("navbar.php"); ?>

            <!-- Navbar end -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">

                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Real Estate Agent</h6>
                    </div>
                    <section class="vh-60 bg-secondary">
                        <div class="container py-3 h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-md-12 col-xl-6">

                                    <div class="card" style="border-radius: 15px; background-color:#181818">
                                        <div class="card-body text-center">
                                            <div class="mt-3 mb-4">
                                                <img src="../companylogo/<?php echo $row_1['company_logo']; ?>" style="max-width: 170px;" />
                                            </div>
                                            <h4 class="mb-2"><?php echo $row_1['agency_name']; ?></h4>
                                            <?php echo $row['company_logo'] ?>
                                            <p class="text-muted mb-4">Fax : <?php echo $row_1['company_fax'];   ?> <span class="mx-2">|</span> <a href="#!">Mobile :<?php echo $row_1['company_mobile']; ?></a></p>
                                            <div class="mb-4 pb-2">
                                                <a href="https://api.whatsapp.com/send?phone=+92<?php echo $row['whatsapp']; ?>&text=Assalam-o-Alaikum">
                                                    <button type="button" class="btn btn-outline-success btn-floating">
                                                        <i class="bi bi-whatsapp ml-2 " data-toggle="tooltip" data-placement="top" title="Contact On whatsapp" style="    color: #12d812;
                                                                cursor: pointer;
                                                                font-weight: bolder;"></i>
                                                    </button>
                                                </a>
                                                <!-- companylogo/Max%20Flow%20Algorithm.pdf -->
                                                <a href="../companylogo/<?php echo $row_1['company_licence'] ?>" target="_blank">
                                                    <button type="button" class="btn btn-outline-primary btn-floating" data-toggle="tooltip" data-placement="top" title="Agency License">
                                                        <i class="fa fa-file-pdf-o" style="color:white;"></i>

                                                    </button>
                                                </a>
                                                <a href="mailto:<?php echo $row['company_email']; ?>">
                                                    <button type="button" class="btn btn-outline-primary btn-floating" data-toggle="tooltip" data-placement="top" title="Email">
                                                        <i class="fa fa-envelope  text-light"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <?php
                                                if (isset($_POST['activation'])) {
                                                    $uid = $row_1['uid'];
                                                    $tooltip="";
                                                    $sql = mysqli_query($con, "UPDATE `user` SET `ag_status` = 'active' WHERE `user`.`uid` = $uid;");
                                                    if ($sql) {
                                                        $tooltip="active agent";
                                                }else{
                                                    $tooltip="Press to activate agent";

                                                }
                                            }
                                                ?>
                                            <form action="" method="POST">
                                                <button type="submit" name="activation" class="btn btn-primary btn-rounded btn-lg" >
                                                    <?php echo $row_1['ag_status']; ?>
                                                </button>
                                                


                                            </form>
                                            <div class="d-flex justify-content-between text-center mt-5 mb-2">
                                                <div>
                                                    <p class="mb-2 h5">Country</p>
                                                    <p class="text-muted mb-0"><?php echo $row_1['country']; ?></p>
                                                </div>
                                                <div class="px-3">
                                                    <p class="mb-2 h5">Location</p>
                                                    <p class="text-muted mb-0"><?php echo $row_1['company_address']; ?></p>
                                                </div>
                                                <div>
                                                    <p class="mb-2 h5">Phone</p>
                                                    <p class="text-muted mb-0"><?php echo $row_1['company_phone'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Oribit Enterprises </a>, All Right Reserved.
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
</body>

</html>