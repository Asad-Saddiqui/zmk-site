<?php
session_start();
include("./admin/config/config.php");
            include("./expire.php");
            expire($con);
$error = "";
$msg = "";
$uid = isset($_GET['uid']) ? (is_numeric($_GET['uid']) ? $_GET['uid'] : header('header:login.php')) : header('header:login.php');
if (isset($_POST['change'])) {
    $code = filter_input(INPUT_POST, 'code', FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, 'uemail', FILTER_SANITIZE_EMAIL);
    $pass = (string)filter_input(INPUT_POST, 'pass', FILTER_UNSAFE_RAW);
 	$pass = sha1($pass);
    if (!$code) {
        $error = "<p class='alert alert-warning'>Please Enter  CODE</p>";
    } else if (!$pass) {
        $error = "<p class='alert alert-warning'>Please Enter  Password</p>";
    } else if (!$email) {
        $error = "<p class='alert alert-warning'>Please Enter  Email</p>";
    } else {
        $query = "SELECT * FROM forgotpass WHERE uid = $uid ORDER BY date_ DESC LIMIT 1;";
        $res = mysqli_query($con, $query);
        $num = mysqli_num_rows($res);
        $myrow = mysqli_fetch_assoc($res);

        if ($num > 0) {
            $passs = (string)$myrow['passs'];
            if ($code === $passs) {
                $delete = "DELETE FROM forgotpass WHERE passs='$passs'";
                $update = "UPDATE `user` SET `pass` = '$pass' WHERE `user`.`id` = $uid and email='$email' ";
                $res = mysqli_query($con, $update);
                $res = mysqli_query($con, $delete);
                $error = "<p class='alert alert-success'>Change Successfully</p>";
                header('location:./login.php');
            } else {
                $error = "<p class='alert alert-warning'>Invalid CODE</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.ico">

    <!--	Fonts
	========================================================-->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!--	Css Link
	========================================================-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/layerslider.css">
    <link rel="stylesheet" type="text/css" href="css/color.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    
    <!--	Title
	=========================================================-->
    <title>Real Estate PHP</title>
</head>

<body>

    <div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
        <div class="d-flex justify-content-center y-middle position-relative">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>



    <div id="page-wrapper">
        <div class="row">



<div class="page-wrappers login-body full-row bg-gray">
				<div class="login-wrapper">
					<div class="container col-lg-12 col-md-12 col-sm-12">
						<div class="loginbox col-lg-5 col-md-5 col-sm-12 p-3 ">
							<div class="login-right col-lg-12 col-md-12 col-sm-12">
								<div class="login-right-wrap col-lg-12 col-md-12 col-sm-12">
                                    <h1>Change Password</h1>
                                    <p class="account-subtitle">Access to our Website</p>
                                    <?php echo $error; ?><?php echo $msg; ?>
                                    <!-- Form -->
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="email" name="uemail" class="form-control" placeholder="Your Email*">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="code" class="form-control" placeholder="OTP Code*">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" class="form-control" placeholder="Enter New Password*">
                                        </div>

                                        <button class="btn btn-success" name="change" value="Change Password" type="submit">Change Password</button>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--	login  -->


            <!--	Footer   start-->
            <?php include("include/footer.php"); ?>
            <!--	Footer   start-->

            <!-- Scroll to top -->
            <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>
            <!-- End Scroll To top -->
        </div>
    </div>
    <!-- Wrapper End -->

    <!--	Js Link
============================================================-->
    <script src="js/jquery.min.js"></script>
    <!--jQuery Layer Slider -->
    <script src="js/greensock.js"></script>
    <script src="js/layerslider.transitions.js"></script>
    <script src="js/layerslider.kreaturamedia.jquery.js"></script>
    <!--jQuery Layer Slider -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/tmpl.js"></script>
    <script src="js/jquery.dependClass-0.1.js"></script>
    <script src="js/draggable-0.1.js"></script>
    <script src="js/jquery.slider.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>