<div class="col-xs-12 table-responsive"> <!-- post table -->
                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
<!--                                        remove password?-->
                                        <th>Password</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
<!--                                        <th>Content</th>-->
                                    </tr>
                                </thead>
                                <tbody>
<?php 
    ///// users table data 
    getAllUsers();      
    deleteUser();
?>                                               
                                </tbody>
                            </table>
                        </div>