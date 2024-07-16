<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
    <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="generate_otp.php">
                        <h2 class="form-title">Forgot Password</h2>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required/>
                        </div>
                        <form action="generate_otp.php" method="POST">
                           <center> <button type="submit" class="signout">Generate OTP</button></center>
                        </form>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
