<div class="col-xs-15 table-responsive">
    <table class="table table-bordered table-hover">
       <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Comment Content</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response To</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
                /*EDITED MY ME*/
                
                if($user_role == "admin")
                    $query = "SELECT * FROM comments ORDER BY comments.comment_date DESC";
                else{
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM comments WHERE comment_post_id in (SELECT posts.post_id FROM posts WHERE post_author = $user_id)";
                    /*$query = "SELECT * FROM comments , posts WHERE posts.post_author = $user_id AND comments.comment_post_id = posts.post_id ORDER BY comments.comment_date DESC";*/
                }
                $select_all_comments_query = mysqli_query($connection , $query);
                while($row = mysqli_fetch_assoc($select_all_comments_query)){
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];

                    echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_content</td>";
                    echo "<td>$comment_email</td>";
                    echo "<td>$comment_status</td>";
                    
                    
                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    $select_comment_post_query = mysqli_query($connection , $query);
                    
                    if($row = mysqli_fetch_assoc($select_comment_post_query)){
                        $comment_post_title = $row['post_title'];
                    }
                    echo "<td><a href='../post.php?p_id=$comment_post_id'>$comment_post_title</a></td>";
                    echo "<td>$comment_date</td>";
                    echo "<td><a class='btn btn-success' href='comments.php?approve=$comment_id'><span class='fa fa-check'></span> Approve</a></td>";
                    
                    echo "<td><a class='btn btn-warning' href='comments.php?unapprove=$comment_id'><span 
                    class='fa fa-remove'></span> Unapprove</a></td>";
    
                    echo "<td><a class='btn btn-danger' href='comments.php?delete=$comment_id'><span class='fa fa-trash'></span> Delete</a></td>";
                    echo "</tr>";
                }

            ?>
        </tbody>
        <?php
    
        if(isset($_GET['approve'])){
            $approve_comment_id = $_GET['approve'];
            $query = "UPDATE comments SET comment_status='approved'  WHERE comment_id = ('$approve_comment_id')";
            $approve_query= mysqli_query($connection , $query);
            confirmQuery($approve_query);
            header("Location: comments.php");
        }
        if(isset($_GET['unapprove'])){
            $unapprove_comment_id = $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status='unapproved'  WHERE comment_id = ('$unapprove_comment_id')";
            $unapprove_query= mysqli_query($connection , $query);
            confirmQuery($unapprove_query);
            header("Location: comments.php");
        }
        if(isset($_GET['delete'])){
            $delete_comment_id = $_GET['delete'];
            $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = (SELECT comment_post_id FROM comments WHERE comment_id = $delete_comment_id)";
            $update_comment_count_query = mysqli_query($connection , $query);
            confirmQuery($update_comment_count_query);
            $query = "DELETE FROM comments WHERE comment_id = ('$delete_comment_id')";
            $delete_query= mysqli_query($connection , $query);
            confirmQuery($delete_query);
            header("Location: comments.php");
        }
    ?>
    </table>
</div>
