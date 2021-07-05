<?php include "./includes/admin_header.php";?>

    <div id="wrapper">

    <?php include "./includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

                        <!-- Add category form -->
                        <div class="col-xs-4">

                            <?php
                            if(isset($_POST['submit'])) {
                                $category_name = $_POST['category_name'];

                                if($category_name == "" || empty($category_name)) {
                                    echo '<p class="text-danger">This field should not be empty</p>';
                                } else {
                                    $query = "INSERT INTO categories(category_name) ";
                                    $query .= "VALUE('{$category_name}')";

                                    $create_category_query = mysqli_query($connection, $query);

                                    echo '<p class="text-success">The category has been added successfully</p>';

                                    if (!$create_category_query) {
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                }
                            }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="category_name">Add Category</label>
                                    <input class="form-control" type="text" name="category_name">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php
                            if(isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                include "./includes/update_categories.php";
                            }
                            ?>
                        </div>

                        <div class="col-xs-8">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // SELECT ALL CATEGORIES
                                $query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_categories)) {
                                    $category_id = $row['category_id'];
                                    $category_name = $row['category_name'];
                
                                    echo "<tr>";
                                    echo "<td>{$category_id}</td>";
                                    echo "<td>{$category_name}</td>";
                                    echo "<td><a href='categories.php?delete={$category_id}'>Delete</td>";
                                    echo "<td><a href='categories.php?edit={$category_id}'>Edit</td>";
                                    echo "</tr>";
                                }
                                ?>

                                <?php
                                // DELETE QUERY
                                if(isset($_GET['delete'])) {
                                    $category_id = $_GET['delete'];
                                    $query = "DELETE FROM categories WHERE category_id = {$category_id} ";
                                    $delete_query = mysqli_query($connection, $query);
                                    header("Location: categories.php");
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php";?>