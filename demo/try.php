<?php
include '../db_session.php';
if(isset($_POST['submit'])){
    $msg = $_POST['msg'];
    $notify = "Your Password was Updated on ";

    $query = "INSERT INTO `notification` (EMAIL, NOTIFICATION) VALUES ('{$_SESSION['email']}', '$notify')";
    $query_res = mysqli_query($conn, $query);
    if($query_res){
        echo "success";
    }
    else{
        echo "fail";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
    <label for="">Message:</label>
    <input type="text" name="msg" id="">
    <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>