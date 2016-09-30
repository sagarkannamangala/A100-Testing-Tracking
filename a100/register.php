<?php
    $title = "Register";
include "home-header.php";
if ((isset($_POST)) and (!empty($_POST))) {
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email');
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $user = mysqli_query($link,"INSERT INTO `users`  (`first_name`,`last_name`,`email`,`username`,`password`) VALUES ('" . $first_name . "','" . $last_name . "','" . $email . "','" . $username . "','" . $password . "')");
    if ($user == true) {
        $message = "<div class='alert alert-success'>You have Registered Successfully.</div>";
        header("refresh:2;url=login.php");
    } else {
        $message = "<div class='alert alert-danger'>Registration Fail... feel free to contact Our Support Team..!</div>";
        header("refresh:2;url=login.php");
    }
}
?>
<section class="body">
    <section class="register-body">
        <section class="container">
		
            <article class="col-sm-7">
                <img src=" images/TestImage.png" class="img-responsive">
            </article>
            <article class="col-sm-4">
                <div class="h1 clearfix"></div>
                <?= (!empty($message)) ? $message : "" ?>
                <div class="h1 clearfix"></div>
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input class="form-control" name="first_name" placeholder="First Name" required="required" autofocus="true">
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" name="last_name" placeholder="Last Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" name="username" placeholder="Username" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" name="email" placeholder="Email" type="email"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" name="password" type="password" placeholder="Password"
                                   id="password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" name="confirm_password" type="password"
                                   placeholder="Confirm Password" id="confirm" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
            </article>
        </section>
    </section>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').submit(function (e) {
            var password = $('#password').val();
            var confirm = $('#confirm').val();
            if (password != confirm) {
                e.preventDefault();
                alert("Password and Confirm Password should be Same.");
            }
        });
    });
</script>
<br/>
<br/>
<br/>
<br/>
<br/>
<?php include "footer.php"; ?>
