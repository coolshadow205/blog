<!DOCTYPE html>
<html lang="en">


<?php
    /*30-12-17*/
    $page = "dashboard";
    include_once("includes/header.php");
//    include_once("functions.php");
    $username = checkUser();
    
    $time_out = time() - 1200;
    $session = session_id();
    $query = "SELECT * FROM users_online WHERE time > $time_out AND session = '$session'";
    $check_active_session = mysqli_query($connection , $query);
    if(mysqli_num_rows($check_active_session) == 0){
        mysqli_query($connection , "DELETE FROM users_online WHERE session = '$session'");
        include_once("../includes/logout.php");
        die("You have been logged out!");
    }
?>
<body>
    <div id="wrapper">
            <!-- Navigation -->
            <?php
                include_once("includes/navigation.php");
            ?>


            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Welcome to CPanel
                                <small><!--/*30-12-17*/--><?php echo $username; ?></small>
                            </h1>

                        </div>
                    </div>
                    <!-- /.row -->
                    <?php
                        /*30-12-17*/
                        include_once("dashboard.php");
                    ?>

                </div>
                <!-- /#page-wrapper -->
                <!-- /.container-fluid -->

            </div>
            <!-- /#pag

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    </div>
</body>

</html>
