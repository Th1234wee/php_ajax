<?php
    $file = $_FILES['_file']['name'];
    $image  = date('YmdHis') . ' - '. $file;
    $path = '../image/'.$image;
    move_uploaded_file($_FILES['_file']['tmp_name'],$path);
    echo $image;