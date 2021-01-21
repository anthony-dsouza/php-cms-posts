<div class="col-xs-12 table-responsive"> <!-- post table -->
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>Content</th>
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
                        </div>