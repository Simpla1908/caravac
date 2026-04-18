<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
include '../../language/eng.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include './Panier.php';
$cmd_id = 0;
$dte_cmd = 0;
$client = '';
$numfact = '';

$prods_groupes = $prods_details = array();
if (isset($_POST['cmd_id']) && isset($_POST['dte_cmd'])) {
    $cmd_id = $_POST['cmd_id'];
    $dte_cmd = $_POST['dte_cmd'];
    $client = $_POST['client'];
    $numfact = $_POST['numfact'];
    $prods_groupes = SelectProduitsMonitoringGroupes($cmd_id, $bdd);
    $prods_details = SelectProduitsMonitoringDetails($cmd_id, $bdd);
}
?>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">MONITORING
                <button type="button" class="btn btn-default pull-right" id="retourListTicket"><i class="ion-chevron-left"></i><i class="ion-chevron-left"></i> Retour
                </button>
            </h2>
        </div>
    </div>
    <div class="row">
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> TABLE/CLIENT:<?php echo $client; ?><small class="pull-right">Date:<?php echo dateAffiche($dte_cmd); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>HEURE</th>
                                <th>SERVEUR</th>
                                <th>DESIGNATION</th>
                                <th>QTE</th>
                                <th>PRIX</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ttc = 0;
                            foreach ($prods_groupes as $pg) {
                                $designation = $pg->designation;
                                $qtegr = $pg->qte;
                                $produit_idgr = $pg->produit_id;
                            ?>
                                <?php
                                $tarif = 0;
                                foreach ($prods_details as $pd) {

                                    $produit_id = $pd->produit_id;
                                    if ($produit_idgr == $produit_id) {
                                        $heure = $pd->heure;
                                        $agent = $pd->agent;
                                        $des = $pd->designation;
                                        $des_plt = $pd->description;
                                        $qte = $pd->qte;
                                        $prix = $pd->prix;
                                        $monnaie = $pd->monnaie;
                                        $repas = $pd->repas;
                                        $suppr = $pd->suppr;
                                        $tarif = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $prix);
                                        $tarif1 = $tarif * $qte;
                                ?>
                                        <tr>
                                            <td><?php echo $heure; ?></td>
                                            <td><?php echo $agent; ?></td>
                                            <td><?php echo $des . '</br>' . ' ' . $des_plt; ?></td>
                                            <td><?php echo $qte; ?></td>
                                            <td><?php echo afficheMontant2($m_affiche, $tarif1) ?></td>
                                        </tr>
                                <?php }
                                    $tarif2 = $tarif * $qtegr;
                                } ?>
                                <tr>
                                    <td colspan="3"><b><?php echo $designation . ' Total'; ?></b></td>
                                    <td><b><?php echo $qtegr; ?></b></td>
                                    <td><b><?php echo afficheMontant2($m_affiche, $tarif2) ?></b></td>
                                </tr>
                            <?php
                                $ttc += $tarif2;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4"><span class="text-right pull-right">TTC</span></th>
                                <th><?php echo afficheMontant2($m_affiche, $ttc) ?></th>
                            </tr>

                        </tfoot>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <input type="hidden" id="cmd_id" value="<?php echo $cmd_id; ?>">
                    <input type="hidden" id="dte_cmd" value="<?php echo $dte_cmd; ?>">
                    <input type="hidden" id="client" value="<?php echo $client; ?>">
                    <input type="hidden" id="numfact" value="<?php echo $numfact; ?>">
                    <a id="btn_impression_monitoring" href="#" target="_blank" class="btn btn-primary pull-right tip " style="margin-right: 5px;"><i class="fa fa-print"></i> Imprimer</a>
                </div>
            </div>
        </section>
    </div>
</div>