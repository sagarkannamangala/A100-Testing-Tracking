<?php
    $title = "Login";
     include "home-header.php";
    if ((isset($_POST)) and (!empty($_POST))) {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $verify = mysqli_query($link,"SELECT * FROM `users` WHERE (`username` = '" . $username . "'  OR `email` = '" . $username . "') AND `password` = '" . $password . "'");
        if (mysqli_num_rows($verify) == '1') {
            $d = mysqli_fetch_array($verify);
            $_SESSION['user_id'] = $d['id'];
            $_SESSION['username'] = $d['username'];
            if ($d['role'] == 1) {
                $_SESSION['user'] = true;
                header("location:profile.php");
            } else if ($d['role'] == 0) {
                $_SESSION['login'] = true;
                header("location:scores.php");
            }
        }else{
            $message = "<div class='alert alert-danger'>Please Check Your Login Credentials...!</div>";
            header("refresh:2;url = login.php");
        }
    }
?>
<div class="col-sm-5 center-block center"> <?= (!empty($message)) ? $message : "" ?></div>
    <div class="h1 clearfix"></div>

    <div class="account-wall"><img class="profile-img" src="images/LoginImage.png" alt="No Image Found">
                <form class="form-signin" method="post">
                    <input type="text" class="form-control" placeholder="Email or Username" name="username" required
                           autofocus>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login"><i
                            class="glyphicon glyphicon-log-in"></i> Sign in
                    </button>
                    <span class="pull-left"><a href="forgot-password.php">Forgot Password?</a> </span>
                    <span class="pull-right">New User ? <a href="register.php">Click here.</a> </span>
                </form>
            </div>
    <div class="h1 clearfix"></div>
<?php include "footer.php" ?>