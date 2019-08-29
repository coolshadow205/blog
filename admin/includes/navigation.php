<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">SL CPanel</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li>
            <a href="">Online Users: <span class="usersonline"></span></a>
        </li>
       <li>
           <a href="../index.php">HOME SITE</a>
       </li>
       
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> 
                <?php echo $username; ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dmenu-width" aria-labelledby="dLabel">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                
                <li class="divider"></li>
                <li>
                    <a href="#changePassword" data-toggle="modal"><i class="fa fa-fw fa-key"></i> Change Password</a>
                </li>
                
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
                
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropmenu"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropmenu" class="collapse">
                    <li>
                        <a href="post.php">View All Posts</a>
                    </li>
                    <li>
                        <a href="post.php?source=add-post">Add Posts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories </a>
            </li>
            <?php
                /*30-12-17*/
                if($user_role == "admin")
                {
            ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#user_dropmenu"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="user_dropmenu" class="collapse">
                    <li>
                        <a href="users.php">View All Users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Add User</a>
                    </li>
                </ul>
            </li>
            <?php
                }//END OF IF
                /*30-12-17*/
            ?>
            <li>
                <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments </a>
            </li>

             <li>
                <a href=""><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
<?php
    if(isset($_POST['update-pass'])){
        $user_id = $_SESSION['user_id'];
        $user_password = $_POST['user_password'];
        $user_confirm_password = $_POST['user_confirm_password'];
        if($user_confirm_password === $user_password){
//            echo $user_password."</br>".$user_confirm_password."</br> ".$user_id;
            $options = [
                'cost' => 10,
                'salt' => mcrypt_create_iv(22 , MCRYPT_DEV_URANDOM),
            ];
            $hashedpass = password_hash($user_password , PASSWORD_BCRYPT, $options);
            $query = "UPDATE users SET user_password = '$hashedpass' WHERE user_id = $user_id";
            
            mysqli_query($connection , $query);
        }
    }
?>
<!--MODAL BEGINS-->
<form class="modal fade" id="changePassword" method="post" action="" role="form">
    <div class="modal-dialog modal-lg outer-modal">
        <!--MODAL CONTENT BEGINS-->
        <div class="modal-content inner-modal">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Reset your password</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter your new password">
                </div>

                <div class="form-group">
                    <label for="user_confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="user_confirm_password" id="user_confirm_password" placeholder="Confirm your new password">
                </div>
            </div>
            <div class="modal-footer">
                <button href="" class="btn btn-primary" id="update-pass" name="update-pass">Update Password</button>
                <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
            </div>
        </div>
        <!--MODAL CONTENT ENDS-->
    </div>
</form>
<!--MODAL ENDS-->
