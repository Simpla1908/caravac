<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
$type = 'restaurant';
include_once '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
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
if ((in_array('RV', $_SESSION['actions']['code_actions'])) || $_SESSION['type_user'] == 1){
    $result = getFactureGlobaleByDteSresto($_SESSION['id_hotel'], $Sresto, 'restaurant', $dte_bd1, $dte_bd2, $filtre, $bdd);
}elseif((in_array('VSV', $_SESSION['actions']['code_actions']))){
    $result = getFactureGlobaleByUserByDteSresto($_SESSION['id_hotel'], $Sresto, $_SESSION['id_user'], 'restaurant', $dte_bd1, $dte_bd2, $filtre, $bdd);
}
$_SESSION['factures3'] = $result;
?>

<div class="box-header">
    <div class="col-lg-10">
        <h3 class="box-title">
            Extraits T.V.A
            <small>(<?php echo $periode; ?>)</small>
        </h3>
    </div>
    <div class="col-lg-2 text-center">
        <a class="btn btn-default" href="impression/examples/tva_collectee.php" 
           target="_blank"><i class="fa fa-print fa-fw"></i>&nbsp;Imprimer</a>
    </div>
</div>
<div class="box-body">
    <table id="example6" class="table table-bordered table-striped table-hover matable table-condensed">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>N° Facture</th>
                <th>Mode</th>
                <th>Montant Total</th>
                <th>T.V.A</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $monnaie_local = getsymbole_local();
            $i = 1;
            $total_fact = 0;
            $total_paye = 0;
            $total_tva = 0;
            foreach ($result as $r) {
                $mode = $r->modef;
                if ($mode != 'Don'){
                    $id_fact = $r->id_fact;
                    $taux_op =$r->taux;
                    $mont_tot = $r->mont_ttc;
                    $mont_tva = montant_equivalent_bdd($monnaie_local, $m_affiche, $taux_op, arrondir($r->mont_tva));
                    $valetat = $r->etat_fact;
                    if ($r->dte_timef == '') {
                        $dte = dateAffiche($r->date_edition);
                    } else {
                        $dte = dateAfficheForHr($r->dte_timef);
                    }
                    $nom_cl = $r->nom_client;
                    if (empty($nom_cl)) {
                        $nom_cl = $r->designation;
                    }
                    $user = $r->nom_user;
                    ?>
                    <tr id1="<?php echo $r->id_res ?>"
                        id2="<?php echo $r->id_fact ?>"
                        id3="<?php echo $r->res_ch_id ?>">
                        <td><?php echo $i ?></td>
                        <td><?php echo $dte; ?></td>
                        <td><?php echo $r->num_fact ?></td>
                        <td><?php echo $mode ?></td>
                        <td><?php echo afficheMontant2($m_affiche, $mont_tot); ?></td>
                        <td><?php echo afficheMontant2($m_affiche, $mont_tva); ?> </td>
                    </tr>
                    <?php
                    $i++;
                    $total_fact+=$mont_tot;
                    $total_paye+=$mont_tva;
                }
            }
            ?>
        </tbody>
        <tfoot>
        <td></td>
        <td></td>
        <td></td>
         <td></td>
        <td><?php echo afficheMontant2($m_affiche, $total_fact); ?></td>
        <td><?php echo afficheMontant2($m_affiche, $total_paye); ?></td>
        </tfoot> 

    </table> 
</div>
