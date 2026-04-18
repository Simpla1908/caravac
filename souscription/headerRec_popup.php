<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
$id_hotel=$_SESSION['id_hotel'];

if (isset($_GET['menu'])) {
    $_SESSION['menu']=$_GET['menu'];
}  else {
    $_SESSION['menu']='';
}
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
    <!-- Custom Theme Style -->
    <link href="../bootstrap.timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="build/css/custom.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <!--<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->

        <link href="../css/bootstrap.min.css" rel="stylesheet">
<!--<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
        <!-- MetisMenu CSS -->
        <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="../css/plugins/dataTables.bootstrap.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../css/sb-admin-2.css" rel="stylesheet">
        <!-- Select2 -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="../img/Iconebutelo.png">
        <link rel="stylesheet" type="text/css" href="../datepicker/jquery.datetimepicker.css"/>
    <link rel="stylesheet" type="text/css" href="../css/styles.css"/>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0; height:51px;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="../img/logoKB1.png"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Réceptioniste</strong>
                                    <span class="pull-right text-muted">
                                        <em>Aujourd'hui</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <!--                        <li class="divider"></li>-->
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
<!--                    <ul class="dropdown-menu dropdown-alerts" id="alert">
                           <?php // include('alert.php') ?>
                    </ul>-->
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                     <li><a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo $_SESSION['nom_user'].' '.$_SESSION['prenom_user']; ?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-bank fa-fw"></i>
                            <?php
                            if ($_SESSION['type_user']==1){
                                echo strtoupper($_SESSION['company_name']);
                            }  else {
                                echo strtoupper($_SESSION['nom_hotel']);
                            }

                            ?>
                            </a>
                        </li>

                        <?php
                        if ($_SESSION['type_user']==1){
                        ?>
                        <li><a href="detail_utilisateur.php?id_user=<?php echo $_SESSION['id_user']?>&prfl=1"><i class="fa fa-gear fa-fw"></i> MON PROFIL</a>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li><a href="detail_utilisateur.php?id_user=<?php echo $_SESSION['id_user']?>&prfl=1"><i class="fa fa-gear fa-fw"></i> MON PROFIL</a>
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
