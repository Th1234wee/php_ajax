<?php 
    include '../shared/connection.php';
    $name    =  $_POST['insert_name'];
    $gender  =  $_POST['insert_gender'];
    $image   =  $_POST['insert_image'];

    $sql     =  "INSERT INTO `user` VALUES(null,'$name' , '$gender' , '$image')";

    $result  = $connection -> query($sql);

    if($result){
        echo "Ok";
    }

