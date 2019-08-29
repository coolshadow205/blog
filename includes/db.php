<?php 
    define("SERVER" , "localhost");
    define("USER" , "jay");
    define("PASSWORD" , "password1234");
    define("DB" , "cms");
    //inbuilt function in PHP
    //connects the php file to sql server
    $connection = mysqli_connect(SERVER , USER , PASSWORD , DB);
    //1st parameter 
    if($connection){
        //Can be used for debugging purposes
        //echo "We are connected!";
    }
?>