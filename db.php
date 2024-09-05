<?php
    $connection = new mysqli('db', 'root', 'password','users_app'); 
    if(!$connection){
        die(mysqli_error($connection));
    }
?>