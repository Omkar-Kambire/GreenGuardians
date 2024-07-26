<?php

include('../../includes/connect.php');

session_start();

if ($_SESSION['userType'] !== 'admin') {
  header("location: index.php");
}



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
      border: 1px solid lightgray;
      border-radius: 10px;
    }

    textarea {
      resize: none;
    }
  </style>
</head>

<body class="bg-light">
  <main class="container ">
    <h1 class="text-center mt-3">Add Category</h1>

    <!-- form -->
    <form method="post" enctype="multipart/form-data">
      <div class="form-outline mb-4 w-50 m-auto">
        <!-- name  -->
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="d-flex align-items-center justify-content-end">
          <div>
            <button type="button" class="btn btn-secondary"><a href="../dashboard.php" class="nav-link text-light">Close</a></button>
            <input type="submit" name="insertCategory" class="btn btn-primary " value="Add Category">
          </div>
        </div>

      </div>
    </form>
  </main>

  <!-- js  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

<?php

$title;
$description;



if (isset($_POST['insertCategory']) && $_SERVER['REQUEST_METHOD'] === "POST") {


  $title = isset($_POST['title']) ? $_POST['title'] : null;
  $description = isset($_POST['description']) ? $_POST['description'] : null;

  if (!$title || !$description || empty($title) || empty($description)) {
    echo "<script>alert('Please fill all the fields')</script>";
    exit();
  }

  $checkIfCategoryExist = mysqli_prepare($conn, "SELECT cTitle from categories WHERE cTitle = ?");
  $checkIfCategoryExist->bind_param("s", $title);
  $checkIfCategoryExist->execute();
  if ($checkIfCategoryExist->get_result()->num_rows === 0) {
    $insertCategory = mysqli_prepare($conn, "INSERT INTO categories (cTitle, cDesc) VALUES (?, ?)");
    $insertCategory->bind_param("ss", $title, $description);
    if ($insertCategory->execute()) {
      echo "<script>alert('Category added successfully!')</script>";
    } else {
      echo "<script>alert('Failed adding a category!')</script>";
    }
    $insertCategory->close();
  } else {
    echo "<script>alert('Category already exists!')</script>";
    $checkIfCategoryExist->close();
  }
}
