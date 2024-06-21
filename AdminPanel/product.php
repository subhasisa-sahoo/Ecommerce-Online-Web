<?php
session_start();
include 'db_session.php';
// error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Product Register</title>
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Add some basic styling for better presentation */
        .container {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-image: linear-gradient(to left, rgb(255, 255, 128), rgb(255, 150, 80));
            border-radius: 30px;
            color: black;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 20px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .heading {
            text-align: center;
        }

        .submit {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .success-message {
            color: black;
            font-size: 20px;
        }

        #quantity,
        #category {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="heading">
            <h1>ENTER PRODUCT DETAILS</h1>
        </div>
        <form method="POST" id="myForm" enctype="multipart/form-data">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <!-- <label for="seller_name">Seller Name:</label>
            <input type="text hidden" id="seller_name" name="seller_name" required> -->

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="10" required>
            <input type="hidden" name="seller_name" value=<?php echo $_SESSION['seller_name'] ?>>
            <label for="category">Category:</label>
            <!-- <input type="text" id="category" name="category"> -->
            <select id="category" name="category">
                <option value="Cloths">Clothing</option>
                <option value="Home Decor">Home Decor</option>
                <option value="Crafts">Artisanal Crafts</option>
                <option value="Skincare">natural Skincare</option>
                <option value="Art Gallery">Art Gallery</option>
                <option value="Kitchenware">Kitchenware</option>
            </select>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="img" accept="image/jpg, image/jpeg, image/webp, image/png">
            <br>
            <br>

            <DIV class="submit">
                <input type="submit" value="Submit" name="submit">
            </DIV>
        </form>
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $seller=mysqli_real_escape_string($conn, $_POST['seller_name']);
    $img = $_FILES['img']['name'];

    // UPLOAD IMG
    $filename = $_FILES['img']['name'];
    $tempname = $_FILES['img']['tmp_name'];
    $folder = "PROIMG/" .$filename;
    move_uploaded_file($tempname, $folder);


    // Insert query
    $sql = "INSERT INTO `product` (product_name, description, price, quantity, category,IMAGE, SELLER) VALUES ('$name', '$description', '$price', '$quantity', '$category','$img','$seller')";
    if (mysqli_query($conn, $sql)) {
        echo '<script>
                swal.fire({
                    title: "Congratulation!",
                    text: "Product Successfully Added",
                    icon: "success"
                }).then((result) => {
                    if (result) {
                        window.location.href = "product.php"; // Redirect to the desired page
                    }
                });
              </script>';
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
