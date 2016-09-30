<?php
    include "user-auth.php";
    $title = "Test";
    include "home-header.php";
    $test_id = (!empty($_GET['test_id'])) ? $_GET['test_id'] : "";
    $course_id = (!empty($_GET['course_id'])) ? $_GET['course_id'] : "";
    if ((isset($_POST)) and (!empty($_POST))) {
        $answer = filter_input(INPUT_POST, 'answer');
        $answer = addslashes($answer);
        $check = mysqli_query($link,"SELECT * FROM `answers` WHERE `answered_by` = '".$_SESSION['user_id']."' and `test_id`='".$test_id."' and `course_id`='".$course_id."' ");
        if(mysqli_num_rows($check)==0) {
            $query = mysqli_query($link, "INSERT INTO `answers`(`course_id`,`test_id`,`answer`,`answered_by`) VALUES ('" . $course_id . "','" . $test_id . "','" . $answer . "','" . $_SESSION['user_id'] . "')");
        if ($query == true) {
            $message = "<div class='alert alert-success'>Your Answer Submitted Successfully..!</div>";
            header("refresh:2;url=tests.php");
        } else {
            $message = "<div class='alert alert-success'>Sorry Something gone  Wrong due to:" . mysqli_error($link) . "</div>";
            header("refresh:2;url=tests.php");
        }
        }else{
            $message = "<div class='alert alert-info'>You Already Answered this Question..!</div>";
            header("refresh:2;url=tests.php");
        }
    }
?>
    <div class="h1 clearfix"></div>
<div class="col-sm-offset-2  col-sm-6"> <?= (!empty($message)) ? $message : "" ?></div>
    <div class="clearfix"></div>
    <form method="post" class="form-horizontal col-sm-8 col-sm-offset-2">
        <h1 class="col-sm-offset-4"><?php $course = mysqli_query($link, "SELECT `course_name` FROM  `courses` WHERE `id`= '" . $course_id . "'");
                $c = mysqli_fetch_row($course);
                echo $c[0]; ?></h1>
        <div class="form-group">
            <div class="col-sm-9">
        <textarea name="answer" required rows="6" class="form-control"></textarea>
              </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
        <button type="submit" class="btn btn-primary">Submit</button>
             </div>
            </div>
    </form>
<?php include "footer.php" ?>