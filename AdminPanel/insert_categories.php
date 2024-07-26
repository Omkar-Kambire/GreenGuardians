<?php
include('../includes/connect.php');
if (isset($_POST['insert_cat'])) {
  $category_title = $_POST['catTitle'];
  $category_desc =  $_POST['catDesc'];

  //select data from db
  $select_query = "select * from categories where cTitle ='$category_title'";
  $result_select = mysqli_query($conn, $select_query);
  $number = mysqli_num_rows($result_select);
  if ($number > 0) {
    echo "<script>alert('Category already exists!')</script>";
  } else {
    $insert_query = "insert into categories (cTitle,cDesc) values ('$category_title','$category_desc') ";
    $result = mysqli_query($conn, $insert_query);
    if ($result) {
      echo "<script>alert('Category Inserted Successfully')</script>";
    }
  }
}
?>

<!-- <form action="" method="post" class="mb-2">
    <div class="input-group w-50 mb-2">
        <span class="input-group-text bg-info"><i class="fa-solid fa-receipt"></i></span>
            <input type="text" class="form-control" name="catTitle"  id="floatingInputGroup1" placeholder="Insert Category">
    </div>
    <div class="input-group w-10 mb-2">
            <input type="submit" class="form-control bg-info" name="insert_cat" value="Insert Catergories" placeholder="Insert Category">
            <button type="button" class="btn btn-success">Insert Category</button>

    </div>

</form> -->
<div class="container-fluid p-0" style="text-align: center;">
<h2>Insert Categories</h2>
  <form action="" method="post" class=" container-fluid p-0 mb-2 w-50">
    <div class="mb-3">
      <input type="text" class="form-control" id="exampleInputEmail1" name="catTitle" aria-describedby="emailHelp" placeholder="Enter Category Name" autocomplete="off">
      <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <div class="mb-3">
      <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
      <textarea style="height: 100px;" class="form-control" name="catDesc" placeholder="Enter Category Description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="insert_cat" value="Insert categories">Submit</button>
    <!-- <button type="button" class="btn btn-secondary" data-dismiss="form">Close</button> -->

  </form>
</div>