
<!-- connection file -->
<?php
include('../includes/connect.php');  // connect to database
include('../functions/common_functions.php'); //get products
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" class="rel">
    <style>
        body {
            overflow-x: hidden;
        }

        .profile_img {
            width: 90%;
            /* height: 100%; */
            display: block;
            margin: auto;
            object-fit: contain;
        }
        .edit_image{
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-dark custom-bg p-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">GG</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link active" href="display_all.php">Products</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link active" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Total price: <?php total_cart_price(); ?> /- </a>
                        </li>
                    </ul>

                    <form class="d-flex" role="search" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <!-- <button type="button" class="btn btn-info">Search</button> -->
                        <input type="submit" value="Search" class="btn btn-outline-info" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- //calling cart function -->
        <?php
        cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link active' href='#'>Welcome, guest</a>
                </li> ";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link active' href='#'>Welcome, " . $_SESSION['username'] . "</a>
                </li> ";
                }
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link active' href='./user/user_login.php'>Login</a>
                </li> ";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link active' href= 'logout.php'>Logout</a>
                </li> ";
                }
                ?>

            </ul>
        </nav>

        <!-- third child -->

        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
                    <li class="nav-item bg-info">
                        <a class="nav-link text-light" href="#">
                            <h4>Your profile</h4>
                        </a>
                    </li>
                    <?php

                    $username = $_SESSION['username'];
                    $user_image = "SELECT * from user where user_name='$username'";
                    $user_image = mysqli_query($conn, $user_image);
                    $row_image = mysqli_fetch_array($user_image);
                    $user_image = $row_image['user_pic'];
                    echo "<li class='nav-item'>
                            <img src='./user_imgs/$user_image' class='profile_img my-4' alt=''>
                        </li>";
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php">Pending orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?edit_account">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?my_orders">My orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php 
                get_user_order_details();
                if(isset($_GET["edit_account"])) {
                    include('edit_account.php');
                }
                ?>
            </div>

        </div>


        <!-- js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>