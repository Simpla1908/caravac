<?php
ini_set('display_errors', 1);
if (!isset($_SESSION)) {
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
$_SESSION['saveprod'] = array();
$_SESSION['saveprod']['id'] = array();
$_SESSION['saveprod']['qte'] = array();
$statut = 1;
if (isset($_GET['ss']) && ($_SESSION['type_user'] == 1 || in_array('VFTSR', $_SESSION['actions']['code_actions']))) {
    $default = 1;
    $pos_id = $_GET['ss'];
    infosPos($pos_id, $default, $bdd);
} else {
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
$_SESSION['panier']['qteoffert'] = array();
$_SESSION['panier']['pa'] = array();
$_SESSION['panier']['prix'] = array();
$_SESSION['panier']['prix2'] = array();
$_SESSION['panier']['repas'] = array();
$_SESSION['panier']['offre'] = array();
$_SESSION['panier']['genre'] = array();
$_SESSION['panier']['id_client'] = 0;
$_SESSION['panier']['remise'] = 0;
$_SESSION['panier']['mont_tva'] = 0;
$_SESSION['panier']['mont_ttc'] = 0;
$_SESSION['panier']['mont_ttc_remise'] = 0;
$_SESSION['panier']['verrouille'] = false;
$_SESSION['cptpanier'] = 0;
//OFFRE
$_SESSION['panier']['cpt'] = array();
$_SESSION['panier']['offre'] = array();
$_SESSION['panier']['pa'] = array();
$_SESSION['panier']['prix2'] = array();
$_SESSION['panier']['qteoffert'] = array();

//DETAILS PLATS
$_SESSION['platdetail'] = array();
$_SESSION['platdetail']['accomp_id'] = array();
$_SESSION['platdetail']['accomp_nom'] = array();
$_SESSION['platdetail']['cpt'] = array();
$_SESSION['platdetail']['cpt2'] = array();
$_SESSION['platdetail']['cuisson_id'] = array();
$_SESSION['platdetail']['cuisson_nom'] = array();
$_SESSION['platdetail']['idprod'] = array();
$_SESSION['platdetail']['idprod2'] = array();
$_SESSION['platdetail']['sauce_id'] = array();
$_SESSION['platdetail']['sauce_nom'] = array();
$_SESSION['platdetail']['sel_id'] = array();
$_SESSION['platdetail']['sel_nom'] = array();
$_SESSION['platdetail']['keyprods'] = array();
//POUR FUSION DE TABLES
$_SESSION['fusion'] = array();
$_SESSION['fusion']['id_client'] = array();
$_SESSION['fusion']['nom_client'] = array();
$_SESSION['fusion']['id_fact'] = array();
$_SESSION['fusion']['mont_ttc'] = array();
$_SESSION['fusion']['taux'] = array();
$_SESSION['fusion']['type'] = array();
//POUR ECLATEMENT FACTURE
$_SESSION['eclat'] = array();
$_SESSION['eclat']['id'] = array();
$_SESSION['eclat']['qte_modif'] = array();

?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include './impot_css.php';
    ?>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <?php include './impot_header_caisse.php'; ?>
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
                                    <?php include('Traitement/cl_tbl.php'); ?>
                                    <div class="col-md-5 panel_client_table" id="tab_1">
                                        <div class="panel panel-default box" style="overflow: auto; height: 700px;">
                                            <ol class="breadcrumb">
                                                <li><a href="#">
                                                        <b>Liste des tables</b></a>
                                                </li>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <input type="text" name="table_search" id="table_search" class="form-control" value="" placeholder="Recherche">
                                                    </div>
                                                </div>
                                            </ol>
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-lg-12 listetable_client" id="produit1">
                                                        <?php include 'Traitement/tableajaxcaisse.php'; ?>
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

                                    </div>

                                    <div class="col-md-4">
                                        <div class="box box-default panel panel-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="ion-android-options"></i>
                                                    Facture:
                                                    <input name="id_client" id="id_client" type="hidden" />
                                                    <input name="type_client" id="type_client" type="hidden" />
                                                    <input name="clresto" id="clresto" type="hidden" />
                                                    <span id="cl_chxi"></span>
                                                    <input name="nbrcouvert" id="nbrcouvert" type="hidden" value="1" />
                                                    <input name="id_sousresto" id="id_sousresto" type="hidden" value="" />
                                                    <input name="user_attente" id="user_attente" type="hidden" value="0" />


                                                </h3>
                                                <br><br>
                                                <div id="text_couvert" style="text-align:center;font-size:16px; font-weight:bold;display:none">
                                                    Nombre de couverts : 1</div>
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
                                                        <div class="col-md-4"> <i class="fa fa-refresh fa-spin fa-1x "></i> Patientez !
                                                        </div>
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
                                                            <div class="input-group input-group-sm" id="div_qte_produit333" style="display: none">
                                                                <input type="hidden" name="id_produit2" class="form-control" id="id_produit2">
                                                                <input type="hidden" name="id_produit" class="form-control" id="id_produit">
                                                                <!--  <input type="number" min="1" name="qte_produit"
                                                                               class="form-control"
                                                                               placeholder="Modifier la quantité"
                                                                               id="qte_produit" disabled>-->
                                                                <input type="hidden" name="repas_resto" id="repas_resto">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-primary" id="btn_qte_produit888" disabled><i class="ion-android-checkbox-outline"></i>
                                                                        Valider
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (in_array('RM', $_SESSION['actions']['code_actions'])) { ?>
                                                            <!--Ajustement Glody-->
                                                            <div class="input-group hidden" id="div_remise333">
                                                                <input type="hidden" name="commande_id" class="form-control" id="com_id">

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
                                                        <input type="hidden" name="idrescl" id="idrescl" value="0">
                                                    </form>

                                                </div>

                                            </div>
                                            <div class="box-body no-padding1" align="center1" style="overflow: auto; height: 700px;">
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
                                                <?php // if (in_array('VLTR', $_SESSION['actions']['code_actions'])) { 
                                                ?>
                                                <a class="btn btn-app bg-purple" id="btn_table_caisse">
                                                    <i class="fa fa-table"></i> TABLES
                                                </a>
                                                <?php // } 
                                                ?>

                                                <?php if (in_array('AR4', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a class="btn btn-app bg-olive loader_cmd hidden" disabled>
                                                        <i class="fa fa-money"></i> PAYER
                                                    </a>
                                                    <a class="btn btn-app bg-olive loader_cmd_h" id="btn_regler">
                                                        <i class="fa fa-money"></i> PAYER
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('AR1', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a class="btn btn-app bg-maroon loader_cmd hidden" disabled>
                                                        <i class="fa fa-plus-square fa-5x"></i> ADDITION
                                                    </a>
                                                    <a class="btn btn-app bg-maroon loader_cmd_h" id="btn_addition3">
                                                        <i class="fa fa-plus-square fa-5x"></i> ADDITION
                                                    </a>
                                                    <a class="btn btn-app bg-maroon hidden" id="btn_addition_loader">
                                                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('RM', $_SESSION['actions']['code_actions'])) { ?>

                                                    <a href="#" class="btn btn-app bg-navy" id="btn_update_price">
                                                        <i class="fa fa-money fa-5x"></i>
                                                        REMISE
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
                                                <?php if (in_array('AR42', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a id="btn_offert" class="btn btn-app bg-purple" disabled>
                                                        <i class="fa fa-circle-o fa-5x"></i>
                                                        OFFRE
                                                    </a>
                                                <?php } ?>


                                                <?php if (
                                                    in_array('AR9', $_SESSION['actions']['code_actions'])
                                                    || in_array('VSPVS', $_SESSION['actions']['code_actions'])
                                                    || in_array('VTVS', $_SESSION['actions']['code_actions'])
                                                ) { ?>
                                                    <a href="#" class="btn btn-app bg-navy modal_versement">
                                                        <i class="fa fa-money fa-5x"></i>
                                                        VERSER
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('EFDEP', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a href="#" class="btn btn-app bg-orange" id="btn_depense">
                                                        <i class="fa fa-money"></i>
                                                        DECAISSER
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('AR6', $_SESSION['actions']['code_actions']) || in_array('VSCQOC', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a class="btn btn-app bg-maroon" id="btn_client_caisse">
                                                        <i class="fa fa-users"></i> CLIENTS
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($_SESSION['type_user'] == 1 || in_array('FSNTBL', $_SESSION['actions']['code_actions'])) {
                                                ?>
                                                    <a href="#" class="btn btn-app bg-navy" id="modal_fusion">
                                                        <i class="fa fa-link fa-5x"></i>
                                                        FUSION
                                                    </a>
                                                <?php } ?>
                                                <a href="#" id="btn-exonerer-tva" class="btn btn-app bg-purple">
                                                    <i class="fa fa-money"></i>
                                                    EXONERER <br />TVA
                                                </a>
                                                <a href="#" id="btn-appliquer-tva" class="btn btn-app bg-purple hidden">
                                                    <i class="fa fa-money"></i>
                                                    APPLIQUER <br />TVA
                                                </a>
                                                <p><br></p>
                                                <?php if (in_array('RV', $_SESSION['actions']['code_actions']) || in_array('VSV', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                                    <a href="pages_actions.php?page=analyse&ss=<?php echo $_SESSION['id_sousresto'] ?>&caisse=1" class="btn btn-app bg-purple">
                                                        <i class="fa fa-file-text fa-5x"></i>
                                                        DETAILS <br />VENTES
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('VTCR', $_SESSION['actions']['code_actions']) || in_array('VSPCER', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                                    <a href="main.php?p=facture&d=liste&ss=<?php echo $_SESSION['id_sousresto'] ?>&caisse=1" class="btn btn-app bg-olive confirmModalLink">
                                                        <i class="fa fa-paste fa-5x"></i>
                                                        FACTURES
                                                    </a>
                                                <?php } ?>

                                                <?php if (in_array('VRLSTCL', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a href="pages_actions.php?page=client" class="btn btn-app bg-maroon">
                                                        <i class="fa fa-users fa-5x"></i>
                                                        LISTE <br />CLIENTS
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('AR41', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a href="main.php?p=fdc&d=liste&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-orange">
                                                        <i class="fa fa-bank fa-5x"></i>
                                                        FONDS <br /> DE CAISSE
                                                    </a>
                                                <?php } ?>

                                                <?php if (in_array('PPR', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a href="main.php?p=plat&d=liste&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-olive">
                                                        <i class="fa fa-cog fa-5x"></i>
                                                        CREATION <br />PLATS
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('VLTR', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a href="pages_actions.php?page=table&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-purple">
                                                        <i class="fa fa-table fa-5x"></i>
                                                        LISTE <br />TABLES
                                                    </a>
                                                <?php } ?>

                                                <?php
                                                if ($_SESSION['type_user'] == 1 || in_array('ECLTMNT', $_SESSION['actions']['code_actions'])) {
                                                ?>
                                                    <a href="#" class="btn btn-app bg-maroon" id="btn_eclater">
                                                        <i class="fa fa-plus-square-o fa-5x"></i>
                                                        ECLATER
                                                    </a>

                                                <?php } ?>
                                                <?php
                                                if ($_SESSION['type_user'] == 1 || in_array('XTRTCPTE', $_SESSION['actions']['code_actions'])) {
                                                ?>
                                                    <a href="main.php?p=extrait&d=liste&ss=<?php echo $_SESSION['id_sousresto'] ?>&caisse=1" class="btn btn-app bg-purple">
                                                        <i class="fa fa-users fa-5x"></i>
                                                        EXTRAIT <br />COMPTES
                                                    </a>
                                                <?php } ?>

                                                <a class="btn btn-app bg-olive loader_cmd2 hidden" disabled>
                                                    <i class="fa fa-money"></i> PAYER 2
                                                </a>
                                                <a class="btn btn-app bg-olive loader_cmd_h2" id="btn_regler2">
                                                    <i class="fa fa-money"></i> PAYER 2
                                                </a>

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
        <?php
        include 'modal_confirm_fusion.php';
        include 'pop_up_eclatmnt.php';
        ?>
        <div id="myModalPaie2" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title blocpaieall blocpaie"><strong>Paiement : <span class="montant_fact2"> </span>soit <span id="mont_equivalent2"></span></strong></h5>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="./Traitement/reglement2.php" method="post" id="form" class="f_modal_paiement2">
                            <input type="hidden" name="id_res" id="id_res" value="0">
                            <input type="hidden" name="dte_edite" id="dte_edite" value="<?php echo date('Y-m-d'); ?>">
                            <input type="hidden" name="justification" id="justification" value="">
                            <input type="hidden" name="id_fact" id="id_fact" value="">
                            <input type="hidden" name="etat_fact" id="etat_fact" value="">
                            <input type="hidden" name="montant_fact" id="montant_fact2" value="">
                            <input type="hidden" name="montant_tot" id="montant_tot2" value="">
                            <input type="hidden" name="res_ch_id" id="res_ch_id3" value="">
                            <input type="hidden" name="type_client" id="type_client" value="" class="tycl">
                            <input type="hidden" name="lib_mode" id="lib_mode2" value="Cash">
                            <input type="hidden" name="montant_tot_af" id="montant_tot_af2" value="">
                            <input type="hidden" name="id_client" id="client_id22" value="">
                            <input type="hidden" name="nom_client" id="nom_client" value="">
                            <input type="hidden" name="id_cmd2" id="id_cmd22" value="0">
                            <input type="hidden" name="attente2" id="attente22" value="">
                            <input type="hidden" name="tauxrendu" id="tauxrendu" value="<?php echo $taux_op; ?>">
                            <input type="hidden" name="monnaieactu" id="monnaieactu" value="<?php echo $m_affiche; ?>">
                            <input type="hidden" name="fusion_frm" id="fusion_frm" value="">
                            <input type="hidden" name="id_fact_fus" id="id_fact_fus" value="">
                            <input type="hidden" name="id_tbl_fus2" id="id_tbl_fus2" value="">
                            <div class="box-body">
                                <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_bkg2">
                                    <span id="sp_bkg2"></span>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 hidden blocpaieall blocpaie">
                                        <div class="col-lg-12 form-group">
                                            <label>Date </label>
                                            <div class="form-group">
                                                <input type="text" id="dte" name="dte" class="form-control text-left datepicker" value="<?php echo date('d/m/Y') ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label>Mode de paiement</label>
                                            <select name="modepaiement" class="form-control select2 input-lg" style="width: 100%;" id="modepaie2">
                                                <option value="3">Credit</option>;
                                            </select>
                                        </div>

                                        <div class="col-lg-12 form-group">
                                            <label>Mouvement stock</label>
                                            <select name="mouvementstk" class="form-control select2 input-lg" style="width: 100%;" id="mouvementstk">
                                                <option value="0">Non</option>
                                                <option value="1">Oui</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-12 form-group hidden">
                                            <label>Montant <?php echo getsymbole_local(); ?> </label>
                                            <div class="input-group input-group-lg">
                                                <input type="text" id="montantcdf2" name="montantcdf" class="form-control text-right" value="0" onFocus="highlightActive(this);
                                                activeinput = this">
                                                <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group hidden">
                                            <label>Montant <?php echo getsymbole_devise(); ?></label>
                                            <div class="input-group input-group-lg">
                                                <input type="text" id="montantusd2" name="montantusd" class="form-control text-right" value="0" onFocus="highlightActive(this);
                                                activeinput = this">
                                                <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                            </div>
                                        </div>
                                        <div class="blrendu hidden">
                                            <input type="hidden" id="totrendu2" name="totrendu" value="0">
                                            <div class="col-lg-6 form-group">
                                                <label>Rendu <?php echo getsymbole_local(); ?> </label>
                                                <div class="input-group">
                                                    <input type="text" id="rendu_cdf2" name="rendu_cdf" class="form-control text-right rd11" value="0">
                                                    <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 form-group ">
                                                <label>Rendu <?php echo getsymbole_devise(); ?> </label>
                                                <div class="input-group">
                                                    <input type="text" id="rendu_usd2" name="rendu_usd" class="form-control  text-right rd22 " value="0">
                                                    <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">ANNULER</button>
                        <button type="submit" class="btn btn-primary btn_modal btn-lg blocpaie" id="btn_valider_reglement2">VALIDER</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="myModalCHXACC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-center" id="myModalLabel">Accompagnement</h4>
                        <input type="hidden" id="lib_repas" name="lib_repas" value="">
                        <input type="hidden" id="idrepas" name="idrepas" value="">
                        <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message">
                            <span id="message"></span>
                        </div>
                    </div>
                    <div class="modal-body overflow-auto" id="datasaccompagn" style="overflow-y:auto;max-height:300px;">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" style="display: block; margin: 0 auto;" id="btn_md_add_accomp"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
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
    <?php include './impot_asside_caisse.php'; ?>
    <div id="myModal_fusion" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>FUSION DE TABLES</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group" style="text-align:left;font-size:20px;" id="datafusionid">

                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn_modal btn-lg" id="btn_fusion_annuler" data-dismiss="modal">ANNULER</button>
                        <button type="submit" class="btn btn-primary btn_modal btn-lg" id="btn_fusion">Fusionner</button>
                        <button type="button" class="btn btn-primary btn_modal btn-lg hidden" id="btn_fusion_loader">VALIDER</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <div id="myModal_transfer" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>TRANFERT FACTURE</strong></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group" style="text-align:left;font-size:20px;" id="datatranfertid">

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">ANNULER</button>
                        <button type="submit" class="btn btn-primary btn_modal btn-lg" id="btn_transfer">VALIDER</button>
                        <button type="button" class="btn btn-primary btn_modal btn-lg hidden" id="btn_transfer_loader">VALIDER</button>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade Modal_versement" id="myModal_versement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    </div>
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
        $(function() {
            //Enable iCheck plugin for checkboxes
            //iCheck for checkbox and radio inputs
            $('#btn_md_add_accomp').click(function(e) {
                e.preventDefault();
                var donnees = '';
                var id_produit = $('input[type=radio][name=chx_accomp]:checked').attr('value');
                var nameprod = $('#lib_repas').val();
                var idrepas = $('#idrepas').val();
                $.ajax({
                    url: 'Traitement/validation_accomp.php?id_produit=' + id_produit + "&idrepas=" +
                        idrepas,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
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
                    },
                    dataType: 'json'

                });
            });

            $('.mailbox-messages input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            //Enable check and uncheck all functionality
            $(".checkbox-toggle").click(function() {
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
            $(".mailbox-star").click(function(e) {
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
        $(function() {
            $("#example3").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
            $('.datepicker').datetimepicker({
                format: "d/m/Y"
            });

        });

        
    </script>
</body>

</html>