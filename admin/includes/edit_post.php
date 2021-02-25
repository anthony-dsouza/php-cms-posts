<?php
    if(isset($_GET['edit'])) {
            $get_post_id = $_GET['edit'];
            $query = "SELECT * FROM posts WHERE post_id = {$get_post_id} ";
            $edit_post = mysqli_query($connection, $query);
            confirmQuery($edit_post);
            while($row = mysqli_fetch_assoc($edit_post)){
                $get_post_id = $row['post_id'];
                $get_post_title = $row['post_title'];
                $get_post_author = $row['post_author'];
                $get_post_cat_id = $row['post_cat_id'];
                $get_post_date = $row['post_date'];
                $get_post_image = $row['post_image'];
                $get_post_content = $row['post_content'];
                $get_post_tags = $row['post_tags'];
                $get_post_status = $row['post_status'];
            }
    }
?>
<?php
    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_cat_id = $_POST['post_cat_id'];
        $post_author= $_POST['post_author'];
        $post_date= $_POST['post_date'];
        $post_status = $_POST['post_status'];
        if(!$_FILES['post_image']['tmp_name']) {
            $post_image = $get_post_image;
        } else {
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            move_uploaded_file($post_image_temp, "../images/$post_image");
        }
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = $_POST['post_date'];
        
        $query = "UPDATE posts SET ";
        $query .= "post_cat_id = '{$post_cat_id}', ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_date = '{$post_date}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}' ";
        $query .= "WHERE post_id = {$get_post_id}";
        $update_post = mysqli_query($connection, $query);
        confirmQuery($update_post);
        echo "<div class='bg-success'>";
        echo "<div class=''>";
        echo "<p>Post Updated</p>";
        echo "</div>";
        echo "<div class=''>";
        echo "<a href='./posts.php'>View All Posts</a> or <a href='../post.php?p_id={$get_post_id}'>View Post</a></p>";
        echo "</div>";
        echo "</div>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $get_post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <select name="post_cat_id" id="post_cat_id">
<?php           
    $query = "SELECT * FROM categories";
    $select_category = mysqli_query($connection, $query);
    confirmQuery($query);
            while($row = mysqli_fetch_assoc($select_category)){
                $get_cat_id = $row['cat_id'];
                $get_cat_title = $row['cat_title'];
                if($get_cat_id == $get_post_cat_id){
                    echo "<option value='{$get_cat_id}' selected='selected'>{$get_cat_title}</option>";
                } else {
                    echo "<option value='{$get_cat_id}'>{$get_cat_title}</option>";
                }
            }           
?>      
        </select>
    </div> 
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $get_post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_date">Post Date</label>
        <input value="<?php echo $get_post_date; ?>" type="text" class="form-control" name="post_date">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <div class="form-group">
        <select name="post_status" id="post_status">
            <option value='<?php echo $get_post_status; ?>' selected='selected'><?php echo ucfirst($get_post_status); ?></option>
            <?php
            if($get_post_status == 'draft'){
                echo "<option value='published'>Published</option>";
            } else {
             echo "<option value='draft'>Draft</option>";
            }
                
            ?>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label for="post_image">Image</label>
        <?php
                echo "<img class='img-responsive' src='../images/{$get_post_image}'>";
?>
        <div class="form-group">     
        <input type="file" name="post_image">
        </div>
    </div>  
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $get_post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $get_post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update">
    </div> 
</form>


