<?php
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if (isset($_POST['generate_otp'])) {
    $otp_str = str_shuffle("0123456789");
    $otp = substr($otp_str, 0, 5);

    $act_str = rand(100000, 10000000000);
    $activation_code = str_shuffle("abcdeghijkl" . $act_str);

    $email = mysqli_escape_string($conn, $_POST['email']);
    $username = mysqli_escape_string($conn, $_POST['username']);
    $pwd = mysqli_escape_string($conn, $_POST['pwd']);
    $seller_name = mysqli_escape_string($conn, $_POST['seller_name']);
    $mobile = mysqli_escape_string($conn, $_POST['num']);
    $adrs = mysqli_escape_string($conn, $_POST['adrs']);
    $pin = mysqli_escape_string($conn, $_POST['pin']);
    $landmark = mysqli_escape_string($conn, $_POST['landmark']);
    $category = mysqli_escape_string($conn, $_POST['category']);

    if (!empty($_FILES['img']['name'])) {
        $img = mysqli_escape_string($conn, $_FILES['img']['name']);
        $filename = $_FILES['img']['name'];
        $tempname = $_FILES['img']['tmp_name'];
        $folder = "USERIMG/" . $filename;
        move_uploaded_file($tempname, $folder);
    } else {
        $img = '';
    }

    $select = "SELECT EMAIL FROM `registration` WHERE EMAIL='$email'";
    $select_result = mysqli_query($conn, $select);

    if (mysqli_num_rows($select_result) == 0) {
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'craftshop.live@gmail.com';
            $mail->Password   = 'bwui jock bnsh oeqn';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('craftshop.live@gmail.com', 'Craft Shop');
            $mail->addAddress($email);
            $mail->addReplyTo('craftshop.live@gmail.com', 'Craft Shop Support');

            $mail->isHTML(true);
            $mail->Subject = 'Verify your Email';
            $mail->Body = "Dear $email,<br><br>
            Your One-Time Password (OTP) for Seller account verification is: $otp.<br><br>
            Please use this OTP to complete the verification process. If you did not request this OTP, please ignore this email.<br><br>
            Best regards,     <br>
            Craft Shop";
            $mail->send();

            $insert = "INSERT INTO `registration` (EMAIL, USERNAME, PASSWORD, SELLER_NAME, MOBILE, OTP, IMAGE, STREET_ADRS, LANDMARK, PIN, activation_code) 
            VALUES ('$email', '$username', '$pwd', '$seller_name', '$mobile', '$otp', '$img', '$adrs', '$landmark', '$pin', '$activation_code')";
            $insert_res = mysqli_query($conn, $insert);
            if ($insert_res) {
                header('Location: reg_otp_verify.php?code=' .$activation_code);
                exit();
            } else {
                echo "Error at Update time" . mysqli_error($conn);
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email already exists!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
    <!-- CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/906/906343.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AOS CSS and JS (Animattion On Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
    <nav>
        <div style="display: flex;">
            <div class="web_logo">
                <img src="logo_new-removebg.png" alt="" srcset="">
            </div>
        </div>
    </nav>
    <!-- REGISTER FORM -->
    <section class="register" data-aos="fade-up">
        <div class="container">
            <p class="container-header">CREATE AN ACCOUNT</p>
            <hr>
            <form method="POST">
                <div class="input_field">
                    <i class="fa fa-envelope-o"></i><input type="email" name="email" id="email" placeholder="Email" required>
                    <i class="fa fa-user-o"></i><input type="text" name="username" id="username" placeholder="User Name" required>
                </div>
                <div class="input_field">
                    <i class="fa fa-lock"></i><input type="password" name="pwd" id="pwd" placeholder="Password" required>
                    <i class="fa fa-lock"></i><input type="password" name="cpwd" id="cpwd" placeholder="Confirm Password" required>
                </div>
                <div class="profile_img">
                    <img src="https://cdn-icons-png.freepik.com/256/10302/10302971.png" alt="img_field" id="profile-pic">
                </div>
                <label for="input-file">Set Business Logo</label>
                <input type="file" accept="image/jpg, image/jpeg, image/webp, image/png" id="input-file" name="img">
                <div class="input_field">
                    <input type="text" name="seller_name" id="" placeholder="Seller Name" required>
                    <input type="tel" name="num" id="" placeholder="Business Number" required>
                </div>
                <div class="input_field">
                    <input type="text" name="category" id="" placeholder="Product Category" required>
                    <input type="text" name="adrs" id="adrs" placeholder="Address(area & Street)">
                </div>
                <div class="input_field">
                    <input type="text" name="pin" id="pin" placeholder="Pincode" minlength="6" maxlength="6">
                    <input type="text" name="landmark" id="landmark" placeholder="Landmark(optional)">
                </div>
                <input type="submit" value="Generate Otp" name="generate_otp">
            </form>
        </div>
    </section>

</body>
<script>
    AOS.init();

    // function validateForm() {
    //     var email = $('#email').val();
    //     var username = $('#username').val();
    //     var password = $('#pwd').val();
    //     var confirmPassword = $('#cpwd').val();
    //     if (email && username && password && confirmPassword && (password == confirmPassword)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    // PROFILE PICTURE SET
    let profilePic = document.getElementById("profile-pic");
    let inputFile = document.getElementById("input-file");
    inputFile.onchange = function() {
        profilePic.src = URL.createObjectURL(inputFile.files[0]);
    }
</script>

</html>
