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
    
    
        $requete = $bdd->prepare("SELECT a.id_prix,a.prix_vente,b.id_sousresto,b.libelle AS resto,b.depot_id FROM t_prix_produit AS a, t_sousresto AS b
                    WHERE a.sousresto_id=b.id_sousresto AND b.etat=1 AND a.produit_id=:produit_id AND b.hotel_id=:id_hotel");
        $requete->BindParam(':produit_id', $id);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $depot = $requete->fetchAll(PDO::FETCH_OBJ);
        $nbr=count($depot);
        
            $col=6;
            $visible=1;
            $_SESSION['depot']=$depot;
            foreach ($depot as $dep) {
                $_SESSION['id_prix']=$dep->id_prix ;
            }
        
    $_SESSION['visible'] = $visible;

} else {
    require 'index.php';
}

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
<!--                <li><a href="#">Taux du jour: <b><span id="taux_jr"><?php echo $taux_op; ?></span></b> </a></li>
                <li>
                   <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
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
                                    Modification
                                </h3>
                            </div>
                            <div class="col-md-3">
                                
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <?php 
                        if ($detail == 'produit') {
                            $requete = $bdd->prepare("SELECT prod.code,prod.idprod,prod.designation AS produit,prod.pa,prod.pv,prod.statut,prod.qte_initial,prod.qte_min,prod.repas,prod.unite,prod.monnaie,s_fam.id_s_fam,s_fam.des,fam.idfamille,fam.designation ,fam.affichage,fam.plat FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam WHERE  prod.famille_id=s_fam.id_s_fam  AND prod.idprod=:idprod AND  prod.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille ORDER BY prod.idprod DESC");
                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                            $requete->BindParam(':idprod',$id);
                            $requete->execute();
                            $produit_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <div class="box-body">
                            <div class="panel box box-default" id="ajout">
                                    <?php
                                    foreach ($produit_motifs as $prod):
                                    ?>
                                    <form id="form_update_plat" action="Traitement/prod_modifier.php" method="post" class="form-horizontal form-label-left">
                                        <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $prod->monnaie;?>">
                                        <input type="hidden" name="idprod" value="<?php echo $prod->idprod; ?>">
                                        <input class="form-control hidden" name="plat" id="plat" value="1">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-<?php echo $col ?>">
                                                    <br>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Famille</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control" id="famille_id" name="famille_id" required> 													<option>  </option>
                                                                <?php
                                                                echo '<option selected value=' . $prod->idfamille . '>' . $prod->designation . '</option>';
                                                                include('./Traitement/famille_combo.php');
                                                                foreach ($familles  as $f):
                                                                    echo '<option value=' . $f->idfamille. '>' . ucfirst($f->designation) . '</option>';
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sous-Famille</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control" id="s_famille_id" name="s_famille_id" required>
                                                                <?php
                                                                    echo '<option value=' . $prod->id_s_fam . '>' . $prod->des . '</option>';
                                                                    include('./Traitement/s_famille_combo.php');

                                                                    foreach ($s_familles  as $f):
                                                                        echo '<option value=' . $f->id_s_fam.'>' . ucfirst($f->des).'</option>';
                                                                    endforeach;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Désignation</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input class="form-control col-md-7 col-xs-12" value="<?php echo $prod->produit; ?>" id="libelle" name="libelle">
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Code</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input class="form-control col-md-7 col-xs-12" name="code_ex"
                                                                       value="<?php echo $prod->code; ?>" type="hidden">
                                                                <input class="form-control col-md-7 col-xs-12" id="code" name="code"
                                                                       value="<?php echo $prod->code; ?>">
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group hidden ">
                                                        <label>Unité</label>
                                                        <select class="form-control" id="unite" name="unite">
                                                            <?php echo '<option value=' . $prod->unite . '>' . $prod->unite . '</option>'; ?>
                                                            <option value="piece">Pièce</option>
                                                            <option value="kg">Kilogramme</option>
                                                            <option value="l">Litre</option>
                                                            <option value="cl">Centilitre</option>
                                                            <option value="g">Gramme</option>
                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <?php // if($_SESSION['type_user']==1){ ?>
                                                    <div class="form-group hidden">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Prix de vente<?php // if($visible==1){ echo ' par defaut'; }?></label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="input-group">
                                                                <input class="form-control" value="<?php echo $prod->pv; ?>" name="prix_vente" id="prix_vente" value="0">
                                                                <input
                                                                     class="form-control" name="enreg" id="enreg"
                                                                     type="hidden" value="1">
                                                                <span class="input-group-addon"> <?php echo $prod->monnaie;?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php //} ?>
                                                    <!-- /.form-group -->
<!--                                                        <div class="form-group">

                                                        <input class="" type="checkbox" value="1" name="repas" id="repas">
                                                        <label>à préparer</label>
                                                    </div>-->
                                                    <!-- /.form-group -->
                                                </div>
                                                <!-- /.col -->
                                                
                                                <div class="col-md-6">
                                                    <?php // if($visible==1){ ?>
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
                                                                    <td><?php echo $dep->resto ?>
                                                                        <input class="form-control hidden" name="sousresto_id[]" id="sousresto_id" value="<?php echo $dep->id_sousresto ?>">
                                                                        <input class="form-control hidden" name="depot_id[]" id="depot_id" value="<?php echo $dep->depot_id ?>">
                                                                        <input class="form-control hidden" name="prix_id[]" id="prix_id" value="<?php echo $dep->id_prix ?>">
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                                                                            <div class="form-group input-group">
                                                                                <input class="form-control" name="prix_vente_site[]" id="prix_vente_site" value="<?php echo $dep->prix_vente;?>" title="<?php echo $dep->prix_vente;?>">
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
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            Fiche technique&nbsp;&nbsp;>&nbsp;&nbsp;<a href="#" title="Ajouter" data-toggle="modal" data-target="#myModaladdFch"> Ajouter&nbsp;&nbsp;</a>
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
                                                                    <th>
                                                                        <div class="tools text-center">
                                                                            <a href="#" title="Selectionner & Supprimer" id="btn_supp" class="text-danger"><i class="fa fa-trash-o"></i></a>
                                                                        </div>
                                                                    </th>
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
                                                                            <td>
                                                                                <input size="10" type="number" min="1" value="<?php echo $_SESSION['fiche']['qte'][$i] ?>" class="qte_prod" id="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>">
                                                                            </td>
                                                                            <td><?php echo $_SESSION['fiche']['utite'][$i] ?></td>
                                                                            <td align="center">
                                                                                <input name="ch_ingred" class='ch_ingred' type='checkbox' id="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>" value="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>" />
                                                                            </td>
                                                                        </tr>
                                                                <?php $j++; }; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.col -->
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
                                                <button type="submit" class="btn btn-success pull-right"
                                                        id="update_produit" name="update_produit">
                                                    <i class=" fa fa-edit"></i> Modifier
                                                </button>
                                                <span class="btn btn-info hidden pull-right" id="loader">
                                                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                </span>
                                            </div>
                                        </div>

                                    </form>
                                    <!-- /.box-footer -->
                                    <?php endforeach; ?>
                                </div>
                        </div>
                        <!-- /.box-body -->
                        <!-- /.box-body -->
                        <?php }elseif ($detail == 'famille') { 
                            
                        $requete = $bdd->prepare("SELECT fam.idfamille,fam.designation FROM stk_famille AS fam WHERE fam.idfamille=:famille_id AND fam.hotel_id=:hotel_id ORDER BY fam.idfamille DESC");
                        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                        $requete->BindParam(':famille_id',$id);
                        $requete->execute();
                        $fam_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <div class="box-body">
                            <div class="panel box box-default" id="ajout">
                                <?php
                                    foreach ($fam_motifs as $fam):
                                   ?>
                                <form id="formfamEdit" method="post" action="Traitement/fam_modifier.php"  data-parsley-validate class="form-horizontal form-label-left">
                                    <input type="hidden" name="idfamille" value="<?php echo $fam->idfamille; ?>">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Désignation <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="designation" id="designation" value="<?php echo $fam->designation; ?>">
                                            <input type="hidden" class="form-control" name="designation_ex" id="designation" required value="<?php echo $fam->designation; ?>">
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                            <button type="submit" id="update_famille" class="btn btn-success">Modifier</button>
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
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <?php }else{ 
                        $requete = $bdd->prepare("SELECT s_fam.id_s_fam,s_fam.des,fam.idfamille,fam.designation FROM stk_sous_famille AS s_fam,stk_famille AS fam WHERE s_fam.id_s_fam=:famille_id AND s_fam.famille=fam.idfamille AND s_fam.hotel_id=:hotel_id ORDER BY s_fam.id_s_fam DESC");
                        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                        $requete->BindParam(':famille_id',$id);
                        $requete->execute();
                        $fam_motifs = $requete->fetchAll(PDO::FETCH_OBJ);   
                            
                        ?>
                        <div class="box-body">
                            <div class="panel box box-default" id="ajout">
                                <?php
                                    foreach ($fam_motifs as $s_fam):
                                ?>
                                <form id="form_sfam" method="post" action="Traitement/s_fam_modifier.php"  data-parsley-validate class="form-horizontal form-label-left">
                                      <input type="hidden" name="id_s_fam" value="<?php echo $s_fam->id_s_fam; ?>">
                                      <br>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Famille <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" id="famille_id" name="famille_id" required>
                                           <?php
                                          echo '<option value='.$s_fam->idfamille .'>'.$s_fam->designation. '</option>';											
                                          include('Traitement/famille_combo2.php');
                                          foreach ($familles  as $f):
                                          echo '<option value='. $f->idfamille. '>'. $f->designation .'</option>';
                                          endforeach;
                                          ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Désignation <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="designation"  id="designation"  value="<?php echo $s_fam->des; ?>">
                                            <input type="hidden" class="form-control" name="designation_ex" id="designation"  value="<?php echo $s_fam->des; ?>">
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                            <button type="submit" id="update_s_famille" class="btn btn-success">Modifier</button>
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
                                <?php endforeach; ?>
                            </div>
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
                        <label>Ingrédients</label>
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
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");

            //Switch states
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }

            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });
    });
</script>
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
        
        
        $('#update_s_famille').click(function (e) {
        e.preventDefault();
        var donnees = $('#form_sfam').serialize();
        var bool;
         $.ajax({
            url: 'Traitement/s_fam_modifier.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader_sfam").removeClass('hidden');
                $("#update_s_famille").addClass('hidden');
            },
            success: function (data) {
                bool=true;
                if (data.message_succes == 'succes') {
                    $('#designation').val(' ');
                    $('#famille_id').val(' ');
                    $('#msg2').show().fadeOut(8000)
                            .addClass('alert-success')
                            .removeClass('alert-danger');
                    $('#msg_alert2').text("La mise a jour s'est effectué avec succès! Patientez...");
                    window.location.href ="pages_actions.php?page=plat";
                }
              else if (data.message_erreur == 'erreur') {
                    $('#msg2').show()
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert2').text("Cette designation " + data.des_value + " de la sous famille existe déjà")
                } else if (data.message_vide== 'vide')  {
                    $('#msg2').show().fadeOut(8000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert2').text('Veuilez remplir les champs vides!')
                    }
            },complete: function () {
                if (bool) {
                    $("#loader_sfam").addClass('hidden');
                    $("#update_s_famille").removeClass('hidden');
                } else {
                    $("#loader_sfam").removeClass('hidden');
                    $("#update_s_famille").addClass('hidden');
                }
            }, dataType: 'json'
        });

    });
        
        
        $('#update_famille').click(function (e) {
        e.preventDefault();
        var donnees = $('#formfamEdit').serialize();
        var bool;

        $.ajax({
            url: 'Traitement/fam_modifier.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader_fam").removeClass('hidden');
                $("#update_famille").addClass('hidden');
            },
            success: function (data) {
                bool=true;
                if (data.message_succes == 'succes') {
//                    effacer();
                    $('#designation').val(' ');
                    $('#msg1').show().fadeOut(12000)
                            .addClass('alert-success')
                            .removeClass('alert-danger');
                    $('#msg_alert1').text("La mise a jour s'est effectué avec succès! Patientez...");
                    window.location.href ="pages_actions.php?page=plat";
                }
                else if (data.message_erreur == 'erreur') {
                    $('#msg1').show()
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert1').text("Cette designation " + data.des_value + " de la famille existe déjà")
                } else if (data.message_vide== 'vide')  {
                    $('#msg1').show().fadeOut(12000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert1').text('Veuilez remplir les champs vides!')
                    }

            },complete: function () {
                if (bool) {
                    $("#loader_fam").addClass('hidden');
                    $("#update_famille").removeClass('hidden');
                } else {
                    $("#loader_fam").removeClass('hidden');
                    $("#update_famille").addClass('hidden');
                }
            }, dataType: 'json'
        });

    });
        
        $('#update_produit').click(function (e) {
        e.preventDefault();
        var bool;
        var donnees = $('#form_update_plat').serialize();

        $.ajax({
            url: 'Traitement/prod_modifier.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#update_produit").addClass('hidden');
            },
            success: function (data) {
                bool=true;
//                alert('ok');
                if (data.message_succes == 'succes') {
                    $("#famille_id").val(' ');
                    $("#s_famille_id").val(' ');
                    $("#code").val(' ');
                    $("#unite").val(' ');
                    $("#libelle").val(' ');
                    $("#prix_vente").val(' ');
                    $("#fiche_technique").empty();
                    $('#msg').show().fadeOut(12000)
                            .addClass('alert-success')
                            .removeClass('alert-danger');
                    $('#msg_alert').text("La mise a jour s'est effectué avec succès! Patientez...");
                    window.location.href ="plat.php";
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert').text("Ce code " + data.code_value + " du produit saisi existe déjà")
                }
                 else if (data.message_vide== 'vide') {
                    $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }

            },complete: function () {
                if (bool) {
                    $("#loader").addClass('hidden');
                    $("#update_produit").removeClass('hidden');
                } else {
                    $("#loader").removeClass('hidden');
                    $("#update_produit").addClass('hidden');
                }
            }, dataType: 'json'
        });

    });
        
        
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
        
        

        //versement js
        $("#tableau_versement").on('click','#btn_vers', function (e) {
            e.preventDefault();
            var bool=false;
            var datedebut=$('#datedebut').val();
            var datefin=$('#datefin').val();
            var donnees = $('#form').serialize();
            $.ajax({
                url: './Traitement/dataversement.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_vers").addClass('hidden');
                },
                success: function (data) {
                    $('#tb_contenu').empty().append(data);
                    $('#p_debut').val(datedebut);
                    $('#p_fin').val(datefin);
                 //   $("#myModal1").modal('hide');
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                        $("#btn_vers").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });
        });

        $("#tableau_versement").on('change','#user_id', function (e) {
             effacer();
            e.preventDefault();
            var bool = false;
            var donnees=$('#formversement').serialize();
            $.ajax({
                url: './Traitement/datamontant.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader_vers").removeClass('hidden');
                    $("#verser_montant").addClass('hidden');
                },
                success: function (data) {
                    $('#vers_id').val(data.vers_id);
                    $('#montant').val(data.montant_vers);
                    $('#montant_aff').val(data.montant_vers_aff);
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader_vers").addClass('hidden');
                        $("#verser_montant").removeClass('hidden');
                    } else {
                        $("#loader_vers").removeClass('hidden');
                    }
                }, dataType: 'json'
            });
        });
        $("#tableau_versement").on('click', '#verser_montant', function (e) {
            e.preventDefault();
            var bool = false;
            var donnees=$('#formversement').serialize();
            $.ajax({
                url: './Traitement/versement.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader_vers").removeClass('hidden');
                    $("#verser_montant").addClass('hidden');
                },
                success: function (data) {
                    if (data.message == 'usernoselect'|| data.message == 'montantvide') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text('Veuilez remplir les champs vides!')
                    } else if (data.message == 'montantnocorrect') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text("Il n'ya pas de recette");
                    } else if (data.message == 'OK') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text('Versement effectué avec succes!')
                        effacer();
                        $('#user_id option[value="0"]').prop('selected', true);

                        var donnees = '';
                        //alert(donnees);
                        $.ajax({
                         url: './Traitement/dataversement.php',
                         type: 'POST',
                         data: donnees,
                         success: function (data) {
                         //alert(data);
                         $('#tb_contenu').empty().append(data);
                         }
                         });
                        window.open('./impression/examples/recu_repartition.php');
                    }
                    bool=true;
                },complete: function () {
                    if (bool) {
                        $("#loader_vers").addClass('hidden');
                        $("#verser_montant").removeClass('hidden');
                    } else {
                        $("#loader_vers").removeClass('hidden');
                    }
                }, dataType: 'json'
            });
        });
        //fin versement
        $("#tableau_versement").load('./Traitement/tableau_versement.php');
        $("#tableau").load('./Traitement/tableau_vente_jour_auto.php');
        $("#view_table").load('./Traitement/view_table.php');
        $("#view_plat").load('./Traitement/view_plat.php');
        $("#view_famille").load('./Traitement/view_famille.php');
        $("#view_sousfamille").load('./Traitement/view_sousfamille.php');
        $("#reservation").load('./Traitement/ajout_reservation.php');
        $("#famille").load('./Traitement/ajout_famille.php');
        $("#s_famille").load('./Traitement/ajout_sfamille.php');
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
                    $("#qte_ingred").val('');
                     $("#myModaladdFch").modal('hide');
//                    $("#myModal2").modal('hide');
//                    $("#qte_ingred").val('');
                }
            });
            
//            $("#table_ingred>tbody:last").append("<tr><td>" + k + "</td><td>" + ingred_name + "</td><td>" + utite + "</td> <td>" + qte + "</td> <td><input class='ch' type='text' value='" + ingred_id + "' /></td></tr>");
//            k++;
            
//            $("#myModaladdFch").modal('hide');
//            $('input[name="ingred_id"]').val(' ');
//            $("#unite_ingred").empty();
            
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
