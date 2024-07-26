<?php
include('../../includes/connect.php');

session_start();

if ($_SESSION['userType'] !== 'admin') {
    header("location: index.php");
}
if (isset($_POST['insertProduct'])) {

    $product_name = $_POST['pName'];
    $product_desc = $_POST['pDesc'];
    $product_keywords = $_POST['pKeywords'];
    $product_cat = $_POST['productCat'];
    // $product_img = $_POST['pPhoto'];
    $product_price = $_POST['pPrice'];
    $product_qty = $_POST['pQuantity'];
    $product_status = 'true';

    //accessing images
    $product_img = $_FILES['pPhoto']['name'];

    //temp image name
    $temp_img = $_FILES['pPhoto']['tmp_name'];
    $destination_folder = "E:/xamppnew/htdocs/GreenGuardians/AdminPanel/prod_imgs/";


    //checking empty fields
    if ($product_name == '' or $product_desc == '' or $product_keywords == '' or $product_cat == '' or $product_price == '' or $product_qty == '' or $product_img == '') {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {
        move_uploaded_file(($temp_img), $destination_folder.$product_img );

        //insert query
        $insert_products = "insert into products (pName,pDesc,pKeywords,cID,pPhoto,pPrice,pQuantity,date,status) values('$product_name','$product_desc','$product_keywords','$product_cat','$product_img','$product_price',$product_qty,NOW(),'$product_status')";
        $result_query = mysqli_query($conn, $insert_products);
        if ($result_query) {
            echo "<script>alert('Successfully inserted!')</script>";
        }
    }
}

function renderCategories()
{
    $options = '';
    global $conn;
    $getCategory = mysqli_prepare($conn, "SELECT * FROM categories");
    $getCategory->execute();
    $res = $getCategory->get_result();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $options .= '<option value=' . $row['cID'] . '>' . $row['cTitle'] . '</option>';
        }
    } else {
        $options .= '<option value="">Currently there are no categories</option>';
    }
    $getCategory->close();
    return $options;
}
$categories = renderCategories();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" class="rel">
    <style>
        body {
            overflow-x: hidden;
        }

        main {
            margin-top: 15vh;
        }
    </style>
</head>

<body class="bg-light">
    <main class="container ">
        <h1 class="text-center">Insert Products</h1>

        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <!-- name  -->
                <label for="productName" class="form-label1 mb-2">Product Name</label>
                <input type="text" name="pName" id="productName" class="form-control mb-2" placeholder="Enter product Name" autocomplete="off" required>
                <!-- desc -->
                <label for="productDesc" class="form-label1 mb-2">Product Description</label>
                <input type="text" name="pDesc" id="productDesc" class="form-control mb-2" placeholder="Enter product Description" autocomplete="off" required>
                <!-- Keywords -->
                <label for="productKeywords" class="form-label1 mb-2">Product Keywords</label>
                <input type="text" name="pKeywords" id="productKeywords" class="form-control mb-2" placeholder="Enter product Keywords" autocomplete="off" required>
                <!-- categories -->
                <label for="productCat" class="form-label1 mb-2">Product Categories</label>
                <select name="productCat" id="" class="form-select mb-2">
                    <option value="">Select Category</option>

                    <?php
                    echo $categories;

                    ?>

                </select>
                <!-- images -->
                <label for="productPhoto" class="form-label1 mb-2">Product Image</label>
                <input type="file" name="pPhoto" id="productPhoto" class="form-control mb-2" required>
                <!-- price  -->
                <label for="productPrice" class="form-label1 mb-2">Product Price</label>
                <input type="text" name="pPrice" id="productPrice" class="form-control mb-2" placeholder="Enter product Price" autocomplete="off" required>
                <!-- quantity -->
                <label for="productQuantity" class="form-label1 mb-2">Product Quantity</label>
                <input type="text" name="pQuantity" id="productQuantity" class="form-control mb-3" placeholder="Enter product Quantity" autocomplete="off" required>
                <!-- button  -->
                <input type="submit" name="insertProduct" class="btn btn-success " value="Insert Product">
                <button type="button" class="btn btn-secondary"><a href="../dashboard.php" class="nav-link text-light">Close</a></button>

            </div>
        </form>
    </main>

    <!-- js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>