<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
include_once('Amelioration/reglage/recuperer_valeurs_reglages.php');
include_once '../FUNCTION/hebergement.php';
$id_hotel = $_SESSION['id_hotel'];
include('Receptionniste.php');
include('headerRec.php');
include('menu_Rec.php');
//$result = ListPaiementPartenaire($id_hotel, $bdd);
//$_SESSION['result_facture']=$result;
$idrespo=$_GET['id_respo'];
$requete = $bdd->prepare("SELECT * FROM v_reglement WHERE id_respo=:id_respo  ORDER BY nom_client");
$requete->BindParam(':id_respo',$idrespo);
$requete->execute();
$result= $requete->fetchAll(PDO::FETCH_OBJ);
//var_dump($result);
//foreach ($reglages as $op) {
//    $remise = $op->remise;
//    $majoration = $op->majoration;
//    $tauxdollar = $op->tauxdollar;
//    $tva = $op->tva;
//    $temps_sortie = $op->temps_regl;
//    $m_insert = $op->m_insert;
//    $m_affiche = $op->m_affiche;
//}
?>
<div id="page-wrapper">
    <div class="col-lg-12">
        <h3 class="page-header">Paiements à crédit</h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-user"></i> Détails Clients Partenaire : Vodacom
                <div class="pull-right"><span class="label label-danger"> Monnaie: USD </span></div>
            </div>
            <div class="panel-body"style="padding: 1px;">
                <br>
                <div class="table-responsive" style="padding: 1px;">
                    <table class="table table-condensed dataTables-example" id="dataTables-example1">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>N° Facture</th>
                                 <th>Date</th>
                                <th>Client</th>
                                <th>Montant total</th>
                                <th>Montant payé</th>
                                <th>Reste</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $tot_paye = 0;
                            $tot_tot = 0;
                            $tot_reste = 0;
                            foreach ($result as $r):
                                $montant_paye = affiche_montant($m_affiche, $tauxdollar, $r->montant_fc, $r->montant_dollar);
                                if ($r->type == 'restaurant') {
                                    $mont = $r->mont_ttc_remise;
                                } else {
                                    $mont_rmz = ($r->montant_total*$r->remise)/100;
                                    $mont = $r->montant_total-$mont_rmz;
                                }
                                $montant_total = affiche_montant($m_affiche, $tauxdollar, 0,$mont);
                                $reste = $montant_total - $montant_paye;
                                ?>

                                <tr class="gradeX">
                                    <td><?php echo $i ?></td>
                                     <td><?php echo $r->num_fact; ?></td>
                                      <td><?php echo $r->date_edition; ?></td>
                                    <td><?php echo $r->nom_client; ?></td>
                                    <td><?php echo $montant_total . ' ' . $m_affiche; ?></td>
                                    <td><?php echo $montant_paye . ' ' . $m_affiche; ?></td>
                                    <td><?php echo $reste . ' ' . $m_affiche; ?></td>
                                </tr>
                                <?php
                                $i++;
                                $tot_paye = $tot_paye + $montant_paye;
                                $tot_tot = $tot_tot + $montant_total;
                                $tot_reste = $tot_reste + $reste;
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                 <th colspan="1"></th>
                                 <th colspan="1"></th>
                                  <th colspan="1"></th>
                                 <th colspan="1">Total</th>
                                <th><?php echo $tot_tot . ' ' . $m_affiche; ?></th>
                                <th><?php echo $tot_paye . ' ' . $m_affiche; ?></th>
                                <th><?php echo $tot_reste . ' ' . $m_affiche; ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.table-responsive -->
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

<!-- modals -->
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


    });

</script>

