<?php 
    include_once("includes/db.php");
    include_once("admin/functions.php");
    $title = "Forgot Password";
?>
<?php
    if(!isset($_GET['token']) || !isset($_GET['email']))
        header("Location: index.php");
    else{
        $token = $_GET['token'];
        $email = $_GET['email'];
    }
    if(!isset($_POST['submit'])){
        if(isset($_POST['password']) && isset($_POST['password'])){
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            if($password === $password2){
                $options = [
                    'cost' => 10, // Hashing will be done till the cost i.e. 10
                    'salt' => mcrypt_create_iv(22 , MCRYPT_DEV_URANDOM), // It will generate a salt 
                ];
                $hashedPassword = password_hash($password,PASSWORD_BCRYPT, $options);
                
                $query = "UPDATE users SET token='' , user_password='$hashedPassword' WHERE token='$token' and user_email = '$email'";
                $updatePassword = mysqli_query($connection , $query);
                confirmQuery($updatePassword);
                echo "Password Changed Successfully:";
                echo "Please login and verify:";
                
            }
        }
    }
?>
<html>
    <?php include_once("includes/header.php"); ?>
    <div>
        <?php include_once("includes/navigation.php"); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <div class="panel-body">
                                <form action="" method="POST" role="form" id="forgot-password">
                                   
                                    <div class="form-group">
                                       <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Please enter your new password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Please Repeat The Password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <input type="submit" class="btn btn-lg btn-primary btn-block" name="reset-submit" value="submit">
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>