<?php
include('../includes/connect.php');

function getCategories()
{
    $table = '
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Operations</th>
                    </tr>
                </thead>
            <tbody>

            ';

    global $conn;
    $getCategories = mysqli_prepare($conn, "SELECT * FROM categories");
    $getCategories->execute();
    $result = $getCategories->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $table .= '<tr>
                    <th scope="row">' . $row['cID'] . '</th>
                    <td>' . $row['cTitle'] . '</td>
                    <td>' . $row['cDesc'] . '</td>
                    <td>
                        <div>
                            <div>
                                <a href="./update/category.php?CategoryId=' . $row['cID'] . '" class=" btn btn-primary">Update</a>
                                <a href="./delete/category.php?CategoryId=' . $row['cID'] . '" class=" btn btn-danger " >Remove</a>
                            </div>
                        </div> 
                    </td>
                    </tr>';
        }
        $table .= '</tbody>
        </table>';

        return $table;
    } else {
        return '<div class="mt-5 ViewProductsDiv"> 
        <h5>No Products Found</h5>
        </div>';
    }
    $getCategories->close();
}




?>


<section class="ViewProductsDiv mx-3 mt-5">
    <?php echo getCategories(); ?>
</section>