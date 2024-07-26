<!-- connection file -->
<?php
include('includes/connect.php');  // connect to database
include('functions/common_functions.php'); //get products
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" class="rel">
    <style>
        .cart_img {
            height: 80px;
            width: 80px;
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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link active" href="display_all.php">Products</a>
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
                    </ul>
                </div>
            </div>
        </nav>

        <!-- //calling cart function -->
        <?php
        cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-4">
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
                    <a class='nav-link active' href= './user/logout.php'>Logout</a>
                </li> ";
                }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="container">
            <h4 class="mb-3 text-center">Cart</h4>
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">

                        <!-- php code to display dynamic data  -->
                        <?php
                        global $conn;
                        $ip = getIPAddress();
                        $total_price = 0;
                        $cart_query = "Select * from cart_details where ip_address='$ip'";
                        $result = mysqli_query($conn, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "<thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                                </thead>
                                <tbody>";



                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
                                $select_products = "Select * from products where pID ='$product_id'";
                                $result_products = mysqli_query($conn, $select_products);
                                while ($row_product_price = mysqli_fetch_array($result_products)) {
                                    $product_price = array($row_product_price['pPrice']);
                                    $price_table = $row_product_price['pPrice'];
                                    $product_title = $row_product_price['pName'];
                                    $product_img = $row_product_price['pPhoto'];
                                    $product_values = array_sum($product_price);
                                    $total_price += $product_values;

                        ?>
                                    <tr>
                                        <td><?php echo $product_title ?></td>
                                        <td><img src="./AdminPanel/prod_imgs/<?php echo $product_img ?>" alt="" class="cart_img"></td>
                                        <td><input type="text" name="qty" id="" class="form-input w-50"></td>
                                        <?php
                                        $ip = getIPAddress();
                                        if (isset($_POST['update_cart'])) {
                                            $quantity = $_POST['qty'];
                                            $update_quantity = "UPDATE cart_details SET quantity=$quantity WHERE ip_address='$ip'";
                                            $result_p_qty = mysqli_query($conn, $update_quantity);
                                            $total_price = $total_price * $quantity;
                                        }
                                        ?>
                                        <td><?php echo $price_table ?> /-</td>
                                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                        <td>
                                            <!-- <button class="btn btn-primary">Update</button> -->
                                            <input type="submit" value="Update cart" class="btn btn-primary" name="update_cart">
                                            <!-- <button class="btn btn-danger">Remove</button> -->
                                            <input type="submit" value="Remove product" class="btn btn-danger" name="remove_cart">

                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <!-- //subtotal -->
                    <?php
                    
                    $ip = getIPAddress();
                    //  $total_price = 0;
                    $cart_query = "Select * from cart_details where ip_address='$ip'";
                    $result = mysqli_query($conn, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        $_SESSION["cartItemsTotalPrice"] = $total_price;
                        echo "<div class='d-flex'>
                        <h4 class='px-3'>Subtotal:<strong class='text-info'>$total_price</strong></h4>
                        <a href='index.php' class='btn btn-primary mx-2'>Continue Shopping</a>
                        <a href='./user/checkout.php' class='btn btn-secondary'>Next</a>
                    </div>";
                    } else {
                        echo "<a href='index.php' class='btn btn-primary mx-2'>Continue Shopping</a>";
                    }
                    ?>

            </div>
        </div>
        </form>

        <!-- function to delete item  -->
        <?php
        function remove_cart_item()
        {
            global $conn;
            if (isset($_POST['remove_cart'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    echo $remove_id;
                    $delete_query = "DELETE from cart_details where product_id=$remove_id";
                    $run_delete = mysqli_query($conn, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        $remove_item = remove_cart_item();
        echo $remove_item;
        ?>
    </div>


    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>




</html>