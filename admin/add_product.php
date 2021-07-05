<?php include "./includes/admin_header.php";?>


<?php

        $query = "SELECT * FROM categories";
        $select_all_categories_query = mysqli_query($connection, $query);
        $categories = mysqli_fetch_all($select_all_categories_query, MYSQLI_ASSOC);


        $query = "SELECT * FROM materials";
        $select_all_materials_query = mysqli_query($connection, $query);

        $materials = mysqli_fetch_all($select_all_materials_query, MYSQLI_ASSOC);


        $message = 'msg';


    if(isset($_POST['submit'])) {
        // add product to database

        if(!empty($_POST['category'])) {
            $category_id = $_POST['category'];
            echo 'You have chosen the category: ' . $category_id;
        }

        if(!empty($_POST['product_title'])) {
            $product_title = $_POST['product_title'];
            echo 'You have chosen the product_title: ' . $product_title;
        }


        if (isset($_FILES['featured_image'])) {
            // get details of the uploaded file
            $fileTmpPath = $_FILES['featured_image']['tmp_name'];
            $fileName = $_FILES['featured_image']['name'];
            $fileSize = $_FILES['featured_image']['size'];
            $fileType = $_FILES['featured_image']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                // directory in which the uploaded file will be moved
                $uploadFileDir = './images/';
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    $message ='File is successfully uploaded. path: '  . $dest_path;
                }
                else {
                    $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
            } else {
                $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
        }


    }
?>





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

                        <!-- Add product form -->
                        <div class="col-sm-6">

                            

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="product_title">Product title </label>
                                    <input class="form-control" type="text" name="product_title">
                                </div>

                                <div class="form-group">
                                    <label for="product_title">Product title </label>
                                    <input class="form-control" type="text" name="product_title">
                                </div>

                                <div class="form-group">
                                    <label for="product_title">Product title </label>
                                    <input class="form-control" type="text" name="product_title">
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" class="form-control">
                                        <?php foreach($categories as $key => $category ): ?>
                                            <option value="<?php echo $category['category_id']; ?>"> <?php echo $category['category_name']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Material</label>
                                    <select name="material" class="form-control">
                                        <?php foreach($materials as $key => $material ): ?>
                                            <option value="<?php echo $material['material_id']; ?>"> <?php echo $material['material_name']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Featured image</label>
                                    <input type="file" id="exampleInputFile" name="featured_image"> 
                                    <p class="help-block">Upload feature image.</p>
                                </div>

                                <p><?php echo $message; ?> </p>


                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Product">
                                </div>
                            </form>

                            <?php
                            if(isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                include "./includes/update_categories.php";
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php";?>