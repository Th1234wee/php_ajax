<?php
    $file = $_FILES['image']['name'];
    $path = '../image/'.$file;
    move_uploaded_file($_FILES['image']['tmp_name'],$path);
    echo $file;