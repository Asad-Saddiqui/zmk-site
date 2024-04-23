<?php
session_start();
require("./config/config.php");
////code

if (!isset($_SESSION['adminEmail'])) {
    header("location:../login.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the form was submitted via POST

    if (isset($_POST['acceptApplicattion'])) {
        // Check if the 'acceptApplicattion' button was clicked

        // Retrieve the user ID from the hidden input
        $userId = $_POST['user_id']; // Assuming 'user_id' is the name of your hidden input
        // Check the connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Update the active status to 1
        $sql = "UPDATE `user` SET `varified` = 1 WHERE `user`.`id` = $userId";

        if ($con->query($sql)) {
            echo '<script>alert("Appplication Accepted Successfully")</script>';
        } else {
            echo '<script>alert("Come Thing Wen wrong")</script>';
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

            <!-- Navbar end -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4 ">

                <h3 style="text-align: center;"> <a href="dashboard.php" style="color: white;">Dashboard</a>&nbsp;/ <a href="adminlist.php" style="color: green;">Admin List </a></h3>
                <hr>
                <hr>
                <div class="bg-white text-dark text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0 text-dark">Real Estate Users</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">S.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">verified</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $query = mysqli_query($con, "SELECT * FROM user ");
                                $cnt = 1;
                                while ($row = mysqli_fetch_row($query)) {
                                ?><tr>

                                        <td>
                                            <a class="text-light" href="./myprofile.php?aid=<?php echo $row['0']; ?>"><?php echo $cnt; ?></a>
                                        </td>
                                        <td><a class="text-light" href="./myprofile.php?aid=<?php echo $row['0']; ?>"><?php echo $row['1']; ?></a></td>
                                        <td>
                                            <a class="text-light" href="./myprofile.php?aid=<?php echo $row['0']; ?>"><?php echo $row['2']; ?></a>
                                        </td>
                                        <td>
                                            <a class="text-light" href="./myprofile.php?aid=<?php echo $row['0']; ?>"><?php echo $row['5']; ?></a>
                                        </td>

                                        <td>
                                            <a class="text-light" href="./myprofile.php?aid=<?php echo $row['0']; ?>"><img src="./common/user/<?php echo $row['3']; ?>" height="50px" width="50px" style="border-radius: 50%;"></a>
                                        </td>
                                        <td>

                                            <?php
                                            $active = (int)trim($row['8']);
                                            $role = (string)trim($row['5']);
                                            if ($active === 1) {
                                            ?>
                                                <a class="text-light" href="./myprofile.php?aid=<?php echo $row['0']; ?>">Complate</a>
                                            <?php

                                            } else if ($role === 'agent') {
                                            ?>

                                                <form method="post" action="adminlist.php">
                                                    <input type="number" name="user_id" hidden value="<?php echo $row['0']; ?>" />
                                                    <input type="submit" name="acceptApplicattion" class="btn btn-sm btn-outline-success" value="Accept application">
                                                </form>
                                            <?php
                                            }

                                            ?>




                                        </td>
                                        <?php
                                        if ($_SESSION['adminID'] === $row['0']) {
                                        ?>
                                            <td><a href="./adminlist.php">@</a></td>


                                        <?php

                                        } elseif((int)$row['0'] === 1) {
                                        ?>
                                            <td><a href="./adminlist.php">@</a></td>



                                        <?php
                                        }else{
                                            ?>
                                            <td><a href="./admindelete.php?id=<?php echo $row['0']; ?>"><button class="btn btn-sm btn-primary"><i class="bi bi-trash"></i></button></a></td>

                                            <?php
                                        }

                                        ?>
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
            <!-- Recent Sales End -->


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