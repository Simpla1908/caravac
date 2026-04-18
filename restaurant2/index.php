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
//Panier
ReinitialiserPanier();

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

//SUPPRESSION LIGNE COMMANDE
$_SESSION['Monitoring_sup'] = array();
$_SESSION['Monitoring_sup']['produit_id'] = array();
$_SESSION['Monitoring_sup']['qte2diff'] = array();
$_SESSION['Monitoring_sup']['description'] = array();
$_SESSION['Monitoring_sup']['prix'] = array();
$_SESSION['Monitoring_sup']['repas'] = array();
//RE-IMPRESSION
$_SESSION['ProduitsSelectiones'] = array();
$_SESSION['ProduitsSelectiones']['id_produit'] = array();
$_SESSION['ProduitsSelectiones']['qte_modif'] = array();
//Initialisation bool_addition pour verrouiller operation ajout modif sup
$_SESSION['bool_addition'] = 0;
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    include './impot_css.php';
    ?>
    <style>
        :root {
            --pos-ink: #14213d;
            --pos-accent: #d97706;
            --pos-accent-soft: #f59e0b;
            --pos-surface: #fffdf8;
            --pos-surface-2: #f7f1e5;
            --pos-line: #e7dcc7;
            --pos-success: #2f855a;
            --pos-danger: #c05621;
            --pos-shadow: 0 14px 36px rgba(20, 33, 61, 0.12);
        }

        body.restaurant-pos {
            background:
                radial-gradient(circle at top right, rgba(245, 158, 11, 0.14), transparent 24%),
                linear-gradient(180deg, #f8f3e8 0%, #f4efe3 100%);
            color: #24324a;
        }

        .restaurant-pos .content-wrapper {
            background: transparent;
            padding: 18px 14px 28px;
        }

        .restaurant-pos .content {
            padding: 0;
        }

        .pos-shell {
            margin: 0;
        }

        .pos-topbar {
            display: flex;
            align-items: stretch;
            justify-content: space-between;
            gap: 14px;
            margin: 0 0 16px;
            padding: 18px 20px;
            border: 1px solid rgba(231, 220, 199, 0.9);
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(20, 33, 61, 0.97), rgba(54, 74, 113, 0.95));
            box-shadow: var(--pos-shadow);
            color: #fff;
        }

        .pos-topbar-main h1 {
            margin: 0 0 6px;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .pos-topbar-main p {
            margin: 0;
            color: rgba(255, 255, 255, 0.78);
            font-size: 14px;
        }

        .pos-topbar-stats {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .pos-chip {
            min-width: 138px;
            padding: 11px 14px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(6px);
        }

        .pos-chip-label {
            display: block;
            margin-bottom: 4px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.7);
        }

        .pos-chip-value {
            display: block;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.2;
        }

        .restaurant-pos .nav-tabs-custom.pos-board {
            border: 1px solid rgba(231, 220, 199, 0.95);
            border-radius: 24px;
            background: rgba(255, 252, 245, 0.95);
            box-shadow: var(--pos-shadow);
            overflow: hidden;
        }

        .restaurant-pos .nav-tabs-custom > .tab-content {
            background: transparent;
            padding: 18px;
        }

        .pos-column {
            margin-bottom: 18px;
        }

        .restaurant-pos .pos-panel {
            border: 1px solid rgba(231, 220, 199, 0.95);
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(251, 247, 239, 0.98));
            box-shadow: 0 10px 24px rgba(20, 33, 61, 0.08);
            overflow: hidden;
        }

        .restaurant-pos .box-header.with-border,
        .restaurant-pos .pos-panel .box-header {
            border-bottom: 1px solid rgba(231, 220, 199, 0.85);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(249, 243, 232, 0.96));
        }

        .pos-catalog-toolbar,
        .pos-panel-toolbar {
            margin: 0;
            padding: 16px 18px 14px;
            border-bottom: 1px solid rgba(231, 220, 199, 0.85);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(249, 243, 232, 0.96));
            list-style: none;
        }

        .pos-toolbar-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .pos-toolbar-actions .btn {
            border: none;
            border-radius: 14px;
            padding: 10px 14px;
            font-weight: 800;
            letter-spacing: 0.02em;
            box-shadow: 0 8px 20px rgba(20, 33, 61, 0.12);
        }

        .restaurant-pos .form-control {
            height: 44px;
            border: 1px solid #ddd2bb;
            border-radius: 14px;
            box-shadow: none;
            background: #fffefa;
            font-size: 14px;
        }

        .restaurant-pos .form-control:focus {
            border-color: rgba(217, 119, 6, 0.7);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
        }

        .restaurant-pos .box-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--pos-ink);
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .restaurant-pos #text_serveur,
        .restaurant-pos #text_couvert {
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(245, 158, 11, 0.12);
            color: #8a5809;
            margin-top: 8px;
        }

        .pos-order-box .box-body,
        .pos-catalog-box .box-body {
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(250, 246, 238, 0.98));
        }

        .restaurant-pos #affiche_commandes {
            padding: 12px;
        }

        .restaurant-pos #affiche_commandes table,
        .restaurant-pos #affiche_commandes .table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .restaurant-pos #affiche_commandes tr {
            background: #fff;
            box-shadow: 0 6px 18px rgba(20, 33, 61, 0.06);
        }

        .restaurant-pos #affiche_commandes td,
        .restaurant-pos #affiche_commandes th {
            border-top: none !important;
            vertical-align: middle;
        }

        .restaurant-pos #blc_categorie_produit_vente .btn,
        .restaurant-pos #blc_produit_vente .btn,
        .restaurant-pos .listetable_client .btn,
        .restaurant-pos .listetable_client a,
        .restaurant-pos #blc_categorie_produit_vente a,
        .restaurant-pos #blc_produit_vente a {
            border-radius: 16px !important;
            box-shadow: 0 10px 20px rgba(20, 33, 61, 0.08);
        }

        .restaurant-pos .pos-actions-box .box-body {
            padding: 16px 14px 18px;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(250, 246, 238, 0.98));
        }

        .restaurant-pos .pos-actions-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .restaurant-pos .btn-app {
            width: auto;
            height: 112px;
            margin: 0;
            padding: 16px 10px 12px;
            border-radius: 18px;
            border: none;
            box-shadow: 0 12px 22px rgba(20, 33, 61, 0.12);
            font-weight: 800;
            letter-spacing: 0.02em;
            transition: transform 0.16s ease, box-shadow 0.16s ease, opacity 0.16s ease;
        }

        .restaurant-pos .btn-app:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 26px rgba(20, 33, 61, 0.16);
        }

        .restaurant-pos .btn-app i {
            margin-bottom: 8px;
        }

        .restaurant-pos .btn-app.bg-purple {
            background: linear-gradient(180deg, #5d4e9d, #483a7d) !important;
        }

        .restaurant-pos .btn-app.bg-maroon {
            background: linear-gradient(180deg, #c05621, #9c4221) !important;
        }

        .restaurant-pos .btn-app.bg-orange {
            background: linear-gradient(180deg, #f59e0b, #d97706) !important;
        }

        .restaurant-pos .btn-app.bg-olive {
            background: linear-gradient(180deg, #2f855a, #276749) !important;
        }

        .restaurant-pos .btn-app.bg-navy {
            background: linear-gradient(180deg, #274c77, #17324d) !important;
        }

        .restaurant-pos .loader_cmd_h333 {
            display: none;
        }

        .restaurant-pos .modal-content {
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(20, 33, 61, 0.22);
        }

        @media (max-width: 1200px) {
            .restaurant-pos .pos-actions-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 991px) {
            .pos-topbar {
                flex-direction: column;
            }

            .pos-topbar-stats {
                justify-content: flex-start;
            }

            .restaurant-pos .pos-actions-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767px) {
            .restaurant-pos .content-wrapper {
                padding: 12px 8px 22px;
            }

            .pos-topbar {
                padding: 16px;
                border-radius: 18px;
            }

            .pos-topbar-main h1 {
                font-size: 22px;
            }

            .restaurant-pos .nav-tabs-custom > .tab-content {
                padding: 12px;
            }

            .restaurant-pos .pos-actions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav restaurant-pos" onload='populateTd()'>
    <div class="wrapper">
        <?php include './impot_header.php'; ?>
        <div class="content-wrapper">
            <div class="row pos-shell">
                <div class="col-md-12">
                    <div class="pos-topbar">
                        <div class="pos-topbar-main">
                            <h1>Restaurant CARAVAC</h1>
                            <p>Cuisiner avec passion , servir avec amour </p>
                        </div>
                        <div class="pos-topbar-stats">
                            <div class="pos-chip">
                                <span class="pos-chip-label">Point De Vente</span>
                                <span class="pos-chip-value"><?php echo isset($_SESSION['libelle_resto']) ? $_SESSION['libelle_resto'] : 'Restaurant'; ?></span>
                            </div>
                            <div class="pos-chip">
                                <span class="pos-chip-label">Taux Actuel</span>
                                <span class="pos-chip-value"><?php echo number_format((float) $taux_op, 2, ',', ' '); ?></span>
                            </div>
                            <div class="pos-chip">
                                <span class="pos-chip-label">Agent</span>
                                <span class="pos-chip-value"><?php echo isset($_SESSION['nom_user']) ? $_SESSION['nom_user'] : 'Utilisateur'; ?></span>
                            </div>
                        </div>
                    </div>
                    <div id="messagesAlert"></div>
                    <div class="nav-tabs-custom pos-board">
                        <?php
                        include('Traitement/fam_prod_s_fam_view.php');
                        ?>
                        <div class="tab-content" id="c1">
                            <div class="active tab-pane fade in" id="tab1">
                                <div class="row">
                                    <div class="col-md-5 pos-column" id="affichage_tout_produit">
                                        <div class="box panel panel-default pos-panel pos-catalog-box">
                                            <ol class="breadcrumb pos-catalog-toolbar">
                                                <li class="pull-left pos-toolbar-actions" style="margin-bottom: 5px">
                                                    <a href="#" title="Voir toutes les familles" class="filterfamilles btn btn-warning">
                                                        <span class="step size-30"><b> FAMILLES</b></span>
                                                    </a>
                                                    <a href="#" title="Voir toutes les categories des produits" class="home btn btn-danger">
                                                        <span class="step size-30"><b> CATEGORIES
                                                            </b></span>
                                                    </a>
                                                    <a href="#" title="Tous les produits" class="filterproduits btn btn-primary">
                                                        <span class="step size-30"><b>PRODUITS</b></span>
                                                    </a>

                                                    <a href="#" title="Voir les produits favoris" class="filterfavoris btn btn-success">
                                                        <span class="step size-30"><b>FAVORIS</b></span>
                                                    </a>
                                                </li>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <input type="hidden" name="prod_pan_added" class="form-control" id="prod_pan_added" value="0">
                                                        <input type="hidden" name="sorte_search" id="sorte_search" value="categorie">
                                                        <input type="text" name="product_search" id="product_search" class="form-control" value="" placeholder="Recherche">
                                                    </div>
                                                </div>
                                            </ol>

                                            <div class="box-body" id="affichage_tout_produit" style="overflow:auto;height:600px;">
                                                <div class="row">
                                                    <div class="col-lg-12" id="blc_categorie_produit_vente">
                                                        <?php include './categorie_produit_vente.php'; ?>
                                                    </div>
                                                    <div class="col-lg-12" id="blc_produit_vente">
                                                    </div>
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->

                                    </div>
                                    <!-- /.col -->

                                    <?php //include('Traitement/cl_tbl.php'); 
                                    ?>
                                    <div class="col-md-5 panel_client_table pos-column" id="tab_1" style="display:none">
                                        <div class="panel panel-default box pos-panel" style="overflow: auto; height: 700px;">
                                            <ol class="breadcrumb pos-panel-toolbar">
                                                <li><a href="#" id="fermer_tab">
                                                        <i class="fa fa-mail-reply-all fa-2x"></i> <b>Liste des
                                                            tables</b></a>
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
                                                        <?php //include 'Traitement/tableajax.php'; 
                                                        ?>
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
                                    <!-- <div class="col-md-5 panel_client_table" id="tab_3" style="display:none">
                                        <?php // include('liste_serveur_maj.php'); 
                                        ?>
                                            </div>-->
                                    <div class="col-md-4 pos-column">
                                        <div class="box box-default panel panel-default pos-panel pos-order-box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="ion-android-options"></i>
                                                    Facture:
                                                    <input name="user_type" id="user_type" type="hidden" value="<?php echo $_SESSION['type_user']; ?>" />
                                                    <input name="id_client" id="id_client" type="hidden" />
                                                    <input name="type_client" id="type_client" type="hidden" />
                                                    <input name="clresto" id="clresto" type="hidden" />
                                                    <input name="statut_tbl" id="statut_tbl" type="hidden" value="libre" />
                                                    <input name="nbrcouvert" id="nbrcouvert" type="hidden" value="1" />
                                                    <input name="id_sousresto" id="id_sousresto" type="hidden" value="" />
                                                    <input name="user_attente" id="user_attente" type="hidden" value="0" />
                                                    <input name="id_serveur" id="id_serveur" type="hidden" value="0" />
                                                    <input name="name_serveur" id="name_serveur" type="hidden" value="" />
                                                    <span id="cl_chxi"></span>
                                                </h3>
                                                <!--Nombre de couverts : 1 -->
                                                <br><br>
                                                <div id="text_serveur" style="text-align:center;font-size:16px; font-weight:bold;display:none">
                                                    SERVEUR :
                                                </div>
                                                <div id="text_couvert" style="text-align:center;font-size:16px; font-weight:bold;display:none">
                                                    Nombre de couverts : 1
                                                </div>
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


                                    <div class="col-md-3 pos-column" style="overflow: auto; height: 700px;">
                                        <div class="box box-default panel panel-default pos-panel pos-actions-box">

                                            <div class="box-header no-padding loader_cmd_h333">
                                                <div class="col-md-12">
                                                    <br>
                                                    <form role="form">
                                                        <?php if (in_array('AR11', $_SESSION['actions']['code_actions'])) { ?>
                                                            <div class="input-group input-group-sm" id="div_qte_produit333" style="display: none">
                                                                <input type="text" name="id_produit2" class="form-control" id="id_produit2">
                                                                <input type="text" name="id_produit" class="form-control" id="id_produit">

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
                                                        <input type="hidden" name="IsChecked" id="IsChecked" value="0">


                                                    </form>

                                                </div>

                                            </div>
                                            <div class="box-body no-padding1" align="center1">
                                                <p><br></p>
                                                <div class="pos-actions-grid">
                                                <a class="btn btn-app bg-purple" id="btn_table">
                                                    <i class="fa fa-table"></i> TABLES
                                                </a>
                                                <?php if (in_array('AR6', $_SESSION['actions']['code_actions']) || in_array('VSCQOC', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a class="btn btn-app bg-maroon" id="btn_client">
                                                        <i class="fa fa-users"></i> CLIENTS
                                                    </a>
                                                <?php } ?>

                                                <?php if (in_array('AR11', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a id="btn_qte_produit" class="btn btn-app bg-orange" disabled>
                                                        <i class="fa fa-edit fa-5x"></i>
                                                        QUANTITE
                                                    </a>
                                                <?php } ?>

                                                <!--  <a class="btn btn-app bg-olive" id="btn_plus_qte">
                                                            <i class="fa fa-plus" style="font-size:50px;"></i> 
                                                 </a>-->
                                                <!-- <a class="btn btn-app bg-maroon" id="btn_moins_qte">
                                                    <i class="fa fa-minus" style="font-size:50px;"></i>
                                                </a> -->

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

                                                <? //php if (in_array('AR12', $_SESSION['actions']['code_actions'])) { 
                                                ?>
                                                <!--     <a class="btn btn-app bg-maroon" id="btn_sup_produit" disabled>
                                                        <i class="fa fa fa-times fa-5x"></i> SUPPRIMER
                                                    </a> -->
                                                <? //php } 
                                                ?>
                                                <a class="btn btn-app bg-maroon" id="btn_sup_produit" disabled>
                                                    <i class="fa fa fa-times fa-5x"></i> SUPPRIMER
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
                                                <?php if (in_array('AR1', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a class="btn btn-app bg-maroon loader_cmd hidden" disabled>
                                                        <i class="fa fa-plus-square fa-5x"></i> ADDITION
                                                    </a>
                                                    <a class="btn btn-app bg-maroon loader_cmd_h" id="btn_addition2">
                                                        <i class="fa fa-plus-square fa-5x"></i> ADDITION
                                                    </a>
                                                    <a class="btn btn-app bg-maroon hidden" id="btn_addition_loader">
                                                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez
                                                    </a>
                                                <?php } ?>
                                                <?php if ($_SESSION['type_user'] == 1 || $_SESSION['type_user'] == 5) { ?>
                                            
                                                <a id="btn_offert" class="btn btn-app bg-purple" disabled>
                                                    <i class="fa fa-circle-o fa-5x"></i>
                                                    OFFRE
                                                </a>
                                                <?php  } ?>
                                                <?php //if (in_array('MODFCOUVER', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { 
                                                ?>
                                                <a id="btn_couvert" class="btn btn-app bg-orange">
                                                    <i class="fa fa-circle-o fa-5x"></i>
                                                    SERVEUR
                                                </a>
                                                <?php //} 
                                                ?>
                                                <?php if ($_SESSION['type_user'] == 1 || in_array('RM', $_SESSION['actions']['code_actions'])) { ?>

                                                    <a href="#" class="btn btn-app bg-navy" id="btn_update_price">
                                                        <i class="fa fa-money fa-5x"></i>
                                                        REMISE
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
                                                <?php if (in_array('EFDEP', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a href="#" class="btn btn-app bg-orange" id="btn_depense">
                                                        <i class="fa fa-money"></i>
                                                        DEPENSER
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
                                                if (
                                                    in_array('AR7', $_SESSION['actions']['code_actions']) || in_array('VSPTA', $_SESSION['actions']['code_actions'])
                                                ) {
                                                ?>
                                                    <a class="btn btn-app bg-navy ticket">
                                                        <i class="fa fa-inbox"></i> TICKETS
                                                    </a>
                                                <?php } ?>

                                                <?php
                                                if (
                                                    in_array('AR9', $_SESSION['actions']['code_actions']) || in_array('VSPVS', $_SESSION['actions']['code_actions']) || in_array('VTVS', $_SESSION['actions']['code_actions'])
                                                ) {
                                                ?>
                                                    <a href="#" class="btn btn-app bg-olive modal_versement">
                                                        <i class="fa fa-money fa-5x"></i>
                                                        CLOTURER
                                                    </a>
                                                <?php } ?>

                                    
                                                <?php if (in_array('RV', $_SESSION['actions']['code_actions']) || in_array('VSV', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                                    <a href="pages_actions.php?page=analyse&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-purple">
                                                        <i class="fa fa-file-text fa-5x"></i>
                                                        DETAILS <br />VENTES
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('VTCR', $_SESSION['actions']['code_actions']) || in_array('VSPCER', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                                    <a href="main.php?p=facture&d=liste&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-olive confirmModalLink">
                                                        <i class="fa fa-paste fa-5x"></i>
                                                        FACTURES
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($_SESSION['type_user'] == 1) {
                                                ?>
                                                    <a href="main.php?p=facture&d=listpay&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-navy">
                                                        <i class="fa fa-money"></i>
                                                        LISTE<br />PAIEMENTS
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($_SESSION['type_user'] == 1) {
                                                ?>
                                                    <a href="main.php?p=versement&d=details2&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-maroon">
                                                        <i class="fa fa-money"></i>
                                                        LISTE<br />VERSEMENTS
                                                    </a>
                                                <?php } ?>

                                                <?php if (in_array('FDCRESTO', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
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
                                                <?php if ($_SESSION['type_user'] == 1) { ?>
                                                    <a href="pages_actions.php?page=table&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-purple">
                                                        <i class="fa fa-table fa-5x"></i>
                                                        LISTE <br />TABLES
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('EFDEP', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a href="main.php?p=depense&d=liste&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-purple">
                                                        <i class="fa fa-money"></i>
                                                        LISTE <br />DEPENSES
                                                    </a>
                                                    <a href="main.php?p=depense&d=libelles&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-olive">
                                                        <i class="fa fa-money"></i>
                                                        LIBELLES <br />DEPENSES
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('VRLSTCL', $_SESSION['actions']['code_actions'])) { ?>
                                                    <a href="pages_actions.php?page=client" class="btn btn-app bg-navy">
                                                        <i class="fa fa-users fa-5x"></i>
                                                        LISTE <br />CLIENTS
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($_SESSION['type_user'] == 1) {
                                                ?>
                                                    <a href="main.php?p=versement&d=etatcaisse&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-orange">
                                                        <i class="fa fa-file-text fa-5x"></i>
                                                        ETAT <br /> DE CAISSE
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($_SESSION['type_user'] == 1 || in_array('CHGETBL', $_SESSION['actions']['code_actions'])) {
                                                ?>
                                                    <a href="#" class="btn btn-app bg-olive" id="modal_transfer">
                                                        <i class="fa fa-exchange fa-5x"></i>
                                                        CHANGER
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
                                                <?php
                                                if ($_SESSION['type_user'] == 1 || in_array('ECLTMNT', $_SESSION['actions']['code_actions'])) {
                                                ?>
                                                    <!-- <a href="#" class="btn btn-app bg-maroon" id="btn_eclater">
                                                        <i class="fa fa-plus-square-o fa-5x"></i>
                                                        ECLATER
                                                    </a> -->
                                                <?php } ?>
                                                <?php
                                                if ($_SESSION['type_user'] == 1 || in_array('XTRTCPTE', $_SESSION['actions']['code_actions'])) {
                                                ?>
                                                    <a href="main.php?p=extrait&d=liste&ss=<?php echo $_SESSION['id_sousresto'] ?>" class="btn btn-app bg-purple">
                                                        <i class="fa fa-users fa-5x"></i>
                                                        EXTRAIT <br />COMPTES
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($_SESSION['type_user'] == 1 || in_array('REIMPRBN', $_SESSION['actions']['code_actions'])) {
                                                ?>
                                                    <a href="#" class="btn btn-app bg-navy" id="btn_re_imprimer">
                                                        <i class="fa fa-print fa-5x"></i>
                                                        RE-IMPRIMER
                                                    </a>
                                                <?php } ?>
                                                <?php if (in_array('RTR', $_SESSION['actions']['code_actions'])) { ?>

                                                    <a href="#" class="btn btn-app bg-maroon" id="modal_reserver">
                                                        <i class="fa fa-lock fa-5x"></i>
                                                        RESERVER
                                                    </a>
                                                <?php } ?>
                                                </div>

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

    </div>
    <?php include 'modal_confirm_fusion.php'; ?>
    <?php include 'pop_up_eclatmnt.php' ?>;
    <?php include './impot_asside.php'; ?>

    <div id="avertissement-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>AVERTISSEMENT</strong></h5>
                </div>
                <div class="modal-body">
                    <p class="text-center"><b>L'ajout des produits,La modification et la suppression sont vérouillées apres l'addition.</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal btn-lg pull-right" data-dismiss="modal">OK</button>
                </div>

            </div>
        </div>
    </div>
    <div id="myModal_transfer" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <div class="col-lg-8">
                        <h4 class="modal-title"><strong>CHANGEMENT DE TABLE</strong></h4>
                    </div>

                    <div class="col-lg-4">
                        <h5>Table à transferer : <span id="tabtransfert1span"></span></h5>
                        <h5>Table à migrer : <span id="tabtransfert2span"></span></h5>
                        <input type="text">
                        <input type="hidden" id="transfer_idfact">
                        <input type="hidden" id="transfer_idclient">

                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" name="table_search2" id="table_search2" class="form-control" value="" placeholder="Recherche">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group" style="text-align:left;font-size:20px;" id="datatranfertid">
                                <p>Table</p>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn_modal btn-lg" id="btn_transfer_annuler" data-dismiss="modal">ANNULER</button>
                        <button type="submit" class="btn btn-primary btn_modal btn-lg" id="btn_transfer">VALIDER</button>
                        <button type="button" class="btn btn-primary btn_modal btn-lg hidden" id="btn_transfer_loader">VALIDER</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--  <div id="myModal_fusion" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
    </div> -->
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
    <div class="modal fade Modal_versement" id="myModal_versement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    </div>

    <div id="modal_re_imprimer" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><strong>RE-IMPRESSION BON</strong></h4>


                </div>
                <div class="modal-body" id="data_re_impression" style="height:500px;overflow: scroll;">





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal btn-lg" id="btn_re_imprimer_annuler" data-dismiss="modal">ANNULER</button>
                    <button type="submit" class="btn btn-primary btn_modal btn-lg" id="btn_re_imprimer_valider">IMPRIMER</button>
                    <button type="button" class="btn btn-primary btn_modal btn-lg hidden" id="btn_re_imprimer_valider_loader">IMPRIMER</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_confirm_reimpression" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Confirmation Re-impression </strong></h5>
                </div>
                <div class="modal-body">
                    <p class="text-center"><b>Voulez-vous vraiment imprimer ce bon?</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal btn-lg pull-left" data-dismiss="modal">NON</button>
                    <button type="button" class="btn btn-danger btn_modal btn-lg " id="btn_confirm_reimpression">OUI</button>
                </div>

            </div>
        </div>
    </div>
    <div id="modal_confirm_reimpression" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Confirmation Re-impression </strong></h5>
                </div>
                <div class="modal-body">
                    <p class="text-center"><b>Voulez-vous vraiment imprimer ce bon?</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal btn-lg pull-left" data-dismiss="modal">NON</button>
                    <button type="button" class="btn btn-danger btn_modal btn-lg " id="btn_confirm_reimpression">OUI</button>
                </div>

            </div>
        </div>
    </div>
    <div id="modal_reserv_confirm" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>INFOS CLIENT</strong></h5>
                </div>
                <div class="modal-body">
                    <form id="form_res">
                        <div class="form-group">
                            <label>Table:</label>
                            <input type="hidden" class="form-control pull-right dateres" name="table_id" id="table_id" required="required">
                            <input type="text" disabled="disabled" class="form-control pull-right dateres" id="table_des" required="required">
                        </div>
                        <div class="form-group">
                            <label>Client:</label>
                            <input type="text" class="form-control pull-right dateres" name="nomclient" required="required">
                        </div>
                        <div class="form-group">
                            <label>Tél:</label>
                            <input type="text" class="form-control pull-right dateres" name="telclient" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" class="form-control pull-right dateres" name="emailclient" required="required">
                        </div>
                        <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="dateres" id="dateres" required="required" placeholder="Date de réservation">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal btn-lg pull-left" data-dismiss="modal">ANNULER</button>
                    <button type="button" class="btn btn-danger btn_modal btn-lg " id="btn_reserv_confirm">VALIDER</button>
                </div>

            </div>
        </div>
    </div>


    <div id="myModal_reserv" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>RESERVATION DE TABLES</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group" style="text-align:left;font-size:20px;" id="datareservid">

                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">FERMER</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="suppression-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Confirmation Suppression </strong></h5>
                </div>
                <div class="modal-body">

                    <div class="div_txt">
                        <p class="text-center"><b>Voulez-vous vraiment supprimer ce produit?</b></p>
                    </div>
                    <div class="div_frm" style="display: none;">
                        <div class="alert-danger msgcode" style="display:none;border-radius:5px; height:40px; padding:10px;">
                            <span>Code incorrect!</span>
                        </div>

                        <br>
                        <form role="form" method="post" class="frmcode">
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control code" placeholder="CODE" name="code" autofocus required value="">
                                <span class="fa fa-lock form-control-feedback"></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn_modal btn-lg pull-left" data-dismiss="modal">ANNULER</button>
                    <button type="button" class="btn btn-primary btn_modal btn-lg " id="btn_sup_produit_ok">VALIDER</button>
                </div>

            </div>
        </div>
    </div>

    <div id="offre-confirm-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Confirmation Offre</strong></h5>
                </div>
                <div class="modal-body">
                    <div class="alert-danger msgcode" style="display:none;border-radius:5px; height:40px; padding:10px;">
                        <span>Code incorrect!</span>
                    </div>
                    <br>
                    <form role="form" method="post" class="frmcodeoffre">
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control code" placeholder="CODE" name="code" autofocus required value="">
                            <span class="fa fa-lock form-control-feedback"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn_modal btn-lg pull-left" data-dismiss="modal">ANNULER</button>
                    <button type="button" class="btn btn-primary btn_modal btn-lg " id="btn_offre_confirm">VALIDER</button>
                </div>

            </div>
        </div>
    </div>

    <div id="annulation-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Confirmation Annulation </strong></h5>
                </div>
                <div class="modal-body">
                    <div class="div_txt">
                        <p class="text-center"><b>Voulez-vous vraiment annuler cette commande?</b></p>
                    </div>
                    <div class="div_frm" style="display: none;">
                        <div class="alert-danger msgcode" style="display:none;border-radius:5px; height:40px; padding:10px;">
                            <span>Code incorrect!</span>
                        </div>
                        <br>
                        <form role="form" method="post" class="frmcodeannul">
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control code" placeholder="CODE" name="code" autofocus required value="">
                                <span class="fa fa-lock form-control-feedback"></span>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn_modal btn-lg pull-left" data-dismiss="modal">FERMER</button>
                    <button type="button" class="btn btn-primary btn_modal btn-lg " id="btn-confirm-annulation">VALIDER</button>
                </div>

            </div>
        </div>
    </div>

    <div id="validate-code-modal-credit" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Validation paiement crédit </strong></h5>
                </div>
                <div class="modal-body">
                    <div class="div_frm" style="display: none;">
                        <div class="alert-danger msgcode" style="display:none;border-radius:5px; height:40px; padding:10px;">
                            <span>Code incorrect!</span>
                        </div>
                        <br>
                        <form role="form" method="post" class="frmcodecredit">
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control code" placeholder="CODE" name="code" autofocus required value="">
                                <span class="fa fa-lock form-control-feedback"></span>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn_modal btn-lg pull-left" data-dismiss="modal">FERMER</button>
                    <button type="button" class="btn btn-primary btn_modal btn-lg " id="btn-confirm-validate-credit">VALIDER</button>
                </div>

            </div>
        </div>
    </div>

    <div id="decrementeQte-confirm-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Réduction de la quantité</strong></h5>
                </div>
                <div class="modal-body">
                    <div class="alert-danger msgcode" style="display:none;border-radius:5px; height:40px; padding:10px;">
                        <span>Code incorrect!</span>
                    </div>
                    <br>
                    <form role="form" method="post" class="frmdecremente">
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control code" placeholder="CODE" name="code" autofocus required value="">
                            <span class="fa fa-lock form-control-feedback"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn_modal btn-lg pull-left" data-dismiss="modal">ANNULER</button>
                    <button type="button" class="btn btn-primary btn_modal btn-lg " id="btn_decremente_confirm">VALIDER</button>
                </div>

            </div>
        </div>
    </div>
    <?php
    include 'modal_ajout_client.php';
    include 'modal_plus.php';
    include '../paiement/modal_paiement_resto.php';
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
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/paiement.js"></script>
    <script src="datepicker/jquery.datetimepicker.js"></script>
    <!--     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
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
            $('#dateres').datetimepicker();
        });

        function highlightActive(obj) {
            var inputcollection = document.getElementsByTagName('input');
            for (i = 0; i < inputcollection.length; i++) {
                inputcollection[i].style.backgroundColor = (inputcollection[i] == obj) ? "lime" : "white";
            }
        }

        var activeinput

        function populateTd() {
            var tdcollection = document.getElementsByTagName('table')[0].getElementsByTagName('button');
            //alert(tdcollection);
            for (i = 0; i < tdcollection.length; i++) {
                tdcollection[i].indice = i;
                tdcollection[i].className = 'up';
                tdcollection[i].onmousedown = function() {
                    this.className = 'down';
                }
                tdcollection[i].onmouseup = function() {
                    this.className = 'up';
                }
                tdcollection[i].onclick = function() {
                    if (!!activeinput) {
                        // pour entrer le numéro sur lequel on vient de taper
                        if (this.indice < 11) {
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
                                beforeSend: function() {

                                },
                                success: function(data) {
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
                                complete: function() {

                                },
                                dataType: 'json'
                            });
                            return false;

                        }
                        // pour effacer le dernier caractere
                        if (this.indice == 11) {
                            activeinput.value = activeinput.value.substr(0, activeinput.value.length - 1);
                            //                alert(activeinput.value);

                            var donnees = $('.f_modal_paiement').serialize();
                            var bool = false;
                            var urlpg = './Traitement/reglement.php?do=rendu';

                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                data: donnees,
                                beforeSend: function() {

                                },
                                success: function(data) {
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
                                complete: function() {

                                },
                                dataType: 'json'
                            });
                            return false;

                        }
                        // pour tout effacer
                        if (this.indice == 12) {
                            activeinput.value = "";
                        }
                    }
                }
            }
        }
    </script>
</body>

</html>
