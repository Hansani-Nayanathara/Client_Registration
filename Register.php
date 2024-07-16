<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dark Bootstrap Admin</title>
  <!-- Meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="robots" content="all,follow">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="temp/vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="temp/vendor/font-awesome/css/font-awesome.min.css">
  <!-- Custom Font Icons CSS -->
  <link rel="stylesheet" href="temp/css/font.css">
  <!-- Google fonts - Muli -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
  <!-- Theme stylesheet -->
  <link rel="stylesheet" href="temp/css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="temp/css/custom.css">
  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon.ico">
  
  <!-- PHP Session and Database Connection -->
  <?php
    session_start();
    include("Connection.php");

    if (!isset($_SESSION['user'])) {
        header("Location: Log_in.php?error=You must be logged in to access your profile");
        exit;
    }

    $user_data = $_SESSION['user'];
    $admin_name = $user_data['Name'];  // Assuming the admin's name is stored in the session

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_name = $_POST['name'];
        $email = $_POST['email'];
        $phone_nu = intval($_POST['phoneNumber']);
        $profile_pic = $_FILES['profile_picture']['name'];
        $tempname = $_FILES['profile_picture']['tmp_name'];
        $folder = "./Uploaded/" . $profile_pic;

        if (move_uploaded_file($tempname, $folder)) {
            $stmt = $conn->prepare("INSERT INTO users (user_name, email, phone_nu, profile_pic, added_by) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiss", $user_name, $email, $phone_nu, $profile_pic, $admin_name);

            if ($stmt->execute()) {
                $_SESSION['message'] = "User registered successfully.";
                header("Location: ViewUser.php");
                exit;
            } else {
                $errors[] = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $errors[] = "Error uploading file.";
        }

        $conn->close();
    }
  
  ?>
  
  <!-- Custom CSS styles -->
  <style type="text/css">
    label {
      width: 300px; /* Example of CSS customization */
    }
    p {
      color: white;
      font-size: 16px;
    }
    form {
      padding: 40px;
      color: white;
    }
    input[type='text'],
    input[type='email'] {
      width: 300px; /* Example of CSS customization */
    }
    h3 {
      color: white;
    }
  </style>
</head>

<body>
  <!-- Header section -->
  <header class="header">
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand">
            <div class="brand-text brand-big visible text-uppercase">
              <strong class="text-primary">Admin</strong>
            </div>
            <div class="brand-text brand-sm">
              <strong class="text-primary">D</strong>
              <strong>A</strong>
            </div>
          </a>
          <!-- Sidebar toggle button -->
          <button class="sidebar-toggle">
            <i class="fa fa-long-arrow-left"></i>
          </button>
        </div>

        <!-- Logout link -->
        <div class="list-inline-item logout">
          <a id="logout" href="Log_out.php" class="nav-link">
            Logout <i class="icon-logout"></i>
          </a>
        </div>
      </div>
    </nav>
  </header>

  <div class="d-flex align-items-stretch">
    <!-- Sidebar navigation -->
    <nav id="sidebar">
      <!-- Sidebar header -->
      <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
          <img src="<?php echo 'PhotoUploaded/' . htmlspecialchars($user_data['Profile_photo']); ?>" alt="Profile" class="img-fluid rounded-circle">
        </div>
        <div class="title">
          <h1 class="h5"><?php echo htmlspecialchars($user_data['Name']); ?></h1>
        </div>
      </div>
      
      <!-- Sidebar navigation menus -->
      <ul class="list-unstyled">
        <li><a href="HomePage.php"><i class="icon-home"></i> Home </a></li>
        <li><a href="Register.php"><i class="icon-home"></i> Register user </a></li>
        <li><a href="ViewUser.php"><i class="fa fa-bar-chart"></i> View User </a></li>
        
      </ul>
    </nav>

    <!-- Main content -->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h3>Register User</h3>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><p>User name:</p></label>
                        <input type="text" class="form-input" name="name" id="name" required/>
                        <span id="nameError" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label><p>User email:</p></label>
                        <input type="email" class="form-input" name="email" id="email" required/>
                    </div>
                    <div class="form-group">
                        <label><p>User Phone number:</p></label>
                        <input type="text" class="form-input" name="phoneNumber" id="phone_nu" required/>
                        <span id="phoneError" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label for="profile_picture"><p>Upload picture:</p></label>
                        <input type="file" id="profile_picture" name="profile_picture" required><br>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="btn btn-secondary" value="Register"/>
                    </div>
                </form>
            </div>
        </div>
          <!-- End form content -->
          

      <!-- Footer section -->
      <footer class="footer">
        <div class="footer__block block no-margin-bottom">
          <div class="container-fluid text-center">
            <!-- Footer text -->
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
