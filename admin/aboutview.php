<?php
session_start();
require("config.php");
////code
if (!isset($_SESSION['uname'])) {
    header("location:index.php");
}
$error = "";
$msg = "";
if (isset($_REQUEST['insert'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $pass = $_REQUEST['pass'];
    $dob = $_REQUEST['dob'];
    $phone = $_REQUEST['phone'];

    if (!empty($name) && !empty($email) && !empty($pass) && !empty($dob) && !empty($phone)) {
        $hash = sha1($pass);
        $sql = "insert into admin (auser,aemail,apass,adob,aphone) values('$name','$email','$hash','$dob','$phone')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $msg = 'Admin Register Successfully';


        } else {
            $error = '* Not Register Admin Try Again';
        }
    } else {
        $error = "* Please Fill all the Fields!";
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
    .dataTables_wrapper .dataTables_length select{
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
    td{
        border:1px solid white;
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

            <!-- Navbar end -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">

                <h3 style="text-align: center;"> <a href="dashboard.php"style="color: white;" >Dashboard</a>&nbsp;/ <a href="adminlist.php"style="color: green;">Admin List </a></h3>
                <hr>
                <hr>
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Real Estate Admin</h6>
                    </div>
                    <div class="table-responsive">
                        <table id ="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">S.No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Feature</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php
                                
                                $query=mysqli_query($con,"select * from about");
                                $cnt=1;
                                while($row=mysqli_fetch_row($query))
                                    {
                            ?><tr>
                            
                                    <td>
                                        <a class="text-light " href="#"><?php echo $cnt; ?></a>
                                    </td>
                                    <td><a class="text-light" href="#"><?php echo $row['1']; ?></a></td>
                                    <td>
                                    <a class="text-light" href="#"><?php echo $row['2']; ?></a>
                                    </td>
                                    <td><a class="text-light" href="#"><?php echo $row['3']; ?></a></td>
                                   
                                    <td>
                                    <a class="text-light" href="#"><img style="width: 200px;height:200px;" src="../companylogo/<?php echo $row['4']; ?>"></a>
                                    </td>
                                    <td>
                                        <a href="aboutedit.php?id=<?php echo $row['0']; ?>"><button
                                                class="btn btn-sm btn-info m-2"><i class="bi bi-pen"></i></button></a>
                                                <a href="aboutdelete.php?id=<?php echo $row['0']; ?>"><button
                                                class="btn btn-sm btn-primary"><i class="bi bi-trash"></i></button></a>
                                    </td>
                                </tr>
                                <?php
                                $cnt=$cnt+1;
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