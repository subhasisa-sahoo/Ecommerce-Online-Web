<?php
include 'db_session.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>NavBar</title> -->
  <!-- CSS LINK -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="CSS/navbar.css">
  <!-- Fav Icon -->
  <link rel="shortcut icon" href="IMG/bg_clip4.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <!-- Bootstrap CDN Couresol-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Ajax CDN -->
  <script src="JS/ajaxquery.js"></script>
  <!-- Sweet alert JS-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <!-- Header Start -->
  <header>
    <section class="main_nav">
        <div class="logo">
            <img src="IMG/logo1-remov.png" alt="logo">
        </div>
        <div class="search_bar">
            <form>
                <input type="search" name="search" id="search" placeholder="Search for products, brands and more">
                <input type="submit" value="Search">
            </form>
        </div>
        <ul>
            <div class="menu">
                <li class="user_icon"><i class="fa fa-folder-open-o"></i>Menu<i class="fa fa-angle-down"></i>
                    <div class="sub_menu">
                        <ul>
                            <li><a href="user_index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="shop.php">Shop</a></li>
                            <!-- <li><a href="#">Event</a></li>
                            <li><a href="#">Help</a></li> -->
                            <li data-bs-toggle="modal" data-bs-target="#exampleModal"><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </li>
            </div>
        </ul>
        <div class="list_icon">
            <ul>
                <li class="user_icon" id="user_name_upper"></i><?php echo "<img src='USERIMG/".$_SESSION['user_img']."'/>". $_SESSION['fname']; ?><i class="fa fa-angle-down"></i>
                <div class="sub_menu">
                  <ul>
                    <li class="user_icon"><a href="profile.php"><i class="fa fa-user-o"></i> My Profile</a></li>
                    <li class="user_icon"><a href="my_cart.php"><img src="IMG/bag_icon.png" alt=""> Cart</a></li>
                    <!-- <li class="user_icon"><a href="#"><i class="fa fa-heart-o"></i> Wishlist</a></li> -->
                    <li class="user_icon"><a href="my_order.php"><img src="IMG/order_icon.svg" alt=""></i> Order</a></li>
                    <!-- <li class="user_icon"><a href="#"><img src="IMG/status_icon.png" alt=""> Track Status</a></li> -->
                    <li class="user_icon"><a href="logout.php"><img src="IMG/logout_icon.svg" alt=""> Logout</a></li>
                  </ul>
                </div></li>
                <?php
                $count = 0;
                if(isset($_SESSION['shopping_cart'])){
                    $count = count($_SESSION['shopping_cart']);
                }
                ?>
                <li class="user_icon"><a href="#"><i class="fa fa-heart-o" style="font-size: 21px;"></i></a></li><div class="sq_val"><div class="sq_val_num">0</div></div>
                <li class="user_icon"><a href="my_cart.php"><img src="IMG/bag_icon.png" alt="" style="height: 23px;"></a></li><div class="sq_val"><div class="sq_val_num"><?php echo $count; ?></div></div>
                <li class="user_icon"><a href="#"><img src="https://cdn-icons-png.flaticon.com/512/69/69890.png" alt="" style="height: 23px;"></a></li>
            </ul>
        </div>
    </section>
    <div id="results"></div>
</header>
<!-- END -->
</body>
<!-- MODAL -->
<form method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <input type="hidden" name="email" value="<?php echo $_SESSION['email'] ?>">
            <label for="recipient-name" class="col-form-label">Subject:</label>
            <input type="text" class="form-control" id="" name="subject">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="msg"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="msg_submit" class="btn btn-warning" value="Send message">
      </div>
    </div>
  </div>
</div>
</form>
</html>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: { query: query },
                    success: function(data) {
                        $('#results').html(data);
                    },
                    error: function() {
                        $('#results').html('An error occurred');
                    }
                });
            } else {
                $('#results').empty();
            }
        });
    });
</script>
<?php
if(isset($_POST['msg_submit'])){
    $sqlQ = "INSERT INTO `contact` (`Email`, `Subject`, `msg`) VALUES ('" . $_POST['email'] . "', '" . $_POST['subject'] . "', '" . $_POST['msg'] . "')";
    if(mysqli_query($conn,$sqlQ)){
        echo "<script>swal.fire({
            icon: 'success',
            title: 'Message sent Succesfully',
            confirmButtonColor: 'black'
        })</script>";
    }else{
        echo "error";
    }
}
?>
