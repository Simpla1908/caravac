                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include'../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include'../FUNCTION/hebergement.php';
$nbArticles=0;
if (isset($_GET['detail'])) {
    $detail = $_GET['detail'];
    $id = $_GET['id'];
    $_SESSION['fiche'] = array();
    $_SESSION['fiche']['ingred_id'] = array();
    $_SESSION['fiche']['name'] = array();
    $_SESSION['fiche']['qte'] = array();
    $_SESSION['fiche']['utite'] = array();
    $ingredients=listeProduitIngredient($id,$_SESSION['id_hotel'], $bdd);
    foreach ($ingredients as $ingr){
        $prod_id=$ingr->produit_id;
        $name=$ingr->designation;
        $qte=$ingr->quantite;
        $utite=$ingr->unite;

        //Sinon on ajoute le produit
        array_push($_SESSION['fiche']['ingred_id'], $prod_id);
        array_push($_SESSION['fiche']['name'], $name);
        array_push($_SESSION['fiche']['qte'], $qte);
        array_push($_SESSION['fiche']['utite'],$utite);

        $nbArticles = count($_SESSION['fiche']['ingred_id']);
    }
    
        $requete = $bdd->prepare("SELECT a.prix_vente,b.id_sousresto,b.libelle AS resto,b.depot_id,b.taux,a.monnaie FROM t_prix_produit AS a, t_sousresto AS b
                    WHERE a.sousresto_id=b.id_sousresto AND b.etat=1 AND a.produit_id=:produit_id AND b.hotel_id=:id_hotel");
        $requete->BindParam(':produit_id', $id);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $depot = $requete->fetchAll(PDO::FETCH_OBJ);

            $col=6;
            $visible=1;
            $_SESSION['depot']=$depot;
            
    $_SESSION['visible'] = $visible;
    
} else {
    require 'index.php';
}

$type_cl = 'table';
$statut = 'libre';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type!=:type_cl ORDER BY cl.id_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ);

$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.statut=:statut ORDER BY cl.id_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->BindParam(':statut', $statut);
$requete->execute();
$tables = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Restaurant |  Parametrage des plats</title>
   <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" type="text/css" href="daterangepicker/daterangepicker-bs3.css"/>
    <!-- /.daterange picker -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="bootstrap/css/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="shortcut icon" href="images/fanion.png">
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="datepicker/jquery.datetimepicker.css">

    <style>
        .loader {
            background-image: url(images/ajax-loader.gif);
            background-repeat: no-repeat;
            background-position: center;
            height: 30px;
        }
        .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: none;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand"><b><i class="ion-android-restaurant"></i> Ebutelo</b> RESTO</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
<!--                <li class="ticket"><a href="#"><i class="ion-android-list"></i> Tickets</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Plus</a></li>-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><?php echo ucfirst($_SESSION['nom_user']); ?></a>
                        </li>
                        <li><a href="#">
                                <?php
                                if ($_SESSION['type_user'] == 1) {
                                    echo strtoupper($_SESSION['company_name']);
                                } else {
                                    echo strtoupper($_SESSION['nom_hotel']);
                                }
                                ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                        </li>
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
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php
                    
                    if ($detail == 'produit') {
                        echo 'Détail Plat';
                    } elseif ($detail == 'famille') {
                        echo 'Détail Famille';
                    } else {
                        echo 'Détail Sous-Famille';
                    }
                    ?>
                    <small><a href="plat.php">retour</a></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                
                    <div class="box" id="tableau_versement1">
                        <div class="box-header">
                            <div class="col-md-9">
                                <h3 class="box-title">
                                    <?php
                                    if ($detail == 'produit') {
//                                        echo 'Apercu sur un produit';
                                    } elseif ($detail == 'famille') {
//                                        echo 'Apercu sur une famille';
                                    } else {
//                                        echo 'Apercu sur une Sous-Famille';
                                    }
                                    ?>
                                </h3>
                            </div>
                            <div class="col-md-3">
                                
                                <?php if ($detail == 'produit') { ?>
                                    <div class="btn-group  btn-group-xs">
                                        <a href="update_plat.php?id=<?php echo $id; ?>&detail=<?php echo $detail; ?>"
                                               title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>
                                                Modifier</a>
                                        <a id="supprimer" class="btn btn-danger">
                                            <i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
<!--                                             <a href="#" id="print" class="btn btn-info">
                                            <i class="fa fa-print fa-fw"></i> Imprimer</a>-->
                                    </div>
                                <?php } elseif ($detail == 'famille') { ?>
                                    <div class="btn-group  btn-group-sm">
                                        <a href="update_plat.php?id=<?php echo $id; ?>&detail=<?php echo $detail; ?>"
                                               title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>
                                                Modifier</a>
                                        <a id="supprimer_fam" class="btn btn-danger">
                                            <i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="btn-group  btn-group-sm">
                                        <a href="update_plat.php?id=<?php echo $id; ?>&detail=<?php echo $detail; ?>"
                                               title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>
                                                Modifier</a>
                                        <a id="supprimer_sfam" class="btn btn-danger">
                                            <i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                    </div>
                                <?php } ?>
                                
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <?php 
                        if ($detail == 'produit') {
                            if (isset($_GET['code'])) {
                                    $requete = $bdd->prepare("SELECT prod.monnaie,prod.code,prod.idprod,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.repas,prod.qte_min,prod.unite,s_fam.des,fam.designation,fam.affichage "
                                            . "FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam "
                                            . "WHERE  prod.famille_id=s_fam.id_s_fam  AND prod.idprod=:idprod "
                                            . "AND  prod.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille ORDER BY prod.idprod DESC");
                                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                $requete->BindParam(':idprod',$id);
                                $requete->execute();
                                $produit_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
                                $code = $_GET['code'];

                            }
                        ?>
                        <?php foreach ($produit_motifs as $operation): 
                            $monnaie=$operation->monnaie;
                            ?>
                        <div class="box-body">
                            <div id="msgsup" class="alert alert-success alert-dismissable"
                                style=" text-align: center; display: none">
                               <span id="msg_alertsup">La suppression s'est effectué avec succès!</span>
                           </div>
                            
                            <div class="alert alert-warning alert-dismissible" id="msg_alert" style="display: none">
                                <button type="button" class="close confirmNo">&times;</button>
                                <h4><i class="icon fa fa-warning"></i> Suppression!</h4>
                                <p>Etes-vous sûr de vouloir supprimer cet élément ?</p>
                                 <div class="">
                                      <button type="button" class="btn btn-outline pull-right confirmNo">non</button>
                                      <button id="<?php echo $id; ?>" type="button" class="btn btn-outline pull-right confirmYes">oui</button>
                                </div>
                                <br><br>
                            </div>
                              <!--</div>-->
                            
                            <form role="form" id="detail_plat" action="Traitement/operation_insertion.php" class="form-horizontal form-label-left">
                                <input type="hidden" name="entree" value="e">
                                <input type="hidden" name="sortie" value="sortie">
                                <input type="hidden" name="idoperation" value="">
                                <br/>
                                
                                <div class="col-md-<?php echo $col ?>">

                                    <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Code : <span class="pull-right"><?php echo $code;?></span></a></li>
                                        <li><a href="#">Designation : <span class="pull-right"><?php echo $operation->produit;?></span></a></li>
                                        <li><a href="#">Sous Famille : <span class="pull-right"><?php echo $operation->des;?></span></a></li>
                                        <li><a href="#">Famille : <span class="pull-right"><?php echo $operation->designation;?></span></a></li>
                                    </ul>
                                    </div>
                                </div>
                                <!-- /.col -->
                                
                                <div class="col-lg-6">
                                <?php // if($visible==1){ ?>
                                <div class="table-responsive" >
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>POINT DE VENTE</th>
                                                <th><span class="pull-right2">Prix de vente</span></th>
                                                <!--<th>En vente</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($depot as $dep) {
                                                $monnaie=$dep->monnaie;
                                            ?>
                                            <tr>
                                                <td><?php echo $dep->resto ?><input class="form-control hidden" name="sousresto_id[]" id="sousresto_id" value="<?php echo $dep->id_sousresto ?>"></td>
                                                <td>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 pull-right2">
                                                        <?php
                                                    if ($m_affiche == $monnaie) {
                                                        echo ': ' . $dep->prix_vente . ' ' . $m_affiche;
                                                    } else {
                                                        if ($monnaie == 'USD' && $m_affiche == 'CDF') {
                                                            echo ': ' . $dep->prix_vente * $tauxdollar . ' ' . $m_affiche;
                                                        } else {
                                                            echo ': ' . round($dep->prix_vente * 1 / $tauxdollar, 2) . ' ' . $m_affiche;
                                                        }
                                                    }
                                                    ?>
                                                    </div>
                                                </td>
                                                <?php // if($operation->en_vente==1){?>
                                                <!--<td><input type="checkbox" name="en_vente" class="en_vente" id="<?php echo $dep->depot_id ?>" id1="<?php echo $operation->idprod ?>" value="<?php echo $dep->depot_id?>" checked="checked"></td>-->
                                                <?php // }else{?>
                                                <!--<td><input type="checkbox" name="en_vente" class="en_vente" id="<?php echo $dep->depot_id ?>" id1="<?php echo $operation->idprod ?>" value="<?php echo $dep->depot_id?>"></td>-->
                                                 <?php // }?>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php // } ?>
                            </div> 
                                
                                <div class="col-md-12">
                                    <br>
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <b>Fiche technique&nbsp;&nbsp;</b>
                                        </h4>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ingrédients</th>
                                                    <th>Qtés</th>
                                                    <th>Unités</th>
                                                </tr>
                                            </thead>
                                            <tbody id="fiche_technique">
                                                <?php 
                                                $j=1;
                                                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $j ?></td>
                                                            <td><?php echo $_SESSION['fiche']['name'][$i] ?></td>
                                                            <td><?php echo $_SESSION['fiche']['qte'][$i] ?></td>
                                                            <td><?php echo $_SESSION['fiche']['utite'][$i] ?></td>
                                                        </tr>
                                                <?php $j++; }; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col -->
                            </form>
                        </div>
                        <!-- /.box-body -->
                        <?php endforeach; ?>
                        <?php } elseif ($detail == 'famille') { 
                            $requete = $bdd->prepare("SELECT fam.idfamille,fam.designation FROM stk_famille AS fam WHERE fam.idfamille=:famille_id AND fam.hotel_id=:hotel_id ORDER BY fam.idfamille DESC");
                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                            $requete->BindParam(':famille_id',$id);
                            $requete->execute();
                            $famille_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
                            
                            ?>
                        
                        <div class="box-body">
                            <div id="msgsup1" class="alert alert-success alert-dismissable"
                                style=" text-align: center; display: none">
                               <span id="msg_alertsup1">La suppression s'est effectué avec succès!</span>
                           </div>
                            
                            <div class="alert alert-warning alert-dismissible" id="msg_alert1" style="display: none">
                                <button type="button" class="close confirmNo1">&times;</button>
                                <h4><i class="icon fa fa-warning"></i> Suppression!</h4>
                                <p>Etes-vous sûr de vouloir supprimer cet élément ?</p>
                                 <div class="">
                                      <button type="button" class="btn btn-outline pull-right confirmNo1">non</button>
                                      <button id="<?php echo $id; ?>" type="button" class="btn btn-outline pull-right confirmYes1">oui</button>
                                </div>
                                <br><br>
                            </div>
                              <!--</div>-->
                            <?php foreach ($famille_motifs as $fam): ?>
                            <form role="form" id="form1" action="Traitement/operation_insertion.php">
                                <input type="hidden" name="entree" value="e">
                                <input type="hidden" name="sortie" value="sortie">
                                <input type="hidden" name="idoperation" value="">
                                <br/>
                                <div class="col-lg-12">

                                    <div class="table-responsive" align="center">
                                        <table width="874">
                                            <tr>
                                                <td width="130">Designation&nbsp;&nbsp;</td>
                                                <td width="321">
                                                    <?php
                                                    echo ': ' .ucfirst($fam->designation);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr height="15">
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </form>
                              <?php endforeach; ?>
                        </div>
                        <?php }else{ 
                        $requete = $bdd->prepare("SELECT s_fam.id_s_fam,s_fam.des,fam.designation FROM stk_sous_famille AS s_fam,stk_famille AS fam WHERE s_fam.id_s_fam=:famille_id AND s_fam.famille=fam.idfamille AND s_fam.hotel_id=:hotel_id ORDER BY s_fam.id_s_fam DESC");
                        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                        $requete->BindParam(':famille_id',$id);
                        $requete->execute();
                        $s_famille_motifs = $requete->fetchAll(PDO::FETCH_OBJ);    
                            
                        ?>
                        
                        <div class="box-body">
                            <div id="msgsup2" class="alert alert-success alert-dismissable"
                                style=" text-align: center; display: none">
                               <span id="msg_alertsup2">La suppression s'est effectué avec succès!</span>
                           </div>
                            
                            <div class="alert alert-warning alert-dismissible" id="msg_alert2" style="display: none">
                                <button type="button" class="close confirmNo2">&times;</button>
                                <h4><i class="icon fa fa-warning"></i> Suppression!</h4>
                                <p>Etes-vous sûr de vouloir supprimer cet élément ?</p>
                                 <div class="">
                                      <button type="button" class="btn btn-outline pull-right confirmNo2">non</button>
                                      <button id="<?php echo $id; ?>" type="button" class="btn btn-outline pull-right confirmYes2">oui</button>
                                </div>
                                <br><br>
                            </div>
                              <!--</div>-->
                             <?php foreach ($s_famille_motifs as $s_fam): ?>
                              <form role="form" id="form2" action="Traitement/operation_insertion.php">
                                    <input type="hidden" name="entree" value="e">
                                    <input type="hidden" name="sortie" value="sortie">
                                    <input type="hidden" name="idoperation" value="">
                                    <br/>
                                    <div class="col-lg-12">

                                        <div class="table-responsive" align="center">
                                            <table width="874">
                                                <tr>
                                                    <td width="130">Designation&nbsp;&nbsp;</td>
                                                    <td width="321">
                                                        <?php
                                                        echo ': ' .$s_fam->des;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td width="130">Famille&nbsp;&nbsp;</td>
                                                    <td width="321">
                                                        <?php
                                                        echo ': ' .$s_fam->designation;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>


                                            </table>
                                        </div>

                                    </div>
                                </form>
                              <?php endforeach; ?>
                        </div>
                        
                        
                        <?php } ?>
                    </div>
                    <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->


<!-- Date time picker -->
<script src="datepicker/jquery.js"></script>
<script src="datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#dateres').datetimepicker();
</script>
<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
        $("#example3").DataTable();
        $("#example4").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript" src="js/resto.js"></script>
<script type="text/javascript" src="js/tab.js"></script>


<script type="text/javascript" src="daterangepicker/jquery.min.js"></script>
<script type="text/javascript" src="daterangepicker/moment-with-langs.min.js"></script>
<script type="text/javascript" src="daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">

    moment.lang('fr');

    var pickerLocale = {
        applyLabel: 'OK',
        cancelLabel: 'Annuler',
        fromLabel: 'Entre',
        toLabel: 'et',
        customRangeLabel: 'Période personnalisée',
        daysOfWeek: moment().lang()._weekdaysMin,
        monthNames: moment().lang()._months,
        firstDay: 0
    };

    var pickerRanges = {
        'Aujourd\'hui': [moment(), moment()],
        'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
        '5 jours précédents': [moment().subtract('days', 4), moment().subtract('days', 1)],
        'Ce mois': [moment().startOf('month'), moment().endOf('month')],
        'Mois précedent': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
    };


    $(document).ready(function () {
        //Suppression produit
        
        $("#supprimer").click(function () {
            $("#detail_plat").hide();
            $("#msg_alert").show();
        });
        $(".confirmNo").click(function () {
            $("#msg_alert").hide();
            $("#detail_plat").show();
        });
        
    var id;
    $(".confirmYes").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        $.ajax({
            url: 'Traitement/prod_rmv.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $("#msg_alert").hide();
                $("#msgsup").show().fadeOut(12000);
                window.location.href ="plat.php";
            }
        });
        
    });
    
    $("#supprimer_fam").click(function () {
            $("#form1").hide();
            $("#msg_alert1").show();
        });
        $(".confirmNo1").click(function () {
            $("#msg_alert1").hide();
            $("#form1").show();
        });
        
    var id;
    $(".confirmYes1").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        $.ajax({
            url: 'Traitement/fam_rmv.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $("#msg_alert1").hide();
                $("#msgsup1").show().fadeOut(12000);
                window.location.href ="plat.php";
            }
        });
        
    });
    
    $("#supprimer_sfam").click(function () {
            $("#form2").hide();
            $("#msg_alert2").show();
        });
        $(".confirmNo2").click(function () {
            $("#msg_alert2").hide();
            $("#form2").show();
        });
        
    var id;
    $(".confirmYes2").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        $.ajax({
            url: 'Traitement/s_fam_rmv.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $("#msg_alert2").hide();
                $("#msgsup2").show().fadeOut(12000);
                window.location.href ="plat.php";
            }
        });
        
    });
        
        
//        $('.en_vente').click(function (e) {
//        var id_depot,id_prod, affichage;
//        id_depot = $(this).val();
//        if ($(this).is(":checked")) {
//            id_depot = $(this).attr('id');
//            id_prod = $(this).attr('id1');
//            affichage = 1;
//            $.ajax({
//                url: 'Traitement/depot_change_statut.php',
//                async: true,
//                type: 'POST',
//                data: "id_depot=" + id_depot + "&id_prod=" + id_prod + "&affichage=" + affichage,
//                global: false,
//                cache: false,
//                success: function (html) {
//
//                }
//            });
//        } else {
//            id_depot = $(this).attr('id');
//            id_prod = $(this).attr('id1');
//            affichage = 0;
//            $.ajax({
//                url: 'Traitement/depot_change_statut.php',
//                async: true,
//                type: 'POST',
//                data: "id_depot=" + id_depot + "&id_prod=" + id_prod + "&affichage=" + affichage,
//                global: false,
//                cache: false,
//                success: function (html) {
//
//                }
//            });
//        }
//
//
//    });
        
        $('#save_sous_famille').click(function (e) {
        e.preventDefault();
        var donnees = $('#form_sfam').serialize();
        
        $.ajax({
            url: 'Traitement/sous_famille_insertion.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    $('#designation_sfam').val(' ');
                    $('#famille_sfam_id').val(' ');
                    
                    $('#msg2').show().fadeOut(4000)
                            .addClass('alert-success')
                            .removeClass('alert-danger');
                    $('#msg_alert2').text("L'enrégistrement s'est effectué avec succès!");
                    $("#view_sousfamille").load('./Traitement/view_sousfamille.php');
                } else if (data.message_erreur == 'erreur') {
                    $('#msg2').show()
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert2').text("Cette designation " + data.des_value + " de la sous famille existe déjà")
                } else if (data.message_vide== 'vide')  {
                    $('#msg2').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert2').text('Veuilez remplir les champs vides!')

                }

            }, dataType: 'json'
        });

    });
        
        
        
        $('#save_fam').click(function (e) {
            e.preventDefault();
            var donnees = $('#formfam').serialize();
//                alert(donnees);
            $.ajax({
                url: './Traitement/famille_insertion.php',
                type: 'POST',
                data: donnees,
                success: function (data) {

                    if (data.message_succes == 'succes') {
//                            effacer();
                            $('#designation').val(' ');
                        $('#msg1').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                        $('#msg_alert1').text("L'enrégistrement s'est effectué avec succès!");
                        $("#view_famille").load('./Traitement/view_famille.php');
//alert("succes");
                    } else if (data.message_erreur == 'erreur') {
                        $('#msg1').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert1').text("Cette famille existe déjà!")
                    } else if (data.message_vide== 'vide')  {
                        $('#msg1').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert1').text('Veuilez remplir les champs vides!')

                    }

                }, dataType: 'json'
            });

        });
        
        
        $("#famille_id").change(onSelectChange);
        function onSelectChange() {
            var idfamille = $("#famille_id").val();

            $.ajax({
                url: 'Traitement/requete_s_famille.php',
                async: true,
                type: 'POST',
                data: "idfamille=" + idfamille,
                global: false,
                cache: false,
                success: function (html) {
                    $("#s_famille_id").empty().append(html);
                }
            });


        }
        
        

        
        
        $("#btn_periode").click(function () {
            var periode = $('#periode').val();
            $.ajax({
                url: './Traitement/tableau_vente_jour.php',
                async: true,
                type: 'POST',
                data: "periode=" + periode,
                global: false,
                cache: false,
                success: function (html) {
                    $("#tableau").empty().append(html);
                    alert(data);

                }
            });
        });
        
        
        // Clic sur le bouton enregistrer produit 
        $('#save_produit').click(function (e) {
            e.preventDefault();
            var donnees = $('#form_insert_plat').serialize();

            $.ajax({
                url: 'Traitement/produit_insertion.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    //alert(data.message_succes);
                    if (data.message_succes == 'succes') {
                        effacer();
                        $('#msg').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                        $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!");
                        $("#monnaie").val(' ');
                        $("#famille_id").val(' ');
                        $("#s_famille_id").val(' ');
                        $("#code").val(' ');
                        $("#unite").val(' ');
                        $("#libelle").val(' ');
                        $("#prix_vente").val(' ');
                        $("#view_plat").load('./Traitement/view_plat.php');
                    } else if (data.message_erreur == 'erreur') {
                        $('#msg').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert').text("Ce code " + data.code_value + " du produit saisi existe déjà")
                    } else if (data.message_vide== 'vide')  {
                        $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert').text('Veuilez remplir les champs vides!')

                    }

                }, dataType: 'json'
            });

        });
        
        $("#save_table").click(function (e) {
            e.preventDefault();
            var donnees = $('#form_table').serialize();

            $.ajax({
                url: './Traitement/insertion_table.php',
                async: true,
                type: 'POST',
                data: donnees,
                global: false,
                cache: false,
                success: function (data) {
                    if (data.message_succes == 'succes') {
                        $('#msg').show();
                        $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!")
                        $("#codetable").val(' ');
                        $("#Destable").val(' ');
                        $("#view_table").load('./Traitement/view_table.php');
                        $('#msg').show().fadeOut(5000);
                        $("#reservation").load('./Traitement/ajout_reservation.php');
                         $('#tab_1').empty().load('liste_tbl_maj.php');

                    } else if (data.message_erreur == 'erreur') {
                        $('#msg').show();
                        $('#msg_alert').text("Ce code " + data.code_value + " du produit saisi existe déjà");
                        $('#msg').show().fadeOut(5000);
                    } else if (data.message_vide == 'vide') {
                        $('#msg').show();
                        $('#msg_alert').text('Veuilez remplir les champs vides!');
                        $('#msg').show().fadeOut(5000);
                    }

                }, dataType: 'json'
            });

        });
        
        
        
        

        $(".btn_res1").click(function (e) {
            e.preventDefault();
//                    var donnees = $('#form_res').serialize();
////                    alert(donnees);
//
//                    $.ajax({
//                        url: './Traitement/insertion_res_table.php',
//                        async: true,
//                        type: 'POST',
//                        data: donnees,
//                        global: false,
//                        cache: false,
//                        success: function (data) {
//                            $('.dateres').val(' ');
//                            $('.client_id').val(' ');
//                            $('.table_id').val(' ');
//                            $("#view_table").load('./Traitement/view_table.php');
////                            alert(data);
//                        }
//                    });

        });
        
        
        
        $("#ajouter").click(function () {
            $("#ajouter").hide();
            $("#fermer").show();
        });
        $("#fermer").click(function () {
            $("#fermer").hide();
            $("#ajouter").show();
        });
        
        $("#ajouterfam").click(function () {
            $("#ajouterfam").hide();
            $("#fermerfam").show();
        });
        $("#fermerfam").click(function () {
            $("#fermerfam").hide();
            $("#ajouterfam").show();
        });
        
        $("#ajouter_sfam").click(function () {
            $("#ajouter_sfam").hide();
            $("#fermer_sfam").show();
        });
        $("#fermer_sfam").click(function () {
            $("#fermer_sfam").hide();
            $("#ajouter_sfam").show();
        });


        $('#periode').daterangepicker(
            {
                showDropdowns: false,
                ranges: pickerRanges,
                format: 'DD/MM/YYYY',
                separator: ' à ',
                locale: pickerLocale
            }
        );
        $('#periode_heure').daterangepicker(
            {
                startDate: moment().subtract('days', 1),
                endDate: moment(),
                showDropdowns: false,
                showWeekNumbers: true,
                timePicker: true,
                timePickerIncrement: 1,
                timePicker12Hour: false,
                ranges: pickerRanges,
                format: 'DD/MM/YYYY hh:mm',
                separator: ' à ',
                locale: pickerLocale
            }
        );
        $('#date_simple').daterangepicker(
            {
                startDate: moment(),
                format: 'DD/MM/YYYY',
                singleDatePicker: true,
                locale: pickerLocale
            }
        );
        //scripts versement

        $('#dataTables-example').dataTable(
            {
                "ordering":false,
            }
        );
        

    });
</script>
</body>
</html>
