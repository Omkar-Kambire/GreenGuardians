<!-- connection file -->
<?php
include('includes/connect.php');  // connect to database
include('functions/common_functions.php'); //get product
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" class="rel">
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-dark custom-bg p-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link active" href="#">Products</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link active" href="./user/user_register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="#">Total price: <?php total_cart_price();?> /- </a>
                        </li>
                    </ul>

                    <form class="d-flex" role="search" action="" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <!-- <button type="button" class="btn btn-info">Search</button> -->
                        <input type="submit" value="Search"  class="btn btn-info" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
            <?php 
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link active' href='#'>Welcome, guest</a>
                </li> ";
                }else{
                    echo "<li class='nav-item'>
                    <a class='nav-link active' href='#'>Welcome, ".$_SESSION['username']."</a>
                </li> ";
                }
                if(!isset($_SESSION['username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link active' href='./user/user_login.php'>Login</a>
                </li> ";
                }else{
                    echo "<li class='nav-item'>
                    <a class='nav-link active' href= './user/logout.php'>Logout</a>
                </li> ";
                }         
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="container-fluid ">
            <div class="row mt-3">
                <div class="col-md-2 bg-secondary p-0">
                    <!-- sidenav -->
                    <!-- Fertilizers -->
                    <ul class="navbar-nav me-auto text-center">
                        <li class="nav-item custom-bg">
                            <a href="#" class="nav-link text-light">
                                <h4>Categories</h4>
                            </a>
                        </li>

                        <?php
                        displaycategories();
                        ?>

                    </ul>

                    <!-- Pesticides -->
                    <!-- <ul class="navbar-nav me-auto text-center">
                        <li class="nav-item custom-bg">
                            <a href="#" class="nav-link text-light">
                                <h4>Pesticides</h4>
                            </a>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link text-light">Pesticide1</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">Pesticide2</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">Pesticide3</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">Pesticide4</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">Pesticide5</a>
                        </li>

                    </ul> -->


                </div>


                <!-- Products -->
                <div class="col-md-10">
                    <!-- Products display area -->
                    <div class="row">

                        <!-- fetching products -->
                        <?php
                        //calling function
                        //displaying products
                        search_product();
                        get_unique_categories();
                        ?>
                        <!-- <div class="col-md-4 mb-2">
                            <div class="card">
                                <img src="fertilizer_img/5-kg-cow-manure-31256517378180.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Add To Cart</a>
                                    <a href="#" class="btn btn-secondary">View More</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html> 