<?php
include 'db.php';
error_reporting(0);
if(!isset($_SESSION['email'])){
    header('Location:login.php');
}
?>