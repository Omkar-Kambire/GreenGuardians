<!-- connection  -->
<?php
session_start();
include('../includes/connect.php');  // connect to database
include('../functions/common_functions.php'); //get products


if (isset($_SESSION['name']) && $_SESSION['userType'] === 'admin') {
    header("location: dashboard.php");
}

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

        main {
            margin-top: 25vh;
        }
    </style>
</head>

<body>
    <main class="container mainDiv ">
        <div class="row mt-3">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-body px-5">
                        <div class="container text-center">
                        </div>
                        <h3 class="text-center my-3 mb-5">Admin Login</h3>
                        <form action="" method="post">
                            <div class="form-group mb-2">
                                <label for="email" class="mb-2">Email</label>
                                <input name="email" type="text" class="form-control" id="email" placeholder="Enter here" aria-describedby="emailHelp" required title="Only letters and numbers are allowed in the username" autocomplete="off">
                            </div>
                            <div class="form-group mb-2">
                                <label for="password" class="mb-2"> Password</label>
                                <input name="password" type="password" minlength="6" class="form-control" id="password" placeholder="Enter here" aria-describedby="emailHelp" required pattern="^\S*$" title="Spaces are not allowed in the password">
                            </div>
                            <div class="mb-2 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" onchange="togglePasswordVisibility()">
                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            </div>
                            <div class="container text-center mb-3">
                            <button type="button" class="btn btn-secondary"><a href="..//index.php" class="nav-link text-light">Close</a></button>
                                <input type="submit" value="Login" class="btn btn-success" name="adminLogin">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <!-- js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminEmail;
    $adminPassword;

    if (isset($_POST['adminLogin'])) {
        $adminEmail  = mysqli_escape_string($conn, $_POST['email']);
        $adminPassword  = mysqli_escape_string($conn, $_POST['password']);
        $userType = "admin";


        $getAdminDetails = mysqli_prepare($conn, "SELECT user_ID, user_password, user_name, user_type, user_email FROM user WHERE user_email = ? AND user_type = ?");
        $getAdminDetails->bind_param("ss", $adminEmail, $userType);
        $getAdminDetails->execute();
        $data = mysqli_fetch_assoc($getAdminDetails->get_result());

        if (!$data || empty($data)) {
            echo "<script>alert('User Doesn't Exist')</script>";
        }

        if (empty($adminEmail) || empty($adminPassword)) {
            echo "<script>alert('Please fill all the fields')</script>";
        }

        if ($adminPassword !== $data['user_password']) {
            echo "<script>alert('Wrong Password')</script>";
        } else {
            session_start();
            $_SESSION['name'] = $data['user_name'];
            $_SESSION['email'] = $data['user_email'];
            $_SESSION['userType'] = $data['user_type'];
            $_SESSION['userId'] = $data['user_ID'];
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('./dashboard.php','_self')</script>";
        }
    }
}

?>