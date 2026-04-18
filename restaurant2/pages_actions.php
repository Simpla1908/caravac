<?php
// Initialisation de la session
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include('../bdd/connexion.php');
include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../FUNCTION/hebergement.php';
include '../FUNCTION/restaurant.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    require 'index.php';
}

$caisse = 0;
if (isset($_GET['caisse'])) {
    $caisse = $_GET['caisse'];
    /*   if($caisse==4){
        $date_bd1 =date('01-m-Y');
        $date_bd2 = date("Y-m-t");
    } */
}
$sous_sites = ListPosResto($_SESSION['id_hotel'], $bdd);
if (isset($_GET['ss']) && ($_SESSION['type_user'] == 1
    || in_array('VFTSR', $_SESSION['actions']['code_actions']))) {
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
?>
<!DOCTYPE html>
<html>

<head>
    <?php include './impot_css.php'; ?>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand"><b><i class="ion-android-restaurant"></i> Ebutelo</b> RESTO (<span class="text" id='nom_ssite'><?php echo $_SESSION['libelle_resto'] ?></span>)</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <!-- /.messages-menu -->
                                <?php if (in_array('AR14', $_SESSION['actions']['code_actions'])) { ?>
                                    <li>
                                        <a href="../REC/tableaudebordRec.php" title="Tableau de bord"><b><i class="fa fa-home fa-2x"></i></b></a>
                                    </li>
                                <?php } ?>
                                <?php if ($caisse == 1) { ?>
                                    <li><a href="caissier.php"><i class="fa fa-mail-reply-all fa-2x"></i> Retour</a></li>
                                <?php } else if ($caisse == 3 || $caisse == 4) { ?>
                                    <li><a href="../REC/tableaudebordRec.php"><i class="fa fa-mail-reply-all fa-2x"></i> Retour</a></li>
                                <?php } else { ?>
                                    <li><a href="index.php?ss=<?php echo $_SESSION['id_sousresto'] ?>"><i class="fa fa-mail-reply-all fa-2x"></i> Retour</a></li>
                                <?php } ?>
                                <!--<li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Plus</a></li>-->
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-user fa-fw fa-2x"></i> <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#"><?php echo ucfirst($_SESSION['nom_user']); ?></a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                                        </li>
                                    </ul>
                                    <!-- /.dropdown-user -->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <?php

        //  include('./POP-UP/action.php');
        ?>
        <input type="hidden" class="form-control pull-right" name="tcaisse" id="tcaisse" value="<?php echo $caisse ?>" />
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php
                        $dte = date('Y-m-d');
                        $date_bd1 = $date_bd2 = date('Y-m-d');
                        $hr_1 = '00:00:00';
                        $hr_2 = '05:00:00';
                        $hr_operation = date('H:i:s');
                        //Ajustement pour des ventes tardives
                        if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
                            $dte = ReduiceDaysToDate($dte, 1);
                            $date_bd1 = $date_bd2 = $dte;
                        }
                        if ($page == 'analyse') {
                            echo 'Details des ventes';
                        } elseif ($page == 'fiche') {
                            echo 'Fiche de stock';
                        } elseif ($page == 'table') {
                            echo 'Tables';
                        } elseif ($page == 'client') {
                            echo 'Clients';
                        } else {
                            require 'index.php';
                        }
                        ?>
                    </h1>
                    <?php if ($page == 'analyse') { ?>
                        <br />
                        <span class="text-danger pull-right hidden" id="loader_dte">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement en cours...
                        </span>
                        <ol class="breadcrumb">
                            <form class="form-inline">
                                <fieldset>
                                    <input type="hidden" name="sousresto_id" id="sousresto_id" value="<?php echo $_SESSION['id_sousresto'] ?>" />
                                    <?php if($_SESSION['type_user']==1){ ?>
                                        <div class="form-group">
                                            <label for="ex4">&nbsp;CAISSIER&nbsp;</label>
                                            <select class="form-control" id="caissier_id" name="caissier_id" required>
                                                <option value="0">Tout</option>
                                                <?php
                                                $requete = $bdd->prepare("SELECT * FROM  t_utilisateur AS u"
                                                    . " WHERE u.id_hotel=:hotel_id AND u.psedo=0 ORDER BY u.nom_user");
                                                //session à enlever
                                                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                                $requete->execute();
                                                $utilisateurs = $requete->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($utilisateurs as $u) :
                                                    echo '<option value=' . $u->id_user . '>' . ucfirst($u->nom_user) . '</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group hidden">
                                        <label for="ex4">&nbsp;SERVEUR&nbsp;</label>
                                        <select class="form-control" id="serveur_id" name="serveur_id" required>
                                            <option value="0">Tout</option>
                                            <?php
                                            $serveurs=getServeurs($_SESSION['id_hotel'],$bdd);
                                            foreach ($serveurs as $s) :
                                                echo '<option value='.$s->id.'>'.ucfirst($s->nom).''.ucfirst($s->prenom).'</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" style="width: 145px" name="periode" id="periode" value="<?php echo dateAffiche($date_bd1) . ' à ' . dateAffiche($date_bd1) ?>" />
                                        <input type="hidden" name="current" id="current" value="0" />
                                        <div class="input-group-addon">
                                            <a href="#" id="btn_periode" title="Valider">
                                                Valider
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group text-right">
                                   <a class="btn btn-default" id="btn-impr-details-vente" href="impression/examples/rapport_detail_vente.php" target="_blank"><i class="fa fa-print fa-fw"></i>&nbsp;Imprimer</a>
                                </div> -->
                                </fieldset>

                            </form>
                        </ol><br>
                    <?php } ?>

                    <?php if ($page == 'fiche') { ?>
                        <br />
                        <span class="text-danger pull-right hidden" id="loader_dte_fiche">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement en cours...
                        </span>
                        <ol class="breadcrumb">
                            <form class="form-inline">
                                <fieldset>

                                    <div class="form-group">
                                        <label for="ex4">&nbsp;Famille&nbsp;</label>
                                        <select class="form-control" id="famille_id" name="famille_id" required>
                                            <option value="0">Tout</option>
                                            <?php
                                            $requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
                                                . " WHERE f.hotel_id=:hotel_id AND f.plat=0 ORDER BY designation");
                                            //session à enlever
                                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                            $requete->execute();
                                            $s_familles = $requete->fetchAll(PDO::FETCH_OBJ);

                                            foreach ($s_familles as $f) :
                                                echo '<option value=' . $f->idfamille . '>' . ucfirst($f->designation) . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" style="width: 145px" name="periode" id="periode" value="<?php echo date("d/m/Y") . ' à ' . date("d/m/Y"); ?>" />
                                        <input type="hidden" name="current" id="current" value="0" />
                                        <div class="input-group-addon">
                                            <a href="#" id="btn_periode_fiche" title="Valider">
                                                Valider
                                            </a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </ol><br>
                    <?php } ?>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php if ($page == 'fiche') { ?>
                        <div class="box" id="tableau_fiche">

                        </div>
                    <?php } elseif ($page == 'analyse') { ?>
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_3" data-toggle="tab">Details ventes</a></li>
                                <!-- <li><a href="#tab_6" data-toggle="tab">Chiffre d'affaire par serveur</a></li> -->
                                <li><a href="#tab_5" data-toggle="tab">Details Benefices</a></li>
                                <li><a href="#tab_4" data-toggle="tab">Extraits T.V.A</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_3">
                                    <div class="box detvente" id="tableau_detail">

                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_4">
                                    <div class="box" id="tableau_tva">

                                    </div>

                                </div>
                                <div class="tab-pane" id="tab_5">
                                    <div class="box" id="tableau_marge">
                                    </div>

                                </div>
                                <div class="tab-pane" id="tab_6">
                                    <div class="box" id="tableau_ca_serveur">
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->

                    <?php } elseif ($page == 'table') { ?>
                        <div class="col-lg-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="col-lg-10">
                                        <h3 class="box-title">
                                            Liste des tables
                                        </h3>
                                    </div>
                                    <?php if (in_array('ATR', $_SESSION['actions']['code_actions'])) { ?>
                                        <div class="col-lg-2 text-center">
                                            <a class="btn-xs btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" id="ajouter111">
                                                <i class="fa fa-chevron-down"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel box box-default">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a>
                                                        Ajout d'une table
                                                    </a>
                                                </h4>
                                            </div>
                                            <form id="form_table" action="Traitement/insertion_table.php" method="post">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Code</label>
                                                                <input type="hidden" id="idtable" name="idtable" value="0">
                                                                <input type="text" class="form-control" id="codetable" name="codetable" placeholder="Code" value="">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Désignation</label>
                                                                <input type="text" class="form-control" id="Destable" name="Destable" placeholder="Désignation" value="">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Ordre d'affichage</label>
                                                                <input type="text" class="form-control" id="ordre" name="ordre" placeholder="" value="100">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <div class="box-footer">
                                                    <div class="col-md-9">
                                                        <div id="msg" class="alert alert-warning alert-dismissable" style=" text-align: center; display: none">
                                                            <i class='fa fa-warning fa-fw'></i> <span id="msg_alert"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit" class="btn btn-info pull-right" id="save_table"><i class="fa fa-save fa-fw"></i>&nbsp;Enregistrer
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                            <!-- /.box-footer -->
                                        </div>
                                    </div>
                                    <?php if (in_array('ATR', $_SESSION['actions']['code_actions']) || in_array('VLTR', $_SESSION['actions']['code_actions'])) { ?>
                                        <div class="box" id="view_table">

                                        </div>
                                    <?php } ?>
                                    <!-- /.box -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>

                    <?php } elseif ($page == 'client') { ?>
                        <div class="col-lg-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="col-lg-10">
                                        <h3 class="box-title">
                                            Liste des clients
                                        </h3>
                                    </div>
                                    <?php //if (in_array('ATR', $_SESSION['actions']['code_actions'])) { 
                                    ?>
                                    <div class="col-lg-2 text-center">
                                        <a class="btn-xs btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" id="ajouter111">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                    <?php //} 
                                    ?>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel box box-default">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a>
                                                        Ajout d'un client
                                                    </a>
                                                </h4>
                                            </div>
                                            <form id="formaddclient" action="Traitement/addclient.php" method="post">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Noms</label>
                                                                <input type="text" class="form-control" id="noms" name="noms" placeholder="Noms" value="">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Sexe</label>
                                                                        <select name="sexe" class="form-control select2" style="width: 100%;" id="sexe">
                                                                            <option value="" selected="selected"></option>
                                                                            <option value="masculin">Masculin</option>
                                                                            <option value="feminin">Feminin</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Remise</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" id="remisecl" name="remisecl" value="40">
                                                                            <span class="input-group-addon">%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Télephone</label>
                                                                <input type="text" class="form-control" id="tel" name="tel" placeholder="Telephone" value="">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>E-mail</label>
                                                                <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <div class="box-footer">
                                                    <div class="col-md-9">
                                                        <div id="msgcl" class="alert alert-success alert-dismissable" style="display:none;">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <span id="msgcl_alert">L'enrégistrement s'est effectué avec
                                                                succès!</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit" class="btn btn-info pull-right" id="btn_add_client_conf"><i class="fa fa-save fa-fw"></i>&nbsp;Enregistrer
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                            <!-- /.box-footer -->
                                        </div>
                                    </div>
                                    <?php //if (in_array('ATR', $_SESSION['actions']['code_actions']) || in_array('VLTR', $_SESSION['actions']['code_actions'])) { 
                                    ?>
                                    <div class="box" id="view_client">

                                    </div>
                                    <?php //} 
                                    ?>
                                    <!-- /.box -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    <?php } else {
                        require 'index.php';
                    } ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <?php
    include 'modal_updt_client.php';
    ?>
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
        $(function() {
            //Enable iCheck plugin for checkboxes
            //iCheck for checkbox and radio inputs
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
    <script src="dist/js/demo.js"></script>
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
            customRangeLabel: 'Periode personnalisée',
            daysOfWeek: moment().lang()._weekdaysMin,
            monthNames: moment().lang()._months,
            firstDay: 0
        };

        var pickerRanges = {
            'Aujourd\'hui': [moment(), moment()],
            'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
            '5 jours precedents': [moment().subtract('days', 4), moment().subtract('days', 1)],
            'Ce mois': [moment().startOf('month'), moment().endOf('month')],
            'Mois precedent': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf(
                'month')]
        };

        $(document).ready(function() {
            //Chargement des fichiers par defaut
            //$("#tableau_fiche").load('./Traitement/tableau_fiche_stock_auto.php');
            var valcaisse = ($("#tcaisse").val());
            $("#tableau_detail").load('./Traitement/tableau_detail_vente_auto.php?caisse=' + valcaisse);
            $("#tableau_tva").load('./Traitement/data_extraits_tva.php');
            $("#tableau_marge").load('./Traitement/data_marge.php');
            $("#view_table").load('./Traitement/view_table.php');
            $("#view_client").load('./Traitement/view_client.php');
            $("#reservation").load('./Traitement/ajout_reservation.php');
        });
        $(document).ready(function() {
            function effacer() {
                $(':input', '#formversement').not(':button,:submit,:reset,:hidden,\n\
                                       #user_id')
                    .val(0)
                    .removeAttr('checked')
                    .removeAttr('selected');
            }

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
                    success: function(html) {
                        $("#s_famille_id").empty().append(html);
                    }
                });
            }

            $("#btn_periode").click(function() {
                var serveur_id = $('#serveur_id').val();
                var periode = $('#periode').val();
                var current = $('#current').val();
                var id_sousresto = $('#sousresto_id').val();
                var caissier_id = $('#caissier_id').val();
                var caissier_name = $('#caissier_id option:selected').text();
                var bool;
                $.ajax({
                    url: './Traitement/tableau_vente_jour.php',
                    async: true,
                    type: 'POST',
                    data: "periode=" + periode + "&serveur_id=" + serveur_id + "&caissier_id=" + caissier_id
                    +"&caissier_name=" + caissier_name,
                    global: false,
                    cache: false,
                    beforeSend: function() {
                        $("#loader_dte").removeClass('hidden');
                    },
                    success: function(data) {
                        $("#tableau_detail").empty().html(data);
                        $("#loader_dte").addClass('hidden');
                    }
                });

                $.ajax({
                    url: './Traitement/data_extraits_tva.php',
                    async: true,
                    type: 'POST',
                    data: "periode=" + periode + "&current=" + current + "&sresto_id=" +
                        id_sousresto,
                    global: false,
                    cache: false,
                    beforeSend: function() {
                        $("#loader_dte").removeClass('hidden');
                    },
                    success: function(html) {
                        $("#tableau_marge").empty().append(html);
                        $("#loader_dte").addClass('hidden');

                    }
                });

                $.ajax({
                    url: './Traitement/data_marge.php',
                    async: true,
                    type: 'POST',
                    data: "periode=" + periode + "&current=" + current + "&sresto_id=" +
                        id_sousresto,
                    global: false,
                    cache: false,
                    beforeSend: function() {
                        $("#loader_dte").removeClass('hidden');
                    },
                    success: function(html) {
                        $("#tab_5").empty().append(html);
                        $("#loader_dte").addClass('hidden');

                    }
                });

            });


            $("#btn_periode_fiche").click(function() {
                var periode = $('#periode').val();
                var current = $('#current').val();
                var famille_id = $('#famille_id').val();
                var bool;

                $.ajax({
                    url: './Traitement/tableau_fiche_stock.php',
                    async: true,
                    type: 'POST',
                    data: "periode=" + periode + "&famille_id=" + famille_id,
                    global: false,
                    cache: false,
                    beforeSend: function() {
                        $("#loader_dte_fiche").removeClass('hidden');
                    },
                    success: function(html) {
                        $("#tableau_fiche").empty().append(html);
                        $("#loader_dte_fiche").addClass('hidden');
                    }
                });
            });

            $("#tableau_detail").on('click', '#btn-impr-details-vente', function(e) {
                e.preventDefault();
                var periode = $("#periode").val();
                var caissier_name = $('#caissier_id option:selected').text();
                window.open('impression/examples/rapport_detail_vente_don.php?periode=' + periode+'&caissier_name='+caissier_name);
                window.open('impression/examples/rapport_detail_vente_credit.php?periode=' + periode+'&caissier_name='+caissier_name);
                window.open('impression/examples/rapport_detail_vente_cash.php?periode=' + periode+'&caissier_name='+caissier_name);
            });

            $("#save_table").click(function(e) {
                e.preventDefault();
                var donnees = $('#form_table').serialize();
                $.ajax({
                    url: './Traitement/insertion_table.php',
                    async: true,
                    type: 'POST',
                    data: donnees,
                    global: false,
                    cache: false,
                    success: function(data) {
                        if (data.message_succes == 'succes') {
                            $('#msg').show();
                            $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!")
                            $("#codetable").val(' ');
                            $("#Destable").val(' ');
                            $("#ordre").val(' ');
                            $("#view_table").load('./Traitement/view_table.php');
                            $('#msg').show().fadeOut(5000);
                            $("#reservation").load('./Traitement/ajout_reservation.php');
                            $('#tab_1').empty().load('liste_tbl_maj.php');

                        } else if (data.message_erreur == 'erreur') {
                            $('#msg').show();
                            $('#msg_alert').text("Ce code " + data.code_value +
                                " du produit saisi existe déjà");
                            $('#msg').show().fadeOut(5000);
                        } else if (data.message_vide == 'vide') {
                            $('#msg').show();
                            $('#msg_alert').text('Veuilez remplir les champs vides!');
                            $('#msg').show().fadeOut(5000);
                        }

                    },
                    dataType: 'json'
                });

            });

            $('#btn_add_client_conf').click(function(e) {
                e.preventDefault();
                var donnees = $('#formaddclient').serialize();
                $.ajax({
                    url: './Traitement/addclient.php',
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        if (data.message == 'succes') {
                            $("#noms").val(' ');
                            $("#tel").val(' ');
                            $("#email").val(' ');
                            $('#msgcl').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msgcl_alert').text(
                                "L'enregistrement s'est effectué avec succes!");
                            $("#view_client").load('./Traitement/view_client.php');
                        } else if (data.message == 'vide') {
                            $('#msgcl').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msgcl_alert').text('Veuilez remplir les champs vides!')

                        }

                    },
                    dataType: 'json'
                });
                return false;
            });
            $("#view_client").on('click', '.updcustomerresto_init', function(e) {
                e.preventDefault();
                $("#id22").val($(this).attr("idclient"));
                $("#remise22").val($(this).attr("remise"));
                $("#noms22").val($(this).attr("nomclient"));
                $("#tel22").val($(this).attr("telephoneclient"));
                $("#email22").val($(this).attr("emailclient"));
                $('#sexe22 option[value=' + $(this).attr("sexeclient") + ']').prop('selected', true);


            });

            $('#updcustomerresto_pro').click(function(e) {
                e.preventDefault();
                var donnees = $('#formupdtclient').serialize();
                $.ajax({
                    url: './Traitement/updtclient.php',
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        //                                    alert(data);
                        if (data.message == 'succes') {
                            $("#view_client").load('./Traitement/view_client.php');
                            $('#msgcl22').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msgcl_alert22').text(
                                "La mise à jour s'est effectué avec succes!");
                        } else if (data.message == 'vide') {
                            $('#msgcl22').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msgcl_alert22').text('Veuillez remplir les champs vides!')

                        }

                    },
                    dataType: 'json'
                });


            });

            //Suppression d'une table
            $("#view_client").on('click', '.supprimer_client', function(e) {
                var donnees = '';
                var table_res_id = $(this).attr('id');
                $.ajax({
                    url: 'Traitement/suppression_table.php?table_res_id=' + table_res_id,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        $("#view_client").load('./Traitement/view_client.php');
                    }
                });
                return false;
            });
            $('#periode').daterangepicker({
                showDropdowns: false,
                ranges: pickerRanges,
                format: 'DD/MM/YYYY',
                separator: ' à ',
                locale: pickerLocale
            });
            $('#periode_heure').daterangepicker({
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
            });
            $('#date_simple').daterangepicker({
                startDate: moment(),
                format: 'DD/MM/YYYY',
                singleDatePicker: true,
                locale: pickerLocale
            });

            $('#dataTables-example').dataTable({
                "ordering": false,
            });

            function deconnexionAuto() {
                setTimeout(function() {
                    $.ajax({
                        url: 'Traitement/autologout.php',
                        type: 'GET',
                        success: function(data) {
                            if (data.bool) {
                                window.location.href = '../Authentification/logout.php ';

                            }
                        },
                        dataType: 'json'
                    });
                    deconnexionAuto();
                }, 1800000);
            }
            deconnexionAuto();
        });
    </script>
</body>

</html>