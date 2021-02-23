<?php include "includes/header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
<!--
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>
-->
                            <?php /// echo ucfirst($_SESSION['firstname']); ?>
<!--
                            </small>
                        </h1>
                    </div>
                </div>
-->
                <!-- /.row -->
       
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php
$query = "SELECT * FROM posts";
$all_posts = mysqli_query($connection, $query);
$num_posts = mysqli_num_rows($all_posts);
echo "<div class='huge'>{$num_posts}</div>";
                        
?>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php
$query = "SELECT * FROM comments";
$all_comments = mysqli_query($connection, $query);
$num_comments = mysqli_num_rows($all_comments);
echo "<div class='huge'>{$num_comments}</div>";
                        
?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php
$query = "SELECT * FROM users";
$all_users = mysqli_query($connection, $query);
$num_users = mysqli_num_rows($all_users);
echo "<div class='huge'>{$num_users}</div>";
                        
?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php
$query = "SELECT * FROM categories";
$all_categories = mysqli_query($connection, $query);
$num_categories = mysqli_num_rows($all_categories);
echo "<div class='huge'>{$num_categories}</div>";
                        
?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
<div class="row">
<?php   
$query = "SELECT * FROM posts WHERE post_status='draft'";
$draft_posts = mysqli_query($connection, $query);
$num_draft_posts = mysqli_num_rows($draft_posts);

$query = "SELECT * FROM comments WHERE comment_status='unapproved'";
$draft_comments = mysqli_query($connection, $query);
$num_draft_comments = mysqli_num_rows($draft_comments);
?>  
   
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['', 'Count', 'Non-Active'],
              ['Posts', <?php echo $num_posts; ?>, <?php echo $num_draft_posts; ?>],
              ['Comments', <?php echo $num_comments; ?>, <?php echo $num_draft_comments; ?>],
              ['Users', <?php echo $num_users; ?>, 0],
              ['Categories', <?php echo $num_categories; ?>, 0]
            ]);

            var options = {
              chart: {
                title: '',
                subtitle: '',
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>  
    <div id="columnchart_material" style="width: 'auto'; height: 400px;"></div>




</div>    
                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>
