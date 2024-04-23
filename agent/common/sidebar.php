  <style>
      @media (max-width: 989px) {
          #hideimg {
              display: none;
              margin-top: 100px;
          }

          #info {
              margin-top: 70px;
          }

      }
  </style>
  <div class="sidebar bg-white pe-4 pb-3">
      <nav class="navbar bg-white navbar-white">
          <!--<a href="dashboard.php" class="navbar-brand ml-7 mb-3 ">-->
          <!--    <img src="./common/logo.png" id="hideimg" alt="" style="height: 93px; width: 115px;margin: 0px 50px;border-bottom: 2px solid white" srcset="">-->

          <!--</a>-->


          <div class="d-flex align-items-center ms-4 mb-4 " id="info">


              <div class="position-relative">
                  <a>
                      <img class="rounded-circle" src="../admin/common/user/<?php echo $_SESSION['agentImg']; ?>" alt="" style="width: 40px; height: 40px;">
                  </a>
                  <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                  </div>
              </div>
              <div class="ms-3">
                  <a href="myprofile.php?aid=<?php echo $_SESSION['agentID']; ?>">
                      <h6 class="mb-0">
                          <?php echo $_SESSION['agentName']; ?>
                      </h6>
                  </a>
                  <a href="myprofile.php?aid=<?php echo $_SESSION['agentID']; ?>" class="text-light"><span>Agent </span></a>
              </div>
          </div>
          <div class="navbar-nav w-100">
              <a href="./index.php" class="nav-item nav-link bg-white "><i class="fa fa-home bg-white me-2"></i>Dashboard</a>



              <a href="./membership.php" class="nav-item nav-link bg-white "><i class="fa fa-building bg-white me-2"></i>Buy Product</a>
              <a href="./Purchase_card_list.php" class="nav-item nav-link bg-white "><i class="fa fa-building bg-white me-2"></i>My Cart</a>

              <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle bg-white" data-bs-toggle="dropdown"><i class="fa bg-white fa-map"></i>
                      &nbsp;Property</a>
                  <div class="dropdown-menu bg-transparent border-0">
                      <a href="_addproperty.php" class="dropdown-item">Add Property</a>
                      <a href="-view-pro.php" class="dropdown-item">View Property</a>
                  </div>
              </div>

              <!-- <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle bg-white" data-bs-toggle="dropdown"><i class="bi bg-white bi-telephone"></i> &nbsp;Contact</a>
                  <div class="dropdown-menu bg-transparent border-0">
                      <a href="contact.php" class="dropdown-item ">Contact</a>

                  </div>
              </div> -->

              <a href="contact.php" class="nav-item nav-link bg-white "><i class="fas bg-white fa-hotel me-2"></i></i>Booking</a>
          </div>
      </nav>
  </div>