<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
     //Affectation temps de la connexion de la page à la session
//$_SESSION['lastload'] = time();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

include('../bdd/connexion.php');
include'../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include'../FUNCTION/hebergement.php';
include('../FUNCTION/restaurant.php');

$_SESSION['fiche'] = array();
$_SESSION['fiche']['ingred_id'] = array();
$_SESSION['fiche']['name'] = array();
$_SESSION['fiche']['qte'] = array();
$_SESSION['fiche']['utite'] = array();

if($_SESSION['type_user']==1){
    $visible=1;
    $col=12;
    $depot = ListPOSResto($_SESSION['id_hotel'], $bdd);
   
}else{
    $visible=1;
    $col=12;
    $depot = ListPOSRestoOne($_SESSION['id_sousresto'], $bdd);
}
$_SESSION['visible'] = $visible;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Restaurant |
        <?php
            echo 'Plats';
        ?>
    </title>
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
/*         .loader_cmd {
            display:none;
        }*/
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
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <!--<li class="ticket"></li>-->
                <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Plus</a></li>
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
                        <li><a href="#">
                                <?php
                                if ($_SESSION['test'] == 1) {
                                    echo '('.$_SESSION['libelle_resto'].')';
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                        if ($_SESSION['type_user'] != 1) {
                            ?>
<!--                            <li><a href="../REC2/detail_utilisateur.php?id_user=<?php echo $_SESSION['id_user']?>&prfl=1"><i class="fa fa-gear fa-fw"></i> MON PROFIL</a>
                            </li>-->
                            <?php
                        }
                        ?>
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
    <?php
    include('./POP-UP/action.php');
    ?>
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Parametrage des plats </h1>
            </section>

            <!-- Main content -->
            <section class="content">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Plat</a></li>
                <li><a href="#tab_2" data-toggle="tab">Famille</a></li>
                <li><a href="#tab_3" data-toggle="tab">Sous-famille</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-lg-5">
                                <h3 class="box-title">
                                    Liste des Plats
                                </h3>
                            </div>
                            <div class="col-lg-5">
                                <span class="text-danger hidden" id="loader_affich">
                                    <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement...
                                </span>
                            </div>
                                <div class="col-lg-2 text-center">
                                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo" id="ajouter">
                                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
                                    </a>
                                    <a style="display: none" class="btn btn-primary" data-toggle="collapse"
                                       data-parent="#accordion" href="#collapseTwo" id="fermer">
                                        <i class="fa fa-minus-circle fa-fw"></i>&nbsp;Fermer
                                    </a>
                                </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel box box-default" id="ajout">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a>
                                                Ajout d'un plat
                                            </a>
                                        </h4>
                                    </div>
                                    <form id="form_insert_plat" action="Traitement/produit_insertion.php" method="post">
                                        <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert;?>">
                                        <input class="form-control hidden" name="plat" id="plat" value="1">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Famille</label>
                                                        <select class="form-control" id="famille_id" name="famille_id" required>
                                                            <option>  </option>
                                                        <?php
//                                                        include('./Traitement/famille_combo.php');
//
//                                                        foreach ($familles  as $f):
//                                                            echo '<option value=' . $f->idfamille. '>' . ucfirst($f->designation) . '</option>';
//                                                        endforeach;
//                                                        ?>
                                                    </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label>Sous-Famille</label>
                                                        <select class="form-control" id="s_famille_id" name="s_famille_id" required>
                                                        <option>  </option>
                                                        <?php
//                                                            include('./Traitement/s_famille_combo.php');
//
//                                                            foreach ($s_familles  as $f):
//                                                                echo '<option value=' . $f->id_s_fam.'>' . ucfirst($f->des).'</option>';
//                                                            endforeach;
                                                        ?>
                                                    </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label>Désignation</label>
                                                        <input class="form-control col-md-7 col-xs-12"id="libelle" name="libelle">
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label>Code</label>
                                                        <input class="form-control col-md-7 col-xs-12" id="code" name="code">
                                                        <input class="form-control col-md-7 col-xs-12 hidden" value="unite" id="unite" name="unite">
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <?php // if($_SESSION['type_user']==1){ ?>
                                                    <div class="form-group hidden">
                                                        <label>Prix de vente</label>
                                                        <div class="form-group input-group">
                                                            <input class="form-control" name="prix_vente" id="prix_vente" value="0">
                                                            <span class="input-group-addon"> <?php echo $m_insert;?></span>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php // } ?>
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-md-6">
                                                    <?php // if($visible==0){ ?>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>POINT DE VENTE</th>
                                                                    <th><span class="pull-right">Prix de vente</span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($depot as $dep) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $dep->libelle  ?>
                                                                        <input class="form-control hidden" name="sousresto_id[]" id="sousresto_id" value="<?php echo $dep->id_sousresto ?>">
                                                                        <input class="form-control hidden" name="depot_id[]" id="depot_id" value="<?php echo $dep->id_sousresto ?>">
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                                                                            <div class="form-group input-group">
                                                                                <input class="form-control" name="prix_vente_site[]" id="prix_vente_site" value="0">
                                                                                <span class="input-group-addon"> <?php echo $m_insert;?></span>
                                                                             </div>
                                                                        </div>
                                                                    </td>
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
                                                    <br><br>
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#profile" data-toggle="tab">Fiche technique</a>
                                                    </li>
                                                    <a class="btn btn-primary btn-sm" href="#" title="Ajouter" data-toggle="modal" data-target="#myModaladdFch">

                                                  <i class="fa fa-plus-circle"></i> Ajouter
                                                    </a>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content" id="bloc_actions">
                                                    <br><br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="table-responsive">
                                                        <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Ingrédients</th>
                                                                    <th>Unités</th>
                                                                    <th>Qtés</th>
                                                                    <th>
                                                                        <div class="tools text-center">
                                                                            <a href="#" title="Selectionner & Supprimer" id="btn_supp" class="text-danger"><i class="fa fa-trash-o"></i></a>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="fiche_technique">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.table-responsive -->
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <div class="box-footer">
                                            <div class="col-md-9">
                                                <div id="msg" class="alert alert-warning alert-dismissable"
                                                     style=" text-align: center; display: none">
                                                    <i class='fa fa-warning fa-fw'></i> <span id="msg_alert"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-danger pull-right"
                                                        id="save_produit"><i class="fa fa-save fa-fw"></i>&nbsp;Enregistrer
                                                </button>
                                                <span class="btn btn-info hidden pull-right" id="loader">
                                                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                </span>
                                            </div>
                                        </div>

                                    </form>
                                    <!-- /.box-footer -->
                                </div>

                                <?php // } ?>
                            </div>
                                <div class="box" id="view_plat">
                                    <?php include('./Traitement/view_plat.php'); ?>
                                </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-lg-5">
                                <h3 class="box-title">
                                    Liste des Familles
                                </h3>
                            </div>
                            <div class="col-lg-5">
                                <span class="text-danger hidden" id="loader_affich1">
                                    <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement...
                                </span>
                            </div>
                                <div class="col-lg-2 text-center">
                                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwofam" id="ajouterfam">
                                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
                                    </a>
                                    <a style="display: none" class="btn btn-primary" data-toggle="collapse"
                                       data-parent="#accordion" href="#collapseTwo" id="fermerfam">
                                        <i class="fa fa-minus-circle fa-fw"></i>&nbsp;Fermer
                                    </a>
                                </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="collapseTwofam" class="panel-collapse collapse">
                                <div class="panel box box-default" id="ajout">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a>
                                                Ajout d'une famille
                                            </a>
                                        </h4>
                                    </div>
                                        <div class="box-body">
                                            <form id="formfam" method="post" action="Traitement/famille_insertion.php"  data-parsley-validate class="form-horizontal form-label-left">
                                                <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert;?>">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Désignation <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" name="designation" id="designation" required class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                        <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                                        <button type="submit" id="save_fam" class="btn btn-success">Sauvegarder</button>
                                                        <span class="btn btn-info hidden" id="loader_fam">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="msg1" class="alert alert-success alert-dismissable" style="display:none;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <span id="msg_alert1">Succès!</span>
                                                </div>
                                            </form>
                                        </div>
                                    <!-- /.box-footer -->
                                </div>

                                <?php // } ?>
                            </div>
                                <div class="box" id="view_famille">
                                    <?php include('./Traitement/view_famille.php'); ?>
                                </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="col-lg-5">
                                <h3 class="box-title">
                                    Liste des Sous-familles
                                </h3>
                            </div>
                            <div class="col-lg-5">
                                <span class="text-danger hidden" id="loader_affich2">
                                    <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement...
                                </span>
                            </div>
                                <div class="col-lg-2 text-center">
                                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo_sfam" id="ajouter_sfam">
                                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
                                    </a>
                                    <a style="display: none" class="btn btn-primary" data-toggle="collapse"
                                       data-parent="#accordion" href="#collapseTwo" id="fermer_sfam">
                                        <i class="fa fa-minus-circle fa-fw"></i>&nbsp;Fermer
                                    </a>
                                </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="collapseTwo_sfam" class="panel-collapse collapse">
                                <div class="panel box box-default" id="ajout">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a>
                                                Ajout d'une sous-famille
                                            </a>
                                        </h4>
                                    </div>
                                        <div class="box-body">
                                            <form id="form_sfam" method="post" action="Traitement/sous_famille_insertion.php"  data-parsley-validate class="form-horizontal form-label-left">
                                                <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert;?>">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Famille <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="form-control" id="famille_sfam_id" name="famille_id" required>
                                                            <option>  </option>
                                                            <?php
//                                                            include('./Traitement/famille_combo.php');
//
//                                                            foreach ($familles as $f):
//                                                                echo '<option value=' . $f->idfamille . '>' . $f->designation . '</option>';
//                                                            endforeach;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Désignation <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" name="designation" id="designation_sfam" required class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                        <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                                        <button type="submit" id="save_sous_famille" class="btn btn-success">Sauvegarder</button>
                                                        <span class="btn btn-info hidden" id="loader_sfam">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="msg2" class="alert alert-success alert-dismissable" style="display:none;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <span id="msg_alert2">Succès!</span>
                                                </div>
                                            </form>
                                        </div>
                                    <!-- /.box-footer -->
                                </div>

                                <?php // } ?>
                            </div>
                                <div class="box" id="view_sousfamille">
                                    <?php include('./Traitement/view_sousfamille.php') ?>
                                </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->                    
                    
               
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->


<!-- Modal -->
<div class="modal fade" id="myModaladdFch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout fiche technique</h4>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Produits</label>
                        <select class="form-control" id="ingred_id" name="ingred_id" required>
                            <option>  </option>
                            <?php
                            include('./Traitement/ingredients_combo.php');
                            foreach ($ingredients  as $ing):
                                echo '<option value=' . $ing->idprod. '>' . ucfirst($ing->designation) . '</option>';
                            endforeach;
//                                                        ?>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Unité</label>
                        <select class="form-control" id="unite_ingred" name="unite_ingred">

                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Quantité</label>
                        <input class="form-control col-md-7 col-xs-12" id="qte_ingred" name="qte_ingred">
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-danger pull-right"
                        id="add_ingred"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
                    </button>
                    <span class="btn btn-info hidden pull-right" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
        var k=1;
        $.ajax({
            url: './Traitement/famille_combo.php',
            dataType: 'json',
            success: function(json) {
                $.each(json, function(index, value) {
                    $('#famille_id').append('<option value="'+ index +'">'+ value +'</option>');
                    $('#famille_sfam_id').append('<option value="'+ index +'">'+ value +'</option>');
                });
            }
        });
       

        $('#save_sous_famille').click(function (e) {
        e.preventDefault();
        var donnees = $('#form_sfam').serialize();
        var bool;
        $.ajax({
            url: 'Traitement/sous_famille_insertion.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
            $("#loader_sfam").removeClass('hidden');
            $("#save_sous_famille").addClass('hidden');
            },
            success: function (data) {
                bool=true;
                if (data.message_succes == 'succes') {
                    $('#designation_sfam').val(' ');
                    $('#famille_sfam_id').val(' ');
                    
                    $('#msg2').show().fadeOut(4000)
                            .addClass('alert-success')
                            .removeClass('alert-danger');
                    $('#msg_alert2').text("L'enrégistrement s'est effectué avec succès!");
//                    $("#view_sousfamille").load('./Traitement/view_sousfamille.php');
                    $('#view_sousfamille').load('./Traitement/view_sousfamille.php', function() {
                            $("#loader_affich2").removeClass('hidden').fadeOut(8000);
                        });
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

            },complete: function () {
                if (bool) {
                    $("#loader_sfam").addClass('hidden');
                    $("#save_sous_famille").removeClass('hidden');
                } else {
                    $("#loader_sfam").removeClass('hidden');
                    $("#save_sous_famille").addClass('hidden');
                }
            }, dataType: 'json'
        });

    });
        
        
        
        $('#save_fam').click(function (e) {
            e.preventDefault();
            var donnees = $('#formfam').serialize();
            var bool;
            $.ajax({
                url: './Traitement/famille_insertion.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                $("#loader_fam").removeClass('hidden');
                $("#save_fam").addClass('hidden');
                },
                success: function (data) {
                    bool=true;
                    if (data.message_succes == 'succes') {
//                            effacer();
                        $('#designation').val(' ');
                        $('#msg1').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                        $('#msg_alert1').text("L'enrégistrement s'est effectué avec succès!");
                        $("#view_famille").load('./Traitement/view_famille.php');
                        $('#view_famille').load('./Traitement/view_famille.php', function() {
                            $("#loader_affich1").removeClass('hidden').fadeOut(8000);
                        });
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

                },complete: function () {
                    if (bool) {
                        $("#loader_fam").addClass('hidden');
                        $("#save_fam").removeClass('hidden');
                    } else {
                        $("#loader_fam").removeClass('hidden');
                        $("#save_fam").addClass('hidden');
                    }
                }, dataType: 'json'
            });


           $('#famille_id').empty();
            $('#famille_sfam_id').empty();
            $.ajax({
                url: './Traitement/famille_combo.php',
                dataType: 'json',
                success: function(json) {
                    $.each(json, function(index, value) {
                        $('#famille_id').append('<option value="'+ index +'">'+ value +'</option>');
                        $('#famille_sfam_id').append('<option value="'+ index +'">'+ value +'</option>');
                    });
                }
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
        
        $("#ingred_id").change(onSelectChangeUnity);
        function onSelectChangeUnity() {
            var ingred_id = $("#ingred_id").val();

            $.ajax({
                url: 'Traitement/select_unite_ingred.php',
                async: true,
                type: 'POST',
                data: "ingred_id=" + ingred_id,
                global: false,
                cache: false,
                success: function (html) {
                    $("#unite_ingred").empty().append(html);
                }
            });
        }
        
        $("#add_ingred").click(function () {
            var selected = $("#ingred_id option:selected");
            var ingred_id= selected.val();
            var ingred_name= selected.text();
            var utite = $("#unite_ingred").val();
            var qte = $("#qte_ingred").val();
//            alert(ingred_id);
            $.ajax({
                url: 'Traitement/tableau_fiche_tech.php',
                async: true,
                type: 'POST',
                data: "ingred_id=" + ingred_id + "&ingred_name=" + ingred_name+ "&utite=" + utite + "&qte=" + qte,
                global: false,
                cache: false,
                success: function (data) {
//                    alert(data);
                    $("#fiche_technique").empty().html(data);
                    $("#myModaladdFch").modal('hide');
                    $("#qte_ingred").val('');
                }
            });
            

            
        });
        
        $('#btn_supp').click(function (e) {
            var donnees = '';
            var ingred_id;
//            var qte_produit = $('#qte_produit').val();
            //var id_produit = $('#id_produit').val();
            var supprimer = 'OK';
            $('.ch_ingred:checked').each(function (i) {
                ingred_id = $(this).val();
                $.ajax({
                    url: 'Traitement/tableau_fiche_tech.php?ingred_id=' + ingred_id + "&supprimer=" + supprimer,
                    type: 'POST',
                    data: donnees,
                    success: function (data) {

                        $("#fiche_technique").empty().html(data);
                    }
                });

            });

            return false;

        });
        
        $("#fiche_technique").on('mouseout', '.qte_prod', function () {
            var donnees = '';
            var ingred_id= $(this).attr('id');
            var qte_produit = $(this).val();
//            alert(qte_produit);
            var modifier = 'OK';
                $.ajax({
                    url: 'Traitement/tableau_fiche_tech.php?ingred_id=' + ingred_id + "&modifier=" + modifier + "&qte_produit=" + qte_produit,
                    type: 'POST',
                    data: donnees,
                    success: function (data) {

                        $("#fiche_technique").empty().html(data);
                    }
                });
            return false;
        });
        
        $("#btn_periode").click(function () {
            var periode = $('#periode').val();
            var current = $('#current').val();
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
            
            $.ajax({
                url: './Traitement/data_analyse_financiere.php',
                async: true,
                type: 'POST',
                data: "periode=" + periode + "&current=" + current,
                global: false,
                cache: false,
                success: function (html) {
                    $("#tab_2").empty().append(html);
                    alert(data);

                }
            });
            
        });
        
        
        // Clic sur le bouton enregistrer produit 
        $('#save_produit').click(function (e) {
            e.preventDefault();
            var bool;
            var donnees = $('#form_insert_plat').serialize();

            $.ajax({
                url: 'Traitement/produit_insertion.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#save_produit").addClass('hidden');
                },
                success: function (data) {
                    bool=true;
                    //alert(data.message_succes);
                    if (data.message_succes == 'succes') {
//                        effacer();
                        $('#msg').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                        $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!");
//                        $("#monnaie").val(' ');
                        $("#famille_id").val(' ');
                        $("#s_famille_id").val(' ');
                        $("#code").val(' ');
                        $("#unite").val(' ');
                        $("#libelle").val(' ');
                        $("#prix_vente").val(' ');
                        $("#fiche_technique").empty();
//                        $("#view_plat").load('./Traitement/view_plat.php');
                        $('#view_plat').load('./Traitement/view_plat.php', function() {
                            $("#loader_affich").removeClass('hidden').fadeOut(8000);
                        });
                    } else if (data.message_erreur == 'erreur') {
                        $('#msg').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert').text("Le code ou la désignation du produit saisi existe déjà")
                    } else if (data.message_vide== 'vide')  {
                        $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert').text('Veuilez remplir les champs vides!')

                    }

                },complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                        $("#save_produit").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                        $("#save_produit").addClass('hidden');
                    }
                }, dataType: 'json'
            });

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
