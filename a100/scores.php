<?php
    include "auth.php";
    $title = "Sorted Scores";
    include "home-header.php";
    $course = (!empty($_GET['course'])) ? $_GET['course'] : "";	
?>
	
	
    <section class="container">
    <div class="col-sm-20 center center-block">
        <?php $skills = mysqli_query($link, "SELECT * FROM `courses` ORDER BY `id` DESC ");
            while ($s = mysqli_fetch_row($skills)) {
                ?>
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input type="radio" name="course_id"
                               value="<?= $s[0] ?>" <?= (!empty($course) and ($course == $s[0])) ? "checked=checked" : "" ?>
                               onchange="location.href='scores.php?course='+this.value"> <?= $s[1] ?>
                    </label></div>
            <?php
            }
        ?>
            </div>
<?php

    if (!empty($course)) {
        $results = mysqli_query($link, "SELECT `user_id`,SUM(`result`) FROM `results` WHERE course_id='".$course."' GROUP BY `user_id` order by `id` asc");
        ?>
        <article class="col-sm-7 center-block center table table-responsive">
            <div class="h1 clearfix"></div>
             <div class="row">
            <div class="col-xs-10">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">User Scores</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th> </th>
                      <th>User Name</th>
                      <th>Score</th>
                      <th>Profile</th>
                    </tr>
                      <?php for ($i = 1; $i <= mysqli_num_rows($results); $i++) {
                          $data = mysqli_fetch_row($results);
                          ?>
                          <tr>
                              <td><?= $i ?></td>
                              <td><?php if(!empty($data[0])){
                                $users = mysqli_query($link,"SELECT `first_name`,`last_name` from `users` WHERE `id`='".$data[0]."'");
                                      $u = mysqli_fetch_row($users);echo $u[0].$u[1];
                                  } ?></td>
								  <?php $res = mysqli_query($link,"select * from `answers` WHERE course_id='".$course."' and `answered_by`='".$data[0]."'");
										$count = mysqli_num_rows($res); ?>
                              <td><?= round($data[1]/$count)  ?></td>
                              <td><a href="ajax.php?user=<?= $data[0]  ?>" class="action btn btn-primary">Get Profile</a> </td>
                          </tr>
                      <?php } ?>
                    </table>
            </article>
        </section>
    <?php } ?>
    <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">User Details</h4>
      </div>
        <div class="modal-body" id="ajaxResult">

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <script>
        $(document).ready(function(){
            $('a.action').click(function(e){
                e.preventDefault();
                var href= $(this).attr('href');
                $.get(href,function(data){
                    $('#ajaxResult').html(data);
                    $('#myModal').modal('show');
                })
            })
        })
    </script>
    <div class="h1 clearfix"></div>
	
<?php include "footer.php" ?>
