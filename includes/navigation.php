 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Categories <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                               <?php 
                                $query = "SELECT * FROM categories";
                                $all_categories = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($all_categories)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<li><a href='category.php?c_id={$cat_id}'>{$cat_title}</a></li>";
                                }
                                ?>  
                            </ul>
                        </li>
                     <li>
                        <a href="admin/index.php">Admin</a>
                    </li>
                    
<?php
if(isset($_SESSION['user_role'])) {
    $user_role = $_SESSION['user_role'];
    if($user_role == 'admin' && isset($_GET['p_id'])) {
        $get_p_id = $_GET['p_id'];
        
        echo "<li>";
        echo "<a href='admin/posts.php?source=edit_post&edit={$get_p_id}'>Edit Post</a>";
        echo "</li>";
    }
}                  
                    
                    
?>
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-form pull-right">
                    <li>
                                                    <!-- Blog Search Well -->
                            <!-- Search Form -->
                            <form action="search.php" method="post">
                                <div class="input-group">
                                    <input name="search" type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button name="submit" class="btn btn-default" type="submit">
                                            <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                    </span>
                                </div>
<!--                                 /.input-group -->
                            </form>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            
        </div>
        <!-- /.container -->
    </nav>
