<?php
// session_start();
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    // var_dump($_SESSION);
    $select_query = "SELECT * from user where user_name='$user_session_name'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_ID'];
    $username = $row_fetch['user_name'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_phone'];
}

if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_phone'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_tmp, "./user_imgs/$user_image");

    // update query
    $update_data = "UPDATE user set user_name='$username', user_email='$user_email',user_pic='$user_image', user_address='$user_address', user_phone='$user_mobile' where user_id=$update_id";
    $result_update_query = mysqli_query($conn, $update_data);
    if (!$result_update_query) {
        echo "<script>alert('Profile updated successfully')</script>";
        // echo "<script>window.open('logout.php','_self')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile</title>
</head>

<body>
    <h3 class="text-center mb-4 mt-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_username" value="<?php echo $username ?>" placeholder="Edit user name">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email ?>" placeholder="Edit user email">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <img src="./user_imgs/<?php echo $user_image ?>" alt="" class="edit_image" placeholder="Edit profile image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address ?>" placeholder="Edit user address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_phone" value="<?php echo $user_mobile ?>" placeholder="Edit user mobile number">
        </div>
        <input type="submit" value="Update" class="btn btn-success" name="user_update">

    </form>
</body>

</html>