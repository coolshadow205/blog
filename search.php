<!--SEARCH PAGE-->
<!DOCTYPE html>
<html lang="en">

<!--Header-->
<?php
    $title = "Search Results";
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
    <!--Navigation end-->
        
        
   
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
                 if(isset($_POST['submit'])){
            $search = $_POST['search'];
            $query = "SELECT * FROM posts WHERE post_tags like '%$search%' AND post_status='published'";
            $search_query = mysqli_query($connection, $query);
            if(!$search_query){
                //there was some error in processing the query
                die("QUERY FAILED : ".mysqli_error($connection));
            }
            $count = mysqli_num_rows($search_query);
            if($count == 0){
                echo "<h2>No results found</h2>";
            }else{
                while($row = mysqli_fetch_assoc($search_query)){
        $post_title = $row["post_title"];
        $post_author = $row["post_author"];
        $post_date = $row["post_date"];
        $post_image = $row["post_image"];
        $post_content = $row["post_content"];
    
?>


                <!-- START OF BLOG POST -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title;?>">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php       }//end of while
                        }//end of else
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