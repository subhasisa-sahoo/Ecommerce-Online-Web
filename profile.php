<?php
// header("refresh:2");
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="CSS/profile.css">
    <link rel="stylesheet" href="CSS/registration.css">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="IMG/bg_clip4.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- AOS CSS (Animattion On Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AJAX QUERY -->
    <script src="JS/ajaxquery.js"></script>
</head>

<body>
    <div class="profile_panel">
        <section class="sidebar">
            <ul class="profile-option-btn">
                <p> USER ID: #<?php echo $_SESSION['id']; ?></p>
                <hr>
                <li id="user-details-btn" onclick="showOption('user-details')" data-category="user-details"><i class="fa fa-user-o"></i>My Profile</li>
                <li id="adrs-btn" onclick="showOption('adrs')" data-category="adrs"><img src="IMG/adrs.svg" style="height: 20px;">Address</li>
                <li id="pwd-btn" onclick="showOption('change-pwd')" data-category="change-pwd"><img src="IMG/change-password.png" style="height: 20px;">Change Passsword</li>
                <li id="myorder-btn" onclick="showOption('myorder')" data-category="myorder"><img src="IMG/order_icon.svg"> My Order</li>
                <li id="wishlist-btn" onclick="showOption('wishlist')" data-category="wishlist"><i class="fa fa-heart-o"></i>WishList</li>
                <li id="notification-btn" onclick="showOption('notification')" data-category="notification"><img src="IMG/notification_icon.png" alt="" srcset="" style="height:20px">Notification</li>
                <li id="coupon-btn" onclick="showOption('coupon')" data-category="coupon"><img src="IMG/reward_icon.webp" style="height: 20px;">coupons & Reward</li>
                <li id="delete-btn" onclick="showOption('delete')" data-category="delete"><img src="IMG/delete_icon.png" alt="" srcset="" style="height: 20px;">Delete Account</li>
                <li id="logout-btn" class="logout"><img src="IMG/logout_icon.svg" alt="logout"> LogOut</li>
            </ul>
        </section>
        <section class="container">
            <div id="user-details-container" class="profile-container">
                <p class="container-header"><i class="fa fa-user-o"></i>Personal Information</p>
                <section class="user-details-profile">
                    <div class="profile_img">
                        <img src="USERIMG/<?php echo $_SESSION['user_img']; ?>" alt="img_field" id="profile-pic">
                    </div>
                    <div class="profile_details">
                        <div class="flname-flex">
                            <div>
                                <label>First Name</label><br>
                                <input type="text" name="fname" id="fname" value="<?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?>" readonly>
                            </div>
                            <div>
                                <label>Last Name</label><br>
                                <input type="text" name="lname" id="lname" value="<?php echo $_SESSION['lname']; ?>" readonly>
                            </div>
                        </div>
                        <label>Email ID</label><br>
                        <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" readonly><br>
                        <label>Mobile Number</label><br>
                        <input type="tel" name="mobile" id="mobile" value="<?php echo $_SESSION['mobile']; ?>" minlength="10" readonly>
                    </div>
                </section>
            </div>
            <div id="adrs-container" class="profile-container">
                <p class="container-header"><img src="IMG/adrs_icon.webp">Address Information</p>
                <section class="adrs-container">
                    <div class="adrs_details">
                        <label>Area & Street</label><br>
                        <input type="text" value="<?php echo $_SESSION['street']; ?>" readonly><br>
                        <label>Landmark</label><br>
                        <input type="text" value="<?php echo $_SESSION['landmark']; ?>" readonly><br>
                        <label>PinCode</label><br>
                        <input type="text" value="<?php echo $_SESSION['pin']; ?>" readonly><br>
                        <label>City</label><br>
                        <input type="text" value="<?php echo $_SESSION['city']; ?>" readonly><br>
                        <label>State</label><br>
                        <input type="text" value="<?php echo $_SESSION['state']; ?>" readonly><br>
                    </div>

                </section>
            </div>
            <div id="change-pwd-container" class="profile-container">
                <p class="container-header"><img src="IMG/change-password.png">Change Password</p>
                <section class="pwd-container">
                    <form id="password-form">
                        <label>Old Password</label><br>
                        <input type="password" name="oldPwd" id="oldPwd"><br>
                        <label>New Password</label><br>
                        <input type="password" name="newPwd" id="newPwd_field"><br>
                        <div class="pwd_validation">
                            <ul>
                                <li class="upperCase"><span></span>One UpperCase Letter</li>
                                <li class="lowerCase"><span></span>One LowerCase Letter</li>
                                <li class="digit"><span></span>One digit</li>
                                <li class="symbol"><span></span>One Special Character</li>
                                <li class="length"><span></span>Atleast 8 Character</li>
                            </ul>
                        </div>
                        <label>Confirm Password</label><br>
                        <input type="password" name="conPwd" id="conPwd_field"><br>
                        <li id="matchError" style="list-style: none;"></li>
                        <li id="result_response" style="list-style: none; color:red"></li>
                        <button type="button" id="update-pwd">Submit</button>
                    </form>
                </section>
            </div>

            <div id="myorder-container" class="profile-container">
                <p class="container-header"><img src="IMG/adrs_icon.webp">My Order</p>
                <section class="myorder-container">
                    <?php
                include 'product_db.php';
    ?>
    <section class="my_order_container">
        <h1 class="bg-light h1_header">MY ORDER</h1>
        <div class="col-lg-9">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Pay Mode</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_dfetch = "SELECT EMAIL, Order_id,Pay_mode FROM `craftshop_sellerdb`.`order_adrs` WHERE EMAIL = '$_SESSION[email]' ORDER BY `Order_id` DESC";
                    $user_qres = mysqli_query($admin_pro_con, $user_dfetch);
                    while ($user_row = mysqli_fetch_assoc($user_qres)) {
                        $Order_id =  $user_row['Order_id'];

                        $order_dfetch = "SELECT * FROM `craftshop_sellerdb`.`orderd_item` WHERE order_id = $Order_id";
                        $order_qres = mysqli_query($admin_pro_con, $order_dfetch);
                        while ($order_row = mysqli_fetch_assoc($order_qres)) {
                            $tQPrice = $order_row['Price'] * $order_row['Quantity'];  //Qunatity wise price
                            echo "<tr>
                                    <td>#{$order_row['order_id']}</td>
                                    <td>{$order_row['Product_name']}</td>
                                    <td>{$order_row['Quantity']}</td>
                                    <td>{$user_row['Pay_mode']}</td>
                                    <td>$tQPrice</td>
                                    <td class='getStatusClass($order_row[STATUS])'>$order_row[STATUS]</td>"
                                    ?>
                                    <?php
                                 "</tr>";
                        }
                    }
                   
                    ?>
                </tbody>
            </table>
        </div>
    </section>

                </section>
            </div>
            <div id="wishlist-container" class="profile-container">
                <p class="container-header"><i class="fa fa-heart-o"></i>Wishlist</p>
                <section class="wishlist-container">
                    <img src="IMG/empty_wishlist.png" style="height: 50vh;">
                    <div class="html-msg">
                        <p>No Item added to Wishlist</p>
                        <pre>You'll be notified when there is something new</pre>
                    </div>
                </section>
            </div>
            <div id="notification-container" class="profile-container">
                <p class="container-header"><img src="IMG/notification_icon.png" style="height: 25px">Notification</p>
                <section class="notification-container">
                    <?php
                    $notif_fetch = "SELECT * FROM notification WHERE EMAIL = '" . $_SESSION['email'] . "' ORDER BY TIME DESC";
                    $notif_res = mysqli_query($conn, $notif_fetch);

                    if ($notif_res) {
                        if (mysqli_num_rows($notif_res) > 0) {
                            echo "<div class='notif_li'>";
                            echo "<ul>";
                            while ($row = mysqli_fetch_assoc($notif_res)) {
                                $time = $row['TIME'];
                                $date = new DateTime($time);
                                $time_format = $date->format("j F,Y, g:i a");
                                // j = Day of the Month
                                // F = full name of month
                                // Y = year
                                // i = minute
                                echo "<li>" . $row['NOTIFICATION'] . " - " . $time_format . "</li>";
                            }
                            echo "</ul>";
                            echo "</div>";
                        } else {
                    ?>
                            <img src="IMG/notification1.webp" alt="" srcset="">
                            <div class="html-msg">
                                <p>NO NOTIFICATION</p>
                                <pre>You'll be notified when there is something new</pre>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </section>

            </div>
            <div id="coupon-container" class="profile-container">
                <p class="container-header"><img src="IMG/reward_icon.webp">Coupons & Rewards</p>
                <section class="coupon-container">
                    <!-- <img src="https://cdn-icons-png.freepik.com/512/6713/6713699.png" style="height:60vh;"> -->
                    <img src="IMG/reward.webp" style="height:60vh;">
                    <div class="html-msg">
                        <p>NO Coupons & Rewards avialable till now</p>
                        <pre>Continue Purchasing to get best Offer</pre>
                    </div>
                </section>
            </div>
            <div id="delete-container" class="profile-container">
                <p class="container-header"><img src="IMG/delete_icon.png">Deactivate Account</p>
                <section class="deactivate-container">
                    <img src="IMG/deleted.png">
                    <button id="deactivate-btn">Deactivate</button>
                </section>
            </div>
        </section>
    </div>

    <!-- <?php
            include 'footer.php';
            ?>  -->
</body>
<script src="JS/profile.js"></script>
<script src="JS/validation.js"></script>

</html>