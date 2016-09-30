<?php
    include "auth.php";
    $title = "Evaluate";
    include "home-header.php ";
    if(isset($_POST)and(!empty($_POST)))
    {
        $user_id = filter_input(INPUT_POST,'user_id');
        $skill_id = filter_input(INPUT_POST,'skill_id');
        $test_id = filter_input(INPUT_POST,'test_id');
        $score = filter_input(INPUT_POST,'score');
        $check = mysqli_query($link,"SELECT * FROM `results` WHERE `user_id`='".$user_id."' and `course_id`='".$skill_id."' and `test_id`='".$test_id."'");
        if(mysqli_num_rows($check) =='0') {
            $query = mysqli_query($link, "INSERT INTO `results`  (`user_id`,`course_id`,`test_id`,`result`)VALUES ('" . $user_id . "','" . $skill_id . "','" . $test_id . "','" . $score . "')");
            if ($query == true) {
                $message = "<div class='alert alert-success'>Results submitted successfully.</div>";
                header("refresh:2;" . $_SERVER['HTTP_REFERER']);
            } else {
                $message = "<div class='alert alert-danger'>Results could not be Submitted.</div>";
                $message.="INSERT INTO `results`  (`user_id`,`course_id`,`test_id`,`result`)VALUES ('" . $user_id . "','" . $skill_id . "','" . $test_id . "','" . $score . "')";
                //header("refresh:2;" . $_SERVER['HTTP_REFERER']);
            }
        }else{
            $message = "<div class='alert alert-danger'>Results already submitted.</div>";
            header("refresh:2;" . $_SERVER['HTTP_REFERER']);
        }
    }
?>
    <style>
        .tests{display: none;}
    </style>
<section class="container">
    <div class="col-lg-4 col-md-4">
        <img src=" images/Evaluate.png" class="img-responsive">
    </div>
    <div class="col-lg-8 col-md-8">
        <div class="col-sm-10"> <?= (!empty($message)) ? $message : "" ?></div>
        <div class="h1 clearfix"></div>
        <form class="form-horizontal" method="post" id="evaluate">
            <div class="form-group">
                <label class="control-label col-sm-2">Apprentice <sup class="text-danger h5">*</sup> :</label>
                <div class="col-sm-6">
                    <select class="form-control" name="user_id" required="required">
                        <option value="">Select an Apprentice</option>
                        <?php
                            $users = mysqli_query($link, "SELECT `id`,`first_name`,`last_name` FROM `users`  WHERE `role`='1'");
                            while ($user = mysqli_fetch_row($users)) { ?>
                                <option value="<?= $user[0] ?>"><?= $user[1] . $user[2] ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Skill <sup class="text-danger h5">*</sup> :</label>
                <div class="col-sm-6">
                    <select class="form-control" name="skill_id" id="skill" required="required">
                        <option value="">Select a Skill</option>
                        <?php
                            $courses = mysqli_query($link, "SELECT *  FROM `courses` ORDER BY `id` DESC ");
                            while ($course = mysqli_fetch_row($courses)) { ?>
                                <option value="<?= $course[0] ?>"><?= $course[1] ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group tests">
                <label class="control-label col-sm-2">Attempts <sup class="text-danger h5">*</sup> :</label>
                <div class="col-sm-6">
                    <select class="form-control" name="test_id" id="test_id">
                        <option value="">Select an Attempt </option>
                        <option value="1">Attempt 1</option>
                        <option value="2">Attempt 2</option>
                        <option value="3">Attempt 3</option>
                        <option value="4">Attempt 4</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6" id="ajaxResult"></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Score:</label>
                <div class="col-sm-6">
                    <input class="form-control score" id="score" name="score" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</section>
    <script>
        $(document).ready(function(){
            $('#skill').on('change',function(){
                var  skill = $(this).val();
                $.get('ajax1.php',{skill:skill},function(data){
                    if(data=='1'){
                        $('.form-group.tests').show('slow');
                    }else{
                        $('.form-group.tests').hide('slow');
                    }
                })
            })
            $('#test_id').on('change',function(){
                var  skill = $('#evaluate').serialize();
                $.post('ajax1.php',skill,function(data){
                    if(data=='0'){
                        $('#ajaxResult').html(' ');
                        $('input.score').attr('readonly',true);
                        $("input.score").attr('id','disabledInput');
                        $('button[type=submit]').attr('disabled',true);
                    }else if(data !=0){
                        $('#ajaxResult').html(data);
                        $("input.score").removeAttr('id readonly');
                        $('button[type=submit]').attr('disabled',false);
                    }
                })
            })
        })
    </script>
<?php include "footer.php" ?>