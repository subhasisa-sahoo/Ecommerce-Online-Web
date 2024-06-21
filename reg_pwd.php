<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Password || Registration</title>
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
    <!-- AJAX_QUERY JS -->
    <script src="JS/ajaxquery.js"></script>

</head>
<?php
include 'fetch_url.php';
if (isset($_POST['create_pwd']) && $_GET['code']) {
    $activation_code = $_GET['code'];
    $pwd = $_POST['pwd'];
    $con_pwd = $_POST['con_pwd'];

    // Password Hasing or Bycrypting
    $hashing_pwd  = password_hash($_POST['pwd'], PASSWORD_BCRYPT);

    if ($pwd == $con_pwd) {
        $update = "UPDATE `registration` SET PASSWORD = '$hashing_pwd', STATUS = 'active' WHERE activation_code = '$activation_code'";
        $update_res = mysqli_query($conn, $update);
        if ($update_res) {
            header('Location: reg_profile.php?code=' . $activation_code);
        } else {
            echo "Error While redirecting You to the next page";
        }
    } else {
        echo "<script>
        Swal.fire({
         icon: 'warning',
         title: 'Oops...',
         text: 'Password must be Same with Confirm Password',
         iconColor: 'red',
         confirmButtonColor: 'black',
        });
        </script>";
    }
}
?>

<body>
    <section class="create_pwd">
        <div class="log1">
            <img src="https://cdn.dribbble.com/users/530884/screenshots/2425883/password-drbl.gif" alt="">
        </div>
        <div class="log2">
            <h1>Create New Password</h1>
            <div class="square_img">
                <img src="IMG/pwd_icon.png" alt="" srcset="">
            </div>
            <form action="#" method="POST">
                <input type="password" name="pwd" id="pwd_field" placeholder="Password">
                <div class="pwd_validation">
                    <ul>
                        <li class="upperCase"><span></span>One UpperCase Letter</li>
                        <li class="lowerCase"><span></span>One LowerCase Letter</li>
                        <li class="digit"><span></span>One digit</li>
                        <li class="symbol"><span></span>One Special Character</li>
                        <li class="length"><span></span>Atleast 8 Character</li>
                    </ul>
                </div>
                <input type="password" name="con_pwd" id="con_pwd" placeholder="Confirm Password">
                <input type="submit" value="submit" name="create_pwd">
            </form>
        </div>
    </section>

</body>
<script src="JS/validation.js"></script>

</html>