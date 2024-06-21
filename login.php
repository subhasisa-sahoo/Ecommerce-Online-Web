<?php
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="style.css">
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
    <section class="login_page">
        <div class="cancel_sign"><a href="index.php"><img src="IMG/gif2.gif" alt="" srcset=""></a></div>
        <div class="log1">
            <img src="IMG/ist1.jpeg" alt="img">
        </div>
        <div class="log2">
            <h1>Welcome Back!</h1>
            <p>Welcome back! Please enter your details</p>
            <div class="square_img">
                <img src="IMG/login_gif.gif" alt="">
            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?' . http_build_query(['redirect' => $_GET['redirect']]); ?>">
                <div class="input_space">
                    <input type="email" name="email" placeholder="Enter email here" value="demoac123@gmail.com" required><br>
                </div>
                <input type="password" name="user_pwd" placeholder="Enter Your password" value="Demo@123" required>
                <input type="submit" name="submit" value="Login">
            </form>
            <div class="register-now">
                <p>Don't have an account? <a href="reg_email_verify.php">Register now</a></p>
            </div>
        </div>
    </section>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pwd = $_POST['user_pwd'];
    $query = "SELECT * FROM `registration` WHERE EMAIL = '$email' and STATUS='active'";
    $query_result = mysqli_query($conn, $query);
    if ($query_result) {
        $result_count = mysqli_num_rows($query_result);
        if ($result_count > 0) {
            $row = mysqli_fetch_assoc($query_result);
            // Fetching hashed password
            $hashed_pwd = $row['PASSWORD'];
            if (password_verify($pwd, $hashed_pwd)) {
                // Set session variables
                $_SESSION['id'] = $row['ID'];
                $_SESSION['user_img'] = $row['IMAGE'];
                $_SESSION['email'] = $row['EMAIL'];
                $_SESSION['pwd'] = $row['PASSWORD'];
                $_SESSION['fname'] = $row['FIRSTNAME'];
                $_SESSION['lname'] = $row['LASTNAME'];
                $_SESSION['mobile'] = $row['MOBILE'];
                $_SESSION['state'] = $row['STATE'];
                $_SESSION['city'] = $row['CITY'];
                $_SESSION['street'] = $row['STREET_ADRS'];
                $_SESSION['landmark'] = $row['LANDMARK'];
                $_SESSION['pin'] = $row['PIN'];
                
                // Handle redirection after successful login
                if (isset($_GET['redirect'])) {
                    header('Location: ' . $_GET['redirect']);
                } else {
                    header('Location: user_index.php');
                }
                exit;
            } else {
                echo "<script>
                    Swal.fire({
                        imageUrl: 'IMG/login_error.gif',
                        imageHeight: 200,
                        title: 'Invalid Password',
                        text: 'Enter Correct password',
                        confirmButtonColor: 'black'
                    });
                    </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Email Id doesn\'t Exist',
                    imageUrl: 'IMG/not_exist.jpg',
                    imageHeight: 200,
                    confirmButtonColor: 'black'
                });
                </script>";
        }
    } else {
        echo "<script>
            alert('Something Error happened While Connecting');
            </script>";
    }
}
?>
