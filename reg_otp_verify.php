<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email OTP Verification || Registration</title>
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
<?php
include 'fetch_url.php';
if(isset($_GET['code'])){
    $activation_code = $_GET['code'];
    $select = "SELECT EMAIL, OTP FROM `registration` WHERE activation_code = '$activation_code'";
    $select_res = mysqli_query($conn, $select);
    if (mysqli_num_rows($select_res) > 0) {
        $row = mysqli_fetch_assoc($select_res);
        $stored_otp = $row['OTP'];
        $email = $row['EMAIL'];

        if (isset($_POST['otp_verify'])) {
            $user_otp = $_POST['otp'];
                if($user_otp == $stored_otp){
                        header('Location: reg_pwd.php?code='.$activation_code);
                }else{
                    echo "<script>
                    Swal.fire({
                    //  icon: 'warning',
                    imageUrl: 'https://t3.ftcdn.net/jpg/05/83/87/88/360_F_583878813_lQ9MoaTWRBSjxourBrYYn8DNjM0xmHwA.jpg',
                     title: 'Oops...',
                     text: 'Enter Correct Otp!',
                     iconColor: 'red',
                     confirmButtonColor: 'black',
                    });
                    </script>";
                }
            }
    }
}
?>
<body>
    <section class="otp_verify">
        <div class="log1">
            <img src="IMG/reg2.jpg" alt="">
        </div>
        <div class="log2">
            <h1>Verify OTP</h1>
            <p class="msg-box"><?php echo "An Otp has been Sent to ". $email ?></p>
            <div class="square_img">
                <img src="IMG/secure_icon.png" alt="" srcset="">
            </div>
            <form action="#" method="POST">
                <input type="number" name="otp" placeholder="Enter Otp sent to the mail" maxlength="6"><br>
                <input type="submit" value="Verify" name="otp_verify">
            </form>
            <!-- <form action="#" method="POST">
                <div class="otp_num">
                    <input type="number" name="otp" class="otpField" minlength="1"><br>
                    <input type="number" name="otp" class="otpField" minlength="1"><br>
                    <input type="number" name="otp" class="otpField" minlength="1"><br>
                    <input type="number" name="otp" class="otpField" minlength="1"><br>
                    <input type="number" name="otp" class="otpField" minlength="1"><br>
                    <input type="number" name="otp" class="otpField" minlength="1"><br>
                </div>
                <input type="submit" value="Verify" name="otp_verify" id="otpForm">
            </form>
        </div>
    </section>

    <script>
        const otpFields = document.querySelectorAll('.otpField');
        otpFields.forEach((field, index) => {
            field.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    if (index < otpFields.length - 1) {
                        otpFields[index + 1].focus();
                    } else {
                        document.getElementById('otpForm').submit();
                    }
                }
            });
        });
    </script> -->
        </div>
    </section>
</body>

</html>
