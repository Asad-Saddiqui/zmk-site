<?php
session_start();
require("./config/config.php");

if (!isset($_SESSION['adminEmail'])) {
    header("location:index.php");
    exit(); // Ensure script stops execution after redirect
}

$error = "";
$msg = "";

if (isset($_POST['reg'])) {
    // Validate and sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $role = filter_input(INPUT_POST, 'role', FILTER_UNSAFE_RAW);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_UNSAFE_RAW);

    // Hash the password
    // $hash = password_hash($pass, PASSWORD_DEFAULT);
    $hash = sha1($pass);
    // Check file type
    $allowedImageTypes = ['image/png', 'image/jpg', 'image/jpeg'];
    $aimageType = $_FILES['a_img']['type'];
    $fileExtension = pathinfo($_FILES['a_img']['name'], PATHINFO_EXTENSION);
    if (!$name) {
        $error = "<p class='alert alert-warning'>Please Enter  Name</p>";
    } else if (!$email) {
        $error = "<p class='alert alert-warning'>Please Enter  Email</p>";
    } else if (!$pass) {
        $error = "<p class='alert alert-warning'>Please Enter  Password</p>";
    } else if (!$role) {
        $error = "<p class='alert alert-warning'>Please Select  Role</p>";
    } else if (!in_array($aimageType, $allowedImageTypes)) {
        $error = "<p class='alert alert-warning'>Please select a valid image type (png, jpg, jpeg)</p>";
    } else {
        $uimage = time() . "user" . "." . $fileExtension;
        $temp_name  = $_FILES['a_img']['tmp_name'];
        move_uploaded_file($temp_name, "./common/user/$uimage");
        // $uimage = "./common/user/" . $uimage;
        // Check if email already exists
        $query = "SELECT * FROM user WHERE email='$email'";
        $res = mysqli_query($con, $query);
        $num = mysqli_num_rows($res);

        if ($num == 1) {
            $error = "<p class='alert alert-warning'>Email Id already exists</p>";
        } else {
            if (!empty($name) && !empty($email) && !empty($role) && !empty($pass) && !empty($uimage)) {
                // Use prepared statements to prevent SQL injection
                $stmt = "INSERT INTO `user` (`id`, `name`, `email`, `img`, `pass`, `role`, `date`, `active`) VALUES (NULL, '$name', '$email', '$uimage', '$hash', '$role', current_timestamp(), '2');";

                $result = mysqli_query($con, $stmt);
                if ($result) {
                    $msg = '<script>alert("Added Successfully!")</script>';
                    $name = "";
                    $email = "";
                    $role = "";
                    $pass = "";
                } else {
                    $error = "<p class='alert alert-warning'>Registration Failed</p>";
                    return;
                }
            } else {
                $error = "<p class='alert alert-warning'>Please fill all the fields</p>";
            }
        }
    }
}
?>

<!-- Your HTML content remains unchanged -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>New-Admin</title>
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
</head>
<style>
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        color: #7a7a7a;
    }

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

        <!-- sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- sidebar end -->
        <!-- Content Start -->
        <div class="content " style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>








            <div class="container-fluid position-relative d-flex p-0">
                <!-- Spinner Start -->

                <!-- Spinner End -->


                <!-- Sign Up Start -->
                <div class="container-fluid ">
                    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-5">

                            <div class=" rounded p-4 p-sm-5 my-2  bg-white">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="index.html" class="">
                                        <h5 class="text-light"><i class="fa fa-user-edit me-2"></i>Registration
                                            Penal
                                        </h5>
                                        <?php echo $error;
                                        ?><?php echo $msg; ?>
                                    </a>
                                </div>

                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" type="text" style="background-color: #191C24;height:50px; color: red; font-family: sans-serif;" placeholder="Name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" type="email" style="background-color: #191C24;height:50px; color: red; font-family: sans-serif;" placeholder="Email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" type="password" style="background-color: #191C24;height:50px; color: red; font-family: sans-serif;" placeholder="Password" name="pass">
                                    </div>
                                    <div class="form-group">
                                        <!-- <input class="form-control my-2" type="text" style="background-color: #191C24;height:50px; color: red; font-family: sans-serif;" placeholder="Phone" name="phone" maxlength="10"> -->
                                        <select class="form-control bg-white my-2" name="role" style="background-color: #191C24;height:50px;  font-family: sans-serif;">
                                            <option value="">Select Role</option>
                                            <option value="admin">Admin</option>
                                            <!-- <option value="agent">Agent</option> -->
                                            <!-- <option value="user">User</option> -->
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" type="file" name="a_img">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input class="btn w-100 mb-2" style="background-color:green; color: white; border: 2px solid black; font-family: sans-serif;" type="submit" name="reg" Value="Register">
                                    </div>
                                </form>

                                <!-- <p class="text-center mb-0">Already have an Account? <a href="/RealEstate-PHP/admin2/index.php">Sign In</a></p> -->

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Sign Up End -->
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
</body>

</html>