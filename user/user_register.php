<!-- connection  -->
<?php
include('../includes/connect.php');  // connect to database
include('../functions/common_functions.php'); //get products
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-body px-5">
                        <div class="container text-center">
                            <!-- <img src="img/add-friend.png" style="max-width: 100px;" class="img-fluid" alt=""> -->
                        </div>
                        <h3 class="text-center my-2">Sign up here !!</h3>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-2">
                                <label for="name" class="mb-2">User Name</label>
                                <input name="user_name" type="text" autocomplete="off" class="form-control" id="name" placeholder="Enter here" aria-describedby="emailHelp" required pattern="^[a-zA-Z0-9]+$" title="Only letters and numbers are allowed in the username">
                            </div>
                            <div class="form-group mb-2">
                                <label for="email" class="mb-2">User Email</label>
                                <input name="user_email" type="email" autocomplete="off" class="form-control" id="email" placeholder="Enter here" aria-describedby="emailHelp" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address">
                            </div>
                            <div class="form-group mb-2">
                                <label for="image" class="mb-2">User Image</label>
                                <input name="user_image" type="file" autocomplete="off" class="form-control" id="image" placeholder="Enter here" aria-describedby="emailHelp" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address">
                            </div>
                            <div class="form-group mb-2">
                                <label for="password" class="mb-2"> Password</label>
                                <input name="user_password" type="password" minlength="6" class="form-control" id="password" placeholder="Enter here" aria-describedby="emailHelp" required pattern="^\S*$" title="Spaces are not allowed in the password">
                            </div>
                            <div class="mb-2 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" onchange="togglePasswordVisibility()">
                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            </div>
                            <div class="form-group mb-2">
                                <label for="conf_password" class="mb-2">Confirm password</label>
                                <input name="conf_password" type="password" minlength="6" class="form-control" id="conf_password" placeholder="Enter here" aria-describedby="emailHelp" required pattern="^\S*$" title="Spaces are not allowed in the password">
                            </div>
                            <div class="form-group mb-2">
                                <label for="phone" class="mb-2">User phone</label>
                                <input name="user_phone" type="text" class="form-control" id="phone" placeholder="Enter here" aria-describedby="phoneHelp" required pattern="[0-9]{10}" title="Enter a 10-digit phone number">
                            </div>
                            <div class="form-group mb-2">
                                <label for="user_address" class="mb-2">User Address</label>
                                <input name="user_address" type="text" autocomplete="off" class="form-control" id="name" placeholder="Enter here" aria-describedby="emailHelp" required pattern="^[a-zA-Z0-9]+$" title="Only letters and numbers are allowed in the address">
                            </div>
                            <div class="container text-center mb-3">
                                <!-- <button class="btn btn-outline-success">Register</button> -->
                                <input type="submit" value="Register" class="btn btn-success" name="user_register">
                                <!-- <button class="btn btn-outline-warning">Reset</button> -->
                                <p class="fw-bold mt-2">Already have an account ? <a href="user_login.php" class="text-decoration-none text-danger"> Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>


<?php
if (isset($_POST['user_register'])) {
    $u_name = $_POST['user_name'];
    $u_email = $_POST['user_email'];
    $u_password = $_POST['user_password'];
    $conf_u_password = $_POST['conf_password'];
    $u_address = $_POST['user_address'];
    $u_phone = $_POST['user_phone'];
    $u_img = $_FILES['user_image']['name'];
    $u_img_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();


    // select query
    //   $select_query="SELECT * from user_table where user_name='$u_name' or
    //   user_email='$u_email'";
    //   $result-mysqli_query($conn, $select_query);
    //   $rows_count=mysqli_num_rows($result);
    //   if($rows_count>0){
    //     echo "<script> alert('Username and Email already exist already exist')</script>";
    //   }else if($u_password!=$conf_u_password){
    //     echo "<script> alert('Passwords do not match')</script>";
    //   }
    $select_query = "SELECT * FROM user WHERE user_name='$u_name' OR user_email='$u_email'";
    $result = mysqli_query($conn, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        $user_exists = false;
        $email_exists = false;

        // Check if username or email exists in the database
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['user_name'] == $u_name) {
                $user_exists = true;
            }
            if ($row['user_email'] == $u_email) {
                $email_exists = true;
            }
        }

        // Display appropriate messages based on existence of username and email
        if ($user_exists && $email_exists) {
            echo "<script>alert('Username and Email already exist.')</script>";
        } elseif ($user_exists) {
            echo "<script>alert('Username already exists.')</script>";
        } elseif ($email_exists) {
            echo "<script>alert('Email already exists.')</script>";
        }
    } elseif ($u_password != $conf_u_password) {
        echo "<script>alert('Passwords do not match.')</script>";
    } else {

        // insert_query
        move_uploaded_file($u_img_tmp, "./user_imgs/$u_img");
        $insert_query = "insert into user (user_name, user_email, user_password, user_pic, user_ip,user_address, user_phone) values ('$u_name', '$u_email', '$u_password','$u_img', '$user_ip', '$u_address', '$u_phone')";
        $sql_execute = mysqli_query($conn, $insert_query);
        if ($sql_execute) {
            echo "<script> alert('Successfully registered') </script>";
        } else {
            die(mysqli_error($con));
        }
    }


//     // selecting cart items
//     $select_cart_items = "SELECT * from cart_details where ip_address='$user_ip'";
//     $result_cart = mysqli_query($conn, $select_cart_items);
//     $rows_count = mysqli_num_rows($result_cart);
//     if ($rows_count > 0) {
//         $_SESSION['username']= $u_name;
//         echo "<script> alert('You have items in your cart')</script>";
//         echo "<script>window.open('checkout.php', '_self')</script>";
//     }
//     else{
//         echo "<script>window.open('../index.php','_self')</script>";
//     }
}
?>