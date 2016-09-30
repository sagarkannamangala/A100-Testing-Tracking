<?php
    $title = "Tests";
    include "user-auth.php";
    include "home-header.php";
?>
<article class="col-lg-9"><img src="images\Progress.png" class="img-responsive col-sm-20"></article>	
    <style>td,th{ border: solid 1px #333333 !important;}</style>
	
    <section class="col-sm-9 col-sm-offset-0">
        <div class="h1 clearfix"></div>
        <div class="h1 clearfix"></div>
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
                $results = mysqli_query($link, "SELECT * FROM `results` WHERE `user_id` = '" . $_SESSION['user_id'] . "'  group by `course_id` ORDER BY `id` ASC ");
                for ($i = 1; $i <= mysqli_num_rows($results); $i++) {
                    $r = mysqli_fetch_array($results);
                    ?>
                    <tr>
                    <td><?= $i ?></td>
                    <td><?php $courses = mysqli_query($link, "SELECT `course_name`,`id` FROM `courses` WHERE `id`='" . $r['course_id'] . "'");
                            $c = mysqli_fetch_array($courses);
                            echo $c['course_name'] ?>
                    </td>
                    <td><?php $t1 = mysqli_query($link,"SELECT  `result`  from `results`  where `course_id`='".$r['course_id']."'  and `test_id`='1' and `user_id`= '".$_SESSION['user_id']."'");
                        $tr1 = mysqli_fetch_array($t1);echo $tr1[0]; ?></td>
                    <td><?php $t2 = mysqli_query($link,"SELECT  `result`  from `results`  where `course_id`='".$r['course_id']."'  and `test_id`='2' and `user_id`= '".$_SESSION['user_id']."'");
                            $tr2 = mysqli_fetch_array($t2);echo $tr2[0]; ?></td>
                    <td><?php $t3 = mysqli_query($link,"SELECT  `result`  from `results`  where `course_id`='".$r['course_id']."'  and `test_id`='3' and `user_id`= '".$_SESSION['user_id']."'");
                            $tr3 = mysqli_fetch_array($t3);echo $tr3[0]; ?></td>
                      <td><?php $t4 = mysqli_query($link,"SELECT  `result`  from `results`  where `course_id`='".$r['course_id']."'  and `test_id`='4' and `user_id`= '".$_SESSION['user_id']."'");
                              $tr4 = mysqli_fetch_array($t4);echo $tr4[0]; ?></td>
                </tr>
                <?php } ?>
        </table>
    </section>
	
<?php include "footer.php" ?>