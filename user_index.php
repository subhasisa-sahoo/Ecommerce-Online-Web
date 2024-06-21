<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art || HandCraft</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="CSS/product.css">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="IMG/bg_clip4.png" type="image/fav-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- Bootstrap CDN carousel-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS CSS (Animattion On Scroll) -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="JS/aos.js"></script>
    <style>
        .home_carousel {
            padding-top: 62px;
        }
        .carousel-item img {
            max-height: 400px !important; /* mean it is required or imp to execute this css in this page */
        }
    </style>
</head>
<body>
    <!-- Header Start -->
    <?php
    include 'navbar.php';
    ?>
    <!-- End -->
    <!-- carousel Start -->
    <section class="home_carousel" data-aos="fade-down">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="IMG/banner3.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="IMG/banner1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="IMG/banner2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item active">
                    <img src="IMG/banner4.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="IMG/banner5.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="IMG/banner6.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="IMG/banner7.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="IMG/banner8.jpeg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- carousel End -->
    <!-- Feature Start -->
    <section class="feature"  data-aos="flip-left">
        <div class="fea_in">
            <div class="fea_in_img">
                <img src="IMG/add_cart_icon.png" alt="cart_img">
            </div>
            <h3>Add to Cart</h3>
            <p>Lorem, ipsum dolor sit amet Lorem,casperiorete incidunt debitis.</p>
            <pre>Read More</pre>
        </div>
        <div class="fea_in">
            <div class="fea_in_img">
                <img src="IMG/pay-gif6.gif" alt="cart_img" style="margin: -6px -15px; width: 90px; height: 70px;">
            </div>
            <h3>Easy Payment</h3>
            <p>Lorem, ipsum dolor sit amet Lorem,casperiorete incidunt debitis.</p>
            <pre>Read More</pre>
        </div>
        <div class="fea_in">
            <div class="fea_in_img">
                <img src="IMG/delivery_cart_gif5.gif" alt="cart_img" style="height: 55px; margin: 0px 2px;">
            </div>
            <h3>Quick Delivery</h3>
            <p>Lorem, ipsum dolor sit amet Lorem,casperiorete incidunt debitis.</p>
            <pre>Read More</pre>
        </div>
        <div class="fea_in">
            <div class="fea_in_img">
                <img src="IMG/track_order_gif5.gif" alt="cart_img" style="height: 88px; margin: -14px -28px;">
            </div>
            <h3>Track Your Order</h3>
            <p>Lorem, ipsum dolor sit amet Lorem,casperiorete incidunt debitis.</p>
            <pre>Read More</pre>
        </div>
        <div class="fea_in">
            <div class="fea_in_img">
                <img src="IMG/help_gif4.gif" alt="cart_img">
            </div>
            <h3>24/7 Service</h3>
            <p>Lorem, ipsum dolor sit amet Lorem,casperiorete incidunt debitis.</p>
            <pre>Read More</pre>
        </div>
    </section>
    <!-- End -->
    <!-- About Us start -->
    <section class="about" data-aos="fade-right">
        <div class="about_page">
            <div class="about_left">
                <img src="IMG/about-us-.png" alt="">
            </div>
            <div class="about_in">
                <h1 class="page_heading">From Wishlist to Reality Find Your Dream Products Here!"</h1>
                <p>Say hello to stress-free shopping and hello to your dream products. Let's embark on this journey of
                    discovery
                    together – because everyone deserves to live their dreams, one purchase at a time!</p>
                <p>Welcome to Handcraft Haven! We are passionate about creating unique and beautiful handcrafted items
                    that
                    bring joy and creativity into your life.</p>
                <div class="about_rate">
                    <div>
                        <p class="highlight">1000+<br></p>
                        <div>Happy Customers+</div>
                        <p class="highlight">5.0<br></p>
                        <div>Star Rating</div>
                    </div>
                    <div>
                        <p class="highlight">100+<br></p>
                        <div>Skilled artisans</div>
                        <p class="highlight">1000+<br></p>
                        <div>Unique Product</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about_card">
            <div class="about_purpose">
                <div class="numbar"></div>
                <div class="about_para">
                    <div class="aflex">
                        <p class="highlight">01</p>
                        <h3>Art $ HandCraft</h3>
                    </div>
                    <p style="font-size: 15px;">Our team of skilled artisans carefully craft each product with love and
                        attention
                        to detail, ensuring that every piece is of the highest quality.</p>
                </div>
            </div>
            <div class="about_purpose">
                <div class="numbar"></div>
                <div class="about_para">
                    <div class="aflex">
                        <p class="highlight">02</p>
                        <h3>Art $ HandCraft</h3>
                    </div>
                    <p style="font-size: 15px;">Whether you're looking for handcrafted jewelry, home decor, or gifts for
                        loved
                        ones, we have something special for everyone.</p>
                </div>
            </div>
            <div class="about_purpose">
                <div class="numbar"></div>
                <div class="about_para">
                    <div class="aflex">
                        <p class="highlight">03</p>
                        <h3>Art $ HandCraft</h3>
                    </div>
                    <p style="font-size: 15px;">Explore our collection and discover the beauty of handmade
                        craftsmanship.</p>
                </div>
            </div>
        </div>
    </section>
    <!--End -->
    <!-- Mission Start -->
    <div class="content"  data-aos="fade-left">
        <div class="content_flex">
            <div class="content_text">
                <h3 class="page_heading">Our Misson</h3>
                <p class="content_text">Our mission at Handcraft Rural is to preserve the rich heritage of rural
                    craftsmanship,
                    empower local artisans, and promote sustainable practices. We aim to create a vibrant marketplace
                    that
                    connects artisans with customers worldwide, fostering economic growth, cultural exchange, and
                    environmental
                    stewardship. Through our dedication to tradition, empowerment, and sustainability, we strive to
                    enrich lives
                    and communities by celebrating the artistry and authenticity of handmade goods.</p>
            </div>
            <img src="IMG/bg7.jpg" alt="bg" class="content_img">
        </div>
    </div>
    <!--End -->
    <div class="madein"></div>
    <!-- Category START -->
    <section class="product">
        <h3 class="pro_heading">HANDCRAFTED IN INDIA</h1>
            <h4 class="pro_sub_heading">Top Category</h4>
            <div class="category">
                <div class="pro_cg">
                    <div class="pro_cg_place">
                        <img src="IMG/catg1_idol.avif" alt="">
                    </div>
                    <p class="pro_name">IDOL</p>
                </div>
                <div class="pro_cg">
                    <div class="pro_cg_place">
                        <img src="IMG/catg2_home_decor.png" alt="">
                    </div>
                    <p class="pro_name">Home Decor</p>
                </div>
                <div class="pro_cg">
                    <div class="pro_cg_place">
                        <img src="IMG/catg3_fashion.webp" alt="" style="padding: 0;">
                    </div>
                    <p class="pro_name">Fashion</p>
                </div>
                <div class="pro_cg">
                    <div class="pro_cg_place">
                        <img src="IMG/catg4_metal_craft.png" alt="">
                    </div>
                    <p class="pro_name">Metal craft</p>
                </div>
                <div class="pro_cg">
                    <div class="pro_cg_place">
                        <img src="IMG/cat5_jewelry.png" alt="">
                    </div>
                    <p class="pro_name">Jewelry</p>
                </div>

            </div>
    </section>
    <!--END -->
    <!-- FEATURED COLLECTIONS START -->
    <section class="fea_collection" data-aos="fade-up">
    <h3 class="pro_heading">FEATURED COLLECTIONS</h3>
    <?php
  include 'product_db.php';
  $category_query = "SELECT DISTINCT category FROM `craftshop_sellerdb`.`product`";
  $category_result = mysqli_query($admin_pro_con, $category_query);

  if ($category_result) {
      while ($category_row = mysqli_fetch_assoc($category_result)) {
          $category = $category_row['category'];
  ?>
          <div class="product_container">
              <h3 class="pro_heading" data-aos="zoom-in-up"><?php echo $category; ?></h3>
              <div class="category" data-aos="fade-up">
                  <?php
                  $product_query = "SELECT * FROM `craftshop_sellerdb`.`product` WHERE category = '$category' LIMIT 4";
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
              <button id="load-btn" data-aos="fade-up"><a href="cat_product.php?cat=<?php echo $category ?>">Load More</a><i class="fa fa-arrow-right"></i></button>
          </div>
  <?php
      }
  }
  ?>
  </section>
    <!--END -->
    <!-- Footer start -->
    <?php
    include 'footer.php';
    ?>
    <!-- Footer End -->
</body>

</html>
<script>
    AOS.init();
</script>