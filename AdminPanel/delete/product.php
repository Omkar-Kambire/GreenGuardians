<?php
session_start();
include('../../includes/connect.php');  // connect to database

if ($_SESSION['userType'] !== 'admin') {
    header("location: index.php");
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            height: 100vh;
            width: 100vw;
        }

        section {
            margin-top: 20vh;
            border: 1px solid #000001;
            width: 35rem;
            padding: 1rem;
            border-radius: 10px;
        }

        .ButtonDiv {
            width: 60%;
            margin-left: 40%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 1rem;
        }
    </style>
</head>


<body class="  py-4 bg-body-tertiary">


    <section class="form-signin  mx-auto">
        <form method="post">
            <h1 class="h3 mb-3 fw-normal">Delete Cart Item?</h1>

            <p>Do you really want to remove this item from your cart</p>

            <div class="ButtonDiv">
                <a href="../dashboard.php" class="btn btn-secondary w-100 py-2">Cancel</a>
                <input class="btn btn-danger w-100 py-2" type="submit" value="Remove" />
            </div>
        </form>
    </section>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $productId = isset($_GET['ProductId']) ? intval($_GET['ProductId']) : null;

    if (!$productId || $productId <= 0) {
        echo '<script>alert("Invalid Product Id")</script>';
        echo "<script>window.open('../index.php','_self')</script>";
    } else {
        // Remove item from cart
        $item = mysqli_prepare($conn, "DELETE FROM products WHERE pID = ?");
        $item->bind_param("i", $productId);

        if ($item->execute()) {
            // Item successfully removed
            echo '<script>alert("Successfully Removed")</script>';
            echo "<script>window.open('../dashboard.php','_self')</script>";
        } else {
            // Error occurred while removing item
            echo '<script>alert("Failed to Remove")</script>';
        }
    }
}
