<?php

    function confirmQuery($result) {
        global $connection;
        if(!$result) {
            die("Query Failed " . mysqli_error($connection));
        }   
    }
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
        ///// updates post_com_count column
        //// could get slow loading if database has many rows. 
        ////you can also implement by increasing and reducing column value when adding and deleting respectfully
        $query = "UPDATE posts SET post_com_count = (SELECT COUNT(*) FROM comments WHERE comment_post_id = posts.post_id AND comment_status = 'approved')";
        $update_post_com_count = mysqli_query($connection, $query);
        confirmQuery($update_post_com_count);
        
        
        $query = "SELECT * FROM posts";
        $all_posts = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($all_posts)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_cat_id = $row['post_cat_id'];
            ///// display cat_title instead of cat_id
                $query1 = "SELECT cat_title FROM categories WHERE cat_id = {$post_cat_id}";
                $cat_title_query = mysqli_query($connection, $query1);
                confirmQuery($cat_title_query);
                $row1 = mysqli_fetch_assoc($cat_title_query);
            $cat_title = $row1['cat_title'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            
            $post_comments = $row['post_com_count'];
            $post_status = $row['post_status'];
?>      
               <tr>
                <td><input class="checkBoxes" type="checkbox" name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td>
                <td><?php echo $post_id; ?></td>
                <td><?php echo $post_author; ?></td>
                <td><a href="../post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a></td>
                <td><?php echo $cat_title; ?></td>
                <td><?php echo $post_status; ?></td>
                <td><?php echo "<img class='img-responsive' width='90' src='../images/{$post_image}'>";?></td>        
                <td><?php echo $post_tags; ?></td>
                <td><?php echo $post_comments; ?></td>
                <td><?php echo $post_date; ?></td>
<!--                <td><?php echo $post_content; ?></td>-->
                <td><a href="posts.php?source=edit_post&edit=<?php echo "{$post_id}"; ?>">Edit</a></td>
                <td><a href="posts.php?delete=<?php echo "{$post_id}"; ?>">Delete</a></td>
                

            </tr>

 <?php }   
    }

    function deletePost() {
            global $connection;
            if(isset($_GET['delete'])) {
                $get_post_id = $_GET['delete'];
                $query = "DELETE FROM posts WHERE post_id = {$get_post_id}";
                $delete_post = mysqli_query($connection, $query);
                $query = "DELETE FROM comments WHERE comment_post_id = {$get_post_id}";
                $delete_comments = mysqli_query($connection, $query);
                header("Location: posts.php");
            }  
        }

    function getAllComments() {
        global $connection;
        $query = "SELECT * FROM comments";
        $all_comments = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($all_comments)){
            $comment_id = $row['comment_id'];
            $comment_email = $row['comment_email'];
            $comment_author = $row['comment_author'];
            $comment_post_id = $row['comment_post_id'];
            ///// display post_title instead of comment_post_id
                $query1 = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                $post_title_query = mysqli_query($connection, $query1);
                confirmQuery($post_title_query);
                $row1 = mysqli_fetch_assoc($post_title_query);
            /// for when a post gets deleted
                if($row1 == null){
                    $post_title = "Post no longer exists";
                    $post_id = 'na';
                } else {
                    $post_title = $row1['post_title'];
                    $post_id = $row1['post_id'];
                }
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
?>      
               <tr>
                <td><?php echo $comment_id; ?></td>
                <td><?php 
            ////// when posts are deleted
            if($post_id == 'na'){
                echo $post_title;  
            } else {
                echo "<a href='../post.php?p_id={$post_id}'>{$post_title}</a>";
            }       
                    
                    ?></td>
                <td><?php echo $comment_author; ?></td>
                <td><?php echo $comment_email; ?></td>
                <td><?php echo $comment_status; ?></td>       
                <td><?php echo $comment_date; ?></td>
                <td><?php echo $comment_content; ?></td>
                <td><a href="comments.php?approve=<?php echo "{$comment_id}"; ?>" >Approve</a></td>
                <td><a href="comments.php?unapprove=<?php echo "{$comment_id}"; ?>">Unapprove</a></td>
                <td><a href="comments.php?delete=<?php echo "{$comment_id}"; ?>">Delete</a></td>

            </tr>

<?php }   
    }

    function deleteComment() {
        global $connection;
        if(isset($_GET['delete'])) {
            $get_comment_id = $_GET['delete'];
            $query = "DELETE FROM comments WHERE comment_id = {$get_comment_id}";
            $delete_comment = mysqli_query($connection, $query);
            header("Location: comments.php");
        }  
    }

    function approveComment() {
        global $connection;
        if(isset($_GET['approve'])) {
            $get_comment_id = $_GET['approve'];
            $query = "UPDATE comments SET comment_status='approved' WHERE comment_id = {$get_comment_id}";
            $approve_comment = mysqli_query($connection, $query);
            header("Location: comments.php");
        }  
    }

    function unapproveComment() {
        global $connection;
        if(isset($_GET['unapprove'])) {
            $get_comment_id = $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = {$get_comment_id}";
            $unapprove_comment = mysqli_query($connection, $query);
            header("Location: comments.php");
        }  
    }

    function getAllUsers() {
        global $connection;
        $query = "SELECT * FROM users";
        $all_users = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($all_users)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $randSalt = $row['randSalt'];
?>      
               <tr>
                <td><?php echo $user_id; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $user_password; ?></td>
                <td><?php echo $user_firstname; ?></td>
                <td><?php echo $user_lastname; ?></td>
                <td><?php echo $user_email; ?></td>
                <td><?php echo "<img class='img-responsive' width='90' src='../images/{$user_image}'>";?></td>        
                <td><?php echo $user_role; ?></td>
                <td><a href="users.php?source=edit_user&edit=<?php echo "{$user_id}"; ?>">Edit</a></td>
                <td><a href="users.php?change=<?php echo "{$user_id}"; ?>">Switch</a></td>
                <td><a href="users.php?delete=<?php echo "{$user_id}"; ?>">Delete</a></td>
                

            </tr>

 <?php }
    }

    function deleteUser() {
        global $connection;
        if(isset($_GET['delete'])) {
            $get_user_id = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = {$get_user_id}";
            $delete_user = mysqli_query($connection, $query);
            header("Location: users.php");
        }  
    }
    
    function changeUserRole() {
        global $connection;
        if(isset($_GET['change'])) {
            $get_user_id = $_GET['change'];
            $query = "SELECT user_role FROM users WHERE user_id = {$get_user_id}";
            $get_user_role = mysqli_query($connection, $query);
            $user_role = mysqli_fetch_assoc($get_user_role)['user_role'];
            if($user_role === 'admin') {
                $new_role = 'subscriber';
            } else {
                $new_role = 'admin';
            }
            $query = "UPDATE users SET user_role='{$new_role}' WHERE user_id = {$get_user_id}";
            $update_role = mysqli_query($connection, $query);
            header("Location: users.php");
        }  
    }
    
?>