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
                    if(isset($_GET['c_id'])) {
                        $get_cat_id = $_GET['c_id'];
                        $query = "SELECT * FROM posts WHERE post_cat_id = {$get_cat_id}";
                        $posts = mysqli_query($connection, $query);
                        if(!$posts) {
                            die("query failed" . mysqli_error($connection));
                        }
                    }
                    while($row = mysqli_fetch_assoc($posts)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $date_month = date('F',strtotime($post_date));
                            $date_day = date('d',strtotime($post_date));
                            $date_year = date('Y',strtotime($post_date));
                            $date_time = date('h:i A',strtotime($post_date));
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0,100);      
                ?>             
                            <h2>
                            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$date_month} {$date_day}, {$date_year} at {$date_time}" ?></p>
                            <hr>
                            <img class="img-responsive" src='images/<?php echo $post_image ?>' alt="" width="900" height="300">
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="#" ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>
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