<?php include "includes/header.php"; ?>
    
<?php
if(isset($_SESSION['username'])) {
    
    $username = $_SESSION['username'];
    
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user = mysqli_query($connection, $query);
    confirmQuery($select_user);
    
    while($row = mysqli_fetch_assoc($select_user)){
            $get_user_id = $row['user_id'];
            $get_username = $row['username'];
            $get_user_password = $row['user_password'];
            $get_user_firstname = $row['user_firstname'];
            $get_user_lastname = $row['user_lastname'];
            $get_user_email = $row['user_email'];
            $get_user_image = $row['user_image'];
            $get_user_role = $row['user_role'];
    }
}

?>
    
    
    

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
                            <small><?php echo ucfirst($_SESSION['firstname']); ?></small>
                        </h1>                                
                   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $get_username ?>">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $get_user_password ?>">
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
        <label for="user_role">Role</label>
        <select class="form-control" name="user_role" id="">
            <option selected value='<?php echo $get_user_role ?>'><?php echo ucfirst($get_user_role) ?></option>
            <?php
            //// if statement to not include selected option
            if($get_user_role === 'admin') {
                echo "<option value='subscriber'>Subscriber</option>";    
            } else {
                echo "<option value='admin'>Admin</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="user_image">Image</label>
        <?php
            echo "<img class='img-responsive' src='../images/{$get_user_image}'>";
?>
        <input type="file" name="user_image">
    </div>  
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
    </div> 
</form>
   <?php
    if(isset($_POST['update_profile'])){
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
        //update database
        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_image = '{$user_image}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$get_user_id}";
        $update_profile = mysqli_query($connection, $query);
        confirmQuery($update_profile);
        
        //update session
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['user_role'] = $user_role;
        header("Location: profile.php");
    }
?>                
                   
                   
                   
                   
                   
                   
                   
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>
