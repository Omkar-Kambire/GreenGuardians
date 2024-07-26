<?php
include('E:/xamppnew/htdocs/GreenGuardians/includes/connect.php');  // connect to database
include('../functions/common_functions.php'); //get products
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Options</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .options {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .option {
            text-align: center;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option:hover {
            background-color: #f0f0f0;
        }

/* progress bar */

 /* progress bar */
 #progress-bar {
    /* text-align: center; */
    display: flex;
            justify-content: center;
            list-style-type: none;
            padding: 15px 0 0;
            counter-reset: step;
  li {
    text-align: center;
            width: 20%;
            position: relative;
            font-size: 16px;
            counter-increment: step;
    &:before {
        content: counter(step);
            display: block;
            margin: 0 auto 10px;
            width: 50px;
            height: 50px;
            line-height: 50px;
            border: 1px solid #efefef;
            border-radius: 50%;
            background-color: #fff;
            color: #212121;
            font-size: 18px;
    }
    &:after {
        content: '';
            position: absolute;
            width: 100%;
            height: 10px;
            background-color: #fff;
            top: 25px;
            left: -50%;
            z-index: -1;
    }
    &:first-child:after {
      content: none;
    }
    &.step-done {
      color: #ff0000;
      &:before {
        border-color: #ff0000;
        background-color: #ff0000;
        color: #fff;
        content: "\f00c";
        font-family: "FontAwesome";
      }
      & + li:after {
        background-color: #ff0000;
      }
    }
    &.step-active {
      color: #ff0000;
      &:before {
        border-color: #ff0000;
        color: #ff0000;
        font-weight: 700;
      }
    }
  }
}
    </style>
</head>

<body>
    <!-- php code to access user id  -->
    <?php
    $user_ip = getIPAddress();
    // $user_ip = getIPAddress();
    $get_user = "SELECT * from user where user_ip='$user_ip'";
    $result = mysqli_query($conn, $get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_ID'];



    ?>

    <!-- <h1>Progress bar / Checkout steps</h1> -->
<ol id="progress-bar">
  <li class="step-done">Step 1</li>
  <li class="step-active">Step 2</li>
  <!-- <li class="step-todo">Step 3</li> -->
</ol>

    <div class="container">
        <h1>Payment Options</h1>
        <div class="options">
            <div class="option">
            <a class="text-decoration-none" href="./components/pay.php">
                <h2>Online</h2>
                <p>Pay securely online</p>
                <?php include( './components/pay.php'); ?>
            </a>
            </div>
            <div class="option">
            <a class="text-decoration-none" href="order.php?user_id=<?php echo $user_id ?>">
                <h2>Offline</h2>
                <p>Pay offline via Cash</p>
                <input type="submit" value="Pay now" class="razorpay-payment-button">
            </a>
            </div>
        </div>
    </div>



    <!-- js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>