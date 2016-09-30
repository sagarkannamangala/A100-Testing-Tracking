<?php
    session_start();
    $title = ($_SESSION['user'] == 'true') ? "User Panel" : "Admin Panel";
    include "home-header.php";
    include "user-auth.php";
    if ((isset($_POST)) and (!empty($_POST))) {
        $education = filter_input(INPUT_POST, 'education');
        $university = filter_input(INPUT_POST, 'university');
        $gpa = filter_input(INPUT_POST, 'gpa');
        $cohort = filter_input(INPUT_POST, 'cohort');
        $interests = filter_input(INPUT_POST, 'interests');
        $profile = mysqli_query($link, "UPDATE  `users` SET `education` ='" . $education . "',`university`='" . $university . "',`gpa` = '" . $gpa . "',`cohort` = '" . $cohort . "',`interests` = '" . $interests . "' WHERE `id` = '" . $_SESSION['user_id'] . "'");
        if($profile=='true'){
            $message = "<div class='alert alert-success'>Your Profile Updated Successfully..!</div>";
            header("refresh:2;url=".$_SERVER['HTTP_REFERER']);
        }else{
            $message = "<div class='alert alert-danger'>Profile Updation failed Due to:". mysqli_error($link)."..!</div>";
            header("refresh:2;url=".$_SERVER['HTTP_REFERER']);
        }
    }
?>
    <article class="col-lg-5"><img src="images\MyProfile.png" class="img-responsive col-sm-10"></article>
    <article class="col-sm-7">
    <?php
    $user_data = mysqli_query($link,"select * from `users` WHERE `id`='".$_SESSION['user_id']."'");
    $user = mysqli_fetch_array($user_data);
    ?>
    <h2 class="text-center col-sm-offset-4">My Profile</h2>
    <div class="col-sm-offset-4"> <?= (!empty($message)) ? $message : ""  ?></div>
    <form method="post" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-4">Education :</label>
                <div class="col-sm-8">
                    <input class="form-control" name="education" value="<?= !empty($user) ? $user['education'] : "" ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">University :</label>

                <div class="col-sm-8">
                    <input class="form-control" name="university"
                           value="<?= !empty($user) ? $user['university'] : "" ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">GPA :</label>
                <div class="col-sm-8">
                    <input class="form-control" name="gpa" value="<?= !empty($user) ? $user['gpa'] : "" ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Cohort :</label>
                <div class="col-sm-8">
                    <input class="form-control" name="cohort" value="<?= !empty($user) ? $user['cohort'] : "" ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Interests :</label>

                <div class="col-sm-8">
                    <textarea class="form-control"
                              name="interests"><?= !empty($user) ? $user['interests'] : "" ?></textarea>
                </div>
            </div>
            <div class="from-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase">Save</button>
                </div>
            </div>
        </form>
    </article>
            <div class="h1 clearfix"></div>
<?php include "footer.php" ?>