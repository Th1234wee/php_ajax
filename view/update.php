<?php 
    include '../shared/connection.php';
    $update_id  = $_POST['up_id'];
    $name       = $_POST['up_name'];
    $gender     = $_POST['up_gender'];
    $image      = $_POST['up_image'];

    $sql = "UPDATE `user` SET `name` = '$name',`gender`='$gender',`image`='$image' WHERE `id` = '$update_id'";
    
    $result_edit = $connection -> query($sql);

    if($result_edit){
        echo "OK";
    }