<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
include_once('Amelioration/reglage/recuperer_valeurs_reglages.php');
include_once '../FUNCTION/hebergement.php';
include 'Traitement_reservation/maj_mont_tot_fact.php';
$id_hotel = $_SESSION['id_hotel'];
include('Receptionniste.php');
include('headerRec.php');
include('menu_Rec.php');
//$result = ListPaiementPartenaire($id_hotel, $bdd);
//$_SESSION['result_facture']=$result;
?>
<div id="page-wrapper">
    <div class="col-lg-12">
        <h3 class="page-header">Paiements à crédit</h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-user"></i> Clients Partenaire
            </div>
            <div class="panel-body">

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="profile-pills">
                        <!--<h4>Clients Partenaire</h4><br>-->
                        <!-- Nav tabs -->
                       <!-- <ul class="nav nav-tabs">
                            <li class="active"><a href="#home1" data-toggle="tab"><i class="fa fa-dashboard fa-fw"></i> En cours</a>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar fa-fw"></i> Périodique</a>
                                <ul class="dropdown-menu">
                                    <li style="padding:10px;">
                                        <form action="rec_liste_reservation_periodique.php" method="post" name="periode">
                                            <fieldset>
                                                <div style="border:1px solid #dddddd; padding:10px;">
                                                    <table width="300" border="0">
                                                        <tr>
                                                            <td width="120"> <label for="date">Date de debut&nbsp;:</label></td>
                                                            <td width="5"></td>
                                                            <td><input id="datetimepickerOcc"  type="date" class="form-control date_d"  name="date_d" required >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        <tr height="15">
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <label for="date">Date de fin&nbsp;:</label></td>
                                                            <td width="5"></td>
                                                            <td>
                                                                <input id="datetimepickerLib"  type="date" class="form-control date_f"  name="date_f" required >
                                                            </td>
                                                        </tr>
                                                        <tr height="15">
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td width="5"></td>
                                                            <td align="left"> <button  name="sauvegarder" type="submit" class="btn btn-primary">Valider</button></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#messages1" data-toggle="tab"><i class="fa fa-history fa-fw"></i> Historique</a>
                            </li>
                            <li class="pull-right"><a href="#"><span class="label label-danger"> Monnaie: USD </span></a>
                            </li>
                        </ul>-->
                        <!-- / Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home1">
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-condensed dataTables-example" id="dataTables-example1">
                                        <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Partenaire</th>
                                            <th>Montant total</th>
                                            <th>Montant payé</th>
                                            <th>Reste</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        $tot_paye1 = 0;
                                        $tot_tot1=0;
                                        $tot_reste1=0;
                                        $montant_total=0;
                                        $mont=0;
                                        //var_dump($result);
                                        $sql0 = 'SELECT DISTINCT  t.id_respo,t.entreprise FROM t_responsable t,v_reglement v WHERE t.id_respo=v.id_respo AND company_id=:company_id';
                                        $requete0 = $bdd->prepare($sql0);
                                        $requete0->BindParam(':company_id',$_SESSION['company_id']);
                                        $requete0->execute();
                                        $result0 = $requete0->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result0 as $r0) {
                                            $tot_paye = 0;
                                            $tot_tot=0;
                                            $tot_reste=0;
                                            $sql = 'SELECT * FROM v_reglement WHERE id_respo=:id_respo';
                                            $requete = $bdd->prepare($sql);
                                            $requete->BindParam(':id_respo',$r0->id_respo);
                                            $requete->execute();
                                            $result = $requete->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($result as $r) {
                                                $montant_paye = affiche_montant($m_affiche, $tauxdollar, $r->montant_fc, $r->montant_dollar);
                                                if ($r->type == 'restaurant') {
                                                    $mont = $r->mont_ttc_remise;
                                                } else {
                                                    $mont_rmz = ($r->montant_total*$r->remise)/100;
                                                    $mont = $r->montant_total-$mont_rmz;
                                                }
                                                $montant_total = affiche_montant($m_affiche, $tauxdollar, 0, $mont);
                                                $reste = $montant_total - $montant_paye;
                                                $i++;
                                                $tot_paye = $tot_paye + $montant_paye;
                                                $tot_tot = $tot_tot + $montant_total;
                                                $tot_reste = $tot_reste + $reste;
                                            }

                                            ?>

                                            <tr class="gradeX">
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $r0->entreprise; ?></td>
                                                <td><?php echo round($tot_tot,2) . ' ' . $m_affiche; ?></td>
                                                <td><?php echo round($tot_paye,2). ' ' . $m_affiche; ?></td>
                                                <td><?php echo round($tot_reste,2) . ' ' . $m_affiche; ?></td>
                                                <td class="center">
                                                    <a href="#" montant="<?php echo round($tot_tot,2) ?>"
                                                       id_respo="<?php echo $r0->id_respo ?>" title="Payer"
                                                       class="btn btn-warning btn-xs payer"><i
                                                            class="fa fa-money"></i> Payer </a>
                                                    <a href="details_paiement_credit.php?id_respo=<?php echo $r0->id_respo; ?>"
                                                       title="Afficher le detail" class="btn btn-info btn-xs"><i
                                                            class="fa fa-list"></i> Détails </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $tot_paye1+= $tot_paye;
                                            $tot_tot1+= $tot_tot;
                                            $tot_reste1+=$tot_reste;
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr class="gradeU">
                                            <th colspan="2">Total</th>
                                            <th><?php echo round($tot_tot1,2) . ' ' . $m_affiche; ?></th>
                                            <th><?php echo round($tot_paye1,2) . ' ' . $m_affiche; ?></th>
                                            <th><?php echo round($tot_reste1,2) . ' ' . $m_affiche; ?></th>
                                            <th colspan="1"></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <div class="tab-pane fade" id="profile1" style="padding-left:30px;">
                                <br>
                                <div class="row">
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Date debut&nbsp;:</label>
                                                    <input class="form-control" id="date_d" name="date_d" required="required">
                                                </div>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Date fin&nbsp;:</label>
                                                    <input class="form-control" id="date_f" name="date_f" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-4" style="margin-top:22px;">
                                                <button type="submit" class="btn btn-primary" id="btn_valider_perio">Valider</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php include('paiecredit_clientpartenaire.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="messages1">
                                <br>
                                <?php include('paiecredit_clientpartenaire.php'); ?>
                            </div>
                        </div>
                        <!-- / Tab panes -->
                    </div>
                </div>
                <!--/tab-content-->
            </div>
            <!-- /.panel-body -->
        </div>
        <!--/.panel-default-->
    </div> 
    <!-- /.col-lg-12 -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- modals Paiement -->
<?php include('./modal_paiement_credit.php') ?>


<!-- jQuery -->
<script src="datepicker/jquery.js"></script>
<script src="datepicker/jquery.datetimepicker.js"></script>
<script>
    $('.date_d').datetimepicker();
    $('.date_f').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!--<script src="../js/bootstrap-modal.js"></script>-->
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
//        alert('gghh');
        $(".div_caisse_histo").load('./Amelioration/caisse/caisse_global_histo.php');
        $(".div_caisse").load('./Amelioration/caisse/paiecash_clientoccasionnel_encours.php?id_hotel=0');
        $('.dataTables-example').dataTable();
        $("#btn_valider_encours").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel').val();
//                    alert(id_hotel);
            $.ajax({
                url: './Amelioration/caisse/caisse_global.php?id_hotel=' + id_hotel,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse").empty().append(html);
//                              alert(html);

                }
            });
        });
        $("#btn_valider_perio").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel_p').val();
            var date_d = $('#date_d').val();
            var date_f = $('#date_f').val();
//                    alert(date_d+date_f);
            $.ajax({
                url: './Amelioration/caisse/caisse_global_perio.php?id_hotel=' + id_hotel + "&date_d=" + date_d + "&date_f=" + date_f,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse_perio").empty().append(html);
//                              alert(html);

                }
            });
        });
        $("#btn_valider_histo").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel_h').val();
            $.ajax({
                url: './Amelioration/caisse/caisse_global_histo.php?id_hotel=' + id_hotel,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse_histo").empty().append(html);
//                              alert(html);

                }
            });
        });

    $('.payer').click(function (e) {
            var id_respo = $(this).attr("id_respo");
            var montant_total = $(this).attr("montant");
            $("#id_respo").val(id_respo);
            $("#montant_total").val(montant_total);
            $(".bs-example-modal-lg").modal('show');
        });
        $('#btn_paie_credit_valider').click(function (e) {
            e.preventDefault();
            var donnees = $('#formPay').serialize();
            $.ajax({
                 url: 'Traitement_reservation/reglement_facture_credit.php',
                 type: 'POST',
                data: donnees,
                success: function (html) {
                     $(".bs-example-modal-lg").modal('hide');
                    $("#page-wrapper").load('partenairecredit_ajax.php');


                }
            });
        });
    });

</script>

