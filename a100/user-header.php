<div class="col-sm-3 pull-left">
    <a class="navbar-brand" href="#"><img src="images/a100Logo.png" class="img-responsive"></a>
</div>
<ul class="navbar-nav navbar-right nav">
    <li><a href="index.php"><?= (!empty( $_SESSION['username'])) ?  $_SESSION['username'] : "" ?></a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
<div class="navbar navbar-default navbar-fixed-side navbar-fixed-side-left" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a class="navbar-brand" href="#">Apprentice Home</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="#">My Profile</a></li>
                <li><a href="#">Take Test</a></li>
                <li><a href="#">View Scores</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
