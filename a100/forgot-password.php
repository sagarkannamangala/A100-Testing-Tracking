<?php
    $title = "Forgot Password";
    include "home-header.php";
    if (isset($_POST) and (!empty($_POST))) {
        $email = filter_input(INPUT_POST, 'username');
        $check = mysqli_query($link, "SELECT * FROM `users` WHERE `email`= '" . $email . "' ");
        if (mysqli_num_rows($check) == 1) {
            $message = "<div class='alert alert-success'>New Password has been Sent to Your Email ..!</div>";
            header("refresh:1;".$_SERVER['HTTP_REFERER']);
        } else {
            $message = "<div class='alert alert-danger'>Your Email Does not Match Our Records Please CheckOnce...!</div>";
            header("refresh:1;".$_SERVER['HTTP_REFERER']);
        }
    }
?>
    <div class="col-sm-5 center-block center"> <?= (!empty($message)) ? $message : "" ?></div>
    <div class="h1 clearfix"></div>

    <div class="account-wall"><img class="profile-img" src="images/LoginImage.png" alt="No Image Found">
                <form class="form-signin" method="post">
                    <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="username" required autofocus>
                        </div>
                    <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login"><i
                            class="glyphicon glyphicon-log-in"></i> Verify Email</button>
                        </div>
</form>
        </div>
    <div class="h1 clearfix"></div>
<?php include "footer.php";