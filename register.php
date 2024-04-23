<?php
include("./admin/config/config.php");
include("./expire.php");
expire($con);
$error = "";
$msg = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
function sendEmail($email, $code,$id)
{
    $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
        $mail->Username = 'faheem@zmkmarketing.com';
    $mail->Password = 'Hareemanas1989@';
        $mail->SMTPSecure = 'tls';
        // $mail->Port = 465;

        // Set email content
        $mail->setFrom('faheem@zmkmarketing.com');
        $mail->addAddress($email);
        $mail->Subject = "OTP";
        $mail->Body ="Password Resset OTP : $code";

            // Send email
            if ($mail->send()) {
             header("location:variyemail.php?uid=$id");
            } else {
                echo 'Failed to send email. Error: ' . $mail->ErrorInfo;
            }
}
if (isset($_POST['reg'])) {
	// Validate and sanitize inputs
	$name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$role = filter_input(INPUT_POST, 'role', FILTER_UNSAFE_RAW);
	$pass = filter_input(INPUT_POST, 'pass', FILTER_UNSAFE_RAW);
	$contact = filter_input(INPUT_POST, 'contact', FILTER_UNSAFE_RAW);
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
	}else if (!$contact) {
		$error = "<p class='alert alert-warning'>Please Enter  Phone no</p>";
	} else if (!$role || $role === 'admin') {
		$error = "<p class='alert alert-warning'>Please Select  Role</p>";
	} else if (!in_array($aimageType, $allowedImageTypes)) {
		$error = "<p class='alert alert-warning'>Please select a valid image type (png, jpg, jpeg)</p>";
	} else {
		$uimage = time() . "user" . "." . $fileExtension;
		$temp_name  = $_FILES['a_img']['tmp_name'];

		// $uimage = "./common/user/" . $uimage;
		// Check if email already exists
		$query = "SELECT * FROM user WHERE email='$email'";
		$res = mysqli_query($con, $query);
		$num = mysqli_num_rows($res);

		if ($num == 1) {
			$error = "<p class='alert alert-warning'>Email Id already exists</p>";
		} else {
			if (!empty($name) && !empty($email) && !empty($role) && !empty($contact) && !empty($pass) && !empty($uimage)) {
				function generateRandomString($length = 8)
				{
					$bytes = random_bytes($length);
					return bin2hex($bytes);
				}

				// Example usage
				$randomString = generateRandomString();
				// Use prepared statements to prevent SQL injection

				$stmt = "INSERT INTO `user` (`id`, `name`, `email`, `img`, `pass`, `role`, `date`, `active`) VALUES (NULL, '$name', '$email', '$uimage', '$hash', '$role', current_timestamp(), '0');";

				$result = mysqli_query($con, $stmt);
				$lastInsertedId = $con->insert_id;
				$phone = "INSERT INTO `profile` (`comid`, `uid`, `cphone`, `clandline`, `fburl`, `youtuburl`, `instaurl`, `about`, `compaddress`, `logo`, `compyemail`, `comname`) VALUES (NULL, '$lastInsertedId', '$contact', '', '', '', '', '', '', '', '', '');";
				$result = mysqli_query($con, $phone);

				move_uploaded_file($temp_name, "./admin/common/user/$uimage");
				$varify = "INSERT INTO `varifyemail` (`varid`, `uid`, `code`) VALUES (NULL, '$lastInsertedId', '$randomString');";
				mysqli_query($con, $varify);
				sendEmail($email, $randomString,$lastInsertedId);
			} else {
				$error = "<p class='alert alert-warning'>Please fill all the fields</p>";
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- FOR MORE PROJECTS visit: codeastro.com -->

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
	<!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->

	<!--	Title
	=========================================================-->
	<title>Real Estate PHP</title>
	<style>
		.login-body {
			display: table;
			height: 100vh;
			min-height: 100vh;
		}

		.login-wrapper {
			width: 100%;
			height: 100%;
			display: table-cell;
			vertical-align: middle;
		}

		.login-wrapper .loginbox {
			background-color: white;
			border-radius: 6px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			display: flex;
			margin: 1.875rem auto;
			/* max-width: 400px; */
			/* min-height: 300px; */
			/* width: 100%; */
		}

		.login-wrapper .loginbox .login-left {
			align-items: center;
			background: linear-gradient(180deg, #3949ab, #2962ff);
			border-radius: 6px 0 0 6px;
			flex-direction: column;
			justify-content: center;
			/* padding: 80px; */
			/* width: 400px; */
			display: flex;
		}

		.login-wrapper .loginbox .login-right {
			align-items: center;
			display: flex;
			justify-content: center;
			/* padding: 40px; */
			/* width: 400px; */
		}

		.login-wrapper .loginbox .login-right .login-right-wrap {
			/* max-width: 100%; */
			flex: 0 0 100%;
		}

		.login-wrapper .loginbox .login-right h1 {
			font-size: 26px;
			font-weight: 500;
			margin-bottom: 5px;
			text-align: center;
		}

		.account-subtitle {
			color: #4c4c4c;
			font-size: 17px;
			margin-bottom: 1.875rem;
			text-align: center;
		}

		.login-wrapper .loginbox .login-right .forgotpass a {
			color: #a0a0a0;
		}

		.login-wrapper .loginbox .login-right .forgotpass a:hover {
			color: #333;
			text-decoration: underline;
		}

		.login-wrapper .loginbox .login-right .dont-have {
			color: #a0a0a0;
			margin-top: 1.875rem;
		}

		.login-wrapper .loginbox .login-right .dont-have a {
			color: #333;
		}

		.login-wrapper .loginbox .login-right .dont-have a:hover {
			text-decoration: underline;
		}

		.social-login {
			text-align: center;
		}

		.social-login>span {
			color: #a0a0a0;
			margin-right: 8px;
		}

		.social-login>a {
			background-color: #ccc;
			border-radius: 4px;
			color: #fff;
			display: inline-block;
			font-size: 18px;
			height: 32px;
			line-height: 32px;
			margin-right: 6px;
			text-align: center;
			/* width: 32px; */
		}

		.social-login>a:last-child {
			margin-right: 0;
		}

		.social-login>a.facebook {
			background-color: #4b75bd;
		}

		.social-login>a.google {
			background-color: #fe5240;
		}

		.login-or {
			color: #a0a0a0;
			margin-bottom: 20px;
			margin-top: 20px;
			padding-bottom: 10px;
			padding-top: 10px;
			position: relative;
		}

		.or-line {
			background-color: #e5e5e5;
			height: 1px;
			margin-bottom: 0;
			margin-top: 0;
			display: block;
		}

		.span-or {
			background-color: #fff;
			display: block;
			left: 50%;
			margin-left: -20px;
			position: absolute;
			text-align: center;
			text-transform: uppercase;
			top: 0;
			width: 42px;
		}
	</style>
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
			<!--	Header start  -->
			<!--	Header end  --><!-- FOR MORE PROJECTS visit: codeastro.com -->

			<!--	Banner   --->
			<!-- <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Register</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Register</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> -->
			<!--	Banner   --->


			<div class="page-wrappers login-body full-row bg-gray ">
				<div class="login-wrapper">
					<div class="container col-lg-12 col-md-12 col-sm-12">
						<div class="loginbox col-lg-5 col-md-5 col-sm-12 p-3 ">
							<div class="login-right col-lg-12 col-md-12 col-sm-12">
								<div class="login-right-wrap col-lg-12 col-md-12 col-sm-12">
									<h1>Register</h1>
									<p class="account-subtitle">Access to our Website</p>
									<?php echo $error; ?><?php echo $msg; ?>
									<!-- Form -->
									<form method="post" enctype="multipart/form-data">
										<div class="form-group">
											<input type="text" name="name" class="form-control" placeholder="Your Name*">
										</div>
										<div class="form-group">
											<input type="email" name="email" class="form-control" placeholder="Your Email*">
										</div>
										<div class="form-group">
											<input type="text" name="contact" class="form-control" placeholder="Your Phone*" maxlength="15">
										</div>
										<div class="form-group">
											<input type="password" name="pass" class="form-control" placeholder="Your Password*">
										</div>

										<div class="form-group">
											<!-- <input type="password" name="pass"  class="form-control" placeholder="Your Password"> -->
											<select class="form-control my-4" name="role">
												<option value="user">User</option>
												<option value="agent">Agent</option>
											</select>
										</div>

										<div class="form-group">
											<input class="form-control" name="a_img" type="file">
										</div>

										<button class="btn btn-success" name="reg" value="Register" type="submit">Register</button>

									</form>

									<div class="login-or">
										<span class="or-line"></span>
										<span class="span-or">or</span>
									</div>



									<div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>

								</div><!-- FOR MORE PROJECTS visit: codeastro.com -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--	login  -->


			<!--	Footer   start-->
			<!--	Footer   start-->

			<!-- Scroll to top -->
			<a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>
			<!-- End Scroll To top -->
		</div>
	</div>
	<!-- Wrapper End -->
	<!-- FOR MORE PROJECTS visit: codeastro.com -->
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