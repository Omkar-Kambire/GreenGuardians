<?php
session_start();
include('../../includes/connect.php');  // connect to database

if (!isset($_SESSION['userId'])) {
    header("Location: user_login.php");
}




$categoryId = isset($_GET['CategoryId']) ? intval($_GET['CategoryId']) : null;

function getCategory()
{
    global $categoryId, $conn;
    if (!$categoryId) {
        echo '<script>alert("Invalid Product Id")</script>';
        echo "<script>window.open('../index.php','_self')</script>";
    }

    $item = mysqli_prepare($conn, "SELECT * FROM categories WHERE cID = ?");
    $item->bind_param("i", $categoryId);
    $item->execute(); // Execute the prepared statement
    $res = $item->get_result()->fetch_assoc();
    $item->close();
    return $res;
}

$data = getCategory();




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

        /* Style to make the text input look like a textarea */
        .textarea {
            white-space: pre-wrap;
            width: 100%;
            text-align: left;
            overflow-y: auto;
            overflow-x: auto;
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
                <label for="title" class="form-label1 mb-2">Title</label>
                <input type="text" name="title" value="<?php echo $data['cTitle'] ?>" id="title" class="form-control mb-2" placeholder="Enter product Name" autocomplete="off" required>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" value="<?php echo $data['cDesc'] ?>" id="description" class="form-control mb-2 textarea" placeholder="Enter product Name" autocomplete="off" required>

                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <div>
                        <button type="button" class="btn btn-secondary"><a href="../dashboard.php" class="nav-link text-light">Close</a></button>
                        <input type="submit" name="updateCategory" class="btn btn-primary " value="Insert Product">
                    </div>
                </div>

            </div>
        </form>
    </main>
</body>

</html>


<?php
$title;
$description;

if (isset($_POST['updateCategory'])) {
    $title = trim(mysqli_real_escape_string($conn, $_POST['title']));
    $description = trim(mysqli_real_escape_string($conn, $_POST['description']));
    $updateCategory = mysqli_prepare($conn, "UPDATE categories SET cTitle = ?, cDesc = ? WHERE cID = ?");
    $updateCategory->bind_param("ssi", $title, $description, $categoryId);;
    if ($updateCategory->execute()) {
        echo '<script>alert("Updated Successfully");</script>';
    } else {
        echo '<script>alert("Failed to Update the Category");</script>';
    }
    $updateCategory->close();
}
