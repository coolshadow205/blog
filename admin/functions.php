<?php
/*
    Global scope refers to any variable that is defined outside of any function.
    Global variables can be accessed from any part of the script that is not inside a function.
    To access a global variable from within a function, use the global keyword:
*/
if(isset($_GET['onlineusers'])){
    session_start();
    include_once("../includes/db.php");
    checkUserSession();
}
    function checkUserSession(){
        global $connection;
       checkUser();
        $session = session_id();
        $user_id = $_SESSION['user_id'];
        $time_out_in_seconds = 1200;// time out duration of inactive user
        //managing users online feature.
        //session_id() will give the session id of the active users
        $time = time();

        $time_out = $time - $time_out_in_seconds;
        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $user_exists = mysqli_query($connection , $query);

        if(mysqli_num_rows($user_exists) == 0){
            $query = "INSERT INTO users_online (session , time , user_id) VALUES('$session' , '$time' , $user_id)";
            $insert_query = mysqli_query($connection , $query);
        }/*
        else{
            // making provition to auto log out id if no activity conducted
            $query = "UPDATE users_online SET time = '$time' WHERE session =  '$session'";

            $update_query = mysqli_query($connection , $query);

        }*/

        $query = "SELECT * FROM users_online WHERE time > '$time_out'";
        $online_users_query = mysqli_query($connection , $query);
        $online_user_count = mysqli_num_rows($online_users_query);
        
        echo $online_user_count;
    }
    /*30-12-17*/
    function checkUser()
    {
        if(!isset($_SESSION['username'])){
            die("<p class='lead my-color'>You have not logged in , please login from <a href='../index.php'>here</a></p>");
        }
        else
        {
            $username = $_SESSION['username'];
            return $username;
        }
    }
    /*30-12-17*/
    function confirmQuery($result)
    {
        global $connection;
        if(!$result)
            die("QUERY FAILED : ".mysqli_error($connection));
    }
    function addCategory()
    {
        global $connection;
        if(isset($_POST['submit'])){
            $input_cat_title = $_POST['cat_title'];
            if($input_cat_title == "" || empty($input_cat_title)){
                echo "Please enter category title and then try";
            }
            else{
                $query = "INSERT INTO categories(cat_title) VALUE('$input_cat_title')";
                $add_cat_query = mysqli_query($connection , $query);

                if(!$add_cat_query){
                    die("QUERY FAILED".mysqli_error($connection));
                }
                header("Location: categories.php");
            }
        }
    }
    function editCategory()
    {
        global $connection;
        if(isset($_POST['edit_submit'])){
            $input_cat_title = $_POST['cat_title'];
            $input_cat_id = $_GET['edit'];
            if($input_cat_title == "" || empty($input_cat_title)){
                echo "Please enter category title and then try";
            }else{
                $query = "UPDATE categories SET cat_title = ' $input_cat_title' WHERE cat_id =  '$input_cat_id'";
                $update_cat_query = mysqli_query($connection , $query);
                if(!$update_cat_query){
                    die("QUERY FAILED".mysqli_error($connection));
                }
                header("Location: categories.php");
            }
        }
    }
    function fetchCategoryForEdit()
    {
        global $connection;
        //USED TO FETCH CATEGORY TITLE ACCORDING TO THE EDIT GET RESQUEST
        if(isset($_GET['edit'])){
            $edit_cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id =$edit_cat_id";
            $edit_category_title_query = mysqli_query($connection , $query);
            if($row = mysqli_fetch_assoc($edit_category_title_query));
                return $row['cat_title'];
            }
    }
?>