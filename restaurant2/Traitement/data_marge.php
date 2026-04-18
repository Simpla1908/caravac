<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
$type = 'restaurant';
include_once '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../../FUNCTION/restaurant.php';
include_once '../../FUNCTION/hebergement.php';
$date1 = $date2 = date('d-m-Y');
$dte_bd1 = $dte_bd2 = date('Y-m-d');
$periode = "Aujourd'hui " . dateAffiche(date('Y-m-d'));
if (isset($_POST['periode']) && isset($_POST['current'])) {
    $periode = $_POST['periode'];
    $current = $_POST['current'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $dte_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $dte_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
}
$_SESSION['dte1'] = $date1;
$_SESSION['dte2'] = $date2;
$filtre = 1;
$Sresto = $_SESSION['id_sousresto'];

//Fonctionnalite des marges
$margeVente = GetMarges($_SESSION['id_hotel'], $dte_bd1, $dte_bd2, $bdd);
$_SESSION['margeVente'] = $margeVente;
?>

<div class="box-header">
    <div class="col-lg-10">
        <h3 class="box-title">
            MARGES
            <small>(<?php echo $periode; ?>)</small>
        </h3>
    </div>
    <div class="col-lg-2 text-center">
        <a class="btn btn-default" href="impression/examples/rapportMarge.php" target="_blank"><i class="fa fa-print fa-fw"></i>&nbsp;Imprimer</a>
    </div>
</div>
<div class="box-body">
    <table id="example6" class="table table-bordered table-striped table-hover matable table-condensed">
        <thead>
            <tr>
                <th>#</th>
                <th>DESIGNATION</th>
                <th>QTE</th>
                <th>PA</th>
                <th>PV</th>
                <th>VALEUR ACHAT</th>
                <th>VALEUR VENTE</th>
                <th>BENEFICE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $j = 1;
            $totvalpa = 0;
            $totvalpv = 0;
            $totbenefice = 0;
            foreach ($margeVente as $r) {
                $designation = $r->designation;
                $tauxdollar1 = $r->taux_prix;
                //  var_dump($tauxdollar1);
                $tx_remise = $r->mont_ttc_remise;
                $qte = $r->qte;
                $pa = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $r->pa);
                //$pa = $r->pa;
                $pv = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $r->prixremise);
                //  $pv = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $r->prix);
                $valpa = $qte * $pa;
                $valpv = $qte * $pv;
                $benefice = $valpv - $valpa;
                // var_dump($margeVente);
            ?>
                <tr>
                    <td><?php echo $j ?></td>
                    <td><?php echo $designation ?></td>
                    <td><?php echo $qte ?></td>
                    <td><?php echo afficheMontant2('', $pa) ?></td>
                    <td><?php echo afficheMontant2('', $pv) ?></td>
                    <td><?php echo afficheMontant2('', $valpa) ?> </td>
                    <td> <?php echo afficheMontant2('', $valpv) ?> </td>
                    <td><?php echo afficheMontant2('', $benefice) ?> </td>
                </tr>
            <?php
                $totvalpa += $valpa;
                $totvalpv += $valpv;
                $totbenefice += $benefice;
                $j++;
            }
            ?>
        </tbody>
        <tfoot>
            <th colspan="5">TOTAL</th>
            <th><?php echo afficheMontant2('', $totvalpa) ?></th>
            <th><?php echo afficheMontant2('', $totvalpv) ?></th>
            <th><?php echo afficheMontant2('', $totbenefice) ?> </th>
        </tfoot>
    </table>
</div>