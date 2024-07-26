<?php
include('../includes/connect.php'); 
// session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Address</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }

/* body {
  background-color: #efefef;
  text-align: center;
  padding-top: 50px;
  font-family: 'Open Sans', sans-serif;
  h1 {
    font-weight: 700;
  }
} */

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
    <!-- <div class="container"> -->
<!-- <h1>Progress bar / Checkout steps</h1> -->
<ol id="progress-bar">
  <li class="step-active">Step 1</li>
  <li class="step-todo">Step 2</li>
  <!-- <li class="step-todo">Step 3</li> -->
</ol>
<!-- </div> -->
    <div class="container">
        <h2>Shipping Address</h2>
        <form action="" method="post">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="address1">Address Line 1</label>
            <input type="text" id="address1" name="address1" required>

            <label for="address2">Address Line 2</label>
            <input type="text" id="address2" name="address2">

            <label for="city">City</label>
            <input type="text" id="city" name="city" required>

            <label for="state">State/Province/Region</label>
            <input type="text" id="state" name="state" required>

            <label for="postalcode">Postal Code</label>
            <input type="text" id="postalcode" name="postalcode" required>

            <label for="country">Country</label>
            <select id="country" name="country" required>
                <option value="">Select Country</option>
                <option value="US">United States</option>
                <option value="CA">Canada</option>
                <option value="GB">United Kingdom</option>
                <option value="AU">Australia</option>
                <option value="IN">India</option>
                <!-- Add more countries as needed -->
            </select>

            <input type="submit" value="Submit" name="insertAdd">
        </form>
    </div>
</body>
</html>

<?php 



if(isset($_POST['insertAdd'])) {
    // print_r($_SESSION);
    $user_id= $_SESSION['userId'];
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $address1 = $conn->real_escape_string($_POST['address1']);
    $address2 = $conn->real_escape_string($_POST['address2']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $postalcode = $conn->real_escape_string($_POST['postalcode']);
    $country = $conn->real_escape_string($_POST['country']);

    

    // SQL query to insert data into addresses table
    $sql = "INSERT INTO addresses (user_ID,fullname, address1, address2, city, state, postalcode, country) 
            VALUES ($user_id,'$fullname', '$address1', '$address2', '$city', '$state', $postalcode, '$country')";

    // Execute the query and check for success

    $result_query=mysqli_query($conn, $sql);
    if($result_query) {
        echo "<script>alert('Address submitted successfully')</script>";
        echo "<script>window.open('../user/payment.php', '_self')</script>";
    }

    // if ($conn->query($sql)) {
    //     echo "Address information saved successfully.";
    //     // Redirect to another page if needed
    //     header("Location: checkout.php");
    //     exit();
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // Close the database connection
    // $conn->close();
}
?>