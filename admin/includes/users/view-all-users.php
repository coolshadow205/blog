<div class="col-xs-12 table-responsive">
    <table class="table table-bordered table-hover">
       <thead class="thead-inverse"><!--burlywood-->
            <tr>
                <th>ID</th>
                <th>User name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <!--CODE EDITED MY ME-->
                <th>Active Posts</th>
                <th>Pending Posts</th>
                <!--CODE EDITED MY ME-->
                <th>Role</th>
                <th>Image</th>
                <th>Make Admin</th>
                <th>Make Subcriber</th>
                <th>Edit User</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM users";
            $select_all_users_query = mysqli_query($connection , $query);
                while($row = mysqli_fetch_assoc($select_all_users_query)){
                    $user_id = $row['user_id'];
                    
                    /*CODE EDITED MY ME*/
                    
                    $published_query = "SELECT * FROM posts WHERE post_author = $user_id AND post_status = 'published'";
                    $published_count_query = mysqli_query($connection , $published_query);
                    $published_count = mysqli_num_rows($published_count_query);
                    
                    $draft_query = "SELECT * FROM posts WHERE post_author = $user_id AND post_status = 'draft'";
                    $draft_count_query = mysqli_query($connection , $draft_query);
                    $draft_count = mysqli_num_rows($draft_count_query);
                    
                    /*CODE EDITED MY ME*/
                    
                    $username = $row['username'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_image = $row['user_image'];
                    $user_role = $row['user_role'];

                    echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$user_firstname</td>";
                    echo "<td>$user_lastname</td>";
                    echo "<td>$user_email</td>";
                    /*CODE EDITED MY ME*/
                    echo "<td>$published_count</td>";
                    echo "<td>$draft_count</td>";
                    /*CODE EDITED MY ME*/
                    echo "<td>$user_role</td>";
                    echo "<td><img src='images/user/$user_image' height='71ox'alt='user image'></img></td>";
                    echo "<td><a class='btn btn-success' href='users.php?make_admin=$user_id'><span class='fa fa-check'></span></a></td>";
                    
                    echo "<td><a class='btn btn-warning' href='users.php?make_subscriber=$user_id'><span 
                    class='fa fa-user'></span></a></td>";
                    
                    echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&edit_id=$user_id'><span 
                    class='fa fa-pencil'></span></a></td>";
                    
                     echo "<td><a class='btn btn-danger' href='users.php?delete=$user_id'><span class='fa fa-trash'></span></a></td>";
                    echo "</tr>";
                }

            ?>
        </tbody>
        <?php
    
        if(isset($_GET['make_admin'])){
            $make_admin_id = $_GET['make_admin'];
            $query = "UPDATE users SET user_role='admin' WHERE user_id = ('$make_admin_id')";
            $admin_query= mysqli_query($connection , $query);
            confirmQuery($admin_query);
            header("Location: users.php");
        }
        if(isset($_GET['make_subscriber'])){
            $make_subscriber_id = $_GET['make_subscriber'];
            $query = "UPDATE users SET user_role='subscriber' WHERE user_id = ('$make_subscriber_id')";
            $admin_query= mysqli_query($connection , $query);
            confirmQuery($admin_query);
            header("Location: users.php");
        }
        if(isset($_GET['delete'])){
            $delete_user_id = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = $delete_user_id";
            $delete_user_query = mysqli_query($connection , $query);
            confirmQuery($delete_user_query);
            header("Location: users.php");
        }
    ?>
    </table>
</div>
