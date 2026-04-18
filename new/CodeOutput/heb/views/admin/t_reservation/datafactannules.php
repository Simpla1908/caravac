<?php
$tot1 = 0;
$tot2 = 0;
$tot3 = 0;
$tot4 = 0;

$i = 1;
foreach ($result as $rows) {
    if ($rows->heb == 0) {
        $id_fact = $rows->id_fact;
        $taux = $rows->taux;
        $num_fact = $rows->num_fact;
        $dte_a = $rows->dte_a;
        $dte_s = $rows->dte_s;
        $nom_client = $rows->nom_client;
        $nom_respo = $rows->entreprise;
        $dte_edt = $rows->dte;
        $nuitee = NbJours($dte_a, $dte_s);
        $totttc = FactureMontHeb($id_fact, $_SESSION['Paie_affiche'], $hrs_sys, $checkout, $bdd);
        $infofactch = InfosFactByChambre2($id_fact, $bdd);
        $id_resch = $infofactch->id_resch;
        $obser = $infofactch->justification;
        $totpaye = TotalPayeByChambre($bdd, $id_resch);
        $totpaye2 = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->montpaie);
        if ($totpaye2 > 0) {
            $totpaye = $totpaye2;
        }
        $montpenalite = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $rows->montpenalite);
        $reste = $totttc - $totpaye;
        $tot1 += $totttc;
        $tot4 += $montpenalite;
        $tot3 += $totpaye;
        $colorstatut = '';
        $statut = $rows->etat;
        if ($statut == 'occupe') {
            $colorstatut = 'bg-lime';
        } elseif ($statut == 'reserve') {
            $colorstatut = 'bg-red';
        }
        $totservices = 0;
?>
        <tr>
            <td><?php echo $num_fact; ?></td>
            <td><?php echo $nom_client; ?></td>
            <td><?php echo $nom_respo; ?></td>
            <td><?php echo dateAffiche($dte_edt); ?></td>
            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $totttc); ?></td>
            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $totpaye); ?></td>
            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montpenalite); ?></td>
            <td><?php echo $obser; ?></td>
            <td class="table-actions">
                <div class="btn-group">
                    <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=detfact2&id=<?php echo $id_fact; ?>" class="btn btn-primary btn-xs tip" title="Détail de la facture">
                        <i class="fa fa-list fa-fw"></i>
                    </a>
                </div>
            </td>
        </tr>
<?php }
}; ?>
<tr>
    <td><b>Total</b></td>
    <td></td>
    <td></td>
    <td></td>
    <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot1); ?></b></td>
    <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot3); ?></b></td>
    <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot4); ?></b></td>
    <td></td>
    <td></td>

</tr>