  <style>
 @media (max-width: 992px) {
        #info {
           margin-top:70px
        }
    }
    .nav-link{
        color:black;
    }
    .sidebar .navbar .navbar-nav .nav-link:hover{
    color: #f47321;
    background: #f4732126;
    border-color: #ff6300;
}
.sidebar .navbar .navbar-nav .nav-link i {
    width: 30px;
    height: 30px;
    background: #ffffff;
}
.sidebar .navbar .navbar-nav .nav-link:hover i{
    background: #fdeade;
}
.sidebar .navbar .dropdown-item:hover{
    background: #f4732124;
}
.sidebar .navbar .navbar-nav .nav-link {
    color: #8f8f8f;
}
.sidebar .navbar .dropdown-item {
    padding-left: 40px;
    border-radius: 0 30px 30px 0;
    color: #8d8d8d;
}
  </style>
  
  <div class="sidebar pe-4 pb-3 bg-white">
      <nav class="navbar bg-white navbar-white">
          <div class="d-flex align-items-center   ms-4 mb-4 " id="info" >
              <div class="position-relative">
                  <a href="Update-Personal-Date.php">
                      <img class="rounded-circle" src="./common/user/<?php echo $_SESSION['adminImg']; ?>" alt="" style="width: 40px; height: 40px;">
                  </a>
                  <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                  </div>
              </div>
              <div class="ms-3">
                  <a href="Update-Personal-Date.php">
                      <h6 class="mb-0">
                          <?php echo $_SESSION['adminName']; ?>
                      </h6>
                  </a>
                  <a href="myprofile.php?aid=<?php echo $_SESSION['adminID']; ?>" class="text-light"><span>Admin </span></a>
              </div>
          </div>
          <div class="navbar-nav w-100">
              <a href="./index.php" class="nav-item nav-link "><i class="fa fa-home me-2 "></i>Dashboard</a>

              <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class=" fa fa-user me-2"></i>
                      User</a>
                  <div class="dropdown-menu bg-transparent border-0">
                      <a href="./register.php" class="dropdown-item">User Registration</a>
                      <a href="./adminlist.php" class="dropdown-item">User List</a>
                  </div>
              </div>


              <a href="./membership.php" class="nav-item nav-link "><i class=" fa fa-table me-2"></i>Membership</a>
    
              <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class=" fa fa-building"></i>
                      Property</a>
                  <div class="dropdown-menu bg-transparent border-0">
                      <a href="_addproperty.php" class="dropdown-item">Add Property</a>
                      <a href="-view-pro.php" class="dropdown-item">View Property</a>
                  </div>
              </div>
              <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class=" fa fa-list"></i>
                      Project</a>
                  <div class="dropdown-menu bg-transparent border-0">
                      <a href="project.php" class="dropdown-item">Add Project</a>
                      <a href="projectlist.php" class="dropdown-item">View Project</a>
                  </div>
              </div>
              <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class=" fa fa-cart"></i>
                      Card & Account </a>
                  <div class="dropdown-menu bg-transparent border-0">
                      <a href="@productCard.php" class="dropdown-item">Product Card</a>
                      <a href="@cardList.php" class="dropdown-item">Card List</a>
                       <a href="account-add.php" class="dropdown-item">Add Account</a>
                      <a href="account_list.php" class="dropdown-item">Manage Account</a>
                  </div>
              </div>
             
             
               <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class=" fa fa-map"></i>
                      Other</a>
                  <div class="dropdown-menu bg-transparent border-0">
                      <a href="contact.php" class="dropdown-item">Contact</a>
                      <a href="handlecomments.php" class="dropdown-item">Comments</a>
                      <a href="./feedback.php" class="dropdown-item">Feedback</a>
                      <a href="bookinginfo.php" class="dropdown-item">Booking</a>
                        <a href="news-add.php" class="dropdown-item">Today News</a>
                      <a href="news_list.php" class="dropdown-item">Manage News</a>
                  </div>
              </div>
          </div>
      </nav>
  </div>