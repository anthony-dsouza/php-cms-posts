<div class="col-md-4">
                <!-- Blog Search Well -->
                <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input name="username" type="text" placeholder="Username" class="form-control">
                        </div>
                        <div class="input-group">
                            <input name="password" type="password" placeholder="Password" class="form-control">
                            <span class="input-group-btn">
                               <button class="btn btn-primary" name="login" type="submit">
                                Login
                               </button> 
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                <!-- Blog Categories Well -->
<!--
                <div class="well">
                    <h4>Blog Categories</h4>
                       <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
-->
                <?php      
//                    $query = "SELECT * FROM categories";
//                    $all_categories = mysqli_query($connection, $query);
//                    while($row = mysqli_fetch_assoc($all_categories)){
//                        $cat_id = $row['cat_id'];
//                        $cat_title = $row['cat_title'];
//                        echo "<li><a href='category.php?c_id={$cat_id}'>{$cat_title}</a></li>";
//                    }          
//                                
                ?>    
                                
<!--
                            </ul>
                        </div>
                    </div>
                
                </div>
-->

                <!-- Side Widget Well -->
               <?php //include "widget.php"; ?>
</div>