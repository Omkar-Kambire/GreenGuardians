<?php
include('../includes/connect.php');  // connect to database
include('../functions/common_functions.php'); //get products
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>User login</title>
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
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
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
                        <h3 class="text-center my-3 mb-5">Login</h3>
                        <form action="" method="post">
                            <div class="form-group mb-2">
                                <label for="name" class="mb-2">User Name</label>
                                <input name="user_name" type="text" autocomplete="off" class="form-control" id="name" placeholder="Enter here" aria-describedby="emailHelp" required pattern="^[a-zA-Z0-9]+$" title="Only letters and numbers are allowed in the username">
                            </div>
                            <div class="form-group mb-2">
                                <label for="password" class="mb-2"> Password</label>
                                <input name="user_password" type="password" minlength="6" class="form-control" id="password" placeholder="Enter here" aria-describedby="emailHelp" required pattern="^\S*$" title="Spaces are not allowed in the password">
                            </div>
                            <div class="mb-2 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" onchange="togglePasswordVisibility()">
                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            </div>
                            <div class="container text-center mb-3">
                                <!-- <button class="btn btn-outline-success">Login</button> -->
                                <input type="submit" value="Login" class="btn btn-success" name="user_login">
                                <p class="fw-bold mt-2">Don't have an account ? <a href="user_register.php" class="text-decoration-none text-danger"> Register</a></p>
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
// if(isset($_POST['user_login'])){
//     $user_username=$_POST['user_name'];
//     $user_password=$_POST['user_password'];
//     $select_query="SELECT * from user where
//     user_name='$user_username'";
//     $result=mysqli_query($con, $select_query);
//     $row_count=mysqli_num_rows($result);
//     if ($row_count>0){
//     }
//     else{
//         echo "<script> alert('Invalid Credentials')</script>";
//     }
// }

if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    // Query to select user with provided username
    $select_query = "SELECT * FROM user WHERE user_name='$user_username'
    ";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();



    if ($row_count > 0) {
        $_SESSION['username']= $user_username;
        $_SESSION['userId']= $row['user_ID'];
        // echo $row['user_ID'];
        $_SESSION['email']= $row['user_email'];
        $_SESSION['contact']= $row['user_phone'];
        $_SESSION['userType'] = "user";
        // Fetch the user data
        // $row = mysqli_fetch_assoc($result);
        $db_password = $row['user_password']; // Password stored in the database

        // Verify the password
        if ($user_password === $db_password) {
            // echo "<script>alert('Login Successful')</script>";
            if ($row_count == 1) {
                $_SESSION['username']= $user_username;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            
        } else {
            // Passwords do not match
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        // User with provided username does not exist
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
}
?>