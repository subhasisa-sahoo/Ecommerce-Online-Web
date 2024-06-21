<?php
include 'db.php';
error_reporting(0);
if(!isset($_GET['code'])){
    header('Location:seller_portal.html');
    exit();
}
?>