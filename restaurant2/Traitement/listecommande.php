<?php
session_start();
include '../bdd/connexion.php';
include('../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
$num_reserv = 0;
include './bc_commandes.php';
include '../../FUNCTION/hebergement.php';

?>
<div class="row">
    <div class="col-lg-12" id="listecommande">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    Liste des commandes
                    <a href="#" class="btn btn-primary pull-right suivi_activite_cmd" data-toggle="modal" data-target="#myModal_suivi"><b><i class="fa fa-sitemap fa-fw"></i> Suivis d'activités</b></a>
                </h4>            </div>
            <!-- /.panel-heading -->
            <div class="panel-body listetable_client">
                <table id="example1"
                       class="table table-bordered  table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Réference</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Vendeur</th>
                        <th>Montant HT</th>
                        <th>Montant TTC</th>
                        <th>Statut</th>
                    </tr>
                    </thead>
                    <tbody id="commandes">
                    <?php
                    $i = 1;
                    $tot_ttc=0;
                    $tot_usd_cash = 0;
                    $tot_cdf_cash= 0;
                    $tot_tva = 0;
                    $tot_credit = 0;
                    foreach ($commandes as $tbl):
                        $netApayer = getNetApayerResto($tbl->num_reserv, $tbl->id_client, $_SESSION['id_hotel'], $tauxdollar, $m_affiche, $bdd);
                        $array_montant = MontantUSDCDF($tbl->num_reserv, $tbl->id_client, $_SESSION['id_hotel'], $tauxdollar, $m_affiche, $bdd);
                        if ($m_affiche == 'USD') {
                            $mont_ttc = round($tbl->mont_ttc_remise, 2);
                            $mont_ht = round($tbl->montant_total, 2);
                            $mont_tva=round($tbl->mont_tva, 2);
                        } else {
                            $mont_ttc = round($tbl->mont_ttc_remise * $tauxdollar, 2);
                            $mont_ht = round($tbl->montant_total * $tauxdollar, 2);
                            $mont_tva=round($tbl->mont_tva* $tauxdollar,2);
                        }
                        if ($netApayer == 0) {
                            $etat = 'paye';
                            $etatlib = 'Payée';
                        } elseif ($netApayer > 0 && $netApayer < $mont_ttc) {
                            $etat = 'ouverte';
                            $etatlib = 'Ouverte';
                        } else {
                            $etat = 'nonpaye';
                            $etatlib = 'Non Payée';
                            $tot_credit+=$mont_ttc;
                        }
                        $tot_ttc+=$mont_ttc;
                        $tot_tva+=$mont_tva;
                        $tot_usd_cash+=$array_montant['usd'];
                        $tot_cdf_cash+= $array_montant['cdf'];
                        ?>
                        <tr id1="<?php echo $tbl->num_reserv ?>"
                            id2="<?php echo $tbl->num_reserv ?>"
                            id3="<?php echo $etat ?>">
                            <td><?php echo $i ?></td>
                            <td><?php echo $tbl->num_reserv ?></td>
                            <td><?php if (empty($tbl->client_designation)) {
                                    echo $tbl->nom_client;
                                } else {
                                    echo $tbl->client_designation;
                                } ?> </td>
                            <td><?php echo $tbl->date_res ?></td>
                            <td><?php echo $tbl->user ?> </td>
                            <td><?php echo $mont_ht . ' ' . $m_affiche; ?></td>
                            <td><?php echo $mont_ttc . ' ' . $m_affiche; ?></td>
                            <td><?php echo $etatlib; ?></td>

                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
                <form id="form_datas_suivie" hidden="hidden">
                    <input name="tot_usd_cash" id="tot_usd_cash" type="text" value=" <?php echo round($tot_usd_cash,2);?>"/>
                    <input name="tot_cdf_cash" id="tot_cdf_cash" type="text" value=" <?php echo round($tot_cdf_cash,2);?>"/>
                    <input name="tot_credit" id="tot_credit" type="text" value=" <?php echo round($tot_credit,2);?>"/>
                    <input name="tot_credit_eq" id="tot_credit_eq" type="text" value=" <?php
                    if($m_affiche=='USD'){
                        $m_affiche_eq='CDF';
                        $tot_credit_eq=$tot_credit* $tauxdollar;
                    }else{
                        $m_affiche_eq='USD';
                        $tot_credit_eq=$tot_credit/$tauxdollar;
                    }
                    echo round($tot_credit_eq,2);
                    ?>"/>
                    <input name="monaie_aff" id="monaie_aff" type="text" value=" <?php echo $m_affiche;?>"/>
                    <input name="monaie_aff_eq" id="monaie_aff_eq" type="text" value=" <?php echo $m_affiche_eq;?>"/>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $(function () {
                $("#example41").DataTable();
            });
    });

</script>