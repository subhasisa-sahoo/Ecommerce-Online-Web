<?php
$admin_pro_con = mysqli_connect('localhost', 'root', '', 'craftshop_sellerdb');
$category = isset($_GET['cat']) ? $_GET['cat'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art | HandCraft</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="CSS/login_slider.css">
    <link rel="stylesheet" href="CSS/product.css">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="IMG/bg_clip4.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- Bootstrap CDN carousel
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- AOS CSS & JS (Animattion On Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="JS/aos.js"></script>
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="product_container">
        <h3 class="pro_heading"><?php echo $category; ?></h3>
        <div class="category">
            <?php
            $product_query = "SELECT * FROM `craftshop_sellerdb`.`product` WHERE category = '$category'";
            $product_result = mysqli_query($admin_pro_con, $product_query);

            if ($product_result) {
                while ($row = mysqli_fetch_assoc($product_result)) {
            ?>
                    <div class="collection">
                                <form action="manage_cart.php" method="POST">
                                    <img src="AdminPanel/PROIMG/<?php echo $row['IMAGE']; ?>" height="480" width="180" alt="">
                                    <h5><?php echo $row['category'] ?></h5>
                                    <h4><?php echo $row['product_name']; ?></h4>
                                    <p class="pro_price"><i class="fa fa-rupee"></i> <?php echo $row['price']; ?></p>
                                    <button type="submit" class="add_to_cart" name="add_to_cart" style="display: block;">
                                        <p class="shop_now" style="margin: -49px 0px 0 154px;">Add to cart</p>
                                    </button>
                                    <input type="hidden" class="pro_id" name="pro_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" class="pro_name" name="pro_name" value="<?php echo $row['product_name']; ?>">
                                    <input type="hidden" class="pro_category" name="pro_category" value="<?php echo $row['category']; ?>">
                                    <input type="hidden" class="pro_price" name="pro_price" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" class="pro_img" name="pro_img" value="<?php echo $row['IMAGE']; ?>">
                                    <input type="hidden" class="pro_seller" name="pro_seller" value="<?php echo $row['SELLER']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                </form>
                            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>
<script>
    AOS.init();
</script>

</html>