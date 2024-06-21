<!DOCTYPE html>
<html lang="en">
<head>
      <!-- Sweet alert JS-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
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

if(isset($_POST['generate_otp'])){
    $email = mysqli_escape_string($conn, $_POST['email']);
    $otp = $_POST['otp'];
    $activation_code= $_POST['activation_code'];

    $select = "SELECT EMAIL, STATUS FROM `registration` WHERE EMAIL='$email'";
    $select_result = mysqli_query($conn, $select);

    if(mysqli_num_rows($select_result) > 0){
        $row = mysqli_fetch_assoc($select_result);
        $status = $row['STATUS'];

        if($status != 'active'){
            try {
                $mail->isSMTP();                                           
                $mail->Host       = 'smtp.gmail.com';                    
                $mail->SMTPAuth   = true;                                  
                $mail->Username   = 'craftshop.live@gmail.com';            
                $mail->Password   = 'bwui jock bnsh oeqn';                              
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                $mail->Port       = 465;                                 
            
                //Recipients
                $mail->setFrom('craftshop.live@gmail.com', 'Craft Shop');
                $mail->addAddress($email);     //Add a recipient
                $mail->addReplyTo('craftshop.live@gmail.com', 'Craft Shop Support');
            
                //Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'Verify your Email';
                $mail->Body = "Dear $email,<br><br>
                Your One-Time Password (OTP) for account verification is: $otp <br><br>
                Please use this OTP to complete the verification process. If you did not request this OTP, please ignore this email.<br><br>
                Best regards,     <br>
                Craft Shop E-commerce";
                $mail->send();
                $update = "UPDATE `registration` SET OTP='$otp', activation_code = '$activation_code' WHERE EMAIL = '$email'";
                $update_res = mysqli_query($conn, $update);
                if($update_res){
                    header('Location: reg_otp_verify.php?code=' .$activation_code);
                }
                else{
                    echo "Error at Update time" .mysqli_error($conn);
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        else{
            echo "<script>
            Swal.fire({
            //  icon: 'warning',
            imageUrl: 'https://t3.ftcdn.net/jpg/05/83/87/88/360_F_583878813_lQ9MoaTWRBSjxourBrYYn8DNjM0xmHwA.jpg',
             title: 'Oops...',
             text: 'Enter Correct Otp!',
             iconColor: 'red',
             confirmButtonColor: 'black',
            }).then(function(){
                window.location.href='reg_email_verify.php';
            });
            </script>";
        }
    } else{
        try {
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                 
            $mail->Username   = 'craftshop.live@gmail.com';              
            $mail->Password   = 'bwui jock bnsh oeqn';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                   
        
            //Recipients
            $mail->setFrom('craftshop.live@gmail.com', 'Craft Shop');
            $mail->addAddress($email);     //Add a recipient
            $mail->addReplyTo('craftshop.live@gmail.com', 'Craft Shop Support');
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verify your Email';
            $mail->Body = "Dear $email,<br><br>
            Your One-Time Password (OTP) for account verification is: $otp.<br><br>
            Please use this OTP to complete the verification process. If you did not request this OTP, please ignore this email.<br><br>
            Best regards,     <br>
            Craft Shop";
            $mail->send();
            $insert = "INSERT INTO `registration`(EMAIL,OTP, activation_code) VALUES('$email','$otp', '$activation_code')";
            $insert_res = mysqli_query($conn, $insert);
            if($insert_res){
                header('Location: reg_otp_verify.php?code=' .$activation_code);
            }
            else{
                echo "Error at Update time" .mysqli_error($conn);
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>