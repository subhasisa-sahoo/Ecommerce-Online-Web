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
    .my_order_container {
        margin-top: 4% !important;
    }

    * {
        text-align: center;
    }

    .h1_header {
        margin: 5% 20% 2% 20%;
        padding: 5px;
        border-radius: 2px;
        background-color: #e9ecef;
        text-align: center;
    }

    .adrs {
        text-align: left;
        /* padding-left: 120px !important; */
    }
</style>

<body>
    <?php
    include 'navbar.php';
    include 'product_db.php';
    ?>
    <section class="my_order_container">
        <h1 class="bg-light h1_header">MY ORDER</h1>
        <div class="col-lg-9">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Pay Mode</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_dfetch = "SELECT EMAIL, Order_id,Pay_mode FROM `craftshop_sellerdb`.`order_adrs` WHERE EMAIL = '$_SESSION[email]' ORDER BY `Order_id` DESC";
                    $user_qres = mysqli_query($admin_pro_con, $user_dfetch);
                    while ($user_row = mysqli_fetch_assoc($user_qres)) {
                        $Order_id =  $user_row['Order_id'];

                        $order_dfetch = "SELECT * FROM `craftshop_sellerdb`.`orderd_item` WHERE order_id = $Order_id";
                        $order_qres = mysqli_query($admin_pro_con, $order_dfetch);
                        while ($order_row = mysqli_fetch_assoc($order_qres)) {
                            $tQPrice = $order_row['Price'] * $order_row['Quantity'];  //Qunatity wise price
                            echo "<tr>
                                    <td class='order_id'>{$order_row['order_id']}</td>
                                    <td>{$order_row['Product_name']}</td>
                                    <td>{$order_row['Quantity']}</td>
                                    <td>{$user_row['Pay_mode']}</td>
                                    <td>$tQPrice</td>
                                    <td class='getStatusClass($order_row[STATUS])'>$order_row[STATUS]</td>"
                    ?>
                    <?php
                            echo '<td><button type="button" class="btn btn-warning view_data" data-toggle="modal" data-target="#view_data"><i class="fa fa-eye"></i></button></td>';
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="view_data" tabindex="-1" role="dialog" aria-labelledby="view_dataLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_dataLabel">Order details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="view_order_details" style="text-align: left;">
                    <!-- AJAX RESULT WILL SHOW HERE -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- BOOTSTRAP 4 MODAL POPUP FOR CONFIRM ORDER -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('.view_data').click(function(e) {
            e.preventDefault();
            var order_id = $(this).closest('tr').find('.order_id').text();
            $.ajax({
                url: 'order_details.php',
                method: 'POST',
                data: {
                    'click_view_btn': true,
                    'order_id': order_id
                },
                success: function(response) {
                    $('.view_order_details').html(response);
                    console.log("pass:", order_id)
                },
                error: function() {
                    $('.view_order_details').html('An error occurred');
                }
            });
        })
    });
</script>