<?php
    include "config.php";
if(!empty($_GET['skill'])){
    $skill = filter_input(INPUT_GET,'skill');
    $check_skill = mysqli_query($link,"SELECT `has_test` from `courses` WHERE `id`='".$skill."'");
    $s = mysqli_fetch_row($check_skill);
    echo $s[0];
}
    if(isset($_POST)and(!empty($_POST))){
        $user_id = filter_input(INPUT_POST,'user_id');
        $skill_id = filter_input(INPUT_POST,'skill_id');
        $test_id = filter_input(INPUT_POST,'test_id');
        $data = mysqli_query($link,"SELECT `answer` from `answers` WHERE `answered_by`='".$user_id."' and `course_id`='".$skill_id."' and `test_id`='".$test_id."'");
        if(mysqli_num_rows($data)=='1'){
            $d= mysqli_fetch_row($data);
            echo "<textarea class='from-control' name='answer' rows='10' cols=25' readonly='true'>".$d['0']."</textarea>";
        }else{
            echo "0";
        }
    }