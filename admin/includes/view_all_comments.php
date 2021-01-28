<div class="col-xs-12 table-responsive"> <!-- post table -->
                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Date</th>
<!--                                        <th>Content</th>-->
                                    </tr>
                                </thead>
                                <tbody>
<?php 
    ///// posts table data 
    getAllComments();      
    deleteComment();
?>                                               
                                </tbody>
                            </table>
                        </div>