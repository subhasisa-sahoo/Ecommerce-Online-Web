<?php
include 'db.php';
error_reporting(0);
if(!isset($_GET['code'])){
    header('Location:reg_email_verify.php');
    exit();
}
?>