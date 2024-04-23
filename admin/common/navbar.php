<style>
    * {
        scrollbar-width: 5px;
        scrollbar-color: #f47321 white;
    }

    /* Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 5px;
    }

    *::-webkit-scrollbar-track {
        background: white;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #FFA500;
        border-radius: 10px;
    }

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

<nav id="navbar" class="navbar navbar-expand  navbar-info sticky-top px-4 py-0" style="background-color:#f47321;">
  
    <a href="#" class="sidebar-toggler flex-shrink-0 bg-white ">
        <i class="fa fa-bars"></i>
    </a>
    <p class="mx-4  mt-3 font-weight-bold" id="hide" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color:black; font-size:20px">ZMK Marketing </p>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown" id="hide2">
            <a class="nav-link ">
                <i class="fa fa-envelope me-lg-2 bg-white d-none d-lg-inline-flex"></i>
                <span class="d-none d-lg-inline-flex " style="color: black;"><?php echo $_SESSION['adminEmail'];; ?></span>
            </a>
        </div>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="./common/user/<?php echo $_SESSION['adminImg']; ?>" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex " style="color: black;"><?php echo $_SESSION['adminName']; ?></span>
            </a>
            <style>
                .content .navbar .dropdown-item:hover{
                        background: #5301011c;
                    }
                </style>

            <div class="dropdown-menu dropdown-menu-end  border-0 rounded-0 rounded-bottom m-0" style="background-color:#f47321 !important">
                <a href="updateProfile.php?aid=<?php echo $_SESSION['adminID']; ?>" class="dropdown-item" style="color: white;">My Profile</a>
                <a href="./adminlogout.php" class="dropdown-item" style="color: white;">Log Out</a>
            </div>
        </div>
    </div>
</nav>
<!-- side bar end -->