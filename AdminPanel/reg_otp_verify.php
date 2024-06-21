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
                        header('Location:login.php');
                        exit(); // Ensure script stops execution after redirection
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
    }else{
        echo "otp not found";
    }
}else{
    echo "URL not found";
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
</head>

<body>
    <div id="otp-show" class="input_field">
        <p class="msg-box"><?php echo "An OTP has been Sent to " . $email ?></p>
        <form method="POST">
            <input type="number" name="otp" placeholder="Enter OTP sent to the mail" maxlength="6"><br>
            <input type="submit" value="Verify" name="otp_verify">
        </form>
    </div>
</body>

</html>
