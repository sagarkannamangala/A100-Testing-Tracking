<?php
include "header.php";
if (!$_SESSION['u_id']) {
    header("location:login.php");
}
$course_id = (!empty($_GET['c_id'])) ? $_GET['c_id'] : "";
$test_id = (!empty($_GET['t_id'])) ? $_GET['t_id'] : "";
$question_id = (!empty($_GET['q_id'])) ? $_GET['q_id'] : "";
$answers = mysql_query("SELECT `answer`,`id` FROM `answers` WHERE `course_id`='" . $course_id . "' AND `test_id`='" . $test_id . "' AND `question_id`='" . $question_id . "'");
$a = mysql_fetch_row($answers);
if ((isset($_POST)) and (!empty($_POST))) {
    $answer = filter_input(INPUT_POST, 'answer');
    $exam = !empty($a[1]) ? mysql_query("UPDATE `answers` SET `answer` = '" . $answer . "' WHERE `id`='" . $a[1] . "'") : mysql_query("INSERT INTO `answers` (`course_id`,`test_id`,`question_id`,`answer`,`answered_by`) VALUES ('" . $course_id . "','" . $test_id . "','" . $question_id . "','" . $answer . "','" . $_SESSION['user_id'] . "')");
}
?>
<section class="container">
    <article class="col-sm-10 center center-block">
        <?php
        $questions = mysql_query("SELECT `question_id`, `question` FROM `student_test` WHERE `question_id` = '" . $question_id . "' AND `test_id` = '" . $test_id . "' AND `course_id` = '" . $course_id . "'");
        $q = mysql_fetch_row($questions);
        echo $q[0] . '.  ' . $q[1];
        ?>
        <form method="post" class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-12">
                    <label>
                        <textarea name="answer" class="form-control"
                                  rows="6"><?= (!empty($a[0])) ? $a[0] : "" ?></textarea>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4" align="left">
                    <?php if (!empty($a[0])) {
                        $prev = mysql_query("SELECT `question_id`,`test_id`,`course_id` FROM `student_test` WHERE  `question_id` < '" . $question_id . "' AND `test_id` = '" . $test_id . "' LIMIT 1");
                        if (mysql_num_rows($prev) == 1) {
                            $p = mysql_fetch_row($prev); ?>
                            <a href="exam.php?q_id=<?= $p[0] ?>&t_id=<?= $p[1] ?>&c_id=<?= $p[2] ?>"
                               class="btn btn-primary col-sm-5">< Prev</a>
                        <?php }
                    } ?>
                </div>
                <div class="col-sm-4" align="center">
                    <button class="col-sm-5 btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-4" align="right">
                    <?php if (!empty($a[0])) {
                        $next = mysql_query("SELECT `question_id`,`test_id`,`course_id` FROM `student_test` WHERE  `question_id` > '" . $question_id . "' AND `test_id` = '" . $test_id . "' LIMIT 1");
                        if (mysql_num_rows($next) == 1) {
                            $n = mysql_fetch_row($next); ?>
                            <a href="exam.php?q_id=<?= $n[0] ?>&t_id=<?= $n[1] ?>&c_id=<?= $n[2] ?>"
                               class="btn btn-primary col-sm-5">Next ></a>
                        <?php }
                    } ?>
                </div>
            </div>
        </form>
    </article>
</section>
