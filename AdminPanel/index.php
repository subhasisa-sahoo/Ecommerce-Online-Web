<?php
session_start();
include 'db_session.php';
$Seller =  $_SESSION['seller_name'];
// Category Count  DISTINCT gives the unique element by avoidingg duplicate element
$cat_count_query = "SELECT COUNT(DISTINCT category) AS cat_count FROM `product` WHERE SELLER = '". $Seller."'";
$cat_count_res = mysqli_query($conn, $cat_count_query);
$cat_count_row = mysqli_fetch_assoc($cat_count_res);
$cat_count = $cat_count_row['cat_count'];

// Product Count
$pro_count_query = "SELECT COUNT(DISTINCT id) AS pro_count FROM `product` WHERE SELLER = '". $Seller."'";
$pro_count_res = mysqli_query($conn, $pro_count_query);
$pro_count_row = mysqli_fetch_assoc($pro_count_res);
$pro_count = $pro_count_row['pro_count'];

// Order Count
$order_count_query = "SELECT COUNT(DISTINCT `Sl No.`) AS order_count FROM `orderd_item` WHERE SELLER = '". $Seller."'";
$order_count_res = mysqli_query($conn, $order_count_query);
$order_count_row = mysqli_fetch_assoc($order_count_res);
$order_count = $order_count_row['order_count'];

// Total Price of Seller
$price_count_query = "SELECT SUM(Price) AS total_price FROM `orderd_item` WHERE SELLER = '". $Seller."'";
$price_count_res = mysqli_query($conn, $price_count_query);
$price_count_row = mysqli_fetch_assoc($price_count_res);
$price_count = $price_count_row['total_price'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="grid-container">
        <!-- Header -->
        <header class="header">
            <div class="menu-icon">
                <span class="material-symbols-outlined" onclick="openSidebar()">menu</span>
            </div>
            <div class="header-left">

                <input type="text" id="search" placeholder="  Search...">
                <span class="material-symbols-outlined">search</span>


            </div>
            <div class="header-right">
                <span class="material-symbols-outlined">account_circle</span>
                <p><?php echo $_SESSION['username'] ?></p>
                <span class="material-symbols-outlined">notifications</span>
                <span class="material-symbols-outlined">mail</span>
            </div>

        </header>

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-symbols-outlined">shopping_cart</span>HANDICRAFT
                </div>
                <span class="material-symbols-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <span class="material-symbols-outlined">dashboard</span> <a href="" id="current-link">Dashboard</a>
                </li>
                <li class="sidebar-list-item">
                    <span class="material-symbols-outlined">inventory_2</span> <a href="product.php" id="product-link">Products</a>
                </li>
                <li class="sidebar-list-item">
                    <span class="material-symbols-outlined">category</span> <a href="categories.html">Categories</a>
                </li>
                <li class="sidebar-list-item">
                    <span class="material-symbols-outlined">list_alt</span> <a href="order.php">Order</a>
                </li>
                <li class="sidebar-list-item">
                    <span class="material-symbols-outlined">settings</span> <a href="">Settings</a>
                </li>
                <li class="sidebar-list-item">
                    <span class="material-symbols-outlined">Logout</span> <a href="logout.php">Logout</a>
                </li>
            </ul>
        </aside>

        <!--Main-->
        <main class="main-container" id="main-container">
            <div class="main-title">
                <h2>DASHBOARD</h2>
            </div>

            <div class="main-cards">

                <div class="card">
                    <div class="card-inner">
                        <h3>PRODUCT</h3>
                        <span class="material-symbols-outlined">inventory_2</span>
                    </div>
                    <h1><?php echo $pro_count; ?></h1>
                </div>


                <div class="card">
                    <div class="card-inner">
                        <h3>CATEGORY</h3>
                        <span class="material-symbols-outlined">category</span>
                    </div>
                    <h1><?php echo $cat_count; ?></</h1>
                </div>


                <div class="card">
                    <div class="card-inner">
                        <h3>ORDERS</h3>
                        <span class="material-symbols-outlined">list_alt</span>
                    </div>
                    <h1><?php echo $order_count ?></h1>
                </div>


                <div class="card">
                    <div class="card-inner">
                        <h3>COST</h3>
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <h1><?php echo $price_count; ?></h1>
                </div>
            </div>
        </main>
    </div>


    <!-- Custom JS -->

</body>

</html>