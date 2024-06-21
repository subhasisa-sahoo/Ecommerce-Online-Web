<?php
ob_start(); //user for output buffering
include '../db_session.php';
ob_clean(); // here it cleans all the output of the previous all line
$oldPwd = $_POST['oldPwd'];
$newPwd = $_POST['newPwd'];
$conPwd = $_POST['conPwd'];
$hashing_pwd = password_hash($newPwd, PASSWORD_BCRYPT);
$query = "SELECT PASSWORD FROM `registration` WHERE EMAIL = '" . $_SESSION['email'] . "'";
$query_res = mysqli_query($conn, $query);
if ($query_res) {
    $res_count = mysqli_num_rows($query_res);
    if ($res_count > 0) {
        $row = mysqli_fetch_assoc($query_res);
        $stored_pwd = $row['PASSWORD'];
        if (password_verify($oldPwd, $stored_pwd)) {
            if ($newPwd == $conPwd) {
                $update = "UPDATE `registration` SET PASSWORD = '$hashing_pwd' WHERE EMAIL = '" . $_SESSION['email'] . "'";
                $update_res = mysqli_query($conn, $update);
                if ($update_res) {
                    $notify = "Your Password was Updated on ";
                    $query = "INSERT INTO `notification` (EMAIL, NOTIFICATION) VALUES ('{$_SESSION['email']}', '$notify')";
                    $query_res = mysqli_query($conn, $query);
                    echo "success";
                } else {
                    echo "fail";
                }
            } else {
                echo "new password and confirm password must be same";
            }
        } else {
            echo "current password mismatch";
        }
    }
}
$output = ob_get_clean();
echo $output;
