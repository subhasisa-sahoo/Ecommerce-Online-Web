<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile || Registration</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="CSS/registration.css">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="IMG/bg_clip4.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- Bootstrap CDN carousel-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body {
        background-color: #fbfbff;
    }
</style>
<?php
include 'fetch_url.php';
if (isset($_GET['code'])) {
    $activation_code = $_GET['code'];
    $select = "SELECT EMAIL FROM `registration` WHERE activation_code = '$activation_code'";
    $select_res = mysqli_query($conn, $select);
    if (mysqli_num_rows($select_res) > 0) {
        $row = mysqli_fetch_assoc($select_res);
        $email = $row['EMAIL'];
        if ($_POST['profile_set']) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mobile = $_POST['mobile'];
            $img = $_FILES['img']['name'];

            // UPLOAD IMG
            $filename = $_FILES['img']['name'];
            $tempname = $_FILES['img']['tmp_name'];
            $folder = "USERIMG/" . $filename;
            move_uploaded_file($tempname, $folder);

            $update = "UPDATE `registration` SET FIRSTNAME = '$fname', LASTNAME = '$lname', MOBILE = '$mobile', IMAGE = '$img' WHERE activation_code = '$activation_code'";
            $update_res = mysqli_query($conn, $update);
            if ($update_res) {
                header('Location: reg_adrs.php?code='.$activation_code);
            } else {
                echo "<script>alert('Error Ocuur! While Updating the Data')</script>";
            }
        }
    }
}
?>
<body>
    <section class="reg_profile">
        <div class="alert alert-success" role="alert"><img src="IMG/tick_gif.webp" alt="img" style="height:30px"> OTP Verified Successfully</div>
        <form action="#" method="POST" enctype="multipart/form-data">
            <h3 class="h3_heading">Profile</h3>
            <p class="under_heading">Create your Profile</p>
            <div class="profile_img">
                <img src="IMG/profile.jpg" alt="img_field" id="profile-pic">
            </div>
            <label for="input-file">Set Profile Picture</label>
            <input type="file" accept="image/jpg, image/jpeg, image/webp, image/png" id="input-file" name="img">
            <div class="profile_details">
                <input type="text" name="fname" id="fname" placeholder="First Name" required>
                <input type="text" name="lname" id="lname" placeholder="Lirst Name" required>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>" readonly>
                <input type="tel" name="mobile" id="mobile" placeholder="Enter Mobile Number" minlength="10" required>
                <input type="submit" value="Save" name="profile_set">
            </div>
        </form>
    </section>
</body>
<script>
    let profilePic = document.getElementById("profile-pic");
    let inputFile = document.getElementById("input-file");
    inputFile.onchange = function() {
        profilePic.src = URL.createObjectURL(inputFile.files[0]);
    }
</script>

</html>