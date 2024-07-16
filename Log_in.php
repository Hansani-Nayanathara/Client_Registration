<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">

    <?php
    session_start();
    include("Connection.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM registration WHERE Email = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            // Verify the password
            if ($user_data['Password'] == $password) {
                // Store user data in session
                $_SESSION['user'] = [
                    'Name' => $user_data['Name'],
                    'Email' => $user_data['Email'],
                    'Address' => $user_data['Address'],
                    'Phone_Number' => $user_data['Phone_Number'],
                    'Profile_photo' => $user_data['Profile_photo'],
                    'How_hear' => $user_data['How_hear'],
                    'Recommandation' => $user_data['Recommandation']
                ];
                header("Location: HomePage.php");
                exit;
            } else {
                header("Location: Log_in.php?error=Your email or password is wrong");
                exit;
            }
        } else {
            header("Location: Log_in.php?error=Your email or password is wrong");
            exit;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</head>
<body>

    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" enctype="multipart/form-data">
                        <h2 class="form-title">Log in</h2>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <?php
                            if (isset($_GET['error'])) {
                                echo "<div class='error' style='color:red; margin-top:5px;'>" . htmlspecialchars($_GET['error']) . "</div>";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Log in"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Don't have an account? <a href="Sign_in.php" class="loginhere-link">Sign up here</a><br><br>
                        Forgot Password? <a href="forgot_password.php" class="loginhere-link">Click here</a>
                    </p>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
