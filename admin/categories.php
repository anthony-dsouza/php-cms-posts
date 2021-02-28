<?php include "includes/header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
<!--
                        <h1 class="page-header">
                            Welcome
                            <small>Author</small>
                        </h1>
-->
                        <!-- Add category form -->
                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add">
                                </div>
                            </form>                                  
<?php
    /////edit and update
    editCategory();
                            
?>
                            <div>
                                <p>
<?php  
    /////add new category
    insertCategory();
?>   
                                </p>
                            </div>   
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php 
    ///// category table data 
    getAllCategories();                    

    ///// delete category
    deleteCategory();
?>                                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>
