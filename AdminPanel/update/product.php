<?php
session_start();
include('../../includes/connect.php');  // connect to database

if (!isset($_SESSION['userId'])) {
    header("Location: user_login.php");
}




$productId = isset($_GET['ProductId']) ? intval($_GET['ProductId']) : null;

function getProductDetails()
{
    global $productId, $conn;
    if (!$productId) {
        echo '<script>alert("Invalid Product Id")</script>';
        echo "<script>window.open('../index.php','_self')</script>";
    }

    $item = mysqli_prepare($conn, "SELECT * FROM products WHERE pId = ?");
    $item->bind_param("i", $productId);
    $item->execute(); // Execute the prepared statement
    $res = $item->get_result()->fetch_assoc();
    $item->close();
    return $res;
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
$data = getProductDetails();

function getTheDefaultCategory()
{
    global $conn, $data;
    $id = intval($data['cID']);
    $result = '';
    $getCategory = mysqli_prepare($conn, "SELECT cTitle FROM categories WHERE cID = ?");
    $getCategory->bind_param("i", $id);
    $getCategory->execute();
    $res = $getCategory->get_result();
    if ($res->num_rows > 0) {
        $result = $res->fetch_assoc();
        return  $result['cTitle'];
    } else {
        $result .= "No Category Found";
        return   $result;
    }
}


$defaultCategory = getTheDefaultCategory();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            height: 100vh;
            width: 100vw;
        }

        main {
            margin-top: 10vh;
            border: 1px solid lightgray;
            width: 35rem;
            padding: 1rem;
            border-radius: 10px;
        }

        .ButtonDiv {
            width: 60%;
            margin-left: 40%;
            display: flex;
            align-items: center;
            justify-content: end;
            gap: 1rem;
        }
    </style>
</head>


<body class="  py-4 bg-body-tertiary">


    <main class="container ">
        <h1 class="text-center">Update Products</h1>

        <!-- form -->
        <form method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <!-- name  -->
                <label for="productName" class="form-label1 mb-2">Product Name</label>
                <input type="text" name="pName" value="<?php echo $data['pName'] ?>" id="productName" class="form-control mb-2" placeholder="Enter product Name" autocomplete="off" required>
                <!-- desc -->
                <label for="productDesc" class="form-label1 mb-2">Product Description</label>
                <input type="text" name="pDesc" value="<?php echo $data['pDesc'] ?>" id="productDesc" class="form-control mb-2" placeholder="Enter product Description" autocomplete="off" required>
                <!-- Keywords -->
                <label for="productKeywords" class="form-label1 mb-2">Product Keywords</label>
                <input type="text" name="pKeywords" value="<?php echo $data['pKeywords'] ?>" id="productKeywords" class="form-control mb-2" placeholder="Enter product Keywords" autocomplete="off" required>
                <!-- categories -->
                <label for="productCat" class="form-label1 mb-2">Product Categories</label>
                <select name="productCat" id="" class="form-select mb-2">
                    <option value="<? echo $data['cID']; ?>"><?php echo $defaultCategory; ?> (default)</option>
                    <?php
                    echo $categories;
                    ?>
                </select>
                <!-- images -->
                <label for="productPhoto" class="form-label1 mb-2">Product Image</label>
                <input type="file" name="pPhoto" value="<?php echo $data['pPhoto'] ?>" id="productPhoto" class="form-control mb-2" required>
                <!-- price  -->
                <label for="productPrice" class="form-label1 mb-2">Product Price</label>
                <input type="text" name="pPrice" value="<?php echo $data['pPrice'] ?>" id="productPrice" class="form-control mb-2" placeholder="Enter product Price" autocomplete="off" required>
                <!-- quantity -->
                <label for="productQuantity" class="form-label1 mb-2">Product Quantity</label>
                <input type="text" name="pQuantity" value="<?php echo $data['pQuantity'] ?>" id="productQuantity" class="form-control mb-3" placeholder="Enter product Quantity" autocomplete="off" required>
                <!-- button  -->
                <div class="ButtonDiv">
                    <div>
                        <a href="../index.php" class="btn btn-secondary text-light">Close</a>
                        <input type="submit" name="updateProduct" class="btn btn-primary " value="Update Product">
                    </div>
                </div>

            </div>
        </form>
    </main>
</body>

</html>


<?php
if (isset($_POST['updateProduct'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['pName']);
    $product_desc = mysqli_real_escape_string($conn, $_POST['pDesc']);
    $product_keywords = mysqli_real_escape_string($conn, $_POST['pKeywords']);
    $product_cat = mysqli_real_escape_string($conn, $_POST['productCat']);
    $product_price = mysqli_real_escape_string($conn, $_POST['pPrice']);
    $product_qty = mysqli_real_escape_string($conn, $_POST['pQuantity']);
    $product_status = 'true';

    //accessing images
    $product_img = $_FILES['pPhoto']['name'];


    //temp image name
    $temp_img = $_FILES['pPhoto']['tmp_name'];


    //checking empty fields
    if ($product_name == '' or $product_desc == '' or $product_keywords == '' or $product_cat == '' or $product_price == '' or $product_qty == '' or $product_img == '') {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {

        $destination_folder = "E:/xamppnew/htdocs/GreenGuardians/AdminPanel/prod_imgs/";

        // Check if the file was successfully uploaded
        move_uploaded_file($temp_img, $destination_folder . $product_img);
     
        echo $productId;
        // Update query
        $update_products = "UPDATE products SET pName = ?,  pDesc = ?, pKeywords = ?, cID = ?, pPhoto = ?, pPrice = ?, pQuantity = ?, status = ? WHERE pID = ?";
        $stmt = mysqli_prepare($conn, $update_products);
    $stmt->bind_param("sssisiibi",$product_name, $product_desc, $product_keywords, $product_cat, $product_img, $product_price, $product_qty, $product_status, $productId);

        if ($stmt->execute()) {
            echo "<script>alert('Successfully updated!')</script>";
        } else {
            echo "<script>alert('Failed to update')</script>";
        }
        mysqli_stmt_close($stmt);
    }
}
