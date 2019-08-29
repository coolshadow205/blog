<!DOCTYPE html>
<html lang="en">

<!--Header-->
<?php
    $title = "Categories";
    include_once("includes/header.php");
    include_once("includes/db.php");
    
    //includes this file once only 
    //if already included doesn't do anything
?>
    
<body>

    <!-- Navigation-->
   <?php
        include_once("includes/navigation.php");
    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    PHP 
                    <small>Secondary Text</small>
                </h1>
                <?php
                    if(isset($_GET['c_id']))
                    {
                        $cat_id = $_GET['c_id'];
                        $query = "SELECT * FROM posts,users WHERE posts.post_author = users.user_id AND post_category_id = $cat_id AND post_status='published'";
                        $select_all_posts_query = mysqli_query($connection , $query);
                        while($row = mysqli_fetch_assoc($select_all_posts_query)){
                            $post_id = $row['post_id'];
                            $post_title = $row["post_title"];
                            $post_author = $row['user_firstname']." ".$row['user_lastname'];
                            $post_date = $row["post_date"];
                            $post_image = $row["post_image"];
                            $post_content = substr($row['post_content'] , 0 , 200 )."...";
                ?>

                <!-- START OF BLOG POST -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title;?>">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php 
                            }//end of while
                    }//end of if
                ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include_once("includes/side-bar.php");
            ?>

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