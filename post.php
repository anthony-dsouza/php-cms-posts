<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
                <h1 class="page-header">
                    Anthony D'Souza's
                    <small>DevJourney</small>
                </h1>
                
                <!-- First Blog Post -->
                <?php
                    if(isset($_GET['p_id'])) {
                        $get_post_id = $_GET['p_id'];
                        $query = "SELECT * FROM posts WHERE post_id = {$get_post_id}";
                        $posts = mysqli_query($connection, $query);
                        if(!$posts) {
                            die("query failed" . mysqli_error($connection));
                        } 
                    }
                    
                    while($row = mysqli_fetch_assoc($posts)){
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $date_month = date('F',strtotime($post_date));
                            $date_day = date('d',strtotime($post_date));
                            $date_year = date('Y',strtotime($post_date));
                            $date_time = date('h:i A',strtotime($post_date));
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];      
                ?>             
                            <h2>
                            <a href=""><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$date_month} {$date_day}, {$date_year} at {$date_time}" ?></p>
                            <hr>
                            <img class="img-responsive" src='images/<?php echo $post_image ?>' alt="" width="900" height="300">
                            <hr>
                            <p><?php echo $post_content ?></p>

                            <hr>
                        <?php } ?>
                
                                <!-- Blog Comments -->

                                <!-- Comments Form -->
                <?php
    if(isset($_POST['submit'])){
            $comment_email = $_POST['comment_email'];
            $comment_author = $_POST['comment_author'];
            $comment_post_id = $get_post_id;
            $comment_content = $_POST['comment_content'];
            $comment_status = "approved";
        
        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ){
            $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_date, comment_content, comment_status) ";
            $query .= "VALUES({$comment_post_id}, '{$comment_author}', '{$comment_email}', now(), '{$comment_content}', '{$comment_status}'  ) ";
            $insert_comment = mysqli_query($connection, $query);
            if(!$insert_comment) {
                die("query failed" . mysqli_error($connection));
            }
    //        $query = "UPDATE posts SET post_com_count = post_com_count + 1 WHERE post_id = {$comment_post_id}";
    //        $update_post_com_count = mysqli_query($connection, $query);
    //        confirmQuery($update_post_com_count);
        } else {
            echo "<script>alert('Fields cannot be empty')</script>";
        }
        
        
    }
?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="comment_author" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="comment_email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content" placeholder="Comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = {$get_post_id} AND comment_status='approved'";
            $query .= "ORDER BY comment_id DESC";
            $post_comments = mysqli_query($connection, $query);
            confirmQuery($post_comments);
            while($row = mysqli_fetch_assoc($post_comments)){
                $comment_id = $row['comment_id'];
                $comment_email = $row['comment_email'];
                $comment_author = $row['comment_author'];
                $comment_post_id = $row['comment_post_id'];
                ///// display post_title instead of comment_post_id
                    $query1 = "SELECT post_title FROM posts WHERE post_id = {$comment_post_id}";
                    $post_title_query = mysqli_query($connection, $query1);
                    confirmQuery($post_title_query);
                    $row1 = mysqli_fetch_assoc($post_title_query);
                $post_title = $row1['post_title'];
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                
?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>
                
                <!-- Comment -->
<!--
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
-->
                        <!-- Nested Comment -->
<!--
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
-->
                        <!-- End Nested Comment -->
<!--
                    </div>
                </div>
-->
                <?php   
                    }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>