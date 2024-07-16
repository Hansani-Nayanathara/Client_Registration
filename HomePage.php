<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="temp/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="temp/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="temp/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="temp/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="temp/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
 
       <?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: Log_in.php?error=You must be logged in to access your profile");
    exit;
}

$user_data = $_SESSION['user'];
?>
<style type="text/css">
    .profile{
        padding: 50px;
        margin-top: 30px;
        color: white;
    }

    .profile-picture{
        padding: 50px;
        margin-top: 30px;
    }
</style>
  </head>

  <body>

    <header class="header">
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.html" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Admin</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>

            <!-- Log out               -->
            <div class="list-inline-item logout"><a id="logout" href="Log_out.php" class="nav-link">Logout <i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="<?php echo 'PhotoUploaded/' .htmlspecialchars($user_data['Profile_photo']); ?>" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5"><?php echo htmlspecialchars($user_data['Name']); ?></h1>

          </div>
        </div>
        <!-- Sidebar Navidation Menus-->
        <ul class="list-unstyled">
                <li><a href="HomePage.php"> <i class="icon-home"></i>Home </a></li>
                <li><a href="Register.php"> <i class="icon-home"></i>Register user </a></li>
                <li><a href="ViewUser.php"> <i class="fa fa-bar-chart"></i>View Users </a></li>
             
        </ul>
        
      </nav>
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h1 class="h5 no-margin-bottom">Dashboard</h1>

            <section class="profile">
                <div class="profile-content">
                    <h2>Welcome, <?php echo htmlspecialchars($user_data['Name']); ?>! </h2>
                    <div class="profile-picture">
                        <img src="<?php echo 'PhotoUploaded/' .htmlspecialchars($user_data['Profile_photo']); ?>" alt="Profile Photo" style="max-width: 200px; max-height: 200px;">
                    </div>
                    <p>Email: <?php echo htmlspecialchars($user_data['Email']); ?></p>
                    <p>Address: <?php echo htmlspecialchars($user_data['Address']); ?></p>
                    <p>Phone Number: <?php echo htmlspecialchars($user_data['Phone_Number']); ?></p>
                 </div>
             </section>

          </div>
        </div>




        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
               <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="temp/vendor/jquery/jquery.min.js"></script>
    <script src="temp/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="temp/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="temp/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="temp/vendor/chart.js/Chart.min.js"></script>
    <script src="temp/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="temp/js/charts-home.js"></script>
    <script src="temp/js/front.js"></script>
  </body>
</html>

