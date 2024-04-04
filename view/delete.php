<?php 
    include '../shared/connection.php';
    $deleted_id =  $_POST['delete_id'];

    $sql   =    "DELETE FROM `user` WHERE `id` = '$deleted_id'";

    $result = $connection -> query($sql);

    if($result){
        echo "OK";
    }