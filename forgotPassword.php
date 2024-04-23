<?php
session_start();
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
               header("location:password.php?uid=$id");

            } else {
                echo 'Failed to send email. Error: ' . $mail->ErrorInfo;
            }
}
if (isset($_POST['send'])) {
    // Validate and sanitize inputs
    $email = filter_input(INPUT_POST, 'uemail', FILTER_SANITIZE_EMAIL);
    if (!$email) {
        $error = "<p class='alert alert-warning'>Please Enter  Email</p>";
    } else {
        function generateRandomString($length = 8)
        {
            $bytes = random_bytes($length);
            return bin2hex($bytes);
        }

        // Example usage
        $randomString = generateRandomString();
        $query = "SELECT * FROM user WHERE email='$email'";
        $res = mysqli_query($con, $query);
        $num = mysqli_num_rows($res);
        $row = mysqli_fetch_assoc($res);
        $lastInsertedId = $row['id'];

        if ($num == 1) {
            $opt="SELECT* FROM forgotpass WHERE uid = $lastInsertedId ";
            $resopt = mysqli_query($con, $opt);
           $otpRow= mysqli_num_rows($resopt);
          if($otpRow===1){
             mysqli_query($con,"DELETE FROM forgotpass WHERE uid = $lastInsertedId");
               $sqli = "INSERT INTO `forgotpass` (`forid`, `uid`, `passs`) VALUES (NULL, '$lastInsertedId', '$randomString');";
                    $res = mysqli_query($con, $sqli);
                    if ($res) {
                        sendEmail($email, $randomString,$lastInsertedId);
                    } else {
                        $error = "<p class='alert alert-warning'>Something Went Wrong</p>";
                    }
          }else{
    $sqli = "INSERT INTO `forgotpass` (`forid`, `uid`, `passs`) VALUES (NULL, '$lastInsertedId', '$randomString');";
                        $res = mysqli_query($con, $sqli);
                        if ($res) {
                            sendEmail($email, $randomString,$lastInsertedId);
                        } else {
                            $error = "<p class='alert alert-warning'>Something Went Wrong</p>";
                        }
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
    <!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
    
    <!--	Title
	=========================================================-->
    <title>Real Estate PHP</title>
</head>
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
                <div class="login-wrapper col-lg-12 col-md-12 col-sm-12">
                    <div class="container col-lg-12 col-md-12 col-sm-12">
                        <div class="loginbox col-lg-5 col-md-5 col-sm-12 p-3">
                            <div class="login-right col-lg-12 col-md-12 col-sm-12">
                                <div class="login-right- col-lg-12 col-md-12 col-sm-12">
                                    <h1>Forgot Password Way</h1>
                                    <p class="account-subtitle">Access to our Website</p>
                                    <?php echo $error; ?><?php echo $msg; ?>
                                    <!-- Form -->
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="email" name="uemail" class="form-control" placeholder="Your Email*">
                                        </div>

                                        <button class="btn btn-success" name="send" value="Send Code" type="submit">Send Code</button>

                                    </form>


                                </div>
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