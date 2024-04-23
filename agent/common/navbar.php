<style>
    @media (max-width: 400px) {
        #hide {
            display: none;
        }
    }

    @media (max-width: 300px) {
        #hide2 {
            display: none;
        }
    }
</style>

<nav id="navbar" class="navbar navbar-expand bg-white navbar-dark sticky-top px-4 py-0">
    <!--<a href="dashboard.php" class="navbar-brand d-flex d-lg-none me-4">-->
    <!--    <img src="./common/logo.png" alt="" style="height: 50px; width: 50px;margin: 0px 10px;" srcset="">-->

    <!--</a>-->
    <a href="#" class="sidebar-toggler bg-white flex-shrink-0 ">
        <i class="fa fa-bars "></i>
    </a>
    <!--<p class="mx-4" id="hide" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color:white;">Oribit Enterprises </p>-->
    <div class="navbar-nav align-items-center ms-auto">
        <a href="../index.php">View ZMK Marketing</a>
        <div class="nav-item dropdown" id="hide2">
            <a href="#" class="nav-link ">
                <i class="fa fa-envelope d-none d-lg-inline-flex  bg-white me-lg-2"></i>
                <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['agentEmail'];; ?></span>
            </a>
        </div>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="../admin/common/user/<?php echo $_SESSION['agentImg']; ?>" alt="no img" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['agentName']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-white border-0 rounded-0 rounded-bottom m-0">
                <a href="../applicationForm.php" class="dropdown-item bg-white">My Profile</a>
                <a href="./adminlogout.php" class="dropdown-item bg-white">Log Out</a>
            </div>
        </div>
    </div>
</nav>
<!-- side bar end -->