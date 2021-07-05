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

                        <!-- Add material form -->
                        <div class="col-xs-4">

                            <?php
                            if(isset($_POST['submit'])) {
                                $material_name = $_POST['material_name'];

                                if($material_name == "" || empty($material_name)) {
                                    echo '<p class="text-danger">This field should not be empty</p>';
                                } else {
                                    $query = "INSERT INTO materials(material_name) ";
                                    $query .= "VALUE('{$material_name}')";

                                    $create_material_query = mysqli_query($connection, $query);

                                    echo '<p class="text-success">The material has been added successfully</p>';

                                    if (!$create_material_query) {
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                }
                            }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="material_name">Add Material</label>
                                    <input class="form-control" type="text" name="material_name">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Material">
                                </div>
                            </form>

                            <?php
                            if(isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                include "./includes/update_materials.php";
                            }
                            ?>
                        </div>

                        <div class="col-xs-8">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Material</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // SELECT ALL MATERIALS
                                $query = "SELECT * FROM materials";
                                $select_materials = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_materials)) {
                                    $material_id = $row['material_id'];
                                    $material_name = $row['material_name'];
                
                                    echo "<tr>";
                                    echo "<td>{$material_id}</td>";
                                    echo "<td>{$material_name}</td>";
                                    echo "<td><a href='materials.php?delete={$material_id}'>Delete</td>";
                                    echo "<td><a href='materials.php?edit={$material_id}'>Edit</td>";
                                    echo "</tr>";
                                }
                                ?>

                                <?php

                                // DELETE QUERY
                                if(isset($_GET['delete'])) {
                                    $material_id = $_GET['delete'];
                                    $query = "DELETE FROM materials WHERE material_id = {$material_id} ";
                                    $delete_query = mysqli_query($connection, $query);
                                    header("Location: materials.php");
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