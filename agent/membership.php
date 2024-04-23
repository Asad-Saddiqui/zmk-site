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
$error = "";
$msg = "";





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

<body class="bg-white">
    <div class="container-fluid bg-white position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <?php include("./common/sidebar.php"); ?>
        <!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content " style="background-color: #c9c9c9;">
            <!-- Navbar Start -->
            <?php include("./common/navbar.php"); ?>

            <!-- Navbar end -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div style="background-color: #e3e3e3;" class=" text-center rounded p-4">

                    <h5 class="mb-0 text-dark text-center mb-3">Purchasing Cart</h5>

                    <hr>

                    <div class="row  row-cols-1 row-cols-md-4 g-4">
                        <?php

                        $query = mysqli_query($con, "SELECT * FROM card ");
                        $cnt = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>

                            <div class="col">
                                <div class="card h-100">
                                    <img src="../admin/card/<?php echo $row['image']; ?>" class="card-img-top" alt="..." style="height: 230px;">
                                    <div class="card-body">
                                        <h5 class="card-title text-dark"><?php echo $row['name']; ?></h5>
                                        <span class="card-title text-dark">Duration : <?php echo $row['duration']; ?> Days</span>-
                                        <span class="card-title text-dark">Price : <?php echo $row['price']; ?></span>
                                    </div>
                                    <div class="card-footer">
                                        <form method="post" action="manage_cart.php">
                                            <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden />
                                            <input type="text" name="name" value="<?php echo $row['name']; ?>" hidden />
                                            <input type="text" name="price" value="<?php echo $row['price']; ?>" hidden />
                                            <input type="text" name="quantity" value="1" hidden />
                                            <input type="text" name="duration" value="<?php echo $row['duration']; ?>" hidden />
                                            <button class="btn btn-success  w-100" name="submit">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        <?php } ?>



                    </div>

                    <div class="table-responsive container row " style="margin-top: 50px;">
                        <h5 class="mb-0 text-dark text-center mb-3">My Cart</h5>
                        <hr>
                        <table class=" col-sm-12  col-md-6 col-lg-8  text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">S.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $total = 0;
                                $count = 1;
                                if (isset($_SESSION['cart'])) {

                                    foreach ($_SESSION['cart'] as $key => $value) {
                                        $total = $total + $value['price'];
                                ?>
                                        <tr>
                                            <td>
                                                <a class="text-light"><?php echo $count;
                                                                        $count++;  ?></a>
                                            </td>
                                            <td><a class="text-light"><?php echo $value['name']  ?></a></td>
                                            <td>
                                                <a class="text-light"><?php echo $value['price'] ?></a>
                                                <input type="text" class="iPrice" hidden name="priceQuantity" value="<?php echo $value['price'] ?>">
                                            </td>
                                            <td>
                                                <a class="text-light"><?php echo $value['duration'] ?> Days</a>
                                            </td>
                                            <td>
                                                <form method="POST" action="manage_cart.php">
                                                    <input type="number" class="iQuantity " min="1" name="mode_quantity" maxlength="10" onchange="this.form.submit()" value="<?php echo $value['quantity']   ?>">
                                                    <input type="text" hidden name="id_remove" value="<?php echo $value['id'] ?>">
                                                </form>

                                            </td>
                                            <td class="itotal">
                                                0
                                            </td>
                                            <td>
                                                <form method="POST" action="manage_cart.php">
                                                    <input type="text" hidden name="id_remove" value="<?php echo $value['id'] ?>">
                                                    <button type="submit" name="remove" class="btn btn-sm btn-outline-danger border-1">Remove</button>
                                                </form>
                                            </td>



                                        </tr>
                                <?php
                                    }
                                }

                                ?>

                            </tbody>
                        </table>
                        <div class=" container col-sm-12 col-md-6 col-lg-4">
                            <div class="card" style="width: 100%;">
                                <big><b>Total : </b></big><span id="gtotal"><?php echo $total ?></span>
                                <?php
                                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

                                ?>
                                    <?php
                                    $acc = "SELECT * FROM `account details`";
                                    $res = mysqli_query($con, $acc);
                                    $num_row = mysqli_num_rows($res);
                                
                                    if ($num_row > 0) {
                                    ?>
                                        <form method="post" action="manage_cart.php">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <input type="text" id="gtotal1" hidden name="PRICE" value="<?php echo $total ?>">
                                                </li>
                                                <?php
                                                 ?>
                                                <li class="list-group-item">
                                                    <select class="form-select bg-white form-select-lg mb-3" name="ACTYPE" aria-label=".form-select-lg example">
                                                        <option>Select Payment Type</option>
                                                        <?php
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                       
                                                        ?>

                                                            <option value="<?php echo $row['Type'] . "(" . $row['accounts'] . ")"; ?>"><?php echo $row['Type'] . "[" . $row['accounts'] . "]"; ?></option>

                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="number" min="1" name="TID" class="form-control bg-white" id="exampleFormControlInput1" placeholder="Transection id.. #">
                                                </li>
                                            </ul>
                                            <div class="card-footer  cursor-pointer">
                                                <button type="submit" name="makepurchase" class=" m4-2 btn btn-success text-white" style="width: 40%;">
                                                    Make Purchase
                                                </button>
                                                <button type="submit" <?php
                                                $uid = $_SESSION['agentID'];
                                                $query_trial = "SELECT * FROM trial WHERE uid = '$uid'";
            $sqlRestrial = mysqli_query($con, $query_trial);
            $sql_row = mysqli_num_rows($sqlRestrial);
            if($sql_row>5){
                ?>
                disabled
                <?php
            }
                                                
                                                ?> name="freetrial" class="ml-2 btn btn-warning text-white" style="width: 40%;">
                                                   Free Trial
                                                </button>
                                            </div>
                                        </form>
                                    <?php
                                    }
                                    ?>

                                <?php
                                }


                                ?>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div style="background-color: #e3e3e3;" class=" rounded-top p-4">
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
        var gt = 0;
        var iPrice = document.getElementsByClassName('iPrice')
        var iQuantity = document.getElementsByClassName('iQuantity')
        var itotal = document.getElementsByClassName('itotal')
        var gtotal = document.getElementById('gtotal')
        var gtotal1 = document.getElementById('gtotal1')

        function subTotal() {

            for (let i = 0; i < iPrice.length; i++) {
                itotal[i].innerHTML = (iPrice[i].value) * (iQuantity[i].value)
                gt = gt + ((iPrice[i].value) * (iQuantity[i].value));
                gtotal.innerText = gt;
                gtotal1.value = gt;
            }
        }
        subTotal();
    </script>
</body>

</html>