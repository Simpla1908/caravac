<?php
// Initialisation de la session
session_start();
$id_hotel=$_SESSION['id_hotel'];?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KA-BE Sprl</title>
	
    <!-- Style CSS -->
    <link href="../css/styles.css" rel="stylesheet">
    
    

    <!-- MetisMenu CSS -->
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../css/plugins/timeline.css" rel="stylesheet">



    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and resume_reservation queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="../img/IconeKA-BE.png">
   <!--Link pour ST-->
<link rel="stylesheet" type="text/css" href="resume_reservation/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"  href="resume_reservation/css/dataTables.colVis.css">
<link rel="stylesheet" type="text/css"  href="resume_reservation/css/jquery-ui.css">
<link rel="stylesheet" type="text/css"  href="resume_reservation/css/TableTools_JUI.css">

    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
 <!--Fin link pour ST-->
    
     <script src="../js/jquery.js"></script>
     <script src="resume_reservation/js/bootstrap-popover.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
    <script>
	$(function (){
	/*$('input').datepicker();*/
	$('#date').datepicker();
	});
	</script>
    
     <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    
    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
  
    
     <!--Script pour ST-->
     
     
    
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
                <!--<a class="navbar-brand" href="index.html">SB Admin v2.0</a>-->
                <div id="img-header"><img src="../img/img-header.png"></div>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown hidden">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Taux du Jour: <?php echo ; ?>
                    </a>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown pull-right">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                     <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['user']; ?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i><?php echo $_SESSION['libe_droit']; ?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-support fa-fw"></i><?php echo strtoupper($_SESSION['nom_hotel']); ?></a>
                        </li>
                        <li class="divider"></li>
                       <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->