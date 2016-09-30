<?php if (empty($_SESSION)) {
    ob_start();
    session_start();
}
    include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript" src="js/menu.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <title><?= (!empty($title)) ? $title : ""; ?></title>
</head>
<body class="skin-blue">
<section class="body">
<?php if (empty($_SESSION['user_id'])) { ?>
        <article class="header-menu">
            <section class="container">
                <?php if (empty($_SESSION['user_id'])) { ?>
                    <a href="index.php" class="col-sm-3 pull-left"><img src="images/a100Logo.png" width="50%"></a>
                <?php } ?>
                <div class="col-sm-2 pull-right">
                    <br>
                    <?php if (current_page() != 'login.php') { ?><a class="btn col-sm-6"   href="login.php">Sign In </a><?php } ?>
                    <?php if (current_page() == 'index.php') { ?><a class="btn btn-primary col-sm-6"
                                                                    href="register.php">Register</a><?php } ?>
                </div>
            </section>
        </article>
    <?php }else{ ?>
    <section class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo"><b><?= (!empty($_SESSION['user']) and ($_SESSION['user'] == true)) ? "Apprentice" : "Admin" ?></b>Panel</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs"><?= (!empty($_SESSION['username'])) ? $_SESSION['username'] : "" ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <p> <?= (!empty($_SESSION['username'])) ? $_SESSION['username'] : "" ?> </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    <aside class="main-sidebar">
    <section class="sidebar">
    <div class="user-panel">
            <div class="pull-left image">
              <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
            </div>
            <div class="pull-left info">
              <p> <?= (!empty($_SESSION['username'])) ? $_SESSION['username'] : "" ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
    <!--<li class="header">MAIN NAVIGATION</li>-->
        <?php if(!empty($_SESSION['user'])and($_SESSION['user']==true)){ ?>
            <li>
              <a href="profile.php">
                <i class="glyphicon glyphicon-user"></i>
                <span>My Profile</span>
              </a>
            </li>
        <li>
              <a href="tests.php">
                <i class="glyphicon glyphicon-book"></i>
                <span>Take Test</span>
              </a>
            </li>
        <li>
              <a href="results.php">
                <i class="glyphicon glyphicon-edit"></i>
                <span>View Scores</span>
              </a>
            </li>
        <?php }else{ ?>
            <li>
              <a href="scores.php">
                <i class="glyphicon glyphicon-book"></i>
                <span>Sorted Scores</span>
              </a>
            </li>
            <li>
              <a href="evaluate.php">
                <i class="glyphicon glyphicon-edit"></i>
                <span>Evaluate</span>
              </a>
            </li>
            <li>
              <a href="grant.php">
                <i class="fa fa-book"></i>
                <span>Grant</span>
              </a>
            </li>
        <?php } ?>
    </ul>
    </section>
    </aside>
    <section class="body content-wrapper">
        <section class="container">
            <h1 class="clearfix"></h1>
    <?php } ?>