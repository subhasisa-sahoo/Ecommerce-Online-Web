<?php
include 'db.php';
session_start();
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $query = "SELECT * FROM `registration` WHERE EMAIL = '$email' and PASSWORD = '$pwd'";
    $query_result = mysqli_query($conn, $query);
    if ($query_result) {
        $result_count = mysqli_num_rows($query_result);
        if ($result_count > 0) {
            $row = mysqli_fetch_assoc($query_result);
            if ($row) {
                $_SESSION['id'] = $row['ID'];
                $_SESSION['seller_img'] = $row['IMAGE'];
                $_SESSION['email'] = $row['EMAIL'];
                $_SESSION['username'] = $row['USERNAME'];
                $_SESSION['seller_name'] = $row['SELLER_NAME'];
                $_SESSION['mobile'] = $row['MOBILE'];
                $_SESSION['city'] = $row['CITY'];
                $_SESSION['street'] = $row['STREET_ADRS'];
                $_SESSION['landmark'] = $row['LANDMARK'];
                $_SESSION['pin'] = $row['PIN'];
                header('Location: index.php');
            } else {
                echo "<script>
              Swal.fire({
                   title: 'Invalid Password',
                   text: 'Enter Correct password',
                   confirmButtonColor: 'black',
                  })
                  </script>";
            }
        } else {
            echo "<script>
                swal.fire({
                  title: 'Email Id doesn\'t Exist',
                  confirmButtonColor:'black'
                });
                </script>";
        }
    } else {
        echo "<script>
    alert('Something Error happened While Connecting');
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login Portal</title>
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/906/906343.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- Sweet alert JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, yellow, orange, brown);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 350px;
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
        }

        .password-toggle {
            margin-left: 5px;
            cursor: pointer;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-me input {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="password-toggle" onclick="togglePassword()">Show</span>
            </div>
            <div class="remember-me">
                <input type="checkbox" id="rememberMe" name="rememberMe">
                <label for="rememberMe">Remember Me</label>
                <p><a href="seller_portal.html">Register Now</a></p>
            </div>
            <input type="submit" value="Login" name="submit">
            <div class="error-message" id="errorMessage"></div>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                document.querySelector(".password-toggle").innerText = "Hide";
            } else {
                passwordField.type = "password";
                document.querySelector(".password-toggle").innerText = "Show";
            }
        }

        document.getElementById("loginForm").addEventListener("submit", function(event) {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var rememberMe = document.getElementById("rememberMe").checked;

            if (email.trim() === "" || password.trim() === "") {
                event.preventDefault();
                document.getElementById("errorMessage").innerText = "email and password are required.";
            } else {
                document.getElementById("errorMessage").innerText = "";
                if (rememberMe) {
                    // Code to remember user
                }
                window.location.href = "index.html";
            
            }
        });
    </script>
</body>
</html>
