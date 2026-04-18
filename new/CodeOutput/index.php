<?php
session_start();
ini_set('display_errors', 1);
include('config/config.php');
include('language/eng.php');
include('libraries/' . $_SESSION['function'] . '.php');
include_once('libraries/class_dbcon.php');
include_once('libraries/upload_class.php');
include_once('libraries/system_users.php');
$haccess = new admin_users_model();
//$acc = $haccess->UserAccess();
$_SESSION['idsite'] = $_SESSION['id_hotel'];
$_SESSION['compta_devise_aff'] = 'CDF';
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
    <link href="<?php echo H_THEME; ?>/css/footable.core.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo H_THEME; ?>/css/skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo H_THEME; ?>/css/jquery.lightbox.min.css" type="text/css" media="screen" />
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

    <script src="libraries/bootstrap3-typeahead.min.js"></script>
    <script src="libraries/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="libraries/bootstrap-multiselect.css" />

</head>
<?php
date_default_timezone_set('Africa/Kinshasa');
$bdcl = 'skin-blue';
if (get('pg') == 'login') {
    /* include('libraries/views/admin/login.php'); */
    header('Location:../../Authentification/logout.php');
} else {
    $_SESSION['idmodule'] = 26;
    $do = '';
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do = 'in';
    }
    if ($do == 'rh') {
        $_SESSION['menu'] = 'rh';
        $_SESSION['title'] = 'Ressources humaines';
    } elseif ($do == 'mcr') {
        $_SESSION['title'] = 'Configuration';
        $_SESSION['menu'] = 'mcr';
    } elseif ($do == 'fact') {
        $_SESSION['title'] = 'Facturation';
        $_SESSION['menu'] = 'fact';
    } elseif ($do == 'achat') {
        $_SESSION['title'] = 'Achat';
        $_SESSION['menu'] = 'achat';
    } elseif ($do == 'heb2') {
        $_SESSION['title'] = 'Hébergement';
        $_SESSION['menu'] = 'hebergement';
    } elseif ($do == 'in') {
        $_SESSION['menu'] = 'menu';
        $_SESSION['title'] = "Applications";
    } elseif ($do == 'fusion') {
        $_SESSION['menu'] = 'fusion';
        $_SESSION['title'] = "Suivi d'activité";
        $bdcl = 'hold-transition skin-blue layout-top-nav';
    } elseif ($do == 'compta') {
        $bdd = HDB::hus();
        DatasExerciceDefault($_SESSION['idsite'], $bdd);
        $_SESSION['menu'] = 'compta';
        $_SESSION['title'] = "Comptabilité";
        $nbre_notification = 0;
        $statut = "attente";
        $requete = $bdd->prepare("SELECT a.mode,a.num_cmd,a.taux, a.fact1,a.id_fact,a.num_fact,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,
                                b.id_client,b.nom_entreprise,SUM(c.prix * c.qte) AS tot_cmd
                                    FROM  t_facture AS a, t_client AS b, lignes_commandes AS c
                                    WHERE a.id_client=b.id_client
                                    AND a.id_fact=c.commande_id 
                                    AND a.type='achat'
                                    AND a.id_hotel=:hotel_id AND a.statut_bon=:statut
                                    GROUP BY a.num_fact");
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->BindParam(':statut', $statut);
        $requete->execute();
        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
        $nbre_notification = count($operations);
        $_SESSION['nbre_notification'] = $nbre_notification;
    } elseif ($do == 'parambase') {
        $_SESSION['menu'] = 'menuparam';
        $_SESSION['title'] = "Paramètres de base";
    } elseif ($do == 'parambase') {
        $_SESSION['menu'] = 'menuparam';
        $_SESSION['title'] = "Paramètres de base";
    } elseif ($do == 'paramfact') {
        $_SESSION['menu'] = 'menuparam';
        $_SESSION['title'] = "Paramètres facturation";
    } elseif ($do == 'paramstk') {
        $_SESSION['menu'] = 'menuparam';
        $_SESSION['title'] = "Paramètres stock";
    }
    $_SESSION['dte_time_bdd'] = 'Y-m-d H:i:s';
    $_SESSION['dte_time_aff'] = 'd/m/Y H:i:s';
?>

    <body class="<?php echo $bdcl; ?>">
        <?php
        if (get('msg') == 'add') {
            success_msg(LANG_SUCCESS_ADD);
        } elseif (get('msg') == 'update') {
            success_msg(LANG_SUCCESS_UPDATE);
        } elseif (get('msg') == 'delete') {
            success_msg(LANG_SUCCESS_DELETE);
        } elseif (get('msg') == 'truncate') {
            success_msg(LANG_SUCCESS_TRUNCATE);
        } elseif (get('msg') == 'error') {
            error_msg(LANG_ERROR_MSG);
        } elseif (get('msg') == 'backup') {
            success_msg(LANG_BACKUP_CREATED);
        } elseif (get('dbrestore') != '') {
            success_msg(LANG_BACKUP_RESTORED);
        } elseif (get('dbfile') != '') {
            success_msg(LANG_BACKUP_DELETED);
        } elseif (get('msg') == 'paie') {
            success_msg(LANG_SUCCESS_PAIE);
        } elseif (get('msg') == 'cloture') {
            success_msg("La clôture de l'exercice s'est effectué avec succes!");
        }
        ?>
        <?php if ($do != 'fusion') { ?>
            <div class="wrapper">

                <header class="main-header">
                    <a href="#" class="logo"><b>Ebutelo</b></a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top" role="navigation">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- Messages: style can be found in dropdown.less-->
                                <li class="dropdown messages-menu">
                                    <!-- User Account-->
                                    <?php if (isset($_SESSION[H_USER_SESSION])) { ?>
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">

                                            <img src="<?php echo NO_IMAGE; ?>" class="img-circle" alt="User Image" />
                                            <p>
                                                <?php echo $_SESSION['user']; ?>
                                                <small>Aujourd'hui <?php echo date('d/m/Y'); ?></small>
                                            </p>
                                        </li>

                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo H_ADMIN; ?>&view=hsys_users2&do=details" class="btn btn-success btn-flat hidden"><?php echo LANG_PROFILE; ?></a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo H_LOGIN; ?>" class="btn btn-success btn-flat"><?php echo LANG_LOGOUT2; ?></a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <?php if (in_array('HIFC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                    <li class="dropdown user user-menu">

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-dollar"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="user-body btn-primary">
                                                <center>
                                                    <h4>
                                                        FONDS DE CAISSE
                                                    </h4>
                                                </center>
                                                <br>
                                                <form action="<?php echo H_ADMIN_MAIN . '&view=fondscaisse&do=addpro'; ?>" method="post" name="frmaddfdc" id="frmaddfdc" enctype="multipart/form-data">

                                                    <div class="form-group" id="grpmontantusd">
                                                        <input type="text" name="montantusd" id="montantusd" class="form-control" value="" placeholder="Montant en USD">
                                                    </div>
                                                    <div class="form-group" id="grpmontantcdf">
                                                        <input type="text" name="montantcdf" id="montantcdf" class="form-control" value="" placeholder="Montant en CDF">
                                                    </div>
                                                </form>
                                            </li>

                                            <!-- Menu Footer-->
                                            <li class="user-footer">
                                                <div class="pull-left">
                                                </div>
                                                <div class="pull-right">
                                                    <button type="b" name="addfdc" id="addfdc" class="btn btn-primary btn-flat">
                                                        <i class="fa fa-check"></i> Valider </button>
                                                </div>
                                            </li>
                                        </ul>

                                    </li>
                                <?php } ?>

                            <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </header>
                <!-- Left side column. contains the logo and sidebar -->
                <aside class="main-sidebar">
                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar ">
                        <!-- Sidebar user panel -->
                        <?php // if($do!='fusion'){
                        ?>
                        <div class="user-panel">
                            <div class="pull-left image">
                                <img src="<?php echo NO_IMAGE; ?>" class="img-circle" alt="User Image" />
                            </div>
                            <div class="pull-left info">
                                <p></p>
                                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                            </div>
                        </div>
                        <hr style="border-color:#666;">
                        <?php // } 
                        ?>
                        <!-- sidebar menu-->
                        <ul class="sidebar-menu">
                            <?php include(APP_FOLDER . '/views/admin/' . $_SESSION['menu'] . '.php'); ?>
                        </ul>
                    </section>
                    <!-- /.sidebar -->
                </aside>

                <!-- Right side column-->
                <div class="content-wrapper">
                    <!-- Content Header -->
                    <section class="content-header">
                        <h1>
                            <?php echo $_SESSION['title']; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <!--                            <li><a href="../../REC/tableaudebordRec.php" ><i class="fa fa-dashboard"></i> Dashboard</a></li>-->
                            <!--<li><a href="#">Tables</a></li>-->
                        </ol>
                    </section>
                    <div class="outputfdc"></div>
                    <!-- Main content -->
                    <section class="content" id="bloc_view_main">
                        <?php
                        $haccess->logged_in_protect(H_LOGIN);
                        if (get('view')) {
                            include(APP_FOLDER . '/controllers/admin/main.php');
                            include('libraries/controllers/system_users.php');
                        } else {
                            include('../new/CodeOutput/index.php?pg=admin&view=module&do=rh.php');
                        ?>

                            <!-- DESIGN AREA -->
                            <div class="box">
                                <div class="box-header with-border hidden">
                                    <h3 class="box-title ">Hezecom Ultimate Speed <em>ULTIMATE EDITION</em></h3>
                                    <div class="box-tools pull-right ">
                                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <section class="section" style="height: 1000px;">
                                        <div class="col-lg-3 col-xs-6">
                                            <div class="small-box bg-red">
                                                <div class="inner">
                                                    <br>
                                                    <br>
                                                    <h4>Configuration</h4>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-cogs"></i>
                                                </div>
                                                <a href="<?php echo H_ADMIN; ?>&view=module&do=mcr" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xs-6">
                                            <div class="small-box bg-primary">
                                                <div class="inner">
                                                    <br>
                                                    <br>
                                                    <h4>Ressources humaines</h4>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                                <a href="<?php echo H_ADMIN; ?>&view=module&do=rh" class="small-box-footer">Cliquez ici <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </section>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    ...the unique solution
                                </div><!-- /.box-footer-->
                            </div><!-- /.box -->

                        <?php } ?>
                        <!-- /DESIGN AREA -->

                    </section><!-- /.content -->

                </div><!-- /.content-wrapper -->
                <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                        <b>version </b> 2.0
                    </div>
                    <strong>&copy; <?php echo date('Y') ?> <a href="#">Ebutelo</a>.</strong> All rights reserved.
                </footer>
            </div><!-- ./wrapper -->
        <?php } else {
            include(APP_FOLDER . '/views/admin/suivi/vente.php');
        } ?>
    <?php } ?>

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
    <script>
        CKEDITOR.replace('editor1');
        $('#details').multiselect({
            nonSelectedText: 'Select details',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '400px'
        });
    </script>
    </body>


</html>