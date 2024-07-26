<?php

// include('E:/xamppnew/htdocs/GreenGuardians/includes/connect.php');  // connect to database
require("E:/xamppnew/htdocs/GreenGuardians/vendor/razorpay/razorpay/Razorpay.php");

use Razorpay\Api\Api;
session_start();

// define('RAZORPAY_KEY', 'rzp_test_jBCLQ5UA5KM40Q');
// define('RAZORPAY_SECRET', 'jFtb1umm0l7kviWadlxsrUI2');

$razorpay = new Api(RAZORPAY_KEY, RAZORPAY_SECRET);
// echo RAZORPAY_KEY ;
// Get user input
$name = $_SESSION['username'];
$email = $_SESSION['email'];
$amount = $_SESSION['cartItemsTotalPrice'];
$contact = $_SESSION['contact'];

// if (!$amount || empty($amount)) {
//     echo "<script>window.open('../../index.php', '_self')</script>";
//     exit; // Ensure no further code is executed after the header redirection

// }


// Create an order on the Razorpay server
$order_data = [
    'receipt'         => uniqid(), // Generate a unique order ID
    'amount'          => $amount * 100,
    'currency'        => 'INR',
    'payment_capture' => true // Auto capture the payment
];
$order = $razorpay->order->create($order_data);

// Prepare the checkout data
$data = [
    "key"               => RAZORPAY_KEY,
    "amount"            => $amount,
    "currency"          => "INR",
    "name"              => "GreenGuardians.com",
    "description"       => "Payment for your order",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
        "name"              => $name,
        "email"             => $email,
        "contact"           => $contact,

    ],
    "theme"             => [
        "color"             => "#F37254"
    ],
    "notes"             => [
        "merchant_order_id" => $order['id'],
    ],
    "order_id"          => $order['id'],
];






// Render the Razorpay checkout form
$json = json_encode($data);


?>
<style>
    .razorpay-payment-button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        transition-duration: 0.4s;
    }

    .razorpay-payment-button:hover {
        background-color: #45a049;
    }
</style>
<form action="./success.php" method="POST">
    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>" data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>" data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>" data-prefill.name="<?php echo $data['prefill']['name'] ?>" data-prefill.email="<?php echo $data['prefill']['email'] ?>" data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id=<?php echo $order['id'] ?> data-order_id="<?php echo $data['order_id'] ?>">
    </script>

    <input type="hidden" name="shopping_order_id" value="<?php echo $order['id'] ?>">
</form>