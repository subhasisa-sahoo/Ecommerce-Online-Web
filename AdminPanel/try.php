<?php
session_start();
include 'db_session.php';

// Count the number of distinct categories
$categoryCountQuery = "SELECT COUNT(DISTINCT category) AS category_count FROM product";
$categoryCountResult = mysqli_query($conn, $categoryCountQuery);
$categoryCountRow = mysqli_fetch_assoc($categoryCountResult);
$categoryCount = $categoryCountRow['category_count'];

// Count the total number of products
$productCountQuery = "SELECT COUNT(*) AS product_count FROM product";
$productCountResult = mysqli_query($conn, $productCountQuery);
$productCountRow = mysqli_fetch_assoc($productCountResult);
$productCount = $productCountRow['product_count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category and Product Count</title>
  <!-- Your CSS styles here -->
</head>
<body>
  <h2>Category and Product Count</h2>
  <p>Number of categories: <?php echo $categoryCount; ?></p>
  <p>Number of products: <?php echo $productCount; ?></p>
</body>
</html>
