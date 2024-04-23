<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("./admin/config/config.php");
include("./expire.php");
expire($con);
$id = isset($_GET['pid']) ? (is_numeric($_GET['pid']) ? $_GET['pid'] : header('location:property.php')) : header('location:property.php');

if (isset($_SESSION['userID'])) {
    $uid = $_SESSION['userID'];
    $quey56 = "SELECT * FROM propviews WHERE uid=$uid and pid=$id";
    $result56 = mysqli_query($con, $quey56);
    $row_num_56 = mysqli_num_rows($result56);
    if ($row_num_56 !== 1) {
        $quey8 = "INSERT INTO `propviews` (`id`, `uid`, `pid`) VALUES (NULL, '$uid', '$id')";
        $result8 = mysqli_query($con, $quey8);
    }
}
function test_input1($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if (isset($_POST['comment'])) {

    $email = $_SESSION['userEmail'];
    $U_id = $_SESSION['userID'];
    $comment = $_POST['message'];

    $comment = test_input1($comment);
    if (isset($_SESSION['userEmail'])) {
        if (!empty($comment)) {
            $query23 = "INSERT INTO `comments` (`id`, `uid`, `comment`, `date`, `pid`) VALUES (NULL, '$U_id', '$comment', current_timestamp(), '$id');";
            $resuluser23 = mysqli_query($con, $query23);
            if ($resuluser23) {

                header(`Location:peoperty-comment.php?pid=$id`);
                $comment = "";
            } else {
                echo '<script>alert("' . $stmt->error . '")</script>';
            }
        } else {
            echo '<script>alert("Please Fill Comments")</script>';
        }
    }
}

if (isset($_POST['deleteComment'])) {

    $email = $_SESSION['userEmail'];
    $U_id = $_SESSION['userID'];
    $cid = $_POST['cid'];

    if (isset($_SESSION['userEmail'])) {
        $check = mysqli_query($con, "select * from comments where id=$cid");
        $check_row = mysqli_fetch_assoc($check);
        if ((int)$check_row['uid'] === (int)$U_id) {
            $query23 = "DELETE FROM comments WHERE id = $cid;";
            $resuluser23 = mysqli_query($con, $query23);
            if ($resuluser23) {

                header(`Location:peoperty-comment.php?pid=$id`);
            } else {
                echo '<script>alert("' . $stmt->error . '")</script>';
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

    <!-- Meta Tags --><!-- FOR MORE PROJECTS visit: codeastro.com -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Real Estate PHP">
    <meta name="keywords" content="">
    <meta name="author" content="Unicoder">
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
    <link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--	Title
	=========================================================-->
    <title>Real Estate PHP</title>
</head>

<body>

    <!-- <div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
        <div class="d-flex justify-content-center y-middle position-relative">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div> -->



    <div id="page-wrapper">
        <div class="row">
            <!--	Header start  -->
            <?php include("include/header.php"); ?>
            <!--	Header end  -->

            <!--	Banner   --->
            <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Property Detail</b></h2>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="float-left float-md-right">
                                <ol class="breadcrumb bg-transparent m-0 p-0">
                                    <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Property Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--	Banner   --->


            <div class="full-row">
                <div class="container">
                    <div class="row"><!-- FOR MORE PROJECTS visit: codeastro.com -->

                        <?php

                        $query = mysqli_query($con, "SELECT property.*, user.name, user.email, user.img,profile.comid,profile.cphone,profile.logo,profile.fburl,profile.youtuburl,profile.instaurl,profile.compyemail,profile.comname,profile.clandline FROM property JOIN user ON property.uid = user.id JOIN profile ON profile.uid = property.uid WHERE property.id = $id and status=1;");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>

                            <div class="col-lg-12">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="single-property" style="width:100%; height:300px; margin:30px auto 50px;">
                                            <?php
                                            $id = $row['id'];
                                            $mysqli = mysqli_query($con, "SELECT * FROM `propertyimages` where propertyimages.pid=$id");
                                            $res = mysqli_fetch_assoc($mysqli)
                                            // while ($res = mysqli_fetch_assoc($mysqli)) {

                                            ?>
                                            <div class="ls-slide"> <img width="100%" height="100%" src="./admin/uploads/<?php echo $res['name'] ?>" class="ls-bg" alt="" /> </div>
                                            <?php
                                            // }
                                            ?>
                                        </div>
                                    </div>
                                </div><!-- FOR MORE PROJECTS visit: codeastro.com -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="bg-success d-table px-3 py-2 rounded text-white text-capitalize">For <?php echo $row['purpose']; ?></div>
                                        <h5 class="mt-2 text-secondary text-capitalize"><?php echo $row['title']; ?> ( <?php echo $row['propertySubtype']; ?> )</h5>
                                        <span class="mb-sm-20 d-block text-capitalize"><i class="fas fa-map-marker-alt text-success font-12"></i> &nbsp;<?php echo $row['city']; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-success text-left h5 my-2 text-md-right">Rs : <?php echo $row['price']; ?></div>
                                        <div class="text-left text-md-right">Price</div>
                                    </div>
                                </div>

                            </div>

                        <?php } ?>

                        <style>
                            #input {
                                width: 100%;
                                height: 50px;
                                border: none;
                                border-bottom: 2px solid green;
                                outline: none;
                                border-radius: none;
                            }
                        </style>
                        <section class="col-md-12 col-sm-12 col-lg-12">
                            <div class="container ">
                                <form method="post" class="row col-lg-12 col-md-12 col-sm-12">
                                    <p class="col-lg-12 col-md-12 col-sm-12"><span>Comment here...</span></p>
                                    <div class="col-sm-10 col-lg-9 col-md-10 mt-2">
                                        <input type="text" id="input" maxlength="700" placeholder="Comment here . . ." name="message" />
                                    </div>
                                    <div class="col-sm-2 mt-2 col-lg-2 col-md-2">
                                        <button class="btn btn-success" name="comment">
                                            Send
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-3 col-md-12 col-sm-12 col-lg-12">
                                <?php
                                $mycomments = mysqli_query($con, "SELECT comments.*, user.name, user.img FROM comments JOIN user ON user.id = comments.uid where pid =$id;");
                                while ($row = mysqli_fetch_assoc($mycomments)) {
                                    # code...
                                ?>
                                    <div class="row col-md-12 col-sm-12 col-lg-12">
                                        <div class="row col-md-12 col-sm-12 col-lg-12">
                                            <div class=" circle border bg-info" style="height: 70px;width:70px">
                                                <img src="./admin/common/user/<?php echo $row['img'] ?>" alt="no Image" width="100%" height="100%" />
                                            </div>
                                            <div class="pl-3 pt-2" style="width: calc(100% - 70px);">
                                                <p style="font-size: small;"><?php echo $row['name'] ?>
                                                    <br>
                                                    <?php echo $row['date'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div>
                                                <form method="post">
                                                    <p style="font-size: small;" class=" pt-2 col-md-8 col-lg-8 col-sm-12"><?php echo $row['comment'] ?>
                                                        <input type="text" hidden value="<?php echo $row['id']; ?> " name="cid" />
                                                        <?php
                                                        if(isset($_SESSION['userEmail'])){
                                                            $uiD=$_SESSION['userID'];
                                                            if((int)$uiD===(int)$row['uid']){
?>
                                                                <button type="submit" name="deleteComment" style="color:red">Delete</button>
                                                         <?php
                                                            }
                                                        }
                                                        ?>


                                                    </p>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>




                            </div>
                        </section>


                    </div>
                </div>
            </div>

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