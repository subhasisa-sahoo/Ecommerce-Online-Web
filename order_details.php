<?php
ob_start(); //user for output buffering
include 'db_session.php';   //USER DB
ob_clean(); // here it cleans all the output of the previous all line
include 'product_db.php';
if(isset($_POST['click_view_btn'])){
    $id = $_POST['order_id'];
    $user_dfetch = "SELECT * FROM `craftshop_sellerdb`.`order_adrs` WHERE Order_id = $id";
    $user_qres = mysqli_query($admin_pro_con, $user_dfetch);
    while ($user_row = mysqli_fetch_assoc($user_qres)) {
        $Order_id =  $user_row['Order_id'];

        $order_dfetch = "SELECT * FROM `craftshop_sellerdb`.`orderd_item` WHERE order_id = $id";
        $order_qres = mysqli_query($admin_pro_con, $order_dfetch);
        while ($order_row = mysqli_fetch_assoc($order_qres)) {
            $address =  $user_row['STREET_ADRS'] . "<br>" .
            $user_row['LANDMARK'] . "<br>" .
            $user_row['CITY'] . "<br>" .
            $user_row['PIN'] . "<br>" .
            $user_row['STATE'];
        echo "<span class='text-primary'>Order ID:</span>$order_row[order_id]<br>
            <span class='text-primary'>Customer Name:</span> $user_row[Customer_name]<br>
            <span class='text-primary'>Order Name:</span> $order_row[Product_name]<br>
            <span class='text-primary'>Quantity:</span> $order_row[Quantity]<br>
            <span class='text-primary'>Payment Mode:</span> $user_row[Pay_mode]<br>
            <span class='text-primary'>Status:</span> $order_row[STATUS]<br>
            <span class='text-primary'>Shipping Address:</span> $address<br>
            <span class='text-primary'>Mobile:</span> $user_row[MOBILE]<br><hr>";
        }
    }
} else {
    echo "No Data Found!";
}
$output = ob_get_clean();
echo $output;
?>
<style>
    span{
        font-size: 15px;
    }
</style>