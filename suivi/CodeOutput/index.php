<?php
ini_set('display_errors', 0);
session_start();
include('config/config.php');
include('language/eng.php');
include('libraries/' . $_SESSION['function'] . '.php');
include_once('libraries/class_dbcon.php');
include_once('libraries/upload_class.php');
include_once('libraries/system_users.php');
$haccess = new admin_users_model();
$acc = $haccess->UserAccess();
$_SESSION['idsite'] = $_SESSION['id_hotel'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo H_TITLE; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo H_THEME; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo H_THEME; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo H_THEME; ?>/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo H_THEME; ?>/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo H_THEME; ?>/css/footable.core.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo H_THEME; ?>/css/skins.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo H_THEME; ?>/css/jquery.lightbox.min.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo H_THEME; ?>/css/datepicker.css">
        <link href="<?php echo H_THEME; ?>/css/chosen.min.css" rel="stylesheet">
        <link href="<?php echo H_THEME; ?>/css/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo H_THEME; ?>/css/admin.css" rel="stylesheet">
        <link href="<?php echo H_THEME; ?>/css/select2.min.css" rel="stylesheet">
        <link href="<?php echo H_THEME; ?>/css/pace.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo H_THEME; ?>/css/jquery.timepicker.css" />
        <script src="<?php echo H_THEME; ?>/js/modernizr.custom.js"></script>
        <script type="text/javascript" src="libraries/tinymce/js/tinymce/tinymce.min.js"></script>
        <script src="<?php echo H_THEME; ?>/js/jQuery-2.1.3.min.js"></script>
        <!-- insertion ckeditor -->
        <script src="<?php echo H_THEME; ?>/ckeditor/ckeditor.js"></script>
        <script src="<?php echo H_THEME; ?>/ckeditor/samples/js/sample.js"></script>
      <!--   <link rel="stylesheet" href="<?php echo H_THEME; ?>/ckeditor/samples/css/samples.css">
        --> 
        <link rel="stylesheet" href="<?php echo H_THEME; ?>/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

    </head>
    <?php
    date_default_timezone_set('Africa/Kinshasa');
    $bdcl = 'skin-blue';
    if (get('pg') == 'login') {
        /* include('libraries/views/admin/login.php'); */
        header('Location:../../Authentification/logout.php');
    } else {
        
    }
    ?>

    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="../../REC/tableaudebordRec.php" class="navbar-brand">
                                <b><i class="ion-android-restaurant"></i> Ebutelo</b>
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">
                                  
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#"><?php echo ucfirst($_SESSION['nom_user']); ?></a></li>
                                            <li class="divider"></li>
                                            <li><a href="../../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a></li>
                                        </ul>
                                        <!-- /.dropdown-user -->
                                    </li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.navbar-custom-menu -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>
            <!-- Full Width Column -->
            <div class="content-wrapper">
                 <?php include(APP_FOLDER . '/controllers/admin/main.php');?>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="container">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 2.0
                    </div>
                   
                </div>
                <!-- /.container -->
            </footer>
        </div>

        <script src="<?php echo H_THEME; ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/pace.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/footable.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.lightbox.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.form.js"></script>
        <script src="<?php echo H_THEME; ?>/js/chosen.jquery.min.js"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.knob.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/jquery.timepicker.js"></script>
        <script src="<?php echo H_THEME; ?>/js/app.min.js" type="text/javascript"></script>
        <script src="<?php echo H_THEME; ?>/js/<?php echo $_SESSION['fichierjs']; ?>.js"></script>

    </body>


</html>
