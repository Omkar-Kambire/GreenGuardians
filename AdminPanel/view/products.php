<?php
include('../includes/connect.php');

function getProducts()
{
    $table = '
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Operations</th>
                    </tr>
                </thead>
            <tbody>

            ';

    global $conn;
    $getProducts = mysqli_prepare($conn, "SELECT * FROM products");
    $getProducts->execute();
    $result = $getProducts->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $table .= '<tr>
                    <th scope="row">' . $row['pID'] . '</th>
                    <td>' . $row['pName'] . '</td>
                    <td>' . $row['pPrice'] . '/-</td>
                    <td>' . $row['pQuantity'] . '</td>
                    <td>
                        <div>
                            <div>
                                <a href="./update/product.php?ProductId=' . $row['pID'] . '" class=" btn btn-primary">Update</a>
                                <a href="./delete/product.php?ProductId=' . $row['pID'] . '" class=" btn btn-danger " >Remove</a>
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
    $getProducts->close();
}




?>


<section class="ViewProductsDiv mx-3 mt-5">
    <?php echo getProducts(); ?>
</section>