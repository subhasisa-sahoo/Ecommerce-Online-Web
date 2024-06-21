<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmaion! Checkout</title>
        <!-- Sweet alert JS-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>
<?php
include 'db_session.php';
include 'product_db.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_SESSION['shopping_cart'])){
        if(isset($_POST['confirm_check_out'])){
            $query1 = "INSERT INTO `craftshop_sellerdb`.`order_adrs`(`Pay_mode`, `EMAIL`, `Customer_name`, `MOBILE`, `STATE`, `CITY`, `STREET_ADRS`, `LANDMARK`, `PIN`,`Total`) VALUES ('COD','$_SESSION[email]','$_POST[customer_name]','$_POST[mobile]','$_POST[state]','$_POST[city]','$_POST[street_adrs]','$_POST[landmark]','$_POST[pin]',$_POST[totalPrice])";
            if(mysqli_query($conn, $query1)){
                $order_id = mysqli_insert_id($conn);
                $query2 = "INSERT INTO `craftshop_sellerdb`.`orderd_item`(`order_id`, `Product_name`, `Quantity`, `Price`, `Category`, `SELLER`,`STATUS`) VALUES (?,?,?,?,?,?,?)";
                $stmt = mysqli_prepare($conn, $query2);
                if($stmt){
                    $status = "Pending";
                    foreach($_SESSION['shopping_cart'] as $key => $value){
                    mysqli_stmt_bind_param($stmt,"isiisss",$order_id, $value['pro_name'],$value['quantity'],  $value['pro_price'], $value['pro_category'], $value['pro_seller'],$status); //i:-int, s:- string
                    mysqli_stmt_execute($stmt);
                    }
                    unset($_SESSION['shopping_cart']);
                    echo "<script>
                    Swal.fire({
                    imageUrl: 'IMG/loader.gif',
                     title: 'Order Placed Successfully',
                     text: 'Thank You. Your Order has been recieved',
                     confirmButtonColor: 'black',
                    })
                    .then(function(){
                        window.location.href = 'my_order.php';
                    });
                    </script>";
                } else{
                    echo "<script>alert('Sql query prepare error')</script>";
                }
            }else{
                echo "Connection not established";
            }
        }else{
            echo "<script>alert('Session cart not exist')</script>"; 
        }
    }
    else{
        echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Empty Cart!',
            confirmButtonColor: 'black'
        }).then(function() {
            window.location.href = 'shop.php';
        });
        </script>";        
    }
}
?>