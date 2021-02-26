                            <!--  post table -->
<?php                          
if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $checkBoxValue) {
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options) {
            case 'published':
                
                $query = "UPDATE posts SET post_status='published' WHERE post_id={$checkBoxValue}";
                $publish_query = mysqli_query($connection, $query);
                confirmQuery($publish_query);
                
                break;
            case 'draft':
                
                $query = "UPDATE posts SET post_status='draft' WHERE post_id={$checkBoxValue}";
                $draft_query = mysqli_query($connection, $query);
                confirmQuery($draft_query);
                
                break;
            case 'delete':
                
                $query = "DELETE FROM posts WHERE post_id={$checkBoxValue}";
                $delete_query = mysqli_query($connection, $query);
                confirmQuery($delete_query);    
                
                break;
        }
    }
}                           
                            
?>
                        <form action="" method="post">
                            <table class="table table-bordered table-hover table-responsive">
                               
                                <div id="bulkOptionContainer" class="col-xs-4">
                                   <select class="form-control" name="bulk_options" id="">
                                       <option value="">Select Options</option>
                                       <option value="published">Publish</option>
                                       <option value="draft">Draft</option>
                                       <option value="delete">Delete</option>    
                                   </select>
                               </div>
                               <div class="col-xs-4">
                                   <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                   <a href="add_post.php" class="btn btn-primary">Add New</a>
                                   
                               </div>
                               
                               
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllBoxes"></th>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
<!--                                        <th>Content</th>-->
                                    </tr>
                                </thead>
                                <tbody>
<?php 
    ///// posts table data 
    getAllPosts();      
    deletePost();
?>                                               
                                </tbody>
                            </table>
                        </form>
<!--                        </div>-->