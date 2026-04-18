<?php
ini_set('display_errors',1);
if (!isset($_SESSION)){
    session_start();
}
include './bdd/connexion.php';
include('../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
include('../FUNCTION/hebergement.php');
include('../FUNCTION/restaurant.php');
include('../FUNCTION/stock.php');
$_SESSION['nbFamille'] = 0;
$_SESSION['nb_sFamille'] = 0;
$_SESSION['fam'] = array();
$_SESSION['fam']['id'] = array();
$_SESSION['fam']['id_fam'] = array();
$_SESSION['fam']['des_fam'] = array();
$_SESSION['sfam'] = array();
$_SESSION['sfam']['id'] = array();
$_SESSION['sfam']['id_fam'] = array();
$_SESSION['sfam']['des_sfam'] = array();
$_SESSION['test'] = 1;
$statut = 1;
if (isset($_GET['ss']) && ($_SESSION['type_user'] == 1 || in_array('VFTSR', $_SESSION['actions']['code_actions']))) {
    $default = 1;
    $pos_id = $_GET['ss'];
    infosPos($pos_id, $default, $bdd);
}else{
    if ($_SESSION['type_user'] == 1) {
        $default = 0;
        $id = 0;
        infosPos($id, $default, $bdd);
    } elseif ($_SESSION['pos_id'] != 0) {
        $default = 1;
        infosPos($_SESSION['pos_id'], $default, $bdd);
    }
}
$taux_op = $_SESSION['taux_resto'];
$sous_sites = ListPosResto($_SESSION['id_hotel'], $bdd);

//POUR ACCOMPAGNEMENT DES PLATS
$_SESSION['Accompagnmt_CHX'] = 0;
$_SESSION['Accompagnmt_ID'] = 0;
$_SESSION['accomp'] = array();
$_SESSION['accomp'] = array();
$_SESSION['accomp']['accomp_id'] = array();
$_SESSION['accomp']['accomp_name'] = array();
$_SESSION['accomp']['qte_accomp'] = array();
$_SESSION['accomp']['unite_accomp'] = array();
$_SESSION['accomp']['prix_accomp'] = array();
$_SESSION['repas_accomp'] = array();
$_SESSION['repas_accomp']['inserer'] = array();
$_SESSION['repas_accomp']['id'] = array();
$_SESSION['repas_accomp']['nom'] = array();

$_SESSION['panier'] = array();
$_SESSION['panier']['cpt'] = array();
$_SESSION['panier']['id_article'] = array();
$_SESSION['panier']['nom'] = array();
$_SESSION['panier']['qte'] = array();
$_SESSION['panier']['qteoffert']=array();
$_SESSION['panier']['pa'] = array();
$_SESSION['panier']['prix'] = array();
$_SESSION['panier']['prix2'] = array();
$_SESSION['panier']['repas'] = array();
$_SESSION['panier']['offre'] = array();
$_SESSION['panier']['id_client'] =0;
$_SESSION['panier']['remise'] =0;
$_SESSION['panier']['mont_tva'] =0;
$_SESSION['panier']['mont_ttc'] =0;
$_SESSION['panier']['mont_ttc_remise'] =0;
$_SESSION['panier']['verrouille'] = false;
$_SESSION['cptpanier']=0;
//OFFRE
$_SESSION['panier']['cpt'] = array();
$_SESSION['panier']['offre']= array();
$_SESSION['panier']['pa']= array();
$_SESSION['panier']['prix2'] = array();
$_SESSION['panier']['qteoffert'] = array();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include './impot_css.php';
        ?>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav" onload='populateTd()'>
        <div class="wrapper">
            <?php include './impot_header.php'; ?>
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div id="messagesAlert"></div>
                        <div class="nav-tabs-custom">
                            <?php
                            include('Traitement/fam_prod_s_fam_view.php');
                            ?>
                            <div class="tab-content" id="c1">
                                <div class="active tab-pane fade in" id="tab1">
                                    <div class="row">
                                        <div class="col-md-5" id="affichage_tout_produit">
                                            <div class="box panel panel-default">
                                                <ol class="breadcrumb">
                                                    <li class="pull-right"><a href="#" title="Tous les produits" class="home"><span
                                                                class="step size-64"><i class="fa fa-mail-reply-all fa-2x"></i> Tous les produits</span></a>
                                                    </li>
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                          <input type="text" name="product_search_code" id="product_search_code" class="form-control" value="" placeholder="Code barre">
                                                          <input type="hidden" name="product_code" id="product_code">
                                                        </div>
                                                        <div class="col-xs-5">
                                                          <input type="text" name="product_search" id="product_search" class="form-control" value="" placeholder="Recherche article">
                                                        </div>
                                                    </div>
                                                 </ol>
                                                    <!--<div class="form-group">
                                                        <input type="text" name="product_search" id="product_search" class="form-control input-lg" value="" placeholder="Rechercher un article">
                                                    </div>-->
                                                <div class="box-body">
                                                    <div class="row" style="overflow: auto; height:100px;">
                                                        <div class="col-lg-12">
                                                            <?php  include './famille_produit_sousresto.php'; ?>
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->

                                            <div class="panel panel-default box" style="overflow:auto;height:425px;">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <?php include './produits_sousresto.php'; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                        <!-- /.col -->
                                        
                                        <?php  include('Traitement/cl_tbl.php'); ?>
                                        <div class="col-md-5 panel_client_table" id="tab_1" style="display:none">
                                            <div class="panel panel-default box" style="overflow: auto; height: 700px;">
                                                <ol class="breadcrumb">
                                                    <li><a href="#"><b>Liste des tables</b></a></li>
                                                    <li class="pull-right"><a href="#" title="Retour" id="fermer_tab"><span
                                                                class="step size-64"><i class="fa fa-mail-reply-all"></i> Retour</span></a>
                                                    </li>
                                                </ol>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 listetable_client" id="produit1">
                                                            <?php  foreach ($tables as $tbl): ?>
                                                                <a class="btn btn-app client_table"
                                                                   id1="<?php  echo $tbl->id_client; ?>"
                                                                   id2="<?php  echo $tbl->designation; ?>">
                                                                    <?php  echo ucfirst($tbl->designation); ?><br>
                                                                    <?php  if ($tbl->statut == 'reserve') { ?>
                                                                        <span
                                                                            class="label label-danger"><?php  echo $tbl->statut ?></span>
                                                                        <?php } else { ?>
                                                                        <span
                                                                            class="label label-success"><?php  echo $tbl->statut ?></span>
                                                                        <?php  } ?>
                                                                </a>
                                                            <?php  endforeach; ?>
                                                        </div>
                                                        <!-- /.col-lg-12 -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                        </div>
                                        <!-- /.col -->

                                        <div class="col-md-5 panel_client_table" id="tab_2" style="display:none">
                                            <?php  include('liste_cl_maj.php'); ?>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-5 panel_client_table" id="tab_3" style="display:none">
                                            <?php // include('liste_serveur_maj.php'); ?>
                                        </div>
                                        
                                        
                                        <div class="col-md-4">
                                            <div class="box box-default panel panel-default">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">
                                                        <i class="ion-android-options"></i>
                                                        Facture: 
                                                        <input name="id_client" id="id_client" type="hidden"/> 
                                                        <input name="type_client" id="type_client" type="hidden"/> 
                                                        <input name="clresto" id="clresto" type="hidden"/> 
                                                        <span id="cl_chxi"></span>
                                                    </h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body no-padding loader_cmd_h " style="overflow: auto; height: 651px;">
                                                    <div class="table-responsive mailbox-messages" id="affiche_commandes">
                                                        <!--Insertion tableau commandes -->
                                                        <!-- /.table -->
                                                    </div>
                                                </div>
                                                <div class="box-body no-padding loader_cmd hidden">
                                                    <div class="row">
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4"> </div>
                                                            <div class="col-md-4"> <i class="fa fa-refresh fa-spin fa-1x "></i> Patientez !</div>
                                                            <div class="col-md-4"> </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                                
                                            </div>
                                            <br>
                                            <!-- /. box -->
                                            
                                        </div>
                                        <!-- /.col -->
                                        
                                        
                                        <div class="col-md-3">
                                            <div class="box box-default panel panel-default">
                                                 
                                                <div class="box-header no-padding loader_cmd_h333 hidden">
                                                        <div class="col-md-12">
                                                            <br>
                                                            <form role="form">
                                                                <?php if (in_array('AR11', $_SESSION['actions']['code_actions'])) { ?>
                                                                    <div class="input-group input-group-sm" id="div_qte_produit333"
                                                                         style="display: none">
                                                                        <input type="hidden" name="id_produit2"
                                                                               class="form-control" id="id_produit2">
                                                                        <input type="hidden" name="id_produit"
                                                                               class="form-control" id="id_produit">
<!--                                                                        <input type="number" min="1" name="qte_produit"
                                                                               class="form-control"
                                                                               placeholder="Modifier la quantité"
                                                                               id="qte_produit" disabled>-->
                                                                        <input type="hidden" name="repas_resto" id="repas_resto">
                                                                        <span class="input-group-btn">
                                                                            <button type="button"
                                                                                    class="btn btn-primary"
                                                                                    id="btn_qte_produit888" disabled><i
                                                                                    class="ion-android-checkbox-outline"></i>
                                                                                Valider
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if (in_array('RM', $_SESSION['actions']['code_actions'])) { ?>
                                                                <!--Ajustement Glody-->
                                                                    <div class="input-group hidden" id="div_remise333">
                                                                        <input type="hidden" name="commande_id"
                                                                               class="form-control" id="com_id">
<!--                                                                        <select name="remise" id="remise"
                                                                                class="form-control col-md-7 col-xs-12"
                                                                                required>
                                                                            <option value="0">0%</option>
                                                                            <option
                                                                                value="<?php // echo $_SESSION['remise']; ?>"><?php // echo $_SESSION['remise']; ?>
                                                                                %
                                                                            </option>
                                                                        </select>-->
<!--                                                                        <span class="input-group-btn">
                                                                            <button type="button"
                                                                                    class="btn btn-primary"
                                                                                    id="btn_remise"><i
                                                                                    class="ion-android-checkbox-outline"></i> Valider</button>
                                                                        </span>-->
                                                                    </div>
                                                                <?php } ?>
                                                            </form>
                                                            <!--la recuperation de l'id client pour la mise en attente-->
                                                            <form role="form">
                                                                <input type="hidden" name="client_id1" class="form-control" id="client_id1" value="">
                                                                <input type="hidden" name="idfactcl" class="form-control" id="idfactcl" value="">
                                                                <input type="hidden" name="id_cmd" class="form-control" id="id_cmd" value="0">
                                                                <input type="hidden" name="reservechambre_id" id="reservechambre_id" value="">
                                                                <input type="hidden" name="attente" class="form-control" id="attente" value="">
                                                                <input type="hidden" name="idrescl"id="idrescl" value="0">	   
                                                            </form>
                                                            
                                                        </div>
                                                    <?php if (in_array('AR12', $_SESSION['actions']['code_actions'])) { ?>
                                                        <div class="col-md-12 hidden" align="center">
                                                            
<!--                                                            <p>
                                                                <br>
                                                            <button type="button" title="Supprimer" class="btn btn-danger"
                                                                    id="btn_sup_produit" disabled><i
                                                                    class="ion-android-delete"></i> Delete
                                                            </button>
                                                            <button type="button" title="Offre" class="btn btn-primary tip"
                                                                    id="btn_offert" disabled><i
                                                                    class="fa fa-circle-o"></i> Offre
                                                            </button>
                                                            <button type="button" title="Modifier Prix" class="btn btn-warning tip"
                                                                    id="btn_update_price" disabled>
                                                                    <i class="fa fa-edit fa-fw"></i> Edit Prix
                                                            </button>
                                                            </p>-->
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="box-body no-padding1" align="center1">
                                                    <p><br></p>
                                                    <?php if (in_array('AR11', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a id="btn_qte_produit" class="btn btn-app bg-orange" disabled>
                                                            <i class="fa fa-edit fa-5x"></i>
                                                           QUANTITE
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (in_array('AR12', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-maroon" id="btn_sup_produit" disabled>
                                                           <i class="fa fa fa-times fa-5x"></i> SUPPRIMER
                                                        </a>
                                                    <?php } ?>
                                                     <?php if (in_array('AR12', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a id="btn_offert" class="btn btn-app bg-purple" disabled>
                                                            <i class="fa fa-circle-o fa-5x"></i>
                                                             OFFRE
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (in_array('AR6', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-maroon" id="btn_client">
                                                            <i class="fa fa-users"></i> CLIENTS
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (in_array('VLTR', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-olive" id="btn_table">
                                                            <i class="fa fa-table"></i> TABLES
                                                        </a>
                                                    <?php } ?>
                                                    <a href="#" class="btn btn-app bg-navy" id="btn_update_price">
                                                            <i class="fa fa-money fa-5x"></i>
                                                            REMISE
                                                    </a>
                                                    <?php if (in_array('AR5', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-purple loader_cmd hidden" disabled>
                                                            <i class="fa fa-remove"></i> ANNULER
                                                        </a>
                                                        <a class="btn btn-app bg-purple  loader_cmd_h" id="btn_annuler">
                                                            <i class="fa fa-remove"></i> ANNULER
                                                        </a>
                                                        <a class="btn btn-app bg-purple hidden" id="btn_annuler_loader">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez
                                                        </a>
                                                    <?php } ?>
                                                    
                                                    <?php if (in_array('AR4', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-olive loader_cmd hidden" disabled>
                                                            <i class="fa fa-money"></i> PAYER
                                                        </a>
                                                        <a class="btn btn-app bg-olive loader_cmd_h" id="btn_regler">
                                                            <i class="fa fa-money"></i> PAYER
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (in_array('AR3', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-purple loader_cmd hidden" disabled>
                                                            <i class="fa fa-pause"></i> EN ATTENTE
                                                        </a>
                                                        <a class="btn btn-app bg-purple loader_cmd_h" id="btn_attente">
                                                            <i class="fa fa-pause"></i> EN ATTENTE
                                                        </a>
                                                        <a class="btn btn-app bg-purple hidden" id="btn_attente_loader">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (in_array('AR7', $_SESSION['actions']['code_actions'])
                                                            || in_array('VSPTA', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-navy ticket">
                                                            <i class="fa fa-inbox"></i> TICKETS
                                                        </a>
                                                    <?php } ?>
                                                     <?php if (in_array('AR1', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-maroon loader_cmd hidden" disabled>
                                                            <i class="fa fa-plus-square fa-5x"></i> ADDITION
                                                        </a>
                                                        <a class="btn btn-app bg-maroon loader_cmd_h" id="btn_addition">
                                                            <i class="fa fa-plus-square fa-5x"></i> ADDITION
                                                        </a>
                                                        <a class="btn btn-app bg-maroon hidden" id="btn_addition_loader">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (in_array('AR2', $_SESSION['actions']['code_actions'])) { ?>
                                                        <a class="btn btn-app bg-navy loader_cmd hidden" disabled>
                                                            <i class="fa fa-paste"></i> BON CMD
                                                        </a>
                                                        <a class="btn btn-app bg-navy loader_cmd_h" id="btn_boncommande">
                                                            <i class="fa fa-paste"></i> BON CMD
                                                        </a>
                                                        <a class="btn btn-app bg-navy hidden" id="btn_boncommande_loader">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez
                                                        </a>
                                                    <?php } ?>
                                                    <p><br></p>
                                                    <?php if (in_array('RV',$_SESSION['actions']['code_actions'])|| in_array('VSV',$_SESSION['actions']['code_actions'])|| $_SESSION['type_user'] == 1){?>
                                                        <a href="pages_actions.php?page=analyse&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-app bg-purple">
                                                            <i class="fa fa-file-text fa-5x"></i>
                                                            DETAILS <br/>VENTES
                                                        </a> 
                                                    <?php }?>
                                                    <?php if (in_array('VTCR', $_SESSION['actions']['code_actions'])||in_array('VSPCER', $_SESSION['actions']['code_actions'])|| $_SESSION['type_user'] == 1){ ?>
                                                        <a href="main.php?p=facture&d=liste&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-app bg-olive confirmModalLink">
                                                            <i class="fa fa-paste fa-5x"></i>
                                                            FACTURES 
                                                        </a> 
                                                    <?php }?>
                                                   
                                                    <?php if (in_array('AR6',$_SESSION['actions']['code_actions'])){?>
                                                        <a href="pages_actions.php?page=client" class="btn btn-app bg-maroon">
                                                                <i class="fa fa-users fa-5x"></i>
                                                             LISTE <br/>CLIENTS
                                                        </a> 
                                                    <?php }?>
                                                    <a href="main.php?p=fdc&d=liste&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-app bg-orange">
                                                        <i class="fa fa-bank fa-5x"></i>
                                                         FONDS <br/> DE CAISSE
                                                    </a>
                                                    
                                                    <?php if (in_array('PPR', $_SESSION['actions']['code_actions'])){ ?>
                                                       <a href="main.php?p=plat&d=liste&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-app bg-olive">
                                                            <i class="fa fa-cog fa-5x"></i>
                                                            CREATION <br/>PLATS
                                                        </a> 
                                                    <?php } ?>
                                                    <?php if (in_array('VLTR',$_SESSION['actions']['code_actions'])){?>
                                                       <a href="pages_actions.php?page=table&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-app bg-purple">
                                                            <i class="fa fa-table fa-5x"></i>
                                                            LISTE <br/>TABLES
                                                        </a> 
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->

                            <!-- Fin Commande et BC-->
                            <div class="tab-content" id="c3" style="display:none">

                                <!-- /.tab-pane -->
                            </div>
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <div class="modal fade" id="myModalCHXACC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title text-center" id="myModalLabel">Accompagnement</h4>
                            <input type="hidden" id="lib_repas" name="lib_repas"  value="">
                            <input type="hidden" id="idrepas" name="idrepas"  value="">
                            <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message">
                                <span id="message"></span>
                            </div>
                        </div>
                        <div class="modal-body overflow-auto" id="datasaccompagn" style="overflow-y:auto;max-height:300px;">
                        </div>
                        <div class="modal-footer">
                            <button  class="btn btn-danger" style="display: block; margin: 0 auto;"
                                     id="btn_md_add_accomp"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                            </button>
                            <span class="btn btn-info hidden" id="loader" style="display: block; margin: 0 auto;">
                                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                            </span>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>


            </div>
            <?php include './impot_asside.php'; ?>
        </div>
        <!-- ./wrapper -->
        <?php
        include '../paiement/modal_paiement_resto.php';
        include 'modal_ajout_client.php';
        ?>
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
                $('#btn_md_add_accomp').click(function (e) {
                    e.preventDefault();
                    var donnees = '';
                    var id_produit = $('input[type=radio][name=chx_accomp]:checked').attr('value');
                    var nameprod = $('#lib_repas').val();
                    var idrepas = $('#idrepas').val();
                    $.ajax({
                        url: 'Traitement/validation_accomp.php?id_produit=' + id_produit + "&idrepas=" + idrepas,
                        type: 'POST',
                        data: donnees,
                        success: function (data) {
                            if (data.accomp_ope == 'ok') {
                                var idprod = id_produit;
                                var prixprod = data.prix_accomp;
                                var nameprod = data.accomp_name;
                                var repas = 1;
                                $('#libelle_repas' + idrepas).empty().append(nameprod);
                                $("#myModalCHXACC").modal('hide');
                            } else {
                                $('#message').text(data.accomp_msg);
                                $('#div_message').removeClass('hidden').show().fadeOut(4000);
                            }
                        }, dataType: 'json'

                    });
                });

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

        <!-- AdminLTE for demo purposes -->
        <script type="text/javascript" src="js/resto.js"></script>
        <script type="text/javascript" src="../js/paiement.js"></script>
        <script src="datepicker/jquery.datetimepicker.js"></script>
        <script>
            $(function () {
                $("#example3").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
                $('.datepicker').datetimepicker(
                        {
                            format: "d/m/Y"
                        }
                );
            });
            
            function highlightActive(obj)
            {
            var inputcollection = document.getElementsByTagName('input');
            for(i = 0 ; i < inputcollection.length ; i++)
            {
                inputcollection[i].style.backgroundColor = (inputcollection[i]==obj) ? "lime" : "white";
            }
            }
            
            var activeinput
            function populateTd()
            {
            var tdcollection = document.getElementsByTagName('table')[0].getElementsByTagName('button');
            //alert(tdcollection);
            for (i = 0 ; i < tdcollection.length ; i++)
            {
             tdcollection[i].indice = i;
             tdcollection[i].className = 'up';
             tdcollection[i].onmousedown = function()
             {
              this.className = 'down';
             }
             tdcollection[i].onmouseup = function()
             {
              this.className = 'up';
             }
             tdcollection[i].onclick = function()
             {
              if (!!activeinput)
              {
               // pour entrer le numéro sur lequel on vient de taper
               if(this.indice < 11)
               {
                activeinput.value += this.innerHTML;
//                alert(activeinput.value);
//                var montsaisi = activeinput.value;
                var donnees = $('.f_modal_paiement').serialize();
                var bool = false;
                var urlpg = './Traitement/reglement.php?do=rendu';

                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function () {
                        
                    },
                    success: function (data) {
                        if (data.succes) {
                            $('#rendu_usd').val(data.rendu_usd);
                            $('#rendu_cdf').val(data.rendu_cdf);
                            $('#totrendu').val(data.totrendu);
                            if (data.boolrendu) {
                                $('.blrendu').removeClass('hidden');
                            } else {
                                $('.blrendu').addClass('hidden');
                            }
                        }
                        bool = true;
                    },
                    complete: function () {
                        
                    }
                    , dataType: 'json'
                });
                return false;
                
               }
               // pour effacer le dernier caractere
               if(this.indice == 11)
               {
                activeinput.value = activeinput.value.substr(0,activeinput.value.length-1);
//                alert(activeinput.value);
                
                var donnees = $('.f_modal_paiement').serialize();
                var bool = false;
                var urlpg = './Traitement/reglement.php?do=rendu';

                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function () {
                        
                    },
                    success: function (data) {
                        if (data.succes) {
                            $('#rendu_usd').val(data.rendu_usd);
                            $('#rendu_cdf').val(data.rendu_cdf);
                            $('#totrendu').val(data.totrendu);
                            if (data.boolrendu) {
                                $('.blrendu').removeClass('hidden');
                            } else {
                                $('.blrendu').addClass('hidden');
                            }
                        }
                        bool = true;
                    },
                    complete: function () {
                        
                    }
                    , dataType: 'json'
                });
                return false;
                
               }
               // pour tout effacer
               if(this.indice == 12)
               {
                activeinput.value = "";
               }
              }
             }
            }
            }
        </script>
    </body>
</html>
