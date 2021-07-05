<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Title</th>
            <th>Description</th>
            <th>Short Description</th>
            <th>Category</th>
            <th>Material</th>
            <th>Photo</th>
            <th>Featured</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM products";
            $select_products = mysqli_query($connection, $query);
    
            while($row = mysqli_fetch_assoc($select_products)) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_short_description = $row['product_short_description'];
                $product_category = $row['product_category'];
                $product_material = $row['product_material'];
                $product_featured_photo = $row['product_featured_photo'];
                $product_is_featured = $row['product_is_featured'];

            echo "<tr>";
            echo "<td>$product_id</td>";
            echo "<td>$product_name</td>";
            echo "<td>$product_title</td>";
            echo "<td>$product_description</td>";
            echo "<td>$product_short_description</td>";
            echo "<td>$product_category</td>";
            echo "<td>$product_material</td>";
            echo "<td><img width='100%' src='../images/products/$product_id/$product_featured_photo'></td>";
            echo "<td>$product_is_featured</td>";
            echo "</tr>";
            }
        ?>
    </tbody>
</table>