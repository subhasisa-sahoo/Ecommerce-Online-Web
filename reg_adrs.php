<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Details || Registration</title>
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
if (isset($_GET['code'])) {
    $activation_code = $_GET['code'];
    $select = "SELECT EMAIL FROM `registration` WHERE activation_code = '$activation_code'";
    $select_res = mysqli_query($conn, $select);
    if (mysqli_num_rows($select_res) > 0) {
        $row = mysqli_fetch_assoc($select_res);
        if (isset($_POST['submit'])) {
            $adrs = $_POST['adrs'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $pin = $_POST['pin'];
            $landmark = $_POST['landmark'];

            $update = "UPDATE `registration` SET STATE = '$state', STREET_ADRS = '$adrs', CITY = '$city', LANDMARK = '$landmark', PIN = '$pin' WHERE activation_code = '$activation_code'";
            $update_res = mysqli_query($conn, $update);
            if ($update_res) {
                ?>
                <script>
                    Swal.fire({
                    imageUrl: 'IMG/success.gif',
                     title: 'Congratulation!  Sign up Successfull',
                     confirmButtonColor: 'black',
                    })
                    .then(function(){
                        window.location.href = 'login.php';
                    });
                    </script>
                <?php
            } else {
                echo "not updated";
            }
        } else if (isset($_POST['skip'])) {
            ?>
           <script>
                    Swal.fire({
                    imageUrl: 'IMG/success.gif',
                     title: 'Congratulation!  Sign up Successfull',
                     confirmButtonColor: 'black',
                    })
                    .then(function(){
                        window.location.href = 'login.php';
                    });
                    </script>
             <?php
        }
        else{

        }
    }
}
?>

<body>
    <section class="reg_adrs">
        <form action="#" method="POST">
            <h3 class="h3_heading">Address</h3>
            <p class="under_heading">Complete Your Profile</p>
            <div class="profile_img">
                <img src="IMG/adrs_icon.png" alt="" srcset="">
            </div>
            <div class="adrs_details">
                <div class="text">
                    <input type="text" name="adrs" id="adrs" placeholder="Address(area & Street)">
                </div>
                <select name="state" id="state">
                    <option value="1" disabled selected>Select state</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                    <option value="Daman and Diu">Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Puducherry">Puducherry</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                </select>
                <input type="text" name="city" id="city" placeholder="City">
                <div class="text">
                    <input type="number" name="pin" id="pin" placeholder="Pincode" minlength="6" maxlength="6">
                    <input type="text" name="landmark" id="landmark" placeholder="Landmark(optional)">
                </div>
            </div>
            <div class="submit-btn">
                <input type="submit" value="Skip" name="skip" class="skip-btn">
                <input type="submit" value="Save" name="submit">
            </div>
            </div>
        </form>
    </section>
</body>

</html>