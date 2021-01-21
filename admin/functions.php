<?php
    function insertCategory() {
        global $connection;
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
    }

    function getAllCategories() {
        global $connection;
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

 <?php }   
    }

    function deleteCategory() {
        global $connection;
        if(isset($_GET['delete'])) {
            $get_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
            $delete_category = mysqli_query($connection, $query);
            header("Location: categories.php");
        }  
    }

    function editCategory() {    
    ///// edit category                    
        if(isset($_GET['edit'])) {
            global $connection;
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
<?php       }    
        ////// update category
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


    function getAllPosts() {
        global $connection;
        $query = "SELECT * FROM posts";
        $all_posts = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($all_posts)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_cat_id = $row['post_cat_id'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comments = $row['post_com_count'];
            $post_status = $row['post_status'];
?>      
               <tr>
                <td><?php echo $post_id; ?></td>
                <td><?php echo $post_author; ?></td>
                <td><?php echo $post_title; ?></td>
                <td><?php echo $post_cat_id; ?></td>
                <td><?php echo $post_status; ?></td>
                <td><?php echo "<img class='img-responsive' src='../images/{$post_image}'>";?></td>        
                <td><?php echo $post_tags; ?></td>
                <td><?php echo $post_comments; ?></td>
                <td><?php echo $post_date; ?></td>
                <td><?php echo $post_content; ?></td>

                <td><a href="posts.php?delete=<?php echo "{$post_id}"; ?>">Delete</a></td>
<!--                <td><a href="posts.php?edit=<?php echo "{$post_id}"; ?>">Edit</a></td>
-->
            </tr>

 <?php }   
    }

function deletePost() {
        global $connection;
        if(isset($_GET['delete'])) {
            $get_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$get_post_id}";
            $delete_post = mysqli_query($connection, $query);
            header("Location: posts.php");
        }  
    }
?>