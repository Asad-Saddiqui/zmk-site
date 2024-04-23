<?php
session_start();
require("./config/config.php");
include('./check_status.php');

// UPDATE `property` SET `size` = '1250' WHERE `property`.`id` = 1;
if (!isset($_SESSION['adminEmail'])) {
    header("location:./login.php");
}
function test_input1($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$part1Error = "";
$pid = $_GET['PID'];
$uid = 1;
$query = "SELECT * FROM property WHERE `property`.`id`='$pid'";
$res = mysqli_query($con, $query);
$num = mysqli_num_rows($res);
$num_row = mysqli_fetch_assoc($res);
if (!empty($pid)) {
    if (isset($_POST['nextInformation'])) {
        $p_title = test_input1($_POST['p_title']);
        $description = test_input1($_POST['description']);

        if (!empty($p_title) && !empty($description)) {


            if ($num == 1) {
                $sql = "UPDATE `property` SET `title` = '$p_title', `description`='$description' WHERE `property`.`id` =$pid ";
                if ($con->query($sql) === TRUE) {
                    propertyStatus($con, $pid, "UPDATE `complete` SET `3` = '1' WHERE  `pid`=$pid ;");

                    header("location:-add-pro-images-youtub.php?PID=$pid");
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
                        <h2 class="mt-2 text-center  border border-info p-3 text-info " style="border-radius: 50%;">3</h2>
                    </div>
                    <?php echo $part1Error; ?>
                    <div class="container  rounded">

                        <div class=" rounded-top p-4 bg-white m-3 border">

                            <div class=" rounded-top p-4 bg-white " style="background-color:white;">
                                <div class="row row col-md-12 col-sm-12 col-lg-12">

                                    <div class="col-lg-2 col-sm-12 col-md-3 text-center text-dark text-sm-start" style="color: white;font-weight: 900;font-size:20px;">
                                        Add Information
                                    </div>
                                    <div class="col-lg-9 col-sm-12 col-md-8 text-center text-sm-start">


                                        <div class="form-group col-lg-12">
                                            <label for="validationServer013" class="form-label">Title</label>
                                            <input type="text" maxlength="90" placeholder="Enter Property title" class="form-control bg-white text-dark <?php  ?>" <?php echo $num_row['title'] ?> name="p_title" id="validationServer013" value="<?php echo $num_row['title'] ?>">
                                            <div class="<?php  ?>">
                                                <?php  ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 col-form-label" for="validationServer013">Description</label>

                                            <div class="col-lg-12 ">
                                                <textarea class="form-control bg-white text-dark <?php  ?> " placeholder="Enter Property Description" name="description" id="validationServer013" rows="6" maxlength="650" style="background-color:white; resize:none"><?php echo $num_row['description'] ?></textarea>
                                                <div class="<?php  ?>">
                                                    <?php  ?>
                                                </div>
                                            </div>


                                        </div>
                                         <div class="row col-md-12 col-sm-12 col-lg-12 bg-white ">



                                            <div class="col-md-4 col-sm-4 col-lg-4  mt-2" style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                                <input type="submit" class="btn btn-outline-info mt-2 text-center" onclick="customButtonClick()" name="nextInformation" style="width: 150px;" value="Next">

                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 text-center " style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                                <button class="btn btn-outline-danger mt-2 "> <a href="-add-pro-images-youtub.php?PID=<?php echo $pid; ?>">Skip</a></button>
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