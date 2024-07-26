<?php
require("E:/xamppnew/htdocs/GreenGuardians/vendor/razorpay/razorpay/Razorpay.php");
include('E:/xamppnew/htdocs/GreenGuardians/includes/connect.php');  // connect to database
include('E:/xamppnew/htdocs/GreenGuardians/functions/common_functions.php'); //get products



use Razorpay\Api\Api;

// Razorpay API credentials
session_start();

function emptyCart()
{
    global $conn;

    global $user_id;
    $get_ip_address = getIPAddress();

    $total_price = 0;
    $cart_query_price = "SELECT * from cart_details where ip_address='$get_ip_address'";
    $result_cart_price = mysqli_query($conn, $cart_query_price);
    $invoice_number = mt_rand();
    $status = 'pending';
    // $result_cart_price=mysqli_query($con,$cart_query_price);
    $count_products = mysqli_num_rows($result_cart_price);
    while ($row_price = mysqli_fetch_array($result_cart_price)) {
        $product_id = $row_price['product_id'];
        $select_product = "SELECT * from products where pID =$product_id";
        $run_price = mysqli_query($conn, $select_product);
        while ($row_product_price = mysqli_fetch_array($run_price)) {
            $product_price = array($row_product_price['pPrice']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }

    $get_cart = "SELECT * from cart_details";
    $run_cart = mysqli_query($conn, $get_cart);
    $get_item_quantity = mysqli_fetch_array($run_cart);
    $quantity = $get_item_quantity['quantity'];
    if ($quantity == 0) {
        $quantity = 1;
        $subtotal = $total_price;
    } else {
        $quantity = $quantity;
        $subtotal = $total_price * $quantity;
    }
    $insert_orders = "INSERT into user_orders (user_ID, amount_due,
invoice_number, total_products, order_date,order_status) values ($user_id,
$subtotal, $invoice_number, $count_products, NOW(), '$status')";
    $result_query = mysqli_query($conn, $insert_orders);
    if ($result_query) {
        echo "<script>alert('Orders are submitted successfully')</script>";
        echo "<script>window.open('profile.php', '_self')</script>";
    }
    //order pending
    $insert_pending_orders = "INSERT into orders_pending (user_ID,
invoice_number, pID, quantity,order_status) values ($user_id,
$invoice_number, $product_id,$quantity,'$status')";
    $result_pending_orders = mysqli_query($conn, $insert_pending_orders);

    //delete items from cart
    $empty_cart = "DELETE from cart_details where ip_address='$get_ip_address'";
    $result_delete = mysqli_query($conn, $empty_cart);
}


// Create a new Razorpay instance
$razorpay = new Api(RAZORPAY_KEY, RAZORPAY_SECRET);




// Get payment details from the request
$payment_id = $_POST['razorpay_payment_id'];
$signature = $_POST['razorpay_signature'];
$order_id = $_POST['razorpay_order_id'];
$orderId = uniqid();
$amount = $_SESSION['cartItemsTotalPrice'];
$user_id = $_SESSION['userId'];


// Verify the payment signature
$success = true;
try {
    $attributes = [
        'razorpay_order_id' => $order_id,
        'razorpay_payment_id' => $payment_id,
        'razorpay_signature' => $signature
    ];

    $razorpay->utility->verifyPaymentSignature($attributes);
    emptyCart();
} catch (Exception $e) {
    $success = false;
    echo 'Payment verification failed: ' . $e->getMessage();
    exit;
}

include("E:/xamppnew/htdocs/GreenGuardians/user/components/payment_result.php");
