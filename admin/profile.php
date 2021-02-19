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
        <input type="submit" class="btn btn-primary" name="update_user" value="Update">
    </div> 
</form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>
