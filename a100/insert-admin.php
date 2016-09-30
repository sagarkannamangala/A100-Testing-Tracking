<?php
    include "config.php";
    $first_name = 'admin';
    $last_name = 'admin';
    $email = 'admin@students.com';
    $username = 'admin';
    $password = 'admin!2345';
    $role = 0;
    $user = mysqli_query($link,"INSERT INTO `users`  (`first_name`,`last_name`,`email`,`username`,`password`,`role`) VALUES ('" . $first_name . "','" . $last_name . "','" . $email . "','" . $username . "','" . $password . "','" . $role . "')");
    if ($user == true) {
        echo "Administrator created successfully.";
        header("refresh:1;url=login.php");
    } else {
        echo "Administrator already created.";
        header("refresh:1;url=login.php");
    }