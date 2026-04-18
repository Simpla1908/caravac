<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
$statut='non';
if (isset($_POST['filtre'])) {
    $statut=$_POST['filtre'];
   $_SESSION['services'] = getlistpaiementGlobal($_SESSION['id_hotel'], $tauxdollar, $taux_op, $m_affiche, $temps_sortie,$statut, $bdd);
    $nbre_rows = count($_SESSION['services']['id_res']); 
}  else {
    $_SESSION['services'] = getlistpaiementGlobal($_SESSION['id_hotel'], $tauxdollar, $taux_op, $m_affiche, $temps_sortie,$statut, $bdd);
    $nbre_rows = count($_SESSION['services']['id_res']);
}

?>
<?php
$j = 1;
$totaux_paye = 0;
$totaux_fact = 0;
for ($i = 0; $i <= $nbre_rows - 1; $i++) {
    $id_res = $_SESSION['services']['id_res'][$i];
    $num_reserv = $_SESSION['services']['num_reserv'][$i];
    $nom_client = $_SESSION['services']['nom_client'][$i];
    $nom_respo = $_SESSION['services']['nom_respo'][$i];
    $montant_total = $_SESSION['services']['montant_total'][$i];
    $montant_paye = $_SESSION['services']['montant_paye'][$i];
    $reste = $montant_total - $montant_paye;
    ?>
    <tr class="odd gradeX">
        <td><?php echo $j ?></td>
        <td><?php echo $num_reserv ?></td>
        <td><?php echo $nom_client ?></td>
        <td><?php echo $nom_respo ?></td>
        <td><?php echo afficheMontant($m_affiche, $montant_total) ?></td>
        <td><?php echo afficheMontant($m_affiche, $montant_paye) ?></td>
        <td><?php echo afficheMontant($m_affiche, abs($reste));
            if($reste>0){?>
            <a title="Litige">(L)</a>
            <?php }else if($reste<0){ ?>
            <a title="Remboursement">(R)</a>
            <?php } ?>
        </td>
        <td>
            <a href="impression/factureglobale.php?id_res=<?php echo $id_res; ?>" 
               title="Générer facture"
               class="btn btn-info btn-xs"
               target="_blank">Facture
            </a>
            <?php if($reste>0){ ?>
            <a
                id_res="<?php echo $id_res; ?>"
                nom_cl="<?php echo $nom_client; ?>"
                href="#" data-toggle="modal" data-target="#myModal2"
                title="enregistrer le paiement"
                class="btn btn-info btn-xs btn_modal_payer"> Régler
            </a>
            <?php } if($montant_paye>0){ ?>
            <a href="detailpaiement.php?id_res=<?php echo $id_res; ?>"
               title="Générer facture"
               class="btn btn-info btn-xs">Détails
            </a>
            <?php } ?>
        </td>
    </tr>
    <?php
    $totaux_fact+=$montant_total;
    $totaux_paye+=$montant_paye;
    $j++;
}
$totaux_fact = afficheMontant($m_affiche, $totaux_fact);
$totaux_paye = afficheMontant($m_affiche, $totaux_paye);
?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?php echo $totaux_fact ?></td>
    <td><?php echo $totaux_paye ?></td>
    <td></td>
    <td></td>
</tr>

