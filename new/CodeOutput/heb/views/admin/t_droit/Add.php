<?php
// Initialisation de la session
session_start();
include('./Amelioration/bdd/connexion .php');
if (isset($_GET['id_site'])) {
    $id_site = $_GET['id_site'];

    include('./actions_site.php');
    $_SESSION['id_hotel'] = $id_site;
} else {
    $id_site = $_SESSION['id_hotel'];
}
$requete = $bdd->prepare("SELECT h.nom_hotel FROM  t_hotel h WHERE h.id_hotel=:id_site");
$requete->BindParam(':id_site', $id_site);
$requete->execute();
$sites = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($sites as $s) {
    $nom_site = $s->nom_hotel;
    $_SESSION['nom_hotel'] = $nom_site;
}
include('./headerRec_popup.php');
?>
<?php
include('menu_Rec_tab.php');
?>
<style type="text/css">
    div.modal-content{
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        -o-box-shadow: none;
        box-shadow: none;
    }

    .modal-dialog {
        box-shadow: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        -moz-transition: none;
        -webkit-transition: none;
    }

</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Tableau de bord</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <?php if (in_array('VMH', $_SESSION['actions']['code_actions'])) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <!--<i class="fa fa-comments fa-5x"></i>-->
                                <i class="fa fa-bed fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-left">
                                <div class="huge">Hebergement</div>
                            </div>
                        </div>
                    </div>
                        <?php if ($_SESSION['id_hotel'] == 186) { ?>
                           <a href="../heb/CodeOutput/index.php?pg=admin&view=module&do=heb">
                                <div class="panel-footer">
                                    <span class="pull-left">Go...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        <?php } else { ?>
                            <a href="tableaudebord_hebergement.php">
                            <div class="panel-footer">
                                <span class="pull-left">Go...</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (in_array('VMR', $_SESSION['actions']['code_actions'])) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cutlery fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-left">
                                <div class="huge">Restaurant</div>
                            </div>
                        </div>
                    </div>
                        <?php if ($_SESSION['id_hotel'] == 186 || $_SESSION['id_hotel'] == 107) { ?>
                            <a href="../restaurant/index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Go...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        <?php } else { ?>
                            <a href="../restaurant2/index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Go...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (in_array('VMS', $_SESSION['actions']['code_actions'])) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-database fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-left">
                                <div class="huge">Stock</div>
                            </div>
                        </div>
                    </div>
                        <?php if ($_SESSION['id_hotel'] == 186) { ?>
                            <a href="../Stock/index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Go...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        <?php } else { ?>
                            <a href="../Stock2/index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Go...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (in_array('VMC', $_SESSION['actions']['code_actions'])){ ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-red">
                    <div class="panel-heading" >
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-left">
                                <div class="huge">Caisse</div>
                            </div>
                        </div>
                    </div>
                        <a href="../Caisse/index.php">
                            <div class="panel-footer">
                                <span class="pull-left">Go...</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                </div>
            </div>
        <?php } ?>
        <?php if (in_array('VRH', $_SESSION['actions']['code_actions'])) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel  panel-primary">
                    <div class="panel-heading" >
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-left">
                                <div class="huge" title="Ressources Humaines">Res. Humaines</div>
                            </div>
                        </div>
                    </div>

                    <a href="../new/CodeOutput/index.php?pg=admin&view=module&do=rh">
                        <div class="panel-footer">
                            <span class="pull-left">Go...</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
        <?php if (in_array('VMFACT', $_SESSION['actions']['code_actions'])) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel  panel-green">
                    <div class="panel-heading" >
                        <div class="row">
                            <div class="col-xs-3">
                                <!--<i class="fa fa-briefcase fa-4x"></i>-->
                                <i class="fa fa-file-text-o fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-left">
                                <div class="huge" title="Facturation">Facturation</div>
                            </div>
                        </div>
                    </div>
                    <a href="../new/CodeOutput/index.php?pg=admin&view=module&do=fact">
                        <div class="panel-footer">
                            <span class="pull-left">Go...</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
        <?php if (in_array('VMCR', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 0) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary" >
                    <div class="panel-heading" >
                        <div class="row" >
                            <div class="col-xs-3">
                                <i class="fa fa-cogs fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-left">
                                <div class="huge">Configuration</div>
                            </div>
                        </div>
                    </div>
                    <a href="tableaudebord_config.php">
                        <div class="panel-footer">
                            <span class="pull-left">Go...</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
     
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- /#wrapper -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>

    $(document).ready(function () {
        donnees = '';
        $.ajax({
            url: 'Traitement/first_conect.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data == 'true') {
                    $('.bs-example-modal-lg').modal({
                        keyboard: false,
                        backdrop: 'static'
                    });

                    $('.reglage').hide();
                    $('.bs-example-modal-lg').modal('show');

                }
            }
        });


        $('.hotel_id').change(function (e) {
            var id_hotel = $(this).val();
            $(".valider").attr("id1", id_hotel);
        });


        $('.valider').click(function (e) {
            var hotel = $(this).attr('id1');
            var url = $(this).attr('id');

            if (hotel != '') {
                $.ajax({
                    url: './utilisateur/affectation_hotel_id_session.php',
                    async: true,
                    type: 'POST',
                    data: "hotel=" + hotel,
                    global: false,
                    cache: false,
                    success: function (json) {
                        location.href = url + '?hotel=' + hotel;
                    }
                });
            }
        });
    });

    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
</script>
<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../bootstrap.timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>
<script src="js/infos_admin.js"></script>

<script type="text/javascript">
    $('#checkin').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        defaultTime: false
    });

    $('#checkout').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        defaultTime: false
    });
</script>
