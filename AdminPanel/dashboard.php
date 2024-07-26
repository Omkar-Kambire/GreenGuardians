<?php
session_start();

if ($_SESSION['userType'] !== 'admin') {
    header("location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../style.css" class="rel">
    <style>
        body {
            overflow-x: hidden;
        }

        .ViewProductsDiv {
            padding: 1rem;
            border: 1px solid lightgray;
            border-radius: 15px;
        }
    </style>

</head>

<body>

    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-dark custom-bg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">GreenGuardians</a>

                <nav class="navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav">
                    </ul>
                </nav>
            </div>
        </nav>
        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">
                Admin Dashboard
            </h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="ms-4 mt-1 mb-1 text-center px-5">
                    <?php
                    if (isset($_SESSION['name']) && $_SESSION['userType'] === 'admin') {
                        echo '<div class="d-flex align-items-center justify-content-evenly">
                        <a class="btn btn-secondary" href="#"><i class="fa-solid fa-user-gear"></i></a>
                        <a class="  mx-3 btn btn-secondary ">' . $_SESSION['name'] . '</a>
                        <a class=" btn btn-secondary" href="./logout.php">Logout</a>
                        </div>';
                    }


                    ?>
                </div>

                <!-- buttons -->
                <div class=" px-4">
                    <a href="./insert/products.php" class="btn btn-primary text-light my-1 mb-1 px-2">Insert Products</a>
                    <a href="dashboard.php?ViewProducts=true" class="btn btn-primary text-light my-1 mb-1 px-2">View Products</a>
                    <a href="./insert/categories.php" class="btn btn-primary text-light my-1 mb-1 px-2">Insert Categories</a>
                    <a href="dashboard.php?ViewCategories=true" class="btn btn-primary text-light my-1 mb-1 px-2">View Categories</a>
                    <a href="" class="btn btn-primary text-light my-1 mb-1 px-2">All Orders</a>
                    <a href="" class="btn btn-primary text-light my-1 mb-1 px-2">All Payments</a>
                    <a href="" class="btn btn-primary text-light my-1 mb-1 px-2">List Users</a>
                </div>
            </div>
        </div>


        <?php
        if (isset($_GET['ViewProducts'])) {
            include("../AdminPanel/view/products.php");
        }

        if (isset($_GET['ViewCategories'])) {
            include("../AdminPanel/view/categories.php");
        }

        ?>

        <!-- fourth child -->
        <div class="container my-4
         align-items-center">
            <?php
            if (isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }
            ?>
        </div>

    </div>
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>