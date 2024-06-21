<?php
session_start();
include 'db_session.php';

$category = isset($_GET['cat']) ? $_GET['cat'] : '';
$fetch = "SELECT * FROM `product` WHERE SELLER = '" . $_SESSION['seller_name'] . "' and category = '$category'";
$result = mysqli_query($conn, $fetch);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <!-- <link rel="stylesheet" href="CSS/style.css"> -->
  <title>Product Cards with Sliding Hover Effects</title>
  <!-- font awesome icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style>
    table {
      height: 100%;
      width: 100%;
    }

    td {
      padding: 0 1px;
      width: 10px;
    }

    .header {
      font-size: 18px;
      padding: 5px 10px;
      font-weight: 800;
    }

    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fff;
    background: url(https://tailwindcss.com/_next/static/media/docs-dark@tinypng.1bbe175e.png);
    }

    .card-img {
      width: 100%;
      height: 100px;
      object-fit: cover;
    }

    .no-product {
      height: 70vh;
      margin: 14% 0 0 68%;
      padding-bottom: 90px;
    }
  </style>
</head>

<body>
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Category</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php
        if ($result) {
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['category']; ?></td>
              <td><?php echo $row['product_name']; ?></td>
              <td><?php echo $row['description']; ?></td>
              <td><?php echo $row['price']; ?></td>
              <td><?php echo "<img class='card-img' src='PROIMG/" . $row['IMAGE'] . " ' height='480' width='180'>"; ?></td>
      </tr>
<?php
            }
          } else {
            echo "<tr>";
            echo "<td>"."<img class='no-product' src='images/notfound.png'>"."<td>";
            echo "<tr>";
          }
        }
?>

    </tbody>
  </table>

</body>

</html>