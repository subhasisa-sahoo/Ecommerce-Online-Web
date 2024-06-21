<?php
include 'db.php';
// Load configuration
$config = require 'config.php';

// OTP GENERATOR
$otp_str = str_shuffle("0123456789");
$otp = substr($otp_str, 0, 5);
// ACTIVATION CODE GENERATOR
$act_str= rand(100000, 10000000000);
$activation_code = str_shuffle("abcdeghijkl".$act_str);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification || Registration</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="CSS/registration.css">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="IMG/bg_clip4.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <section class="email_verify">
        <div class="log1">
            <img src="IMG/reg1.jpg" alt="">
        </div>
        <div class="log2">
            <h1>Email Verification</h1>
            <div class="square_img">
                <img src="IMG/document-mail.png" alt="" srcset="">
            </div>
            <form method="POST">
                <input type="hidden" name="otp" value="<?php echo $otp; ?>">
                <input type="hidden" name="activation_code" value="<?php echo $activation_code; ?>">
                <input type="email" name="email" placeholder="Enter Your Email">
                <input type="submit" value="Generate OTP" name="generate_otp">
            </form>
        </div>
    </section>
</body>
</html>
<?php
include 'db.php';
// Email send Part
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/src/DSNConfigurator.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if (isset($_POST['generate_otp'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $otp = $_POST['otp'];
    $activation_code = $_POST['activation_code'];

    $select = "SELECT EMAIL, STATUS FROM `registration` WHERE EMAIL='$email'";
    $select_result = mysqli_query($conn, $select);

    if (mysqli_num_rows($select_result) > 0) {
        $row = mysqli_fetch_assoc($select_result);
        $status = $row['STATUS'];

        if ($status != 'active') {
            try {
                $mail->isSMTP();
                $mail->Host = $config['smtp_host'];
                $mail->SMTPAuth = true;
                $mail->Username = $config['smtp_username'];
                $mail->Password = $config['smtp_password'];
                $mail->SMTPSecure = $config['smtp_secure'];
                $mail->Port = $config['smtp_port'];

                //Recipients
                $mail->setFrom($config['smtp_username'], 'Craft Shop');
                $mail->addAddress($email);
                $mail->addReplyTo($config['smtp_username'], 'Craft Shop Support');

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Verify your Email';
                $mail->Body = "Dear $email,<br><br>
                Your One-Time Password (OTP) for account verification is: $otp <br><br>
                Please use this OTP to complete the verification process. If you did not request this OTP, please ignore this email.<br><br>
                Best regards,     <br>
                Craft Shop E-commerce";
                $mail->send();
                $update = "UPDATE `registration` SET OTP='$otp', activation_code='$activation_code' WHERE EMAIL='$email'";
                $update_res = mysqli_query($conn, $update);
                if ($update_res) {
                    header('Location: reg_otp_verify.php?code=' . $activation_code);
                } else {
                    echo "Error at Update time" . mysqli_error($conn);
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>
            Swal.fire({
            imageUrl: 'IMG/mail gif.gif',
             title: 'Active Email ID',
             text: 'Email is already exist in our database',
             iconColor: 'red',
             confirmButtonColor: 'black',
            }).then(function(){
                window.location.href='reg_email_verify.php';
            });
            </script>";
        }
    } else {
        try {
            $mail->isSMTP();
            $mail->Host = $config['smtp_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['smtp_username'];
            $mail->Password = $config['smtp_password'];
            $mail->SMTPSecure = $config['smtp_secure'];
            $mail->Port = $config['smtp_port'];

            //Recipients
            $mail->setFrom($config['smtp_username'], 'Craft Shop');
            $mail->addAddress($email);
            $mail->addReplyTo($config['smtp_username'], 'Craft Shop Support');

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Verify your Email';
            $mail->Body = "Dear $email,<br><br>
            Your One-Time Password (OTP) for account verification is: $otp.<br><br>
            Please use this OTP to complete the verification process. If you did not request this OTP, please ignore this email.<br><br>
            Best regards,     <br>
            Craft Shop";
            $mail->send();
            $insert = "INSERT INTO `registration`(EMAIL,OTP, activation_code) VALUES('$email','$otp', '$activation_code')";
            $insert_res = mysqli_query($conn, $insert);
            if ($insert_res) {
                header('Location: reg_otp_verify.php?code=' . $activation_code);
            } else {
                echo "Error at Update time" . mysqli_error($conn);
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
