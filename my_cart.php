<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart || Art | HandCraft</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="CSS/product.css"> -->
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="IMG/bg_clip4.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- Bootstrap CDN carousel-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- AOS CSS & JS (Animattion On Scroll) -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="JS/aos.js"></script> -->
    <!-- AJAX JQUERY -->
    <script src="JS/ajaxquery.js"></script>
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    /* * {
        text-align: center;
    } */

    .h1_header {
        margin: 5% 20% 2% 20%;
        padding: 5px;
        border-radius: 2px;
        background-color: #e9ecef;
        text-align: center;
    }

    .place_order_btn {
        margin-top: 20px;
        margin-left: 0px;
        width: 100%;
    }

    table,
    input[type="number"] {
        text-align: center;
    }

    .cart_img img {
        height: 31px;
    }

    #empty_cart {
        margin-left: 9%;
    }

    .order_adrs {
        padding: 0;
        margin: 0;
    }

    #empty_cart,
    #place_order {
        display: none;
    }

    .input-group-text {
        width: 100px;
    }

    .input-group {
        margin-right: 10px;
    }

    .modal #shipping-adrs input:focus {
        outline: #e9ecef;
    }

    .form-control:focus {
        border-color: var(--maincolor) !important;
        box-shadow: none !important;
    }
</style>

<body>
    <?php
    include 'navbar.php';
    ?>
    <h1 class="bg-light h1_header">MY CART</h1>
    <div class="alert alert-warning col-lg-8" role="alert" id="empty_cart">
        Empty Cart! <a href="shop.php">Add Item</a> to Proceed Further
    </div>
    <div style="display: flex;">
        <div class="col-lg-8" style="margin-left:8%"> <!--total=12 ; column-largedevice-8outof 12 col or half of thr gorizontal row-->
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">IMAGE</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    if (isset($_SESSION['shopping_cart'])) {
                        foreach ($_SESSION['shopping_cart'] as $key => $value) {  //foreach is used for travesing or loops itrates of array
                            $serial = $key + 1;
                            $total += $value['pro_price'];
                            echo "<tr>
                    <th>$serial</th>
                    <td class='cart_img'><img src='AdminPanel/PROIMG/$value[pro_img]'></td>
                    <td>$value[pro_name]</td>
                    <td>$value[pro_category]</td>  
                    <td>$value[pro_price] <input type='hidden' class='iprice' name='iprice' value='$value[pro_price]' ></td> 
                    <form action='manage_cart.php' method='POST'>
                    <td><input type='number' class='iquantity' name='iquantity' value='$value[quantity]' min='1' max='10' onchange='this.form.submit();'></td>
                    <input type='hidden' name='pro_name' value= '$value[pro_name]'>
                    </form>
                    <td class='itotal'></td>
                    <td>
                    <form action='manage_cart.php' method='POST'>
                    <button class='btn btn-sm btn-outline-danger' name='Remove-pro'>Remove</button>
                    <input type='hidden' name='pro_name' value= '$value[pro_name]'>
                    </form></td>
                    </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-lg-2">
            <div class="border p-4"> <!-- due to this black color arises as bg-->
                <h3 class="text-left">Total:</h3>
                <h5 class="text-right"><i class="fa fa-rupee"></i> <span class="allTotal"></span></h5>
                
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cod" id="cod" value="COD" checked>
                    <label class="form-check-label" for="cod">
                        Cash On Delivery
                    </label>
                </div>
                <div class="form-check disabled">
                    <input class="form-check-input" type="radio" name="upi" id="upi" value="UPI" disabled>
                    <label class="form-check-label" for="upi">
                        UPI (Not available)
                    </label>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="place_order_btn btn-warning btn-lg " id="place_order_btn" name="place_order" data-toggle="modal" data-target="#place_order">Place Order</button>
            </div>

        </div>
    </div>

    <!-- BOOTSTRAP MODAL   -->
    <form action="check_out.php" method="POST">
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="place_order">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Shipping and Billing Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="border p-4"> <!-- due to this black color arises as bg-->
                        <h3 class="text-left">Total:</h3>
                        <h5 class="text-right"><i class="fa fa-rupee"></i> <span id="allTotal"></span></h5>
                        <input type="hidden" name="totalPrice">
                    </div>
                    <hr>
                    <pre>⚠ Note: Verify Your Shipping address. Once the order is confirmed it can't be changed.</pre>
                    <h5>Shipping Details:</h5>
                    <div id="shipping-adrs">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" name="customer_name" value="<?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] ?>" readonly>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Street</span>
                            </div>
                            <input type="text" class="form-control" name="street_adrs" value="<?php echo $_SESSION['street'] ?>">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Landmark</span>
                            </div>
                            <input type="text" class="form-control" name="landmark" value="<?php echo $_SESSION['landmark'] ?>">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">City</span>
                            </div>
                            <input type="text" class="form-control" name="city" value="<?php echo $_SESSION['city'] ?>">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Pin</span>
                            </div>
                            <input type="text" class="form-control" name="pin" value="<?php echo $_SESSION['pin'] ?>">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">State</span>
                            </div>
                            <input type="text" class="form-control" name="state" value="<?php echo $_SESSION['state'] ?>">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone</span>
                            </div>
                            <input type="text" class="form-control" name="mobile" value="<?php echo $_SESSION['mobile'] ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-warning" name="confirm_check_out" value="confirm">
                    <!-- <button type="submit" class="btn btn-warning" name="confirm_check_out">Confirm</button> -->
                </div>
            </div>
        </div>
    </div>
    </form>

</body>
<script>
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal');
    var allTotal = document.getElementsByClassName('allTotal')[0];

    function subTotal() {
        var total = 0;
        for (var i = 0; i < iprice.length; i++) {
            var price = parseInt(iprice[i].value);
            var quantity = parseInt(iquantity[i].value);
            itotal[i].textContent = price * quantity; //Total Value as price increase as no. of quantity
            total += (price * quantity);
        }
        allTotal.textContent = total;
        document.getElementById('allTotal').innerHTML = total;
    }
    subTotal();

    // BS ALERT WHEN NO PRO IN CART
    document.querySelector("#place_order_btn").addEventListener("click", function() {
        var totalPrice = document.getElementById('allTotal').innerHTML;
        if (totalPrice == 0) {
            document.getElementById('empty_cart').style.display = 'block';
            // document.getElementById('place_order').style.display='none';  ///NOT WORK
        } else {
            // BS MODAL SHOW
            // document.getElementById('place_order').style.display='block';  
        }
        var hiddenInput = document.querySelector("input[name='totalPrice']");
        hiddenInput.value = totalPrice;
    })
</script>

</html>


<!-- BOOTSTRAP 4 MODAL POPUP FOR CONFIRM ORDER -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>