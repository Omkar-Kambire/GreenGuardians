<?php

//connection file
// include('./includes/connect.php');

//getting products
function getproducts()
{
    global $conn;

    //condition to check if isset or not
    if (!isset($_GET['cat'])) {

        //query to select all from
        $select_query = "select * from products order by pName";
        $result_query = mysqli_query($conn, $select_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['pID'];
            $product_title = $row['pName'];
            $product_desc = $row['pDesc'];
            // $product_keywords=$row['pID'];
            $product_img = $row['pPhoto'];
            $product_price = $row['pPrice'];
            $category_id = $row['cID'];

            echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./AdminPanel/prod_imgs/$product_img' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_desc</p>
                                    <p class='card-text'>Price: $product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
                                </div>
                            </div>
                        </div>";
        }
    }
}

// getting unique categories

function get_unique_categories()
{
    global $conn;

    //condition to check if isset or not
    if (isset($_GET['cat'])) {
        $category_id = $_GET['cat'];

        //query to select all from
        $select_query = "select * from products where cID=$category_id";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        //checking the number of rows in result query
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>Stock is not available for this category</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['pID'];
            $product_title = $row['pName'];
            $product_desc = $row['pDesc'];
            // $product_keywords=$row['pID'];
            $product_img = $row['pPhoto'];
            $product_price = $row['pPrice'];
            $category_id = $row['cID'];

            echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./AdminPanel/prod_imgs/$product_img' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_desc</p>
                                    <p class='card-text'>Price: $product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
                                </div>
                            </div>
                        </div>";
        }
    }
}

//displaying categories on sidenav
function displaycategories()
{
    global $conn;

    $select_cat = "select * from categories";
    $result_cat = mysqli_query($conn, $select_cat);
    // $row_data=mysqli_fetch_assoc($result_cat);
    // echo $row_data['cTItle'];
    while ($row_data = mysqli_fetch_assoc($result_cat)) {
        $catTitle = $row_data['cTitle'];
        $catID = $row_data['cID'];
        echo " <li class='nav-item'> 
                            <a href='index.php?cat=$catID' class='nav-link text-light'>$catTitle</a>
                            </li>";
    }
}

//searching products
function search_product()
{
    global $conn;
    if (isset($_GET["search_data_product"])) {
        $search_data_value = $_GET['search_data'];

        //query to select all from
        $search_query = "select * from products where pKeywords like '%$search_data_value%'";
        $result_query = mysqli_query($conn, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        //checking the number of rows in result query
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No results matched. No products in this category</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['pID'];
            $product_title = $row['pName'];
            $product_desc = $row['pDesc'];
            // $product_keywords=$row['pID'];
            $product_img = $row['pPhoto'];
            $product_price = $row['pPrice'];
            $category_id = $row['cID'];

            echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./AdminPanel/prod_imgs/$product_img' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_desc</p>
                                    <p class='card-text'>Price: $product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
                                </div>
                            </div>
                        </div>";
        }
    }
}

//get ip address function
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;

//cart function
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip' AND product_id=$get_product_id";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        //checking the number of rows in result query
        if ($num_of_rows > 0) {
            echo "<script>alert('This product is already present in cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_query = "insert into cart_details (product_id,ip_address,quantity) values ($get_product_id,'$ip',0) ";
            $result_query = mysqli_query($conn, $insert_query);
            echo "<script>alert('Item added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

//function to get cart items number
function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $ip = getIPAddress();
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        global $conn;
        $ip = getIPAddress();
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo "$count_cart_items";
}

// total price function
function total_cart_price()
{
    global $conn;
    $ip = getIPAddress();
    $total_price = 0;
    $cart_query = "Select * from cart_details where ip_address='$ip'";
    $result = mysqli_query($conn, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "Select * from products where pID ='$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['pPrice']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo $total_price;
}

// get user order details
function get_user_order_details()
{
    global $conn;
    $username = $_SESSION['username'];
    // print_r($_SESSION);
    $get_details = "SELECT * from user where user_name='$username'";
    $result_query = mysqli_query($conn, $get_details);
    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_ID'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "SELECT * from user_orders where user_ID=$user_id and order_status='pending'";
                    $result_order_query = mysqli_query($conn, $get_orders);
                    $row_count = mysqli_num_rows($result_order_query);
                    if ($row_count > 0) {
                        echo "<h3 class='text-center mt-5 mb-3'>You have <span class='text-danger'> $row_count</span> pending orders</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details </a></p>";
                      }else{
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>Explore products</a></p>";
                    }
                }
            }
        }
    }
}
?>
