<?php
    if(isset($_GET['p_id'])){
        $edit_post_id = $_GET['p_id'];
        $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
        $edit_post_query = mysqli_query($connection , $query);
        confirmQuery($edit_post_query);
        if($row = mysqli_fetch_assoc($edit_post_query))
        {
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_tag = $row['post_tags'];
            $post_content = $row['post_content'];
            $post_image = $row['post_image'];
        }
    }
    if(isset($_POST['edit_post']))
    {
        if(isset($_GET['p_id'])){
            $post_title = $_POST['title'];
            $post_author = $_POST['author'];
            $post_category_id = $_POST['post_category_id'];
            $post_status = $_POST['status'];

            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];

            $post_tag = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $edit_post_id=$_GET['p_id'];

            move_uploaded_file($post_image_temp , "../images/$post_image");

            
            if(empty($post_image))//EMPTY function will check that given variable is EMPTY or NOT
            {
                //This will not allow us to send a NULL as value in post_image of DB
                $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
                $select_image_query = mysqli_query($connection,$query);
                if($row = mysqli_fetch_assoc($select_image_query))
                    $post_image = $row['post_image'];
            }
            $query = "UPDATE posts SET ";
            $query .="post_category_id='$post_category_id',";
            $query .="post_title='$post_title',";
            $query .="post_content='$post_content',";
            $query .="post_tags='$post_tag',";
            $query .="post_status='$post_status',";
            $query .="post_image='$post_image' WHERE post_id = $edit_post_id";

            $update_post_query = mysqli_query($connection,$query);
            confirmQuery($update_post_query);
            header("Location: post.php");
            }
        }
?>
<!--Multipart divides the file into parts-->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="title" id="post_title" value="<?php echo $post_title; ?>">
    </div>
    
    <div class="form-group">
        <label for="post_category">Post Category ID</label>
        <select name="post_category_id" id="post_category" class="form-control">
           <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection , $query);
                while($row = mysqli_fetch_assoc($select_all_categories_query)){
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];
                    if($cat_id == $post_category_id)
                        echo "<option value='$cat_id' selected>$cat_title</option>";
                    else
                        echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="status" id="post_status" class="form-control">
            <option value="draft" <?php if($post_status=="draft") echo "selected"; ?>>Draft</option>
            <option value="published" <?php if($post_status=="published") echo "selected"; ?>>Published</option>
        </select>
    </div>
    
    <div class="form-group">
       <img src="../images/<?php echo $post_image;?>" width="350px" class="img-responsive" alt="">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" id="post_image" class="form-control">
        
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="post_tags" value="<?php echo $post_tag; ?>">
    </div>
    
    <div class="form-group">
        <label for="post_contents">Post Content</label>
        <textarea class="form-control" name="post_content" id="post_contents" cols="30" rows="10" 
        ><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
    </div>
</form>