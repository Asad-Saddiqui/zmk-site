<?php
$query = "SELECT profile.* FROM profile JOIN user ON profile.uid = user.id WHERE user.role = 'admin' and id=1 ORDER BY user.date DESC;";
$mysqlifooter = mysqli_query($con, $query);
$myCompanyNum = mysqli_num_rows($mysqlifooter);
$myCompanyRow = mysqli_fetch_assoc($mysqlifooter);
?>
           <style> *{
                font-family: "gilroy-semibold, Sans-serif";
           }

                        #zmklogo{
                            height:80px;
                            width:auto;
                        }
                     p{
                        font-size: 23px;
                        font-family: sans-serif;
                        letter-spacing: 1px;
                        color: #6d6d6d;
                font-family: "gilroy-semibold, Sans-serif";

                     }
                     .pdf_{
                        width:100%;
                        height:400px
                    }
                    .table-responsive{
                            
                            margin-top:50px;
                        }
                        .NOC{
                        margin-top:50px; 
                        }
                    #imgsection{
                        width:100%;
                        /* height:300px; */
                    }
                    .NOC{
                        height:auto;
                    }
                    .swiperDetails img {
                        /* display: block; */
                        /* background-color: gray; */
                        width: 100%;
                        /* height: 400px; */
                        /* object-fit: cover; */
                    }
                    .swiper2 {
                        /* height: 400px; */
                    }
                @media screen and (min-width: 1600px) {
                    .toplink{
                        font-size:25px;
                    }
                    .font12{
                        font-size:25px;
                    }
                  .nav-item{
                    margin-left: 15px;
                  }
                  .dropdown-menu{
                    width:300px;
                }
                  #zmklogo{
                            height:80px;
                        }
                        .top-header {
                            line-height: 80px;
                        }
                 .navbar-expand-lg .navbar-nav .nav-link{
                    font-size: 24px;
                 }
                }
                @media screen and (max-width: 1600px) {
                    #imgsection{
                        width:100%;
                        height:auto;
                    }
                    .text-capitalize{
                        font-size:20px;
                    }
                    p{
                        font-size: 22px;
                        font-family: sans-serif;
                        letter-spacing: 1px;
                        color: #6d6d6d;
                    }
                    .swiper2 {
                        height: auto;
                    }
                    .swiperDetails img {
                        display: block;
                        width: 100%;
                        height: auto;
                    }
                }
                @media screen and (max-width: 990px) {
                    #imgsection{
                        width:100%;
                        height:auto;
                    }
                    .text-capitalize{
                        font-size:20px;
                    }
                    p{
                        font-size: 18px;
                        font-family: sans-serif;
                        letter-spacing: 1px;
                        color: #6d6d6d;
                    }
                    .swiper2 {
                        width: 100%;
                        height: auto;
                    }
                    .swiperDetails img {
                        width: 100%;
                        height: auto;
                    }
                }
                @media screen and (max-width: 890px) {
                    #imgsection{
                        width:100%;
                        height:390px;
                    }
                    .text-capitalize{
                        font-size:20px;
                    }
                    p{
                        font-size: 18px;
                        font-family: sans-serif;
                        letter-spacing: 1px;
                        color: #6d6d6d;
                    }
                    .swiper2 {
                        width: 100%;
                        height: 280px;
                    }
                    .swiperDetails img {
                        width: 100%;
                        height: 280px;
                    }
                }
                @media screen and (max-width: 790px) {
                    #imgsection{
                        width:100%;
                        height:340px;
                    }
                    .text-capitalize{
                        font-size:20px;
                    }
                    p{
                        font-size: 13px;
                        font-family: sans-serif;
                        letter-spacing: 1px;
                        color: #6d6d6d;
                    }
                    .swiper2 {
                        width: 100%;
                        height: 250px;
                    }
                    .swiperDetails img {
                        width: 100%;
                        height: 250px;
                    }
                }
              
                @media screen and (max-width: 400px) {
                    .pdf_{
                        width:100%;
                        height:100px
                    }
                    #imgsection{
                          width: 329px;
                           height: 250px;
                    }
                    .text-capitalize{
                        font-size:20px;
                    }
                    p{
                        font-size: 18px;
                        font-family: sans-serif;
                        letter-spacing: 1px;
                        color: #6d6d6d;
                        width: 330px;
                    }
                    .table-responsive{
                        width: 330px;
                        margin-top:0px;
                    }
                    .swiper2 {
                        width: 330px;
                        height: 250px;
                    }
                    .swiperDetails img {
                        width: 330px;
                        height: 250px;
                    }
                    .NOC{
                        width: 330px;
                    }
                    h4{
                            width: 330px;
                    }
                    span{
                        width: 330px;
                    }
                }
              
                @media screen and (max-width: 380px) {
                    #imgsection{
                          width: 320px;
                           height: 250px;
                           margin-left:-20px
                    }
                    .pdf_{
                        width:100%;
                        height:100px
                    }
                    .text-capitalize{
                        font-size:20px;
                        margin-left:-20px
                    }
                    p{
                        font-size: 12px;
                        font-family: sans-serif;
                        letter-spacing: 1px;
                        color: #6d6d6d;
                        width: 330px;
                        margin-left:-20px
                    }
                    .table-responsive{
                        width: 320px;
                        margin-top:0px;
                        margin-left:-20px
                    }
                    .swiper2 {
                        width: 320px;
                        height: 250px;
                        margin-left:-20px
                    }
                    .swiperDetails img {
                        width: 100%;
                        height: 250px;
                        /* margin-left:-40px */
                    }
                    .NOC{
                        width: 330px;
                        margin-left:-20px
                    }
                    h4{
                            width: 320px;
                            margin-left:-20px
                    }
                    span{
                        width: 320px;
                        margin-left:-20px
                    }
                }
                @media screen and (max-width: 360px) {
                    .pdf_{
                        width:100%;
                        height:100px
                    }
                    #imgsection{
                          width: 300px;
                           height: 250px;
                           margin-left:-20px
                    }
                    .text-capitalize{
                        font-size:20px;
                        /* margin-left:-20px */
                    }
                    p{
                        font-size: 12px;
                        font-family: sans-serif;
                        letter-spacing: 1px;
                        color: #6d6d6d;
                        width: 300px;
                        /* margin-left:-20px */
                    }
                    .table-responsive{
                        width: 320px;
                        margin-top:0px;
                        margin-left:-20px
                    }
                    .swiper2 {
                        width: 300px;
                        height: 250px;
                        margin-left:-20px
                    }
                    .swiperDetails img {
                        width: 100%;
                        height: 250px;
                        /* margin-left:-40px */
                    }
                    .NOC{
                        width: 300px;
                        margin-left:-20px
                    }
                    h4{
                            width: 300px;
                            /* margin-left:-20px */
                    }
                    span{
                        width: 300px;
                        margin-left:-20px
                    }
                }
            </style>
            <header id="header" class="transparent-header-modern fixed-header-bg-white w-100">
                <div class="top-header" style="background-color:#f36c21">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <ul class="top-contact list-text-white  d-table">
                                    <li><a class="text-white toplink" href="tel:<?php echo $myCompanyRow['clandline']; ?>"><i
                                                class="fas fa-phone-alt text-white mr-1"></i><?php echo $myCompanyRow['clandline']; ?></a>
                                    </li>
                                    <li><a class="text-white toplink" href="mailto:<?php echo $myCompanyRow['compyemail']; ?>"><i
                                                class="fas fa-envelope text-white toplink mr-2 font-13 mt-1"></i><?php echo $myCompanyRow['compyemail'] ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <div class="top-contact float-right">
                                    <ul class="list-text-white d-table">
                                        <li>
                                            <?php if (isset($_SESSION['userEmail'])) { ?>
                                            <i class="fas fa-user toplink text-white mr-1"></i><a
                                                href="logout.php">Logout</a>&nbsp;&nbsp;<?php } else { ?>
                                            <i class="fas fa-user toplink text-white mr-1"></i><a href="login.php" class="toplink">Login</a>&nbsp;&nbsp;

                                            |
                                        </li>
                                        <li><i class="fas fa-user-plus toplink text-white mr-1"></i><a href="register.php" class="toplink"> Register</li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    ::-webkit-scrollbar-thumb {
                        background: #f36c21;
                        /* Color of the thumb */
                    }

                    #projDiv {
                        height: auto;
                        max-height: 300px;
                        overflow-y: auto;
                    }

                    #links {
                        /* border-bottom: 2px solid white; */
                        border-radius: 0px;
                    }

                    #links:hover {
                        /* border-bottom: 2px solid green; */
                        border-radius: 0px;
                        background-color: lightgray;
                    }
                </style>
                <div class="main-nav secondary-nav hover-success-nav py-2">
                        <div class=" container">
                            <div class="col-lg-12 col-lg-12 ">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <a class="position-relative"  href="index.php">
                                        <img src="./zmkImages/LOGO FINAL-02.png"  alt="" id="zmklogo" />
                                    </a>
                                    <a class="position-relative" id="zmkmargin1" href="index.php">

                                    </a>
                                    <a class="position-relative" id="zmkmargin1" href="index.php">

                                    </a>

                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation"> <span
                                            class="navbar-toggler-icon"></span> </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item dropdown"> <a class="nav-link" href="index.php" role="button"
                                                    aria-haspopup="true" aria-expanded="false">Home</a></li>
                                                       <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Project</a>
                                                <ul class="dropdown-menu" id="projDiv">


                                                    <?php
                                                    $sql = "SELECT project_id, project_name FROM projects";
                                                    $resultp = mysqli_query($con, $sql);
                                                    $numN = mysqli_num_rows($resultp);

                                                    // Check if there are any rows returned by the query
                                                    if ($numN > 0) {
                                                        // Loop through each row and create dropdown items
                                                        while ($rowN = mysqli_fetch_assoc($resultp)) {
                                                    ?>
                                                    <li class="nav-item"> <a class="nav-link" id="links"
                                                            href="./projectDetails.php?pid=<?php echo $rowN['project_id']; ?>"><?php echo $rowN['project_name'] ?></a>
                                                    </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>


                                                </ul>
                                            </li>
                                            <!-- <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Project</a>
                                                <ul class="dropdown-menu" id="projDiv">


                                                    <?php
                                                    $sql = "SELECT project_id, project_name FROM projects where ListingCategory='Society'";
                                                    $resultp = mysqli_query($con, $sql);
                                                    $numN = mysqli_num_rows($resultp);

                                                    // Check if there are any rows returned by the query
                                                    if ($numN > 0) {
                                                        // Loop through each row and create dropdown items
                                                        while ($rowN = mysqli_fetch_assoc($resultp)) {
                                                    ?>
                                                    <li class="nav-item"> <a class="nav-link" id="links"
                                                            href="./projectDetails.php?pid=<?php echo $rowN['project_id']; ?>"><?php echo $rowN['project_name'] ?></a>
                                                    </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>


                                                </ul>
                                            </li> -->

                                            <li class="nav-item"> <a class="nav-link" href="about.php">About</a> </li>


                                            <li class="nav-item"> <a class="nav-link" href="property.php">Properties</a> </li>
                                            <li class="nav-item"> <a class="nav-link" href="blog-grid.php">News</a> </li>

                                            <li class="nav-item"> <a class="nav-link" href="agent.php">Agents</a> </li>
                                            <!-- <li class="nav-item"> <a class="nav-link" href="contact.php">Contact</a> </li> -->
                                         

                                            <?php if (isset($_SESSION['userEmail'])) { ?>
                                            <li class="nav-item dropdown  d-lg-none">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">My Account</a>
                                                <ul class="dropdown-menu">
                                                    <li class="nav-item"> <a class="nav-link" href="profile.php">Profile</a> </li>

                                                    <li class="nav-item"> <a class="nav-link" href="logout.php">Logout</a> </li>
                                                </ul>
                                            </li>
                                            <?php } else { ?>
                                            <li class="nav-item d-lg-none"> <a class="nav-link" href="login.php">Login/Register</a>
                                            </li>
                                            <?php } ?>

                                        </ul>

                                        <?php

                                        if (isset($_SESSION['userEmail'])) {
                                            $email = $_SESSION['userEmail'];
                                            $var = mysqli_query($con, "select * from user where varified=1 and email='$email'");
                                            $num_ = mysqli_num_rows($var);
                                            if ($num_ === 1) {


                                        ?>
                                        <a class="btn d-xl-block mb-2 mr-3" style="background-color:#f36c21"
                                            style="border-radius:30px;" href="./agent/index.php">Add Property</a>
                                        <?php
                                            }
                                        }

                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['userEmail'])) {
                                    ?>
                                    <a href="profile.php" class="d-none d-lg-block"> <img
                                            src="./admin/common/user/<?php echo $_SESSION['userImg']; ?>"
                                            style="height: 60px;width:60px;border-radius:50%;cursor:pointer" alt="" /></a>

                                    <?php
                                    }
                                    ?>

                                </nav>
                            </div>
                        </div>
                </div>
            </header>