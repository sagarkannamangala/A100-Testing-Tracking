<?php
    include "auth.php";
    $title = "Grant Attempts";
    include "home-header.php ";
    if(isset($_GET)and(!empty($_GET))){
        $req_id = (!empty($_GET['request'])) ? $_GET['request'] : "";
        $update = mysqli_query($link,"UPDATE `test_requests` SET `flag`='1' where `id`='".$req_id."'");
        if($update == true)
        {
            header("location:".$_SERVER['HTTP_REFERER']);
        }
    }
?>
<section class="container">
    <div class="col-sm-5">
        <img src="images/Add.png" class="img-responsive">
    </div>
        <article class="col-sm-7 table-responsive">
            <div class="h1 clearfix"></div>
             <div class="row">
            <div class="col-xs-10">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Additional Attempt Requests - Open</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th> </th>
                      <th>User Name</th>
                      <th>Course</th>
                      <th>Grant</th>
                    </tr>
                      <?php
                        $requests = mysqli_query($link,"SELECT * FROM `test_requests` WHERE `flag`='0' ORDER BY  `id` DESC ");
                        if(mysqli_num_rows($requests)>=1){
                        for ($i = 1; $i <= mysqli_num_rows($requests); $i++) {
                          $data = mysqli_fetch_row($requests);
                          ?>
                          <tr>
                              <td><?= $i ?></td>
                              <td><?php if (!empty($data[2])) {
                                      $users = mysqli_query($link, "SELECT `first_name`,`last_name` FROM `users` WHERE `id`='" . $data[2] . "'");
                                      $u = mysqli_fetch_row($users);
                                      echo $u[0] . $u[1];
                                  } ?></td>
                              <td><?php
                                      $courses = mysqli_query($link,"SELECT `course_name` from `courses` WHERE `id`='".$data[1]."'");
                                      $course = mysqli_fetch_row($courses);echo $course[0];
                                  ?></td>
                              <td><a href="grant.php?request=<?= $data[0] ?>"
                                     class="action btn btn-primary">Grant Attempt</a> </td>
                          </tr>
                      <?php }}else{ ?>
                            <tr><td colspan="4">No open Requests</td> </tr>
                      <?php } ?>
                    </table>
            </article>
            <div class="h1 clearfix"> </div>
        </section></section>
<?php include "footer.php"; ?>