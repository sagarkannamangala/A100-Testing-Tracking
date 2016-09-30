<?php
    $title = "Tests";
    include "user-auth.php";
    include "home-header.php";
    $course_id = (!empty($_GET['course_id'])) ? $_GET['course_id'] : "";
    if (!empty($course_id)) {
        $request = mysqli_query($link, "INSERT INTO `test_requests` (`course_id`,`user_id`) VALUES ('" . $course_id . "','" . $_SESSION['user_id'] . "')");
        if ($request == true) {
            $message = "<div class='alert alert-success'>Test Request Sent Successfully.</div>";
            header("refresh:2;url=tests.php");
        }
    }
?>
    <style>td, th { border: solid 1px #333333 !important; }</style>
    <section class="col-sm-8 col-sm-offset-1">
        <div class="h1 clearfix"></div>
        <div class="h1 clearfix"></div>
        <?= (!empty($message)) ? $message : "" ?>
        <table class="table table-bordered table-striped">

            <tr>
                <th> </th>
                <th>Course Name</th>
                <th>Attempt 1</th>
                <th>Attempt 2</th>
                <th>Attempt 3</th>
                <th>Attempt 4</th>
            </tr>
            <?php
                $courses = mysqli_query($link, "SELECT * FROM `courses` WHERE `has_test`='1'  ORDER BY `id` ASC ");
                for ($i = 1; $i <= mysqli_num_rows($courses); $i++) {
                    $c = mysqli_fetch_array($courses);
                    ?>
                    <tr>
                    <td><?= $i ?></td>
                    <td><?= $c['course_name'] ?></td>
                    <td><?php
                            $check = mysqli_query($link, "SELECT * FROM `answers` WHERE `answered_by` = '" . $_SESSION["user_id"] . "' AND `test_id`='1' AND `course_id`='" . $c['id'] . "' "); ?>
                        <?= (mysqli_num_rows($check) == 0) ? '<a href="test.php?test_id=1&course_id=' . $c[0] . '">TEST -1</a>' : "Completed"; ?></td>
                    <td><?php
                            $check = mysqli_query($link, "SELECT * FROM `answers` WHERE `answered_by` = '" . $_SESSION["user_id"] . "' AND `test_id`='2' AND `course_id`='" . $c['id'] . "' "); ?>
                        <?= (mysqli_num_rows($check) == 0) ? '<a href="test.php?test_id=2&course_id=' . $c[0] . '">TEST -2</a>' : "Completed"; ?></td>
                    <td><?php
                            $check = mysqli_query($link, "SELECT * FROM `answers` WHERE `answered_by` = '" . $_SESSION["user_id"] . "' AND `test_id`='3' AND `course_id`='" . $c['id'] . "' "); ?>
                        <?= (mysqli_num_rows($check) == 0) ? ' <a href="test.php?test_id=3&course_id=' . $c[0] . '">TEST -3</a>' : "Completed"; ?> </td>
                        <td>
                            <?php $test_count = mysqli_query($link, "SELECT * FROM `answers` WHERE `answered_by`='" . $_SESSION["user_id"] . "' AND `course_id`='" . $c['id'] . "'");
                                if (mysqli_num_rows($test_count) >= 3){
                                $requests = mysqli_query($link, "SELECT `flag`  FROM `test_requests` WHERE `course_id`='" . $c[0] . "' AND `user_id`='" . $_SESSION["user_id"] . "' ");
                                if ((mysqli_num_rows($requests)) == 0){
                                ?>
                                <a href="tests.php?course_id=<?= $c[0] ?>">Request Attempt</a>
                            <?php } else{     $list = mysqli_fetch_array($requests);
                                if($list['flag'] == 1) {
                                    $check = mysqli_query($link, "SELECT * FROM `answers` WHERE `answered_by` ='" . $_SESSION["user_id"] . "' AND `test_id`='4' AND `course_id`= '" . $c['id'] . "' ");
                                    ?>
                                    <?= (mysqli_num_rows($check) == 0) ? '<a href="test.php?test_id=4&course_id=' . $c[0] . '">Attempt 4</a>' : "Completed" ?>
                                    <?php
                                }else{ echo  "Attempt Requested"; }}
                                    ?>
                        </td>
                        <?php }   ?>
                </tr>
                <?php } ?>
        </table>
    </section>
<?php include "footer.php" ?>