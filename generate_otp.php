<?php
    session_start();
    include("Connection.php");

    function generateOTP($length = 6) {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];

        $query = "SELECT * FROM registration WHERE Email = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {

            $otp = generateOTP();
            
            $update_query = "UPDATE registration SET OTP = ? WHERE Email = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ss", $otp, $email);
            if ($update_stmt->execute()) {
                echo "OTP has been generated and stored in the database.";
            } else {
                echo "Failed to store OTP.";
            }

            $update_stmt->close();
        } else {
            echo "Email does not exist.";
        }

        $stmt->close();
        $conn->close();
    }
?>
