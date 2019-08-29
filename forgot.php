<?php 
    include_once("includes/db.php");
    include_once("admin/functions.php");
    $title = "Forgot Password";
?>
<?php
    if(!isset($_GET['forgot']))
        header("Location: index.php");
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['emailid'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        
        //check whether the exists or not:
        $query = "SELECT * FROM users WHERE user_email = '$email'";
        $user = mysqli_query($connection , $query);
        if(mysqli_num_rows($user) == 1){
            //u can say that email exists
            //now if the email exists then just update the token
            $query = "UPDATE users SET token = '$token' WHERE user_email = '$email'";
            $updateToken = mysqli_query($connection , $query);
            confirmQuery($updateToken);
            
            $headers = 'MIME-Version: 1.0'."\r\n";
            $headers .= 'From: Jay Ashra <jay.ashra251198@gmail.com>'."\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

            $to = $email;
            $subject = "Subject Link Blog Change Password";
            
            $body = "Please Click the below link to reset your password:<br/>
            <a href='http://localhost/blog/reset.php?email=$email&token=$token'>http://localhost/blog/reset.php?email=$email&token=$token</a>";
           // echo $body;

            $sentMail = mail($to,$subject,$body,$headers);
            if(!$sentMail){
                echo error_get_last()['message'];
            }else{
                echo "Sent";
            }
        }
        else{
            echo "Some issue with email id: OR No such user found";
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
                            <h2 class="text-center">Forgot Password</h2>
                            <p>You can reset your password here!</p>
                            <div class="panel-body">
                                <form action="" method="POST" role="form" id="forgot-password">
                                   
                                    <div class="form-group">
                                       <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Please enter your email id">
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