<?php
    include "config.php";
    if (isset($_GET) and (!empty($_GET))) {
        $user_id = filter_input(INPUT_GET, 'user');
        $users = mysqli_query($link, "SELECT * FROM `users` WHERE `id`='" . $user_id . "'");
        $user = mysqli_fetch_array($users);
        if (!empty($user)) {
            ?>
            <p><b>UserName : </b> <?= $user['first_name'].$user['last_name']; ?></p>
            <p><b>Email ID : </b><?= $user['email'] ?></p>
            <p><b>Education : </b><?= $user['education'] ?></p>
            <p><b>Interests :</b><?= $user['interests'] ?></p>
            <p><b>GPA :</b><?= $user['gpa'] ?></p>
            <p><b>University :</b><?= $user['university'] ?></p>
            <p><b>Interests :</b><?= $user['interests'] ?></p>
            <p><b>Cohort :</b><?= $user['cohort'] ?></p>
        <?php }} ?>