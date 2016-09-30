<?php
    if (empty($_SESSION)) {
        ob_start();
        session_start();
        if ((!empty($_SESSION)) and (($_SESSION['login']) != true)) {
            header("location : login.php");
        }
    }
    if ((!empty($_SESSION)) and (($_SESSION['login']) != true)) {
        header("location : login.php");
    }