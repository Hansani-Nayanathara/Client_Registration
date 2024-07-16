<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">

    <?php
        session_start();
        include("Connection.php");

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phoneNu = intval($_POST['phoneNumber']);
            $password = $_POST['password'];
            $rePassword = $_POST['re_password'];
            $profile_picture = $_FILES['profile_picture']['name'];
            $tempname = $_FILES['profile_picture']['tmp_name'];
            $howhear = $_POST['howhear'];
            $recommandation = $_POST['recommand'];
            $agreeterm = isset($_POST['agreeterm']) ? 1 : 0;
            $folder = "./PhotoUploaded/" . $profile_picture;


            if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[\W_]/', $password)) {
                $errors[] = "Password must be at least 8 characters long and include at least one number, one symbol, one uppercase letter, and one lowercase letter.";
            }

            if ($password !== $rePassword) {
                $errors[] = "Passwords do not match.";
            }

            if (empty($errors) && move_uploaded_file($tempname, $folder)) {

                $stmt = $conn->prepare("INSERT INTO registration (Name, Email, Address, Phone_Number, Password, Re_Password, Profile_photo, How_hear, Recommandation, Agree_Term) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssisssssi", $name, $email, $address, $phoneNu, $password, $rePassword, $profile_picture, $howhear, $recommandation, $agreeterm);

                if ($stmt->execute()) {
                    $_SESSION['user'] = [
                        'Name' => $name,
                        'Email' => $email,
                        'Address' => $address,
                        'Phone_Number' => $phoneNu,
                        'Profile_photo' => $profile_picture,
                        'How_hear' => $howhear,
                        'Recommandation' => $recommandation
                    ];
                    header("Location: HomePage.php");
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.toggle-password').click(function() {
            $(this).toggleClass('zmdi-eye zmdi-eye-off');
            var passwordField = $(this).siblings('input[type="password"]');
            var fieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', fieldType);
        });

        $('#re_password').on('keyup', function() {
            var password = $('#password').val();
            var rePassword = $('#re_password').val();

            if (password !== rePassword) {
                $('#passwordError').text('Passwords do not match');
            } else {
                $('#passwordError').text('');
            }
        });

        $('#password').on('keyup', function() {
            var password = $(this).val();
            var passwordError = '';

            if (password.length < 8) {
                passwordError = 'Password must be at least 8 characters long';
            } else if (!/[A-Z]/.test(password)) {
                passwordError = 'Password must include at least one uppercase letter';
            } else if (!/[a-z]/.test(password)) {
                passwordError = 'Password must include at least one lowercase letter';
            } else if (!/[0-9]/.test(password)) {
                passwordError = 'Password must include at least one number';
            } else if (!/[\W_]/.test(password)) {
                passwordError = 'Password must include at least one symbol';
            }

            $('#passwordValidationError').text(passwordError);
        });


        $('#name').on('keyup', function() {
            var name = $(this).val();
            if (!/^[a-zA-Z ]*$/.test(name)) {
                $('#nameError').text('Name must contain only letters and spaces');
            } else {
                $('#nameError').text('');
            }
        });

        $('#phone_nu').on('keyup', function() {
            var phoneNu = $(this).val();
            if (!/^\d{10}$/.test(phoneNu)) {
                $('#phoneError').text('Phone number must be 10 digits');
            } else {
                $('#phoneError').text('');
            }
        });
    });
</script>
</head>
<body>
    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" enctype="multipart/form-data">
                        <h2 class="form-title">Create account</h2>
                        
                        <?php if (!empty($errors)): ?>
                            <div class="form-group">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li class="text-danger"><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name" required/>
                            <span id="nameError" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="address" id="address" placeholder="Your Address" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="phoneNumber" id="phone_nu" placeholder="Your phone number" required/>
                            <span id="phoneError" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            <span id="passwordValidationError" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password" required/>
                            <span id="passwordError" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture">Upload your profile picture:</label>
                            <input type="file" id="profile_picture" name="profile_picture" required><br>
                        </div>
                        <div class="form-group">
                            <label for="howhear">How did you hear about us? :&nbsp</label>
                                <select name="howhear" id="ways" required>
                                    <option value="whatsapp">Whatsapp</option>
                                    <option value="institue or university">Institue or university</option>
                                    <option value="linkedin">Linkedin</option>
                                    <option value="Other">Other</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="recommand">Will you be willing to recommend us? : &nbsp</label>
                            <input type="radio" id="yes" name="recommand" value="yes">
                            <label for="yes"> Yes&nbsp&nbsp</label><span></span><span></span>
                            <input type="radio" id="no" name="recommand" value="no">
                            <label for="no"> No&nbsp&nbsp</label>
                            <input type="radio" id="maybe" name="recommand" value="may_be">
                            <label for="maybe"> Maybe</label><br>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agreeterm" id="agree-term" class="agree-term" required/>
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service" >Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="Log_in.php" class="loginhere-link">Login here</a>
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
