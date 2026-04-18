<?php
//Fusion horaire
//date_default_timezone_set('Europe/Paris');
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
//Affectation temps de la connexion de la page à la session
$_SESSION['lastload'] = time();
//=======================================
include('./Amelioration/bdd/connexion .php');
$id_hotel = $_SESSION['id_hotel'];
include '../FUNCTION/date_format.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ebutelo | app</title>
        <!-- Bootstrap Core CSS -->
        <link href="build/css/custom.min.css" rel="stylesheet">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap.timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/datepicker.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- Timeline CSS -->
        <link href="../css/plugins/timeline.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="../css/plugins/dataTables.bootstrap.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../css/sb-admin-2.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../datepicker/jquery.datetimepicker.css"/>
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../img/Iconebutelo2.png"/>
        <!-- Select2 -->
        <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" media="all" href="bootstrap-daterangepicker-master/daterangepicker.css" />


        <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap-select.min.css"/>
        <link rel="stylesheet" href="css/ajax-bootstrap-select.css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand1" href="index.php"><img src="../img/logoKB1.png"></a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown hidden">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Taux du Jour: 
                        </a>
                        <!-- /.dropdown-alerts -->
                    </li>
                   
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']; ?></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bank fa-fw"></i>
                                    <?php echo strtoupper($_SESSION['company_name']); ?>
                                </a>
                            </li>
                            <?php
                            if ($_SESSION['type_user'] == 1) {
                                ?>
                                <li><a href="detail_utilisateur.php?id_user=<?php echo $_SESSION['id_user'] ?>&prfl=1"><i class="fa fa-gear fa-fw"></i> MON PROFIL</a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li><a href="detail_utilisateur.php?id_user=<?php echo $_SESSION['id_user'] ?>&prfl=1"><i class="fa fa-gear fa-fw"></i> MON PROFIL</a>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="divider"></li>
                            <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
