<?php
    if(isset($_POST['create_post']))
    {
        $post_title = $_POST['title'];
        $post_auhtor = $_SESSION['user_id'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tag = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        
        move_uploaded_file($post_image_temp , "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_content,post_tags,post_status,post_image) VALUES ('$post_category_id','$post_title','$post_auhtor',now(),'$post_content','$post_tag','$post_status','$post_image')";
        
        $create_post_query = mysqli_query($connection,$query);
        confirmQuery($create_post_query);
    }
?>
<!--Multipart divides the file into parts-->
<form action="" method="POST" enctype="multipart/form-data" id="addPost">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="title" id="post_title">
    </div>
    
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category_id" id="post_category" class="form-control">
            <?php
                $query = "SELECT * FROM categories";
                $cat_query = mysqli_query($connection , $query);
                while($row = mysqli_fetch_assoc($cat_query)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="status" id="post_status" class="form-control">
           <?php
            $post_status = "draft";
            if($post_status == "draft"){
                echo "<option value='draft' selected>Draft</option>";
                echo "<option value='published'>Published</option>";
            }
            else{
                echo "<option value='draft'>Draft</option>";
                echo "<option value='published' selected>Published</option>";
            }
            ?>
        </select>
    </div>
    
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" id="post_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_contents">Post Content</label>
        <textarea class="form-control" name="post_content" id="post_contents" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <div class="col-md-8 col-md-offset-3">
            <div id="messages"></div>
        </div>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>