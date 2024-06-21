<?php
include 'db_session.php';   //USER DB
include 'product_db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_to_cart'])) {
        if (isset($_SESSION['shopping_cart'])) {  //By default first time no shopping cart is there so we have to create cart at else part and initalize 
            $cartItems = array_column($_SESSION['shopping_cart'], 'pro_id'); // array_column: here all the product id will be stored once added to cart
            if (in_array($_POST['pro_id'], $cartItems)) { //in_array:- it will check the specified value with in the array
                echo "<script>alert('Item already added to cart');
                window.location.href='shop.php';
                </script>";
            } else {
                $count = count($_SESSION['shopping_cart']);
                $_SESSION['shopping_cart'][$count] = array(
                    'pro_id' => $_POST['pro_id'],
                    'pro_name' => $_POST['pro_name'],
                    'pro_category' => $_POST['pro_category'],
                    'pro_price' => $_POST['pro_price'],
                    'quantity' => $_POST['quantity'],
                    'pro_img' => $_POST['pro_img'],
                    'pro_seller' => $_POST['pro_seller']
                );
                header('Location: shop.php');
            }
        } else {
            $_SESSION['shopping_cart'][0] =
                array(
                    'pro_id' => $_POST['pro_id'],
                    'pro_name' => $_POST['pro_name'],
                    'pro_category' => $_POST['pro_category'],
                    'pro_price' => $_POST['pro_price'],
                    'quantity' => $_POST['quantity'],
                    'pro_img' => $_POST['pro_img'],
                    'pro_seller' => $_POST['pro_seller']
                );
            header('Location: shop.php');
        }
    }
    if (isset($_POST['Remove-pro'])) {
        foreach ($_SESSION['shopping_cart'] as $key => $value) {  //$key gives the whole array but $value gives the index position
            if ($value['pro_name'] == $_POST['pro_name']) {
                unset($_SESSION['shopping_cart'][$key]);
                $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']); //after one index deleted then it will rearrenge the array supoose 012 1 index deleted then again it is rearrenge to 01
                echo "<script>
                window.location.href='my_cart.php';</script>";
            }
        }
    }
    if (isset($_POST['iquantity'])) {
        foreach ($_SESSION['shopping_cart'] as $key => $value) { 
            if ($value['pro_name'] == $_POST['pro_name']) {
                $_SESSION['shopping_cart'][$key]['quantity'] = $_POST['iquantity']; 
                echo "<script>window.location.href='my_cart.php';</script>"; 
            }
        }
    }
    
}?>
