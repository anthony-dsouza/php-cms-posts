<div class="col-xs-12 table-responsive"> <!-- post table -->
                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Post</th>
                                        <th>Author</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Comment</th>
                                        <th>Approve</th>
                                        <th>Unapprove</th>
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