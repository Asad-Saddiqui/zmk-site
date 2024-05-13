<?php
session_start();
require(".././admin/config/config.php");
// include('./validateUser.php');
if (!isset($_SESSION['agentEmail'])) {
    header("location:../login.php");
}
// $validate = validate($_SESSION['agentEmail'], $_SESSION['agentID'], $con);
// if ($validate !== true) {
//     header("location:../login.php");
// }


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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
</style>
<style>
    @media (max-width: 989px) {
        #hideimg {
            display: none;
            margin-top: 100px;
        }

        #info {
            margin-top: 70px;
        }

    }
</style>
<style>
    .sidebar .navbar .dropdown-item:hover {
        background-color: #cacaca;
    }



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

    <div class="container-fluid bg-white position-relative d-flex p-0">

        <?php include("./common/sidebar.php"); ?>
        <!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content bg-light">
            <!-- Navbar Start -->
            <?php include("./common/navbar.php"); ?>

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <h2 style="color: white; text-align: center">
                    Well come to Oribit Enterprises
                </h2>
                <hr />
                <hr />
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div style="background-color:#e3e3e3;" class=" rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2"> Admin </p>
                                <h6 class="mb-0 text-dark">
                                    <?php $sql = "SELECT * FROM user WHERE role = 'admin'";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows"; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div style="background-color:#e3e3e3;" class=" rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 text-dark">Users</p>
                                <h6 class="mb-0 text-dark"><?php $sql = "SELECT * FROM user WHERE role = 'user'";
                                                            $query = $con->query($sql);
                                                            echo "$query->num_rows"; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div style="background-color:#e3e3e3;" class=" rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-success"></i>
                            <div class="ms-3">
                                <p class="mb-2">Agents</p>
                                <h6 class="mb-0 text-dark">
                                    <?php
                                    $sql = "SELECT * FROM user WHERE role = 'agent'";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows"; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div style="background-color:#e3e3e3;" class=" rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-home fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2 ">Properties</p>
                                <h6 class="mb-0 text-dark">
                                    <?php
                                    $uid = $_SESSION['agentID'];
                                    $sql = "SELECT * FROM property where uid='$uid' ";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows"; ?>
                                </h6>
                            </div>
                        </div>
                    </div>




                    <div class="col-sm-6 col-xl-6">
                        <div style="background-color:#e3e3e3;" class=" rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-quote-left fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">On Rent</p>
                                <h6 class="mb-0 text-dark">
                                    <?php
                                    $uid = $_SESSION['agentID'];
                                    $sql = "SELECT * FROM property where uid='$uid' AND purpose='Rent' ";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows"; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div style="background-color:#e3e3e3;" class=" rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-quote-right fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">On Sale</p>
                                <h6 class="mb-0 text-dark">
                                    <?php
                                    $uid = $_SESSION['agentID'];
                                    $sql = "SELECT * FROM property where uid='$uid' AND purpose='Sale' ";
                                    $query = $con->query($sql);
                                    echo "$query->num_rows"; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6" style="height: 300px;">
                        <div style="background-color:#e3e3e3;" class=" rounded h-60 p-4">
                            <h6 class="mb-1 text-dark">Users</h6>
                            <canvas id="bar-chart"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div style="background-color:#e3e3e3;" class=" rounded  h-60 p-4">
                            <h6 class="text-dark">No Of Property</h6>
                            <canvas id="price"></canvas>
                        </div>
                    </div>

                </div>


            </div>
            <!-- Sale & Revenue End -->



            <!-- Widgets End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div style="background-color:#e3e3e3;" class=" rounded-top p-4">
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
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>
    <?php
    // $query = mysqli_query($con, "select * from property where aid=47");
    // print_r($query);
    // $row = mysqli_fetch_row($query);
    // echo count($row);
    // while($row=mysqli_fetch_row($query)){

    // }

    // print_r($query);
    ?>

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
    <!-- Template Javascript -->
    <script>
        var ctx4 = $("#bar-chart").get(0).getContext("2d");
        var myChart4 = new Chart(ctx4, {
            type: "line",
            data: {
                labels: ["Admin", "Agent", "User"],

                datasets: [{
                    label: "Total",
                    backgroundColor: [
                        "rgba(255, 69, 69, 0.83)",
                        "rgba(0, 0, 255, 0.8)",
                        "rgba(32, 214, 68, 0.83)",

                    ],
                    data: [
                        <?php
                        //  $sql = "SELECT * FROM user WHERE utype = 'admin'";
                        // $query = $con->query($sql);
                        // echo "$query->num_rows";

                        ?>,
                        <?php
                        //  $sql = "SELECT * FROM user WHERE utype = 'agent'";
                        //                                 $query = $con->query($sql);
                        //                                 echo "$query->num_rows"; 
                        ?>,
                        <?php
                        // $sql = "SELECT * FROM user WHERE utype = 'user'";
                        // $query = $con->query($sql);
                        // echo "$query->num_rows";
                        ?>
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });


        // var ctx3 = $("#price").get(0).getContext("2d");
        // var myChart3 = new Chart(ctx3, {
        //     type: "line",
        //     data: {
        //         labels: [
        //            <?php
                        //             $data = ['Sale', "Rent"];


                        //             foreach ($data as $aa) {



                        //             
                        ?> '<?php echo $aa; ?>',

        //             <?php
                        //             }
                        //             
                        ?> 
        //         ],
        //         datasets: [{
        //             label: "No. of Property",
        //             backgroundColor: [
        //                 "rgba(255, 69, 69, 0.83)",
        //                 "rgba(0, 0, 255, 0.8)",
        //                 "rgba(32, 214, 68, 0.83)",

        //             ],
        //             data: [
        //                 <?php $sql = "SELECT * FROM property WHERE propty_purpose = 'Sale' and status='active'";
                            //                 $query = $con->query($sql);
                            //                 echo "$query->num_rows"; 
                            ?>, <?php $sql = "SELECT * FROM property WHERE propty_purpose = 'Rent' and status='active'";
                                //                                                 $query = $con->query($sql);
                                //                                                 echo "$query->num_rows"; 
                                ?>
        //             ]
        //         }]
        //     },
        //     options: {
        //         responsive: true
        //     }
        // });
    </script>

    <!-- <script src="js/main.js"></script> -->
</body>

</html>