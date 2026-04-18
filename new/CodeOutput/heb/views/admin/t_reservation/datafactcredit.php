<?php
//Mise en session pour impression
$_SESSION['credit'] = array();
$_SESSION['credit']['num'] = array();
$_SESSION['credit']['cl'] = array();
$_SESSION['credit']['resp'] = array();
$_SESSION['credit']['dte'] = array();
$_SESSION['credit']['ttc'] = array();
$_SESSION['credit']['pay'] = array();
$_SESSION['credit']['rest'] = array();
//Fin mise en session
$tot1 = 0;
$tot2 = 0;
$tot3 = 0;
$i = 1;
foreach ($result as $rows) {
    if ($rows->mode == 'Credit' && $rows->heb == 1) {
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
        //    $totpaye=TotalPayeSejour($bdd,$id_fact);
        $infofactch = InfosFactByChambre2($id_fact, $bdd);
        $id_resch = $infofactch->id_resch;
        $totpaye = TotalPayeByChambre($bdd, $id_resch);
        //    $totpaye = montant_equivalent_bdd(getsymbole_local(),$_SESSION['Paie_affiche'],$taux,$totpaye);
        $reste = $totttc - $totpaye;
        $tot1 += $totttc;
        $tot2 += $totpaye;
        $tot3 += $reste;
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
            <!--<td><?php // echo dateAffiche($dte_a); 
                    ?></td>-->
            <!--<td><?php // echo dateAffiche($dte_s); 
                    ?></td>-->
            <!--<td><?php // echo $nuitee; 
                    ?></td>-->
            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $totttc); ?></td>
            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $totpaye); ?></td>
            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $reste); ?></td>
            <td class="table-actions">
                <div class="btn-group">
                    <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=detfact2&id=<?php echo $id_fact; ?>" class="btn btn-primary btn-xs tip" title="Détail de la facture">
                        <i class="fa fa-list fa-fw"></i>
                    </a>
                </div>
            </td>
        </tr>
<?php
        array_push($_SESSION['credit']['num'], $num_fact);
        array_push($_SESSION['credit']['cl'], $nom_client);
        array_push($_SESSION['credit']['resp'], $nom_respo);
        array_push($_SESSION['credit']['dte'], dateAffiche($dte_edt));
        array_push($_SESSION['credit']['ttc'], afficheMontant($_SESSION['Paie_affiche'], $totttc));
        array_push($_SESSION['credit']['pay'], afficheMontant($_SESSION['Paie_affiche'], $totpaye));
        array_push($_SESSION['credit']['rest'], afficheMontant($_SESSION['Paie_affiche'], $reste));
    }
}; ?>
<tr>
    <!--<td></td>-->
    <td><b>Total</b></td>
    <td></td>
    <td></td>
    <!--    <td></td>
    <td></td>-->
    <td></td>
    <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot1); ?></b></td>
    <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot2); ?></b></td>
    <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot3); ?></b></td>
    <td></td>
</tr>
<?php
$_SESSION['credit_tot1'] = afficheMontant($_SESSION['Paie_affiche'], $tot1);
$_SESSION['credit_tot2'] = afficheMontant($_SESSION['Paie_affiche'], $tot2);
$_SESSION['credit_tot3'] = afficheMontant($_SESSION['Paie_affiche'], $tot3);
