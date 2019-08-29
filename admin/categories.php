<!DOCTYPE html>
<html lang="en">

<?php
    ob_start();
    $page = "categories";
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
                        
                <!-- ADD CATEGORY FORM -->
                    <?php include_once("includes/category/add-category.php"); ?>
                <!-- END OF ADD CATEGORY FORM -->
                        
    
               <!-- EDIT CATEGORY FORM -->
                        <?php
                            include_once("includes/category/edit-category.php");
                        ?>
                <!-- END OF EDIT CATEGORY FORM -->

                <!--VIEW CATEGORIES CODE BEGINS-->
                        <?php include_once("includes/category/view-categories.php"); ?>
                <!--VIEW CATEGORIES CODE ENDS-->
                    </div>
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
