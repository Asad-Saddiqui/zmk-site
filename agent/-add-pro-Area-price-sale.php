<?php
session_start();
require("../admin/config/config.php");
include('./check_status.php');
// include('./validateUser.php');

if (!isset($_SESSION['agentEmail'])) {
    header("location:../login.php");
}
// $validate = validate($_SESSION['agentEmail'], $_SESSION['agentID'], $con);
// if ($validate !== true) {
//     header("location:../login.php");
// }
$pid = $_GET['PID'];
$uid = $_SESSION['agentID'];
if (!$pid || !is_numeric($pid)) {
    header("location:-view-pro.php");
}
$query = "SELECT * FROM property WHERE id='$pid'";
$result = mysqli_query($con, $query);
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if (trim($row['purpose']) === 'Rent') {
    header("location:-add-pro-Area-price-rent.php?PID=$pid");
}
function test_input1($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$part1Error = '';
if (!empty($pid)) {
    if (isset($_POST['nextSale'])) {
        $area_size = test_input1($_POST['area_size']);
        $area_size_in = test_input1($_POST['size_in__']);
        $t_price_ = test_input1($_POST['t_price_']);
        $Price_t = test_input1($_POST['Price_t']);
        $installments = "No";
        // $installments = test_input1($_POST['installments']);
        if (isset($_POST['installments'])) {
            // Checkbox is checked
            $installments = 'Yes';
        } else {
            // Checkbox is not checked
            $installments = 'No';
        }


        $advance_amount = test_input1($_POST['advance_amount']);
        $advance_amount_type = test_input1($_POST['advance_amount_type']);
        $n_installment = test_input1($_POST['n_installment']);
        $monthly_amount = test_input1($_POST['monthly_amount']);
        $monthly_amount_type = test_input1($_POST['monthly_amount_type']);

        if (
            !empty($area_size) && !empty($area_size_in) && !empty($t_price_)
            && !empty($Price_t)
        ) {
            $query = "SELECT * FROM property WHERE `property`.`id`='$pid'";
            $res = mysqli_query($con, $query);
            $num = mysqli_num_rows($res);

            if ($num == 1) {
                $sql;
                if ($installments === 'Yes') {
                    if (
                        !empty($advance_amount) && !empty($advance_amount_type) && !empty($n_installment) && !empty($monthly_amount)
                        && !empty($monthly_amount_type)
                    ) {
                        $sql = "UPDATE `property` SET `size` = '$area_size', `size_in`='$area_size_in',
                        `price`='$t_price_',`ins_avalable`='$installments', `monthly_ins`='$monthly_amount',
                        `advance`='$advance_amount',`no_ins`='$n_installment',
                        `curency`='Pkr' WHERE `property`.`id` =$pid and `property`.`uid`='$uid'";
                    } else {
                        $part1Error = "<p class='alert alert-success'>Please Fill All Fields 1</p>";
                    }
                } else {
                    $advance_amount = "";
                    $advance_amount_type = "";
                    $n_installment = "";
                    $monthly_amount = "";
                    $monthly_amount_type = "";
                    $sql = "UPDATE `property` SET `size` = '$area_size', `size_in`='$area_size_in',
                        `price`='$t_price_',`ins_avalable`='No', `monthly_ins`='$monthly_amount',
                        `advance`='$advance_amount',`no_ins`='$n_installment',
                        `curency`='Pkr' WHERE `property`.`id` =$pid and `property`.`uid`='$uid'";
                }


                if ($con->query($sql) === TRUE) {
                    propertyStatus($con, $uid, $pid, "UPDATE `complete` SET `2` = '1' WHERE `complete`.`uid` = $uid AND `pid`=$pid ;");

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

    #installment1 {
        display: none;
    }
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0 bg-white">
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
                    <div class="d-flex justify-content-between">
                        <h2 class="mt-2 pt-2 text-center text-dark">Property Listing</h2>
                        <h2 class="mt-2 text-center  border border-info p-3 text-info " style="border-radius: 50%;">2</h2>
                    </div>
                    <?php echo $part1Error; ?>
                    <div class="container  rounded">

                        <div class=" rounded-top p-4 bg-white m-3 border">

                            <div id="forsell">
                                <div class="row bg-white">
                                    <div class="col-lg-2 col-sm-12 col-md-3 text-center text-sm-start" style="color: black;
                                                    font-weight: 900;
                                                    font-size:20px;">

                                        Price and Area
                                    </div>
                                    <div class="col-lg-9 col-sm-12 col-md-8 text-center text-sm-start">

                                        <div class="form-group row">
                                            <div class="form-group col-lg-8">
                                                <label for="validationServer013" class="form-label">Area Size</label>
                                                <input type="text" class="form-control bg-white dark <?php  ?>" name="area_size" id="validationServer013" value="<?php echo $row['size']; ?>">
                                                <div class="<?php  ?>">
                                                    <?php  ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 ">
                                                <label for="validationServer06" class="form-label w-100 dark" style="text-align:left;">area size in</label>
                                                <select class="form-select bg-white dark <?php  ?> " name="size_in__" id="validationServer06" aria-describedby="validationServer06Feedback">
                                                    <option value="">Choose....</option>
                                                    <option value="Marla" selected>Marla</option>
                                                    <option value="Sq.Ft.">Sq.Ft.</option>
                                                    <option value="Sq.M.">Sq.M.</option>
                                                    <option value="Sq.Yd.">Sq.Yd.</option>
                                                    <option value="Kanal">Kanal</option>

                                                </select>
                                                <div id="validationServer06Feedback" class="<?php  ?>  w-100 " style="text-align:left;">
                                                    <?php  ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="form-group col-lg-8">
                                                <label for="validationServer013" class="form-label">Total Price</label>
                                                <input type="text" class="form-control bg-white dark <?php  ?>" name="t_price_" id="validationServer013" value="<?php echo $row['price']; ?>">
                                                <div class="<?php  ?>">
                                                    <?php  ?>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 ">
                                                <label for="validationServer07" class="form-label w-100 dark" style="text-align:left;color:white">....</label>
                                                <select class="form-select bg-white dark <?php  ?> " name="Price_t" id="validationServer07" aria-describedby="validationServer07Feedback">
                                                    <option value="">Choose....</option>
                                                    <option value="Pkr" selected>Pkr</option>


                                                </select>
                                                <div id="validationServer07Feedback" class="<?php  ?>  w-100 " style="text-align:left;">
                                                    <?php  ?>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="col-lg-6 col-form-label" style="color: info;
                                                        font-weight: 900;
                                                        font-size:20px;">Installment
                                            available</label>
                                        <div class="form-group row">
                                            <div class="col-lg-9 ">
                                                Enable if listing is available on installments
                                                <?php
                                                // echo $ins; 
                                                ?>
                                            </div>
                                            <div class="col-lg-3 ">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-info" type="checkbox" value="Yes" name="installments" onclick="installment()" id="flexSwitchCheckDefault" style="    background-color: #989d98;
                                                                height: 21px;
                                                                width: 44px;">
                                                </div>

                                            </div>
                                        </div>
                                        <div id="installment1">




                                            <div class="form-group row">
                                                <div class="form-group col-lg-8">
                                                    <label for="validationServer013" class="form-label">Advance Amount</label>
                                                    <input type="text" class="form-control bg-white dark<?php  ?>" name="advance_amount" id="validationServer013" value="<?php echo $row['advance']; ?>">
                                                    <div class="<?php  ?>">
                                                        <?php  ?>
                                                    </div>
                                                </div>


                                                <div class="col-lg-4 ">
                                                    <label for="validationServer07" class="form-label w-100 " style="text-align:left;color:white">....</label>
                                                    <select class="form-select bg-white dark <?php  ?> " name="advance_amount_type" id="validationServer07" aria-describedby="validationServer07Feedback">
                                                        <option value="">Choose....</option>
                                                        <option value="Pkr" selected>Pkr</option>


                                                    </select>
                                                    <div id="validationServer07Feedback" class="<?php ?>  w-100 " style="text-align:left;">
                                                        <?php  ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-8">
                                                <label for="validationServer013" class="form-label">No. of installment</label>
                                                <input type="text" class="form-control bg-white dark <?php  ?>" name="n_installment" id="validationServer013" value="<?php echo $row['no_ins']; ?>">
                                                <div class="<?php  ?>">
                                                    <?php  ?>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="form-group col-lg-8">
                                                    <label for="validationServer013" class="form-label">Monthly Amount</label>
                                                    <input type="text" class="form-control  bg-white dark<?php  ?>" name="monthly_amount" id="validationServer013" value="<?php echo $row['monthly_ins']; ?>">
                                                    <div class="<?php  ?>">
                                                        <?php  ?>
                                                    </div>
                                                </div>


                                                <div class="col-lg-4 ">
                                                    <label for="validationServer07" class="form-label w-100 dark" style="text-align:left;color:white">....</label>
                                                    <select class="form-select bg-white dark<?php  ?> " name="monthly_amount_type" id="validationServer07" aria-describedby="validationServer07Feedback">
                                                        <option value="">Choose....</option>
                                                        <option value="Pkr" selected>Pkr</option>


                                                    </select>
                                                    <div id="validationServer07Feedback" class="<?php  ?>  w-100 " style="text-align:left;">
                                                        <?php  ?>
                                                    </div>
                                                </div>




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
                                                <input type="submit" class="btn btn-outline-info mt-2 text-center" onclick="customButtonClick()" name="nextSale" style="width: 150px;" value="Next">

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
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white rounded-top p-4">
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

        function installment() {
            var a = document.getElementById("installment1");
            if (a.style.display === "block") {
                a.style.display = "none";
            } else {
                a.style.display = "block";
            }
        }
    </script>
</body>

</html>