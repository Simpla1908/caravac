<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
$_SESSION['acompte']=getlistpaiementAcompte($_SESSION['id_hotel'],$bdd,$m_affiche,$tauxdollar);
$nbre_rows = count($_SESSION['acompte']['id_res']);
?>
<?php
$j = 1;
$totaux_paye=0;
$totaux_fact=0;
for ($i = 0; $i <= $nbre_rows - 1; $i++) {
    $id_res = $_SESSION['acompte']['id_res'][$i];
    $num_reserv = $_SESSION['acompte']['num_reserv'][$i];
    $nom_client = $_SESSION['acompte']['nom_client'][$i];
    $nom_respo = $_SESSION['acompte']['nom_respo'][$i];
    $montant_total =$_SESSION['acompte']['montant_total'][$i];
    $montant_paye = $_SESSION['acompte']['montant_paye'][$i];
    $reste = $montant_total - $montant_paye;
    ?>
    <tr class="odd gradeX">
        <td><?php echo $j ?></td>
        <td><a title="Cliquez-ici pour voir les détails de cette réservation" href="details_hebergement.php?id_res=<?php echo $id_res ?>"><?php echo $num_reserv ?></a></td>
        <td><?php echo $nom_client ?></td>
        <td><?php echo $nom_respo ?></td>
        <td><?php echo afficheMontant($m_affiche, $montant_total) ?></td>
        <td class="text-success"><?php echo afficheMontant($m_affiche, $montant_paye) ?></td>
        <td><?php echo afficheMontant($m_affiche, abs($reste)) ?></td>
    </tr>
    <?php
    $totaux_fact+=$montant_total;
    $totaux_paye+=$montant_paye;
    $j++;
}
$totaux_fact=afficheMontant($m_affiche,$totaux_fact);
$totaux_paye_usd=$totaux_paye/$tauxdollar;
$totaux_paye=afficheMontant($m_affiche,$totaux_paye);
?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?php// echo $totaux_fact ?></td>
    <th class="text-success"><?php echo $totaux_paye.' Soit '.$totaux_paye_usd.' USD' ?></th>
    <td></td>
</tr>

