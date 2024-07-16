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
          include("Connection.php");

          if (!isset($_SESSION['user'])) {
              header("Location: Log_in.php?error=You must be logged in to access your profile");
              exit;
          }

          $user_data = $_SESSION['user'];
          $admin_name = $user_data['Name'];
        ?>

        <style type="text/css">
          
          thead, tbody, td, th{
            border: 1px solid grey;
            color: white;
            padding: 15px;
          }

          table {
            margin-left: 40px;
            margin-top: 40px;
          }
          
        </style>
  </head>

  <body>

    <header class="header">
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form method="post" enctype="multipart/form-data">
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

        <ul class="list-unstyled">
                <li><a href="HomePage.php"> <i class="icon-home"></i>Home </a></li>
                <li ><a href="Register.php"> <i class="icon-home"></i>Register user </a></li>
                <li><a href="ViewUser.php"> <i class="fa fa-bar-chart"></i>View User </a></li>
                
        </ul>
        
      </nav>
      <!-- Sidebar Navigation end-->

            <!-- Main content -->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h3>View Users</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Profile Picture</th>
                                <th>Added By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT user_name, email, phone_nu, profile_pic, added_by FROM users WHERE added_by = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("s", $admin_name);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['phone_nu']) . "</td>";
                                    echo "<td><img src='./Uploaded/" . htmlspecialchars($row['profile_pic']) . "' alt='Profile Picture' width='50' height='50'></td>";
                                    echo "<td>" . htmlspecialchars($row['added_by']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No users found</td></tr>";
                            }

                            $stmt->close();
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
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

