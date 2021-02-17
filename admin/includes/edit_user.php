<?php
    if(isset($_GET['edit'])) {
            $get_user_id = $_GET['edit'];
            $query = "SELECT * FROM users WHERE user_id = {$get_user_id} ";
            $edit_user = mysqli_query($connection, $query);
            confirmQuery($edit_user);
            while($row = mysqli_fetch_assoc($edit_user)){
                $get_user_id = $row['user_id'];
                $get_username = $row['username'];
                $get_user_password = $row['user_password'];
                $get_user_firstname = $row['user_firstname'];
                $get_user_lastname = $row['user_lastname'];
                $get_user_email = $row['user_email'];
                $get_user_image = $row['user_image'];
                $get_user_role = $row['user_role'];
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $get_username ?>">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="text" class="form-control" name="user_password" value="<?php echo $get_user_password ?>">
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $get_user_firstname ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $get_user_lastname ?>">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email" value="<?php echo $get_user_email ?>">
    </div>
    <div class="form-group">
        <label for="user_image">Image</label>
        <?php
            echo "<img class='img-responsive' src='../images/{$get_user_image}'>";
?>
        <input type="file" name="user_image">
    </div>  
    <div class="form-group">
        <label for="user_role">Role</label>
        <input type="text" class="form-control" name="user_role" value="<?php echo $get_user_role ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update">
    </div> 
</form>
            
<?php
          }
    }
?> 


<?php
    if(isset($_POST['update_user'])){
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        if(!$_FILES['user_image']['tmp_name']) {
            $user_image = $get_user_image;
        } else {
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];
            move_uploaded_file($user_image_temp, "../images/$user_image");
        }
        $user_role = $_POST['user_role'];
        
        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_image = '{$user_image}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$get_user_id}";
        $insert_user = mysqli_query($connection, $query);
        confirmQuery($insert_user);
        header("Location: users.php?source=edit_user&edit={$get_user_id}");
    }
?>