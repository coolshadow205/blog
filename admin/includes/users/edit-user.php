<?php
    if(isset($_GET['edit_id'])){
        $edit_user_id = $_GET['edit_id'];
        $query = "SELECT * FROM users WHERE user_id = $edit_user_id";
        $edit_user_query = mysqli_query($connection , $query);
        confirmQuery($edit_user_query);
        if($row = mysqli_fetch_assoc($edit_user_query))
        {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
        }
    }
    if(isset($_POST['edit_user']))
    {
        if(isset($_GET['edit_id'])){
            $username = $_POST['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];

            $user_image = $_FILES['image']['name'];
            $user_image_temp = $_FILES['image']['tmp_name'];
            
            $edit_user_id = $_GET['edit_id'];
            move_uploaded_file($user_image_temp , "images/user/$user_image");


            if(empty($user_image))//EMPTY function will check that given variable is EMPTY or NOT
            {
                //This will not allow us to send a NULL as value in post_image of DB
                $query = "SELECT * FROM users WHERE user_id = $edit_user_id";
                $select_image_query = mysqli_query($connection,$query);
                if($row = mysqli_fetch_assoc($select_image_query))
                    $user_image = $row['user_image'];
            }
            $query = "UPDATE users SET username = '$username' , user_firstname = '$user_firstname' , user_lastname = '$user_lastname' , user_role = '$user_role' , user_image = '$user_image' , user_email = '$user_email'WHERE user_id = '$edit_user_id' ";
            $update_user_query = mysqli_query($connection,$query);
            confirmQuery($update_user_query);
            header("Location: users.php");
            
            
        }
    }
?>
<!--Multipart divides the file into parts-->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="user_firstname" id="first_name" value="<?php echo $user_firstname; ?>">
    </div>
    
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" id="last_name" value="<?php echo $user_lastname; ?>">
    </div>
    
    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" class="form-control" name="username" id="user_name" value="<?php echo $username; ?>">
    </div>
    
    <div class="form-group">
        <img src="images/user/<?php echo $user_image; ?>" class="img-responsive" width="100px"alt="user current image">
        <label for="user_image">User Image</label>
        <input type="file" name="image" id="user_image" class="form-control" id="image">
    </div>
    
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email; ?>">
    </div>
    
    <div class="form-group">
        <label for="role">Role</label>
        <select name="user_role" id="role" class="form-control">
           <?php
            $user_role = "subscriber";
            if($user_role == "subscriber"){
                echo "<option value='subscriber' selected>Subscriber</option>";
                echo "<option value='admin'>Admin</option>";
            }
            else{
                echo "<option value='subscriber'>Subscriber</option>";
                echo "<option value='admin' selected>Admin</option>";
            }
            ?>
        </select>
    </div> 
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>