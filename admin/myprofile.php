<?php
session_start();
require("./config/config.php");
////code

if (!isset($_SESSION['adminEmail'])) {
    header("location:index.php");
}
$uid = $_GET['aid'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile</title>
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
        <!-- Sidebar Start -->
        <?php include("./common/sidebar.php"); ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content "style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php include("./common/navbar.php"); ?>


            <div class="container d-flex">
                <div class="col-sm-12 col-xl-12 container-fluid my-5">
                    <div class="bg-white rounded h-200 p-4 " style="height:500px">
                        <?php
                        // $auser = $_SESSION['auser'];
                        $query = "SELECT * FROM user left JOIN profile ON profile.uid = user.id WHERE user.id = $uid;";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);


                        ?>
                        <h6 class="mb-4 mt-4"><?php echo $row['role']; ?></h6>

                        <div class="owl-carousel testimonial-carousel mt-3">
                            <div class="testimonial-item text-center">
                                <img class="img-fluid rounded-circle mx-auto mb-4" src="./common//user/<?php echo $row['img']; ?>" style="width: 200px; height: 200px;">
                                <h5 class="mb-1">
                                    <?php echo $row['name']; ?>
                                </h5>
                                <p><?php echo $row['email']; ?></p>
                                <p class="mb-0"> Contact No : <?php echo $row['cphone']; ?> | Landline No : <?php echo $row['clandline']; ?></p>

                            </div>
                            <div class="testimonial-item text-center">
                                <img class="img-fluid rounded-circle mx-auto mb-4" src="./common/user/<?php echo $row['logo']; ?>" style="width: 200px; height: 200px;">
                                <h5 class="mb-1">
                                    <?php echo $row['comname']; ?>|
                                    <?php echo $row['compyemail']; ?>
                                </h5>
                                <p>Address :<?php echo $row['compaddress']; ?></p>
                                <p>About: <?php echo $row['about']; ?></p>
                            </div>
                        </div>
                        <?php

                        ?>
                    </div>
                </div>
            </div>
            <div class="container d-flex">
                <div class="col-sm-12 col-xl-12 container-fluid my-5">
                    <div class="bg-white text-center rounded p-4">
                        <div class="table-responsive">
                            <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">S.No</th>
                                        <th scope="col">Listing</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                       
                                        <th scope="col">Date</th>
                                        <th scope="col">Ex Date</th>
                                        <th scope="col">Property</th>
                                     
                                        <th scope="col">Action</th>
                                        <th scope="col">status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    // $uid = $_SESSION['adminID'];
                                    $query = mysqli_query($con, "SELECT * FROM property JOIN complete ON complete.pid = property.id And complete.uid=property.uid where property.uid =$uid;");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $id_ = $row['id'];
                                        $current = (string)date("Y-m-d H:i:s");;
                                        $date2 = (string)$row['expireDate'];
                                        if (strtotime($date2) < strtotime($current)) {
                                            $update = "UPDATE `property` SET `status` = '0' WHERE `property`.`id` = $id_";
                                            $result = mysqli_query($con, $update);
                                            if (!$result) {
                                                echo "Error updating record: ";
                                            }
                                        }
                                    ?><tr>
                                            <td>
                                                <a class="text-light" href=""=<?php echo $row['id']; ?>"><?php echo $cnt; ?></a>
                                            </td>
                                            <td><a class="text-light" href=""=<?php echo $row['id']; ?>"><?php echo $row['purpose']; ?></a></td>
                                            <td>
                                                <a class="text-light" href=""=<?php echo $row['id']; ?>"><?php echo $row['propertyType']; ?></a>
                                            </td>
                                            <td>
                                                <a class="text-light" href=""=<?php echo $row['id']; ?>"><?php echo $row['propertySubtype']; ?></a>
                                            </td>
                                          
                                            <td>
                                                <a class="text-light" href=""=<?php echo $row['id']; ?>"><?php echo $row['listingDate']; ?></a>
                                            </td>
                                            <td>
                                                <a class="text-light" href=""=<?php echo $row['id']; ?>"><?php echo $row['expireDate']; ?></a>
                                            </td>
                                            <td>
                                                <a class="text-light" href=""=<?php echo $row['id']; ?>"><?php echo $row['status1']; ?></a>
                                            </td>
                                          

                                            <td>
                                                <a class="text-light" href="-update-pro.php?PID=<?php echo $row['id']; ?>"> <button class="btn m-2 btn-info"><i class="bi bi-pen"></i></button></a>
                                                <a class="text-light" href="-Delete-pro.php?id=<?php echo $row['id']; ?>&uid=<?php echo $_SESSION['adminID']; ?>"> <button class="btn m-2 btn-danger"><i class="bi bi-trash"></i></button></a>


                                            </td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                if (trim($status) === '1') {
                                                ?>
                                                    <a class="text-light" href="!#"> <button class="btn m-1 text-white " style="background-color: green;">Live</button></a>

                                                <?php
                                                } else {
                                                ?>
                                                    <?php
                                                    $status = (string)$row['status1'];
                                                    if (trim($status) === 'Complate') {
                                                    ?>
                                                        <a class="text-light" href="-propertyListing.php?id=<?php echo $row['id']; ?>"> <button class="btn m-1 btn-light">Offline</button></a>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn m-1 btn-light" disabled>Offline</button>

                                                    <?php
                                                    }

                                                    ?>
                                                <?php
                                                }

                                                ?>
                                             

                                            </td>



                                        </tr>
                                    <?php
                                        $cnt = $cnt + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Recent Sales Start -->

            <!-- RecentSales End -->
            <!-- Footer Start -->
            
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