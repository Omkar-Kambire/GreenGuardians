<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if ($success) {

                    $paymentMethod = "Razorpay";
                    $paymentStatus = "completed";
                    echo '
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Payment Successful!</h4>
                        <p>Thank you for your payment. Your transaction has been completed successfully.</p>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0">Payment ID: ' . $payment_id . '</p>
                            <a class="btn btn-secondary" href="../index.php">Continue Shopping</a>
                        </div>
                    </div>
                    ';

                    $insertPaymentDetails = mysqli_prepare($conn, "INSERT INTO payments (order_id, payment_method, payment_amount,
                    payment_status, razorpay_order_id, razorpay_payment_id) VALUES(?, ?, ?, ?, ?, ?)");

                    $insertPaymentDetails->bind_param(
                        "isdsss",
                        $orderId,
                        $paymentMethod,
                        $amount,
                        $paymentStatus,
                        $attributes['razorpay_order_id'],
                        $attributes['razorpay_payment_id'],
                    );
                    if ($insertPaymentDetails->execute()) {

                        unset($_SESSION['cartItemsTotalPrice']);
                    }

                    $insertPaymentDetails->close();
                } else {
                    echo '
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Payment Failed!</h4>
                        <p>Unfortunately, your payment could not be processed. Please try again or contact our support team for assistance.</p>
                        <hr>
                        <p class="mb-0">Error: ' . $error_message . '</p>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>


<!-- 

todo ;
orderid
paymentid
paymentmod
totalamt

 -->