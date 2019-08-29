<!DOCTYPE html>
<html lang="en">

<!--Header-->
<?php
    $title = "Blog Home";
    include_once("admin/functions.php");
    include_once("includes/header.php");
    include_once("includes/db.php");
    $posts_per_page = 3;
    //includes this file once only 
    //if already included doesn't do anything
    
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $emailid = $_POST['emailid'];
        
        // cleaning all inputs 
        
        $username = mysqli_real_escape_string($connection , $username);
        $firstname = mysqli_real_escape_string($connection , $firstname);        
        $lastname = mysqli_real_escape_string($connection , $lastname);
        $password = mysqli_real_escape_string($connection , $password);
        $emailid = mysqli_real_escape_string($connection , $emailid);

        $query = "SELECT * FROM users WHERE username = '$username'";
        if($row = mysqli_fetch_assoc(mysqli_query($connection , $query)))
            echo "Saskjasd";
        else{
    //      echo $username."</br>".$firstname."</br>".$lastname."</br>".$password."</br>".$emailid;
            $options = [
                'cost' => 10, // Hashing will be done till the cost i.e. 10
                'salt' => mcrypt_create_iv(22 , MCRYPT_DEV_URANDOM), // It will generate a salt 
            ];
            $hashpass = password_hash($password,PASSWORD_BCRYPT, $options);
            /*The above function
              password_hash(your_password , technique that will be used to hash it , array that has cost and salt in it)
              will generate a hash of password.
            */

            $query = "INSERT INTO users (username , user_firstname , user_lastname , user_email , user_password , user_role , user_image) VALUES('$username' , '$firstname' , '$lastname' , '$emailid' , '$hashpass' , 'subscriber' , '')";
            mysqli_query($connection, $query);
            confirmQuery($query);
        }
    }
?>
    
<body>

    <!-- Navigation-->
   <?php
        include_once("includes/navigation.php");
    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="" method="post" role="form">
                    <legend>Register</legend>
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter your First Name" name="firstname">
                        </div>
                        
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter your Last Name" name="lastname">
                        </div>
                        
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter your Desitrd Username" name="username">
                        </div>
                        
                        <div class="form-group">
                            <label for="emailid">Email</label>
                            <input type="text" class="form-control" id="emailid" placeholder="Enter your Email Id" name="emailid">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Please Provide some Strong Password" name="password">
                        </div>
                        <button class="btn btn-primary" type="submit" name="register">Submit</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
       <!--Footer-->
        <?php
            include_once("includes/footer.php");
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>