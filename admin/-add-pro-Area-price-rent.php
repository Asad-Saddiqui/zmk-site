<?php
session_start();
require("../admin/config/config.php");
include('./check_status.php');

// UPDATE `property` SET `size` = '1250' WHERE `property`.`id` = 1;
if (!isset($_SESSION['adminEmail'])) {
    header("location:../login.php");
}
$pid = $_GET['PID'];
if (!$pid || !is_numeric($pid)) {
    header("location:-view-pro.php");
}
$query = "SELECT * FROM property WHERE id='$pid'";
$result = mysqli_query($con, $query);
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if (trim($row['purpose']) === 'Sale') {
    header("location:-add-pro-Area-price-sale.php?PID=$pid");
}
function test_input1($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$part1Error = "";
$part1Error2 = "";

if (!empty($pid)) {
    if (isset($_POST['nextRent'])) {
        $rent_area_size = test_input1($_POST['rent_area_size']);
        $rent_area_size_in = test_input1($_POST['rent_area_size_in']);
        $monthly_rent = test_input1($_POST['monthly_rent']);
        $monthly_rent_in = test_input1($_POST['monthly_rent_in']);
        if (!empty($rent_area_size) && !empty($rent_area_size_in) && !empty($monthly_rent) && !empty($monthly_rent_in)) {
            $query = "SELECT * FROM property WHERE `property`.`id`='$pid'";
            $res = mysqli_query($con, $query);
            $num = mysqli_num_rows($res);

            if ($num == 1) {
                // If the property exists, update its details
                $sql = "UPDATE `property` SET `size` = '$rent_area_size', `size_in`='$rent_area_size_in',
                        `price`='$monthly_rent', `curency`='Pkr' WHERE `property`.`id` =$pid";

                if ($con->query($sql) === TRUE) {
                    propertyStatus($con, $pid, "UPDATE `complete` SET `2` = '1' WHERE `pid`=$pid ;");

                    header("location:-add-pro-information.php?PID=$pid");
                    exit();
                } else {
                    $part1Error = "<p class='alert alert-warning'>Something Went Wrong</p>";
                }
            } else {
                $part1Error = "<p class='alert alert-warning'>Invalid Crenditials</p>";
            }
        } else {
            $part1Error = "<p class='alert alert-success'>Please Fill All Fields</p>";
        }
    }
} else {
    header("location:_addproperty.php");
    exit();
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
        <div class="content "style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>
            <div class="full-row   rounded bg-white" style="margin-top: 50px; margin-left: 25px; margin-right: 25px;">


                <form method="post" enctype="multipart/form-data">
                    <div class="d-flex justify-content-between">
                        <h2 class="mt-2 pt-2 text-center text-dark">Property Listing</h2>
                        <h2 class="mt-2 text-center  border border-info p-3 text-info " style="border-radius: 50%;">2</h2>
                    </div>

                    <div class="container  rounded">
                        <?php
                        echo $part1Error;
                        echo $part1Error2;
                        ?>
                        <div class=" rounded-top p-4 bg-white m-3 border">
                            <div id="forrent">
                                <div class="row row col-md-12 col-sm-12 col-lg-12">
                                    <div class="col-lg-2 col-sm-12 col-md-3 text-center text-sm-start" style="color: white;">
                                        Price and Area
                                    </div>
                                    <div class="col-lg-9 col-sm-12 col-md-8 text-center row text-sm-start">
                                        <div class="form-group col-lg-8">
                                            <label for="validationServer011" class="form-label">Area Size</label>
                                            <input type="text" class="form-control bg-white text-dark <?php  ?>" name="rent_area_size" id="validationServer011" value="">
                                            <div class="<?php  ?>">
                                                <?php ?>
                                            </div>
                                        </div>
                                        <div class=" form-group col-lg-4 ">
                                            <label for="validationServer06" class="form-label w-100 text-secondary" style="text-align:left;">area size in</label>
                                            <select class="form-select bg-white text-dark <?php  ?> " name="rent_area_size_in" id="validationServer06" aria-describedby="validationServer06Feedback">
                                                <option value="">Choose....</option>
                                                <option value="Marla" selected>Marla</option>
                                                <option value="Sq.Ft.">Sq.Ft.</option>
                                                <option value="Sq.M.">Sq.M.</option>
                                                <option value="Sq.Yd.">Sq.Yd.</option>
                                                <option value="Kanal">Kanal</option>

                                            </select>
                                            <div id="validationServer06Feedback" class="<?php   ?>  w-100 " style="text-align:left;">
                                                <?php   ?>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-8">
                                            <label for="validationServer011" class="form-label">Monthly Rent</label>
                                            <input type="text" class="form-control bg-white text-dark <?php   ?>" name="monthly_rent" id="validationServer011" value="">
                                            <div class="<?php   ?>">
                                                <?php   ?>
                                            </div>

                                        </div>

                                        <div class=" form-group col-lg-4 ">
                                            <label for="validationServer06" class="form-label w-100 text-dark" style="text-align:left;">....</label>
                                            <select class="form-select bg-white text-dark <?php  ?> " name="monthly_rent_in" id="validationServer06" aria-describedby="validationServer06Feedback">
                                                <option value="">Choose....</option>
                                                <option value="Pkr" selected>Pkr</option>


                                            </select>
                                            <div id="validationServer06Feedback" class="<?php  ?>  w-100 " style="text-align:left;">
                                                <?php  ?>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid pt-4 px-4 ">
                                <div class="container-fluid pt-4 px-4 bg-white">
                                    <div class=" rounded-top p-4 bg-white">
                                        <div class="row col-md-12 col-sm-12 col-lg-12 bg-white ">

                                            <div class="col-md-4 col-sm-4 col-lg-4 text-center " style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                                <input type="submit" class="btn btn-outline-info mt-2 text-center" onclick="customButtonClick()" name="nextRent" style="width: 150px;" value="Next">

                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 text-center " style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                                <button class="btn btn-outline-danger"> <a href="-add-pro-information.php?PID=<?php echo $pid; ?>">Skip</a></button>
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