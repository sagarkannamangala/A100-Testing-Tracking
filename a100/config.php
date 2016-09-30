<?php
    $link = mysqli_connect("localhost", "root", "", "a100tntdb");
    function current_page() {  return basename($_SERVER['PHP_SELF']);  }