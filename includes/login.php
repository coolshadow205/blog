<?php
    include_once("db.php");
    include_once("../admin/functions.php");
    session_start();
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $username = mysqli_real_escape_string($connection , $username);
        $password = mysqli_real_escape_string($connection , $password);
        
        $query = "SELECT * FROM users WHERE username = '$username'";
        $select_user_details = mysqli_query($connection , $query);
        confirmQuery($select_user_details);
        if(mysqli_num_rows($select_user_details) > 1)
            header("Location: ../index.php");
        if($row = mysqli_fetch_assoc($select_user_details)){
            /*30-12-2017*/
            $user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_hashed_password = $row['user_password'];
            $db_role = $row['user_role'];
        }
        else
            $db_password = "";
        if(password_verify($password , $db_hashed_password) && $username === $db_username){
            $_SESSION['username'] = $db_username;
            $_SESSION['user_role'] = $db_role;
            $_SESSION['user_id'] = $user_id;
            header("Location: ../admin/");
        }
        else
            header("Location: ../index.php");//header("Location: ../");
    }
    /*30-12-2017*/
?>