<?php include "includes/header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Author</small>
                        </h1>
                        <!-- Add category form -->
                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add">
                                </div>
                            </form>
                            
                                    
               <?php                                     // edit category                    
                    if(isset($_GET['edit'])) {
                        $get_cat_id = $_GET['edit'];
                        $query = "SELECT * FROM categories WHERE cat_id = {$get_cat_id} ";
                        $edit_category = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($edit_category)){
                            $edit_cat_id = $row['cat_id'];
                            $edit_cat_title = $row['cat_title']; 
                ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Edit Category</label>
                                    <input value="<?php echo $edit_cat_title; ?>" class="form-control" type="text" name="update_cat_title">
                                    </div>
                                    <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                                </div>
                            </form>  
                <?php       // update category
                            if(isset($_POST['update'])) {
                                $update_cat_title = $_POST['update_cat_title'];
                                if($update_cat_title == "" || empty($update_cat_title)){
                                    echo "This field should not be empty";
                                } else {
                                    $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = {$edit_cat_id}";
                                    $update_category = mysqli_query($connection, $query);
                                    if(!$update_category) {
                                        die("Query Failed" . mysqli_error($connection));
                                    }
                                    header("Location: categories.php");
                                }
                            }
                        }
                    }
                ?>
                                    
                            <div>
                                <p>
<?php 
                                    // fucntion to add new category
                                    if(isset($_POST['submit'])){
                                        $cat_title = $_POST['cat_title'];
                                        if($cat_title == "" || empty($cat_title)){
                                            echo "This field should not be empty";
                                        } else {
                                            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
                                            $add_category = mysqli_query($connection, $query);
                                            if(!$add_category) {
                                                die("Query Failed" . mysqli_error($connection));
                                            }
                                        }
                                    }
?>   
                                </p>
                            </div>   
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                <?php // category table data 
                    $query = "SELECT * FROM categories";
                    $all_categories = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($all_categories)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title']; 
                ?>
                                    <tr>
                                        <td><?php echo $cat_id; ?></td>
                                        <td><?php echo $cat_title; ?></td>
                                        <td><a href="categories.php?delete=<?php echo "{$cat_id}"; ?>">Delete</a></td>
                                        <td><a href="categories.php?edit=<?php echo "{$cat_id}"; ?>">Edit</a></td>
                                    </tr>
                                    
                <?php } ?>
                <?php
                  // delete category
                    if(isset($_GET['delete'])) {
                        $get_cat_id = $_GET['delete'];
                        $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
                        $delete_category = mysqli_query($connection, $query);
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
<?php include "includes/footer.php"; ?>
