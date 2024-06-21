<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Dashboard</title>
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
    <!-- AJAX JQUERY -->
    <script src="JS/ajaxquery.js"></script>
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        text-align: center;
        font-family: "kanit";
    }

    .h1_header {
        margin: 0% 20% 2% 20%;
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
    session_start();
    include 'db_session.php';
    $seller= $_SESSION['seller_name'];
    ?>
    <section class="my_order_container">
        <h1 class="bg-light h1_header">ORDER</h1>
        <div class="col-lg-11">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Mobile</th>
                        <th>Pay Mode</th>
                        <th>Address</th>
                        <th>Orders</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_dfetch = "SELECT * FROM `craftshop_sellerdb`.`order_adrs` ORDER BY `Order_id` DESC";
                    $user_qres = mysqli_query($conn, $user_dfetch);
                    while ($user_row = mysqli_fetch_assoc($user_qres)) {
                        $address =  $user_row['STREET_ADRS'] . "<br>" .
                            $user_row['LANDMARK'] . "<br>" .
                            $user_row['CITY'] . "<br>" .
                            $user_row['PIN'] . "<br>" .
                            $user_row['STATE'];
                        echo "<tr>
                                  <th class='order_id'>{$user_row['Order_id']}</th>
                                  <td>{$user_row['Customer_name']}</td>
                                  <td>{$user_row['MOBILE']}</td>
                                  <td>{$user_row['Pay_mode']}</td>
                                  <td class='adrs'>$address</td>
                                  <td><table class='table'>
                                  <thead class='thead-light'>
                                    <tr>
                                      <th>Product</th>
                                      <th>Quantity</th>
                                      <th>Price</th>
                                    </tr>
                                  </thead>
                                  <tbody>";
                        $order_dfetch = "SELECT * FROM `craftshop_sellerdb`.`orderd_item` WHERE order_id = {$user_row['Order_id']} OR SELLER =' $seller'";
                        $order_qres = mysqli_query($conn, $order_dfetch);
                        while ($order_row = mysqli_fetch_assoc($order_qres)) {
                            $status = $order_row['STATUS'];
                            $tQPrice = $order_row['Price']*$order_row['Quantity'];  //Qunatity wise price
                            echo "<tr>
                                    <td>{$order_row['Product_name']}</td>
                                    <td>{$order_row['Quantity']}</td>
                                    <td>$tQPrice</td>
                                 </tr>";
                        }
                        echo "</tbody>
                                </table></td>
                                  <td>Rs. {$user_row['Total']}</td>
                                  <td class='getStatusClass'>$status</td>
                                  <td><button type='submit' class='btn btn-warning update_status' data-toggle='modal' data-target='#updateStatusModal' data-orderid='{$Order_id}'>Update</button></td>
                            </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Modal for updating order status -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateStatusLabel">Update Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <select name="status" class="form-control">
            <option value="Pending">Pending</option>
            <option value="Out for delivery">Out for delivery</option>
            <option value="Delivered">Delivered</option>
            <option value="Cancelled">Cancelled</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-warning save_update_status" value="Update Status">
        </div>
      </form>
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
        $('.update_status').click(function(e) {
            e.preventDefault();
            var order_id = $(this).closest('tr').find('.order_id').text();
            var status = $(this).closest('tr').find('.getStatusClass').text();
            $('.save_update_status').click(function(e){
              e.preventDefault();
              var new_status = $('#updateStatusModal select[name="status"]').val();
              $.ajax({
                url: 'status.php',
                method: 'POST',
                data: {
                    'click_view_btn': true,
                    'order_id': order_id,
                    'new_status': new_status
                },
                success: function(response) {
                  swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        confirmButtonColor: 'black'
                    });
                    location.reload();
                },
                error: function() {
                  swal.fire({
                        icon: 'error',
                        title: 'Status not updated',
                        confirmButtonColor: 'black'
                    });

                }
            });
            });
        })
    });
</script>