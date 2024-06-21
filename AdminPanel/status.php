<?php
session_start();
include 'db_session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['click_view_btn'])){
        if (isset($_POST['order_id']) && isset($_POST['new_status'])) {
            $order_id = $_POST['order_id'];
            $status = $_POST['new_status'];
            echo $order_id;
            echo $status;
            $update_query = "UPDATE `orderd_item` SET STATUS = '$status' WHERE order_id = '$order_id'";
    
            if (mysqli_query($conn, $update_query)) {
                echo "success";
            } else {
                echo "error";
            }
        }
    }
}
?>