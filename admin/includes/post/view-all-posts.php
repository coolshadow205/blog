<?php
    if(isset($_POST['checkBoxArray'])){
        $bulk_options = $_POST['bulk_options'];
        foreach ($_POST['checkBoxArray'] as $postValueId){
//            echo $postValueId;
            switch($bulk_options){
                case 'draft':    
                case 'published':
                    $query = "UPDATE posts SET post_status = $bulk_options WHERE post_id = $postValueId";
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = $postValueId";
                    $delete_posts = mysqli_query($connection , $query);
                    header("Location: post.php");
                    break;
                    
            }
        }
    }
?>
<!--VIEW ALL POSTS SECTION-->
<div class="col-xs-12 table-responsive">
   <form action="" method="post">
    <table class="table table-bordered table-hover">
      <div id="bulkOptionContainer" class="col-xs-4">
          <select name="bulk_options" id="" class="form-control">
              <option value="" unselected>Select Option</option>    
              <option value="published">Published</option>
              <option value="draft">Draft</option>
              <option value="delete">Delete</option>
          </select>
      </div>
      <div class="col-xs-4">
          <input type="submit" name="submit_bulk_option" class="btn btn-primary" value="Apply">
          <a href="post.php?source=add-post" class="btn btn-warning">Add New</a>
      </div>
       <thead class="thead-inverse">
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
                <th>Data</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $user_id = $_SESSION['user_id'];
                if($user_role == "admin")
                    $query = "SELECT * FROM posts,users WHERE posts.post_author = users.user_id ORDER BY posts.post_date DESC";
                else
                    $query = "SELECT * FROM posts,users WHERE posts.post_author = $user_id AND users.user_id = $user_id ORDER BY posts.post_date DESC";
            
                $select_all_posts_query = mysqli_query($connection , $query);
                confirmQuery($select_all_posts_query);
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_author = $row['user_firstname']." ".$row['user_lastname'];//$row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];

                    echo "<tr>";
                    echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='$post_id'></td>";
                    echo "<td>$post_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_title</td>";
                    
                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                    $select_all_categories_query = mysqli_query($connection , $query);
                    
                    if($row = mysqli_fetch_assoc($select_all_categories_query)){
                        $post_category_title = $row['cat_title'];
                    }
                    echo "<td>$post_category_title</td>";
                    
                    echo "<td>$post_status</td>";
                    echo "<td><img src='../images/$post_image' height='71'alt='post image'></img></td>";/*class='img-responsive' if you want*/
                    echo "<td>$post_tags</td>";
                    echo "<td>$post_comment_count</td>";
                    echo "<td>$post_date</td>";
                    echo "<td><a class='btn btn-danger' href='post.php?delete=$post_id'><span class = 'fa fa-fw fa-trash'></a></td>";
                    echo "<td><a class='btn btn-primary' href='post.php?source=edit-post&p_id=$post_id'><span class = 'fa fa-fw fa-pencil-square-o'></a></td>";
                    echo "</tr>";
                }

            ?>
        </tbody>
    </table>
</form>
    <?php
        if(isset($_GET['delete'])){
            $delete_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = ('$delete_post_id')";
            $delete_query= mysqli_query($connection , $query);
            confirmQuery($delete_query);
            header("Location: post.php");
        }
    ?> 
</div>