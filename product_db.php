<?php
$admin_pro_con = mysqli_connect('localhost', 'root', '', 'craftshop_sellerdb');  //ADMIN & PRODUCT DB
if(!$admin_pro_con){
    echo "<script>alert('Product not fetched due to databse error')</script>";
}
?>