<?php
session_start();
require("./config/config.php");

if (!isset($_SESSION['adminEmail'])) {
    header("location:index.php");
    exit(); // Ensure script stops execution after redirect
}


$error = "";
$msg = "";
$uid = $_SESSION['adminID'];
$query_ = "SELECT * FROM user WHERE id='$uid'";
$res_ = mysqli_query($con, $query_);
$num = mysqli_num_rows($res_);
$row = mysqli_fetch_assoc($res_);

if (isset($_POST['reg'])) {
    // Validate and sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_UNSAFE_RAW);
    $allowedImageTypes = ['image/png', 'image/jpg', 'image/jpeg'];
    $temp_name  = $_FILES['a_img']['tmp_name'];

    $aimageType = $_FILES['a_img']['type'];
    $fileExtension = pathinfo($_FILES['a_img']['name'], PATHINFO_EXTENSION);
    if (!$name) {
        $error = "<p class='alert alert-warning'>Please Enter  Name</p>";
    } else if (!$email) {
        $error = "<p class='alert alert-warning'>Please Enter  Email</p>";
    } else if (!$pass) {
        $error = "<p class='alert alert-warning'>Please Enter  Password</p>";
    }else if (!in_array($aimageType, $allowedImageTypes)) {
         $query = "SELECT * FROM user WHERE email='$email'";
        $res = mysqli_query($con, $query);
        $num = mysqli_num_rows($res);
        $Email = (string)$row['email'];
        if ($num === 1) {
            if ($Email === (string)$email) {
                if (!empty($name) && !empty($email) && !empty($pass)) {
                    $stmt = "";
                    // Assuming $row['pass'] contains the user's current password fetched from the database
                    $pass_ = $row['pass'];

                    // Hash the new password
                    $hash = $pass;

                    // Check if the new password is different from the current one
                    if ($pass_ === $hash) {
                        // Passwords match, no need to rehash
                        $stmt = "UPDATE `user`
                        SET
                            `name` = ?,
                            `email` = ?,
                            `pass` = ?
                        WHERE
                            user.id = ?";
                    } else {
                        $hash = sha1($pass);
                        $stmt = "UPDATE `user`
                        SET
                            `name` = ?,
                            `email` = ?,
                            `pass` = ?
                        WHERE
                            user.id = ?";
                    }

                    // Prepare and execute the statement
                    $preparedStmt = mysqli_prepare($con, $stmt);
                    if ($preparedStmt) {
                        mysqli_stmt_bind_param($preparedStmt, "sssi", $name, $email, $hash, $uid);
                        mysqli_stmt_execute($preparedStmt);

                        if (mysqli_stmt_affected_rows($preparedStmt) > 0) {

                            $msg = '<script>alert("Updated Successfully!")</script>';
                            unset($_SESSION['adminID']);
                            unset($_SESSION['adminEmail']);
                            unset($_SESSION['adminImg']);
                            unset($_SESSION['adminName']);
                            header('location:../login.php');
                            $name = "";
                            $email = "";
                            $pass = "";
                        } else {
                            $error = "<p class='alert alert-warning'>Updation Failed</p>";
                        }

                        mysqli_stmt_close($preparedStmt);
                    } else {
                        $error = "<p class='alert alert-warning'>Database error: Unable to prepare statement</p>";
                    }
                } else {
                    $error = "<p class='alert alert-warning'>Please fill all the fields</p>";
                }
            } else {
                $error = "<p class='alert alert-warning'>Email Already Exist</p>";
            }
        } else {
            if (!empty($name) && !empty($email) && !empty($pass)) {
                $stmt = "";
                // Assuming $row['pass'] contains the user's current password fetched from the database
                $pass_ = $row['pass'];

                // Hash the new password
                $hash = $pass;

                // Check if the new password is different from the current one
                if ($pass_ === $hash) {
                    // Passwords match, no need to rehash
                    $stmt = "UPDATE `user`
                        SET
                            `name` = ?,
                            `email` = ?,
                            `pass` = ?
                        WHERE
                            user.id = ?";
                } else {
                    $hash = sha1($pass);
                    $stmt = "UPDATE `user`
                        SET
                            `name` = ?,
                            `email` = ?,
                            `pass` = ?
                        WHERE
                            user.id = ?";
                }

                // Prepare and execute the statement
                $preparedStmt = mysqli_prepare($con, $stmt);
                if ($preparedStmt) {
                    mysqli_stmt_bind_param($preparedStmt, "sssi", $name, $email, $hash, $uid);
                    mysqli_stmt_execute($preparedStmt);

                    if (mysqli_stmt_affected_rows($preparedStmt) > 0) {
                        $msg = '<script>alert("Updated Successfully!")</script>';
                        unset($_SESSION['adminID']);
                        unset($_SESSION['adminEmail']);
                        unset($_SESSION['adminImg']);
                        unset($_SESSION['adminName']);
                        header('location:../login.php');
                        $name = "";
                        $email = "";
                        $pass = "";
                    } else {
                        $error = "<p class='alert alert-warning'>Updation Failed</p>";
                    }

                    mysqli_stmt_close($preparedStmt);
                } else {
                    $error = "<p class='alert alert-warning'>Database error: Unable to prepare statement</p>";
                }
            } else {
                $error = "<p class='alert alert-warning'>Please fill all the fields</p>";
            }
        }
    } else {
        $query = "SELECT * FROM user WHERE email='$email'";
        $res = mysqli_query($con, $query);
        $num = mysqli_num_rows($res);
        $Email = (string)$row['email'];
         $uimage = time() . "admin" . "." . $fileExtension;
        $temp_name  = $_FILES['a_img']['tmp_name'];
        move_uploaded_file($temp_name, "./common/user/$uimage");
        if ($num === 1) {
            if ($Email === (string)$email) {
                if (!empty($name) && !empty($email) && !empty($pass)) {
                    $stmt = "";
                    // Assuming $row['pass'] contains the user's current password fetched from the database
                    $pass_ = $row['pass'];

                    // Hash the new password
                    $hash = $pass;

                    // Check if the new password is different from the current one
                    if ($pass_ === $hash) {
                        // Passwords match, no need to rehash
                        $stmt = "UPDATE `user`
                        SET
                            `name` = ?,
                            `email` = ?,
                            `pass` = ?,
                            `img`=?
                        WHERE
                            user.id = ?";
                    } else {
                        $hash = sha1($pass);
                        $stmt = "UPDATE `user`
                        SET
                            `name` = ?,
                            `email` = ?,
                            `pass` = ?,
                              `img`=?
                        WHERE
                            user.id = ?";
                    }

                    // Prepare and execute the statement
                    $preparedStmt = mysqli_prepare($con, $stmt);
                    if ($preparedStmt) {
                        mysqli_stmt_bind_param($preparedStmt, "ssssi", $name, $email, $hash,$uimage, $uid);
                        mysqli_stmt_execute($preparedStmt);

                        if (mysqli_stmt_affected_rows($preparedStmt) > 0) {

                            $msg = '<script>alert("Updated Successfully!")</script>';
                            unset($_SESSION['adminID']);
                            unset($_SESSION['adminEmail']);
                            unset($_SESSION['adminImg']);
                            unset($_SESSION['adminName']);
                            header('location:../login.php');
                            $name = "";
                            $email = "";
                            $pass = "";
                        } else {
                            $error = "<p class='alert alert-warning'>Updation Failed</p>";
                        }

                        mysqli_stmt_close($preparedStmt);
                    } else {
                        $error = "<p class='alert alert-warning'>Database error: Unable to prepare statement</p>";
                    }
                } else {
                    $error = "<p class='alert alert-warning'>Please fill all the fields</p>";
                }
            } else {
                $error = "<p class='alert alert-warning'>Email Already Exist</p>";
            }
        } else {
            if (!empty($name) && !empty($email) && !empty($pass)) {
                $stmt = "";
                // Assuming $row['pass'] contains the user's current password fetched from the database
                $pass_ = $row['pass'];

                // Hash the new password
                $hash = $pass;

                // Check if the new password is different from the current one
                if ($pass_ === $hash) {
                    // Passwords match, no need to rehash
                    $stmt = "UPDATE `user`
                        SET
                            `name` = ?,
                            `email` = ?,
                            `pass` = ?,
                            `img`=?,
                        WHERE
                            user.id = ?";
                } else {
                    $hash = sha1($pass);
                    $stmt = "UPDATE `user`
                        SET
                            `name` = ?,
                            `email` = ?,
                            `pass` = ?,
                            `img`=?
                        WHERE
                            user.id = ?";
                }

                // Prepare and execute the statement
                $preparedStmt = mysqli_prepare($con, $stmt);
                if ($preparedStmt) {
                    mysqli_stmt_bind_param($preparedStmt, "ssssi", $name, $email, $hash,$uimage, $uid);
                    mysqli_stmt_execute($preparedStmt);

                    if (mysqli_stmt_affected_rows($preparedStmt) > 0) {
                        $msg = '<script>alert("Updated Successfully!")</script>';
                        unset($_SESSION['adminID']);
                        unset($_SESSION['adminEmail']);
                        unset($_SESSION['adminImg']);
                        unset($_SESSION['adminName']);
                        header('location:../login.php');
                        $name = "";
                        $email = "";
                        $pass = "";
                    } else {
                        $error = "<p class='alert alert-warning'>Updation Failed</p>";
                    }

                    mysqli_stmt_close($preparedStmt);
                } else {
                    $error = "<p class='alert alert-warning'>Database error: Unable to prepare statement</p>";
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
                                        <h5 class="text-light"><i class="fa fa-user-edit me-2"></i>Update
                                            Personal Details 
                                        </h5>
                                        <?php echo $error;
                                        ?><?php echo $msg; ?>
                                    </a>
                                </div>

                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" value="<?php echo $row['name'] ?>" type="text" style="background-color: #191C24;height:50px; color: black; font-family: sans-serif;" placeholder="Name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" value="<?php echo $row['email'] ?>" type="email" style="background-color: #191C24;height:50px; color: black; font-family: sans-serif;" placeholder="Email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control bg-white my-2" value="<?php echo $row['pass'] ?>" type="password" style="background-color: #191C24;height:50px; color: black; font-family: sans-serif;" placeholder="Password" name="pass">
                                    </div>
	           <div class="form-group bg-white" style="color: black; font-family: sans-serif;">
											<input class="form-control" name="a_img" type="file">
										</div>
                                    <div class="form-group mb-0">
                                        <input class="btn w-100 mb-2 mt-3" style="background-color:#f47321; color: white;  font-family: sans-serif;" type="submit" name="reg" Value="Register">
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