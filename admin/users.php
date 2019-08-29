<!DOCTYPE html>
<html lang="en">

<?php
    ob_start();
    $page = "users";
    include_once("includes/header.php");
    include_once("functions.php");
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
                        
                    <!--View All Posts selection-->
                        <?php 
                            $source = "";
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }
                            switch($source)
                            {
                                //This is called conditional Routing
                                case 'add_user':
                                    include_once("includes/users/add-user.php");
                                    break;
                                case 'edit_user':
                                    include_once("includes/users/edit-user.php");
                                    break;
                                //For increased Security , this case is written in default
                                default:
                                    include_once("includes/users/view-all-users.php");
                            }
                        ?>
                    </div>
                    <!--End of View All Posts selection-->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
