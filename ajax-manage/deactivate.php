<?php
include '../db.php';
session_start();

if(!isset($_SESSION['email'])){
    echo 0;
    exit;
}

$email = $_SESSION['email'];
$deactivate = "DELETE FROM `registration` WHERE EMAIL = '$email'";
$deact_query = mysqli_query($conn, $deactivate);

if($deact_query){
    echo 1;
} else {
    echo 0;
}
mysqli_close($conn);
?>
