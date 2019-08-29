<?php
    if(isset($_POST['create_user']))
    {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['user_email'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_password_confirm = $_POST['user_password_confirm'];
//        echo "$user_firstname</br>$user_lastname</br>$username";
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($user_image_temp , "images/user/$user_image");

        $username = mysqli_real_escape_string($connection , $username);
        $user_firstname = mysqli_real_escape_string($connection , $user_firstname);        
        $user_lastname = mysqli_real_escape_string($connection , $user_lastname);
        $user_password_confirm = mysqli_real_escape_string($connection , $user_password_confirm);
        $user_email = mysqli_real_escape_string($connection , $user_email);

        $query = "SELECT * FROM users WHERE username = '$username'";
        if($row = mysqli_fetch_assoc(mysqli_query($connection , $query)) || $user_password !== $user_password_confirm)
            echo "Saskjasd";
        else{
            
            $options = [
                'cost' => 10, // Hashing will be done till the cost i.e. 10
                'salt' => mcrypt_create_iv(22 , MCRYPT_DEV_URANDOM), // It will generate a salt 
            ];
            $hashpass = password_hash($user_password_confirm , PASSWORD_BCRYPT , $options);
            $query = "INSERT INTO users(username, user_firstname, user_lastname, user_role, user_email, user_password, user_image) VALUES ('$username', '$user_firstname', '$user_lastname', '$user_role', '$user_email', '$hashpass', '$user_image')";

            $create_post_query = mysqli_query($connection,$query);
            confirmQuery($create_post_query);
            header("Location: users.php");
        }
    }
?>
<!--Multipart divides the file into parts-->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="user_firstname" id="first_name">
    </div>
    
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" id="last_name">
    </div>
    
    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" class="form-control" name="username" id="user_name">
    </div>
    
    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="image" id="user_image" class="form-control" id="image">
    </div>
    
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email" id="user_email">
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
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" id="user_password">
    </div>
    
    <div class="form-group">
        <label for="confirm">Confirm Password</label>
        <input type="password" class="form-control" name="user_password_confirm" id="confirm">
    </div>
    
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>
    <!--<div class="form-group">
        <p id="error"></p>
    </div>-->
</form>
<!--<script>
    function check()
    {
        var username = document.getElementById("username");
        var user_firstname = document.getElementById("user_firstname");
        var user_lastname = document.getElementById("user_lastname");
        var error =  document.getElementById("error");
        var msg = "";
        try{
            if(!(/\w/.test(username))
               msg = "ERROR";
               throw msg;
        }
        catch( err ){
                error.innerHTML = msg;
            }
    }
</script>-->