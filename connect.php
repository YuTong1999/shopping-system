<?php
    $conn = new mysqli("localhost", "root", "", "market");
    if(mysqli_connect_errno()){
        print("连接失败:%s\n" + mysqli_connect_errno());
        exit();
    }
?>


