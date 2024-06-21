<?php
ob_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'craftshop';
$conn = mysqli_connect($host, $user, $pass, $dbname);
error_reporting(0);
if (!$conn) {
    echo " " . mysqli_connect_error();
    echo "<html>";
    echo "<style>";
    echo ".img_container{";
    echo "text-align:center";
    echo "}";
    echo ".img_container img{";
    echo "height:100vh";
    echo "}";
    echo "</style>";
    echo "<div class='img_container' style='height:100vh'>";
    $img = "IMG/disconnect.webp";
    echo "<img src='$img' alt=img>";
    echo "</html>";
}
?>
<html>
<head>
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="IMG/bg_clip4.png" type="image/x-icon">
</head>
<style>
    .preloader {
        background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url(IMG/loader1.gif);
        /* background: url(../Lp2/IMG/preloader.gif); */
        height: 100vh;
        width: 100vw;
        background-position: center;
        background-size: auto;
        /* background-size: cover;
    background-position: center; */
        position: fixed;
        z-index: 100;
        background-repeat: no-repeat;
    }
</style>
<body>
    <div class="preloader"></div>
</body>
<script>
    const fadeOut = () => {
        const loader = document.querySelector(".preloader");
        loader.classList.remove("preloader");
    }
    window.addEventListener("load", fadeOut)
</script>
</html>
