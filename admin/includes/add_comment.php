<?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_cat_id = $_POST['post_cat_id'];
        $post_author= $_POST['post_author'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_com_count = 4;
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_com_count, post_status) ";
        $query .= "VALUES({$post_cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_com_count}, '{$post_status}'  ) ";
        $insert_post = mysqli_query($connection, $query);
        confirmQuery($insert_post);
        
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <select name="post_cat_id" id="">
            <option selected disabled value=''>Select Category</option>    
<?php           
    $query = "SELECT * FROM categories";
    $select_category = mysqli_query($connection, $query);
    confirmQuery($query);
            while($row = mysqli_fetch_assoc($select_category)){
                $get_cat_id = $row['cat_id'];
                $get_cat_title = $row['cat_title'];
                echo "<option value='{$get_cat_id}'>{$get_cat_title}</option>";
                }
?>         
        </select>
    </div> 
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" name="post_image">
    </div>  
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Add Post">
    </div> 
</form>