<?php
ini_set('display_errors', 0);
if (!isset($_SESSION)) {
    session_start();
}
include './bdd/connexion.php';
include('../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
include('../FUNCTION/hebergement.php');
include('../FUNCTION/restaurant.php');

$_SESSION['test'] = 0;
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
        <?php include './impot_header_cuisine.php'; ?>
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        CUISINE
                        <!--<small>Example 2.0</small>-->
                    </h1>
                    <!--    <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Layout</a></li>
            <li class="active">Top Navigation</li>
        </ol>-->
                    <span class="text-danger pull-right hidden" id="loader_dte">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement en cours...
                    </span>
                    <ol class="breadcrumb">
                        <form class="form-inline filter_frm" id="frm_report" style="display: none;">
                            <fieldset>
                                <input type="hidden" name="sousresto_id" id="sousresto_id" value="<?php echo $_SESSION['id_sousresto'] ?>" />
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right text-left" name="periode" id="periode" value="<?php echo date("d/m/Y") . ' à ' . date("d/m/Y"); ?>" />
                                    <input type="hidden" name="current" id="current" value="0" />
                                    <div class="input-group-addon">
                                        <a href="#" id="filtrer_report_yes" title="Valider">
                                            Valider
                                        </a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </ol><br>
                </section>
                <section class="content">
                    <div class="box">
                        <!--<div class="box-header">
            <h3 class="box-title">Factures</h3>
        </div>-->
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive" id="alldatafact">
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active li_1"><a href="#tab_1" data-toggle="tab" class="facture" mode="cash" id="boncommande">Bons de commande</a></li>
                                        <li class="li_2"><a href="#tab_2" data-toggle="tab" class="facture" mode="credit" id="generaterapport">Rapport Cuisine</a></li>

                                        <input type="hidden" id="mode" name="mode" value="cash">
                                        <a href="#" class="btn btn-primary btn-sm pull-right" id="btn_report_cuisine" style="display: none;"><i class="fa fa-print"></i> Imprimer</a>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="box-body" id="listboncommandes">

                                                <?php
                                                $impr_row = 1;
                                                $compt_row = 4;
                                                // Liste des tickets pour chaque sous resto
                                                $requete = $bdd->prepare("SELECT  f.id_user,f.montant_total,f.mont_tva,f.mont_ttc,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,f.date_edition,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type,c.user_attente "
                                                    . "FROM  t_reservation AS r,t_client AS c,t_facture AS f "
                                                    . "WHERE f.type='restaurant' AND f.etat_cmd='1' AND f.id_client=c.id_client "
                                                    . "AND r.id_res=f.id_res AND r.id_hotel=:hotel_id AND f.cuisine=1 AND f.preparer=0 ORDER BY r.id_res ASC");
                                                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                                $requete->execute();
                                                $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($reservation_attente as $ra) {
                                                    $id = $ra->id_res;
                                                    $date_edition = $ra->date_edition;
                                                    $id_fact = $ra->id_fact;
                                                    $num_fact = $ra->num_fact;
                                                    $remise_fact = $ra->mont_ttc_remise;
                                                    $mont_remise = $ra->tva;
                                                    $tva_fact = $ra->tva;
                                                    $mont_tva = $ra->mont_tva;
                                                    $mont_ht = 0;
                                                    $mont_ttc = $ra->mont_ttc;
                                                    $id_cl = $ra->id_client;
                                                    $cmd_num = $ra->num_reserv;
                                                    $tbl = $ra->designation;
                                                    $cl = $ra->nom_client;
                                                    $typ = $ra->type;
                                                    $user_attente = $ra->id_user;
                                                    //infos serveur
                                                    $datas = InfosUser($user_attente, $bdd);
                                                    $nom_serveur = $datas['nom_user'];
                                                    //infos serveur
                                                    if (($typ == 'client') || ($typ == 'serveur')) {
                                                        $cl_tbl = $cl;
                                                    } else if ($typ == 'table') {
                                                        $cl_tbl = $tbl;
                                                    } else {
                                                        $cl_tbl = 'Client occasionnel';
                                                    }
                                                ?>
                                                    <?php
                                                    if ($impr_row == 1) {
                                                        $impr_row = 0;
                                                    ?>
                                                        <div class="row">
                                                        <?php }
                                                    $impr = 0;
                                                    ReimprimerBC2($id_fact, $impr, $bdd);
                                                    $nbArticles = count($_SESSION['panier']['id_article']);
                                                        ?>
                                                        <div class="col-md-3">
                                                            <!-- DIRECT CHAT PRIMARY -->
                                                            <div class="box box-default direct-chat direct-chat-primary panel panel-default">
                                                                <div class="box-header with-border center" align="center">
                                                                    <h3 class="box-title">N° FAC :<?php echo $num_fact; ?></h3><br>
                                                                    <h3 class="box-title">SERVEUR :<?php echo $nom_serveur; ?></h3><br>
                                                                    <h3 class="box-title">STATUT :<?php echo $_SESSION['statut_cmd']; ?></h3><br>
                                                                    <span data-toggle="tooltip" class="badge bg-green"><?php echo $cl_tbl; ?></span>
                                                                </div>
                                                                <table class="table table-hover table-condensed" id="tab_commandes">
                                                                    <tbody>
                                                                        <?php if ($_SESSION['entree'] == 1) { ?>
                                                                            <tr>
                                                                                <td align="center" colspan="3">
                                                                                    <b>ENTREES</b>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>

                                                                                <th class='mailbox-subject'> DESIGNATION</th>
                                                                                <th class='mailbox-attachment'>QTE</th>
                                                                                <th></th>
                                                                            </tr>


                                                                            <?php
                                                                            $compteur_entree = 0;
                                                                            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                                                                $repas = $_SESSION['panier']['repas'][$i];
                                                                                $genre = $_SESSION['panier']['genre'][$i];

                                                                                if ($repas == 1 && $genre == 1) {
                                                                            ?>
                                                                                    <tr>
                                                                                        <td class='mailbox-subject'><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></td>
                                                                                        <td class='mailbox-attachment'><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                                                                        <td></td>

                                                                                    </tr>
                                                                            <?php
                                                                                    $compteur_entree = $compteur_entree + $_SESSION['panier']['qte'][$i];
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td><b>TOTAL ENTREES</b></td>
                                                                                <td><b><?php echo $compteur_entree; ?></b></td>
                                                                                <td></td>

                                                                            </tr>
                                                                        <?php } ?>
                                                                        <?php if ($_SESSION['plats'] == 1) { ?>
                                                                            <tr>
                                                                                <td align="center" colspan="3">
                                                                                    <b>PLATS</b>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>

                                                                                <th class='mailbox-subject'> DESIGNATION</th>
                                                                                <th class='mailbox-attachment'>QTE</th>
                                                                                <th></th>
                                                                            </tr>


                                                                            <?php
                                                                            $des_plt = '';
                                                                            $kt = 0;
                                                                            $compteur_plat = 0;
                                                                            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                                                                $repas = $_SESSION['panier']['repas'][$i];
                                                                                $genre = $_SESSION['panier']['genre'][$i];
                                                                                $des_plt = $_SESSION['panier']['description'][$i];
                                                                                $plat_idc = $_SESSION['panier']['id_article'][$i];

                                                                                if ($repas == 1 && $genre == 0) {

                                                                            ?>
                                                                                    <tr>
                                                                                        <td class='mailbox-subject'><?php echo ucfirst($_SESSION['panier']['nom'][$i] . '</br>' . ' ' . $des_plt); ?></td>
                                                                                        <td class='mailbox-attachment'><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                                                                        <td></td>

                                                                                    </tr>
                                                                            <?php
                                                                                    $compteur_plat = $compteur_plat + $_SESSION['panier']['qte'][$i];
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td><b>TOTAL PLATS</b></td>
                                                                                <td><b><?php echo $compteur_plat; ?></b></td>
                                                                                <td></td>

                                                                            </tr>
                                                                        <?php } ?>
                                                                        <?php if ($_SESSION['dessert'] == 1) { ?>
                                                                            <tr>
                                                                                <td align="center" colspan="3">
                                                                                    <b>DESSERTS</b>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>

                                                                                <th class='mailbox-subject'> DESIGNATION</th>
                                                                                <th class='mailbox-attachment'>QTE</th>
                                                                                <th></th>
                                                                            </tr>


                                                                            <?php
                                                                            $compteur_dessert = 0;
                                                                            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                                                                $repas = $_SESSION['panier']['repas'][$i];
                                                                                $genre = $_SESSION['panier']['genre'][$i];

                                                                                if ($repas == 1 && $genre == 0) {

                                                                            ?>
                                                                                    <tr>
                                                                                        <td class='mailbox-subject'><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></td>
                                                                                        <td class='mailbox-attachment'><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                                                                        <td></td>

                                                                                    </tr>
                                                                            <?php
                                                                                    $compteur_dessert = $compteur_dessert + $_SESSION['panier']['qte'][$i];
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td><b>TOTAL DESSERT</b></td>
                                                                                <td><b><?php echo $compteur_dessert; ?></b></td>
                                                                                <td></td>

                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>

                                                                    </tfoot>
                                                                </table>
                                                                <div class="box-footer">
                                                                    <button class="btn btn-default btn-block btn_vld_preparation" id="<?php echo $id_fact; ?>">
                                                                        Valider
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!--/.direct-chat -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <?php
                                                        $compt_row--;
                                                        if ($compt_row == 0) {
                                                            $impr_row = 1;
                                                            $compt_row = 4;
                                                        }
                                                        if ($impr_row == 1) {
                                                            $impr_row = 1;
                                                        ?>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                <?php }
                                                ?>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>
                        </div>

                        <!-- /.box-body -->
                    </div>
                </section>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.tab-pane -->


    </div>
    <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <?php include './impot_asside.php'; ?>
    </div>

    </div>
    </div>

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
        // JavaScript Document
        $(document).ready(function() {
            $("#listboncommandes").on('click', '.btn_vld_preparation', function(e) {

                var fact_id = $(this).attr('id');
                var bool = false;
                $.ajax({
                    url: 'Traitement/cuisineupdatefact.php?boncommande_id=' + fact_id,
                    type: 'GET',
                    beforeSend: function() {
                        $(".loader_list").removeClass('hidden');

                    },
                    success: function(data) {
                        bool = true;
                        $.ajax({
                            url: 'Traitement/cuisinedata.php',
                            type: 'POST',
                            success: function(data) {
                                bool = true;
                                $("#listboncommandes").html(data);
                                // var donnees="";
                                //  $.ajax({
                                //     url: './Traitement/data_rapport_boncmd.php',
                                //     type: 'POST',
                                //     data: donnees,
                                //     success: function(data) {
                                //     $("#rapport_boncommande").html(data); 

                                //     }
                                // });
                                window.open('impression/examples/recu_bon_commande.php?boncommande_id=' + fact_id);
                            }

                        });
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader_list").addClass('hidden');
                        } else {
                            $(".loader_list").removeClass('hidden');
                        }
                    }
                });
                return true;
            });
            $('#boncommande').click(function(e) {
                e.preventDefault();
                var donnees = "";
                $.ajax({
                    url: './Traitement/cuisinedata.php',
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        $('.li_2').removeClass('active');
                        $('.li_1').addClass('active');
                        $('#btn_report_cuisine').hide();
                        $('#frm_report').hide();
                        $("#listboncommandes").html(data);

                    }
                });
                return false;
            });
            $('#generaterapport').click(function(e) {
                e.preventDefault();
                var donnees = "";
                $.ajax({
                    url: './Traitement/data_rapport_boncmd.php',
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        $('.li_1').removeClass('active');
                        $('.li_2').addClass('active');
                        $('#btn_report_cuisine').show();
                        $('#frm_report').show();
                        $("#listboncommandes").html(data);

                    }
                });
                return false;
            });
            $('#btn_report_cuisine').click(function(e) {
                e.preventDefault();
                window.open('impression/examples/rapport_cuisine.php');
                return true;
            });
            $('#filtrer_report_yes').click(function(e) {
                e.preventDefault();
                var donnees = $('#frm_report').serialize();
                $.ajax({
                    url: './Traitement/data_rapport_boncmd_maj.php',
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        $('.li_1').removeClass('active');
                        $('.li_2').addClass('active');
                        $('#btn_report_cuisine').show();
                        $("#listboncommandes").html(data);


                    }
                });
                return false;
            });
            $("#listboncommandes").on('click', '.btn_print_bon', function(e) {
                var fact_id = $(this).attr('id');
                var id_cmd = 0;
                var nom_client = $(this).attr('n');
                window.open('impression/examples/recu_bon_commande.php?nom_client=' + nom_client + '&boncommande_id=' + fact_id + "&id_cmd=" + id_cmd);

                return false;
            });

            function loadbcAuto() {
                var bool = false;
                setTimeout(function() {
                    $.ajax({
                        url: 'Traitement/cuisinedata.php',
                        type: 'POST',
                        beforeSend: function() {
                            $(".loader_list").removeClass('hidden');

                        },
                        success: function(data) {
                            $('.li_2').removeClass('active');
                            $('.li_1').addClass('active');
                            $("#listboncommandes").html(data);
                            bool = true;
                        },
                        complete: function() {
                            if (bool) {
                                $(".loader_list").addClass('hidden');
                            } else {
                                $(".loader_list").removeClass('hidden');
                            }
                        }

                    });
                    loadbcAuto();
                }, 60000);
            }
            loadbcAuto();
        });
    </script>
    <script type="text/javascript" src="daterangepicker/moment-with-langs.min.js"></script>
    <script type="text/javascript" src="daterangepicker/daterangepicker.js"></script>
    <script>
        moment.lang('fr');

        var pickerLocale = {
            applyLabel: 'OK',
            cancelLabel: 'Annuler',
            fromLabel: 'Entre',
            toLabel: 'et',
            customRangeLabel: 'Periode personnalisee',
            daysOfWeek: moment().lang()._weekdaysMin,
            monthNames: moment().lang()._months,
            firstDay: 0
        };

        var pickerRanges = {
            'Aujourd\'hui': [moment(), moment()],
            'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
            '5 jours precedents': [moment().subtract('days', 4), moment().subtract('days', 1)],
            'Ce mois': [moment().startOf('month'), moment().endOf('month')],
            'Mois précedent': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        };
        $(function() {
            $(".example1").DataTable();
            $(".tblsousfam").DataTable();
            $(".tblfam").DataTable();
            $(".tblplat").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
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
        });
    </script>
</body>

</html>