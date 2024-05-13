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

$query_ = $_GET['query'];
$id = $_GET['id'];
$error = "";


$uid = $_SESSION['agentID'];
$query = "SELECT * FROM oder JOIN card ON card.id = oder.cid where oder.uid = '$uid' AND card.name='$query_';";
$res = mysqli_query($con, $query);


if (isset($_POST['next'])) {
    $cardIndex = $_POST['cardPrice'] ?? '';

    if (empty(trim($cardIndex))) {
        $error = '<div class="alert alert-danger" role="alert">Please Select Duration And Price</div>';
    } else {
        $query_ = "SELECT * FROM `card` WHERE id='$cardIndex'";
        $res_ = mysqli_query($con, $query_);
        $row_ = mysqli_fetch_assoc($res_);
        $dur = '+' . $row_['duration'] . " " . "days";
        $ListingDate = date("Y-m-d H:i:s");
        $expirDate = date("Y-m-d H:i:s", strtotime($ListingDate . $dur));
        $uid = $_SESSION['agentID'];
        $stmt = $con->prepare("UPDATE `property` 
                       SET 
                           `cid` = ?,
                           `listingDate` = ?,
                           `expireDate` = ?,
                           `top` = '0',
                           `status` = '1'
                       WHERE 
                           uid='$uid' AND `property`.`id` = ?");


        // UPDATE `oder` SET `Quantity` = '1' WHERE `oder`.`id` = 3;


        $stmt->bind_param("isss", $cardIndex, $ListingDate, $expirDate, $id);  // Adjust the type definition string here
        $stmt->execute();
        $query_ = "SELECT * FROM `oder` WHERE cid='$cardIndex'";
        $res_ = mysqli_query($con, $query_);
        $myorw = mysqli_fetch_assoc($res);
        $qty = $myorw['Quantity'] - 1;
        $query_ = "UPDATE `oder` SET `Quantity` = '$qty' WHERE `oder`.`cid` = '$cardIndex'";
        $res_ = mysqli_query($con, $query_);
        $stmt->close();
        header('location:thank.php');
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Area-Price-Rent</title>
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

    .mce-container-body {
        background: #111;
        color: #35ff00;
    }

    .mce-container {
        display: block;
        background-color: green;
    }
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content bg-light">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>
            <div class="full-row   rounded bg-white" style="margin-top: 50px; margin-left: 25px; margin-right: 25px;">
                <form method="post" enctype="multipart/form-data">
                    <h2 class="mt-2 pt-2 text-dark">Property Listing</h2>
                    <div class="container  rounded">
                        <?php
                        echo $error;


                        ?>
                        <div class=" rounded-top p-4 bg-white m-3 border">

                            <div class=" rounded-top p-4 bg-white " style="background-color:white;">
                                <div class="row row col-md-12 col-sm-12 col-lg-12">

                                    <div class="col-lg-2 col-sm-12 col-md-3 text-dark text-center text-sm-start" style="color: white;
                                    font-weight: 600;
                                    font-size:17px;">
                                        Select Duration And Price

                                    </div>
                                    <div class="col-lg-9 col-sm-12 col-md-8 text-center text-sm-start">

                                        <div class="form-group row col-lg-12 col-md-12 col-sm-12">
                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                <select class="form-select bg-white form-select-lg mb-3" name="cardPrice" aria-label=".form-select-lg example">
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $uniqueName = $row['duration'] . " => RS : " . $row['price'];
                                                    ?>

                                                        <option value="<?php echo $row['id']; ?>"><?php echo $uniqueName; ?></option>
                                                    <?php


                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 text-center " style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                                <input type="submit" class="btn btn-info mt-2 text-center" onclick="customButtonClick()" name="next" style="width: 150px;" value="Next">
                                            </div>


                                        </div>


                                    </div>

                                </div>

                            </div>



                        </div>

                    </div>
                    <br>
                    <br>
                    <br>
                </form>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Oribit Enterprises Brochure</a>, All Right Reserved.
                        </div>
                       
                    </div>
                </div>
            </div>
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
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>